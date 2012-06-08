<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class Homework_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	
	public function get_homework_by_hid($hid, $table = 'homework')
	{
		$this->db->where('hid', $hid);
		return $this->db->get($table);
	}
	
	public function get_all_homeworks($table = "homework") 
	{
		return $this->db->get($table);
	}
	
    public function add_homework($data, $table = 'homework') 
    {
		$data['create_time'] = date("Y-m-d");
		$data['edit_time'] = date("Y-m-d");
        if (!$this->db->insert($table, $data)) 
            return false;
        return true;
    }
	
	public function update_homework($hid, $data, $table='homework')
	{
		$this->db->where('hid', $hid);
		$query = $this->db->get($table);
		if ($query->num_rows() > 0) {
			$new = $query->row_array();
			$new['title'] = $data['title'];
			$new['deadline'] = $data['deadline'];
			$new['content'] = $data['content'];
			$new['edit_time'] = date("Y-m-d");
			$new['author'] = $this->session->userdata('user_name');
			$this->db->where('hid', $hid);
			$this->db->update($table, $new);
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	
    public function delete_homework_by_hid($hid, $table = 'homework') 
    {
        $this->db->where('hid', $hid);
        if (!$this->db->delete($table))
            return false;
        return true;
    }
	
	public function get_homeworks_by_uid($uid, $table = 'hw_user')
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('homework','hw_user.hid = homework.hid','right');
		$this->db->where('uid', $uid);
		$this->db->or_where('uid', NULL);
		return $this->db->get();
	}
	
	public function get_homework_by_uid($hid, $uid, $table = 'hw_user')
	{
		$query = $this->get_homeworks_by_uid($uid)->result();
		foreach ($query as $hw) {
			if ($hw->hid== $hid)
				return $hw;
		}
	}
	
	public function upload_homework($hid, $uid, $src, $table='hw_user')
	{
		$this->db->where('uid', $uid);
		$this->db->where('hid', $hid);
		$query = $this->db->get($table);
		
		if ($query->num_rows() == 0) {
			$data['hid'] = $hid;
			$data['uid'] = $uid;
			$data['src'] = $src;
			$this->db->insert($table, $data);
		}
			
		else {
			$data = $query->row_array();
			$data['src'] = $src;
			$this->db->where('uid', $uid);
			$this->db->where('hid', $hid);
			$this->db->update($table, $data);
		}
	}
}

?>