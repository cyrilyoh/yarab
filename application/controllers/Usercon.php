<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usercon extends CI_Controller {

	public function __construct() {
        //call CodeIgniter's default Constructor
        parent::__construct();
        
        if ( ! $this->session->userdata('email') ||  $this->session->userdata('type')!="user")
        {
            redirect('/');
        }
    }
    public function home()
    {
        $sub = $this->session->userdata('sub');
            $api_url = 'https://hn.algolia.com/api/v1/search?tags='.$sub;
            $json_data = file_get_contents($api_url);
            $response_data = json_decode($json_data);
            // print_r($response_dataa->hits);
        $usr['data'] = $response_data->hits;
        $usr['sub'] = $sub;
        $this->load->view('header');
        $this->load->view('userhome',$usr);
        $this->load->view('footer');    
    }
}