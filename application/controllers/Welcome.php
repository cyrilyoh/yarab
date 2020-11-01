<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
        //call CodeIgniter's default Constructor
        parent::__construct();
        
        if ( ! $this->session->userdata('email') ||  $this->session->userdata('type')!="admin")
        {
            if ($this->router->fetch_method()!='login' && $this->router->fetch_method()!='index' && $this->router->fetch_method()!='register' && $this->router->fetch_method()!='saveuser' && $this->router->fetch_method()!='verify_email')
            {
                redirect('/');
            }
        }
        $this->load->model('User_Model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		$this->load->view('login');	
	}
	public function register()
	{
		$cap = array('capt' => rand(1000,9999));
		$this->session->set_userdata($cap);
		$this->load->view('register',$cap);	
	}
	public function login()
    {
         $this->form_validation->set_rules('email', 'Email', 'required');
         $this->form_validation->set_rules('password', 'Password', 'required');
			
         if ($this->form_validation->run())
         {
             $email = $this->input->post('email');
             $password = md5($this->input->post('password'));
             $logdet = $this->User_Model->login($email, $password);
             if($logdet!="")
             {
                $session_data = array('email' => $email, 'type' => $logdet[0]->type, 'sub' => $logdet[0]->subscription);  
                $this->session->set_userdata($session_data);
                if($logdet[0]->type=="user")
                {
                	redirect('Usercon/home');
                } else {
                	redirect('welcome/home');
                }  
             } else {
                 $this->session->set_flashdata('validation', 'Invalid Username and Password');
                 redirect('/');
             }
         } else {
         	$this->index();
         }
    }
    public function saveuser()
    {
         $this->form_validation->set_rules('fname', 'First Name', 'required');
         $this->form_validation->set_rules('email', 'Email', 'required');
         $this->form_validation->set_rules('password', 'Password', 'required');
			
         if ($this->form_validation->run() == FALSE) { 
            $cap = array('capt' => rand(1000,9999));
			$this->session->set_userdata($cap);
			$this->load->view('register',$cap);
         } elseif($this->session->userdata('capt')!=$this->input->post('captcha')) {
         	$this->session->set_flashdata('Invalid', 'Invalid Captcha ! Try Again.');
	        $cap = array('capt' => rand(1000,9999));
			$this->session->set_userdata($cap);
			$this->load->view('register',$cap);
         } else {
         	if($this->User_Model->checkemail($this->input->post('email'))<1)
         	{
         		$key = md5(rand());
	            $data = array(
	                 'firstname' => $this->input->post('fname'),
	                 'lastname' => $this->input->post('lname'),
	                 'phone' => $this->input->post('phone'),
	                 'dob' => $this->input->post('dob'),
	                 'country' => $this->input->post('country'),
	                 'type' => 'user',
	                 'email' => $this->input->post('email'),
	                 'verification_key' => $key,
	                 'password' => md5($this->input->post('password')),
	                 'subscription' => $this->input->post('subs'),
	             );
	             $res = $this->User_Model->saverecords($data);
	             if ($res == true) {
	             	$subject = "Email Verification";
	             	$message = "<h2>Hello ".$this->input->post('fname')."</h2><p>Please <a href='".base_url('welcome/verify_email/'.$key)."'>click here</a> to verify your email</p>";
	             	$config = array(
	             		'protocol'=>'smtp',
	             		'smtp_host'=>'ssl://smtp.googlemail.com',
	             		'smtp_port'=>'465',
	             		'smtp_user'=>'letters2me2020@gmail.com',
	             		'smtp_pass'=>'myworks@2020',
	             		'mailtype'=>'html',
	             		'smtp_crypto'=> 'tls',
	             		'charset'=>'utf-8',
	             		'wordwrap'=>TRUE);
	             	$this->load->library('email',$config);
	             	$this->email->set_newline("\r\n");
	             	$this->email->from('letters2me2020@gmail.com');
	             	$this->email->to($this->input->post('email'));
	             	$this->email->subject($subject);
	             	$this->email->message($message);
	             	$this->email->send();
	            }
	            $this->session->set_flashdata('success', 'Registered Successfully ! Please check your mail for verification !');
	            redirect('/');
            } else {
            	$this->session->set_flashdata('Invalid', 'Email already exists !');  
	            $cap = array('capt' => rand(1000,9999));
				$this->session->set_userdata($cap);
				$this->load->view('register',$cap);
            }          
        }
    }

    public function home()
	{
		$this->load->library('pagination');
		$config = [
			'base_url' => base_url('welcome/home'),
			'per_page' => 2,
			'total_rows' => $this->User_Model->viewrecount(),
		];
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['attributes'] = ['class' => 'page-link'];
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
		$config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);

		$result['data']=$this->User_Model->viewrecords($config['per_page'],$this->uri->segment(3));
		$this->load->view('header');
        $this->load->view('home', $result);
		$this->load->view('footer');	
	}
	public function deluser($id)
    {
        $res = $this->User_Model->deleteuser($id);
        if ($res == true) {
                $this->session->set_flashdata('success', 'User deleted Successfully');
            }
            redirect('welcome/home');
    }
    public function edituser($id)
    {
        $result['data']=$this->User_Model->edituser($id);
        $this->load->view('header');
        $this->load->view('edituser', $result);
        $this->load->view('footer');
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
    public function update($id)
    {
         $this->form_validation->set_rules('fname', 'First Name', 'required');
         $this->form_validation->set_rules('email', 'Email', 'required');
			
         if ($this->form_validation->run() == FALSE) { 
             redirect('welcome/edituser/'.$id);
         } 
         else {
            $data = array(
	                 'firstname' => $this->input->post('fname'),
	                 'lastname' => $this->input->post('lname'),
	                 'phone' => $this->input->post('phone'),
	                 'dob' => $this->input->post('dob'),
	                 'country' => $this->input->post('country'),
	                 'email' => $this->input->post('email'),
	             );
            $res = $this->User_Model->updateuser($data, $id);
            if ($res == true) {
                $this->session->set_flashdata('success', 'User Updated Successfully');
            }
            redirect("welcome/home");
         }
    }
    public function verify_email($key)
    {
    	$data = array('status' => '1',);
        $res = $this->User_Model->changestatus($data, $key);
        if ($res == true) {
           $this->session->set_flashdata('success', 'Email Verified Successfully ! Please login to continue.');
        }
        redirect("/");
    }
}
