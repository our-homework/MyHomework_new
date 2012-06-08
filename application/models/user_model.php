<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class User_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	
	public function check_user($uid, $password, $table='user') {
        $this->db->where('uid', $uid);
        $this->db->where('password', $password);
        return $this->db->get($table);
    }
	
	public function get_user_by_id($uid, $table = 'user' )
	{
		$this->db->where('uid', $uid);
        return $this->db->get($table);
	}
	
	public function is_user($uid, $table = 'user')
	{
		$query = $this->get_user_by_id($uid);
        if (!$query->num_rows())
       		return false;
		return true;
	}
	
}