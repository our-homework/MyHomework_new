<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include_once 'user_model.php';

class Teacher_model extends User_model
{
	function __construct()
    {
        parent::__construct();
    }
	
	public function get_all_studnets($table = 'user')
	{
		$this->db->where('role', 'student');
		return $this->db->get($table);
	}
	
	public function get_all_tas_students($table = 'user')
	{
		$this->db->where('role', 'student');
		$this->db->or_where('role', 'ta');
		return $this->db->get($table);
	}
	
	public function get_user_by_uid($uid, $table = 'user')
	{
		$this->db->where('uid', $uid);
		return $this->db->get($table);
	}

    public function add_user($data, $table = 'user') {
    	if($this->User_model->is_user($data['uid']))
			return false;
        if (!$this->db->insert($table, $data))
            return false;
        return true;
    }
	
    public function delete_user_by_uid($uid, $table = 'user') {
        $this->db->where('uid', $uid);
        if (!$this->db->delete($table))
            return false;
        return true;
    }
}

?>