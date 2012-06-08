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
	
	function get_grouped_stu_number($table = 'group_user')
	{
		return $this->db->get($table)->num_rows();
	}
	
	function get_members_by_gid($gid, $table = 'group_user') {
		$this->db->where('gid', $gid);
		return $this->db->get($table);
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
	
	public function get_all_group($table = "group") 
	{
		return $this->db->get($table);
	}
	
	public function get_all_teams_info() 
	{
		$return_data['groups'] = $this->get_all_group()->result_array();
		$return_data['uid2user_name'] = array('key' => 'value');
		$all_grouped_stu = array(array());
		foreach ($return_data['groups'] as $group) {
			$query = $this->get_members_by_gid($group['gid'])->result_array();
			$member = array();
			foreach ($query as $row) {
				array_push($member, $row['uid']);
				$user_name = $this->User_model->get_user_name_by_uid($row['uid']);
				$return_data['uid2user_name'][$row['uid']] = $user_name;
			}
			array_push( $all_grouped_stu, array($group['gid'] => $member));
			$user_name = $this->User_model->get_user_name_by_uid($group['leader_id']);
			$return_data['uid2user_name'][$group['leader_id']] = $user_name;
		}
		$return_data['members'] = $all_grouped_stu;
		$return_data['group_number'] = count($return_data['groups']);
		$return_data['stu_number'] = $this->User_model->get_stu_number();
		$return_data['grouped_stu_number'] = $this->get_grouped_stu_number();
		
		return $return_data;
	}
	
    function add_group($data, $table = 'group') {
        //$data['create_date'] = date("Y-m-d");
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