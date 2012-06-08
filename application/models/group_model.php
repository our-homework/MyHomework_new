<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
	
class Group_model extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }
	
	function is_lock($table = 'lockgroup')
	{
		return $this->db->get($table)->row()->is_lock;
	}	
	
	function lock_group($table = 'lockgroup')
	{
		$this->db->get($table)->row();
		$data['is_lock'] = TRUE;
		return $this->db->update($table, $data);
	}
	
	function unlock_group($table = 'lockgroup')
	{
		$this->db->get($table)->row();
		$data['is_lock'] = FALSE;
		return $this->db->update($table, $data);
	}
	
	function get_group_by_gid($gid, $table = 'group')
	{
		$this->db->where('hid', $gid);
		return $this->db->get($table);
	}
	
	
    function add_group($data, $table = 'group') {
        $data['create_date'] = date("Y-m-d");
        if (!$this->db->insert($table, $data))
            return false;
        return true;
    }
	
	
    function delete_group_by_gid($gid, $table = 'group') {
        $this->db->where('gid', $gid);
        if (!$this->db->delete($table))
            return false;
        return true;
    }
}

?>