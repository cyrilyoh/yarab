<?php
class User_Model extends CI_Model
{
	function login($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('status', '1');
        $result = $this->db->get('users');
        if($result->num_rows() > 0) {
            return $result->result();
        }
        else {
            return false;
        }
	}
	function saverecords($data)
	{
        return $this->db->insert('users',$data);
	}
	function viewrecount()
	{
		$this->db->where('type', 'user');
        $result = $this->db->get('users');
        return $result->num_rows();
    }
	function viewrecords($limit,$offset)
	{
		$this->db->limit($limit,$offset);
		$this->db->where('type', 'user');
        $result = $this->db->get('users');
        return $result->result();
    }
    function checkemail($email)
    {
        $this->db->where('email', $email);
        $result = $this->db->get('users');
        if($result->num_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
	}
	function deleteuser($id)
    {
        return $this->db->delete('users', array('id' => $id));
    }
    function edituser($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('users');
        return $result->result();
    }
    function updateuser($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('users',$data);
    }
    function changestatus($data, $key)
    {
        $this->db->where('verification_key', $key);
        return $this->db->update('users',$data);
    }
}
