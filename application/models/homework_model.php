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
	
	public function get_all_homework($table = "homework") 
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
	
    public function delete_homework_by_hid($hid, $table = 'homework') 
    {
        $this->db->where('hid', $hid);
        if (!$this->db->delete($table))
            return false;
        return true;
    }
	
	public function get_homeworks_by_uid($uid, $table = 'hw_user')
	{
		$this->db->where('uid', $uid);
		$this->db->join('homework','homework.hid = hw_user.hid');
		return $this->db->get($table);
	}
	
	public function upload_homework($hid, $uid, $src, $table='hw_user')
	{
		$this->db->where('uid', $uid);
		$data = $this->db->where('hid', $hid)->row();
		$data['src'] = $src;
		$this->db->update($table, $data);
	}
}

?>