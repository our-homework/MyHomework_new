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
	
	function add_stu_to_group($data, $table = 'group_user')
	{
		$this->db->where('uid', $data['uid']);
		if ($this->db->get($table)->num_rows() > 0)
			return false;
		if (!$this->db->insert($table, $data))
			return false;
		return true;
	}
	
	function del_stu_in_group($data, $table = 'group_user')
	{
		$this->db->where('uid', $data['uid']);
		if (!$this->db->delete($table))
			return false;
		return true;
	}
	
	function get_grouped_stu_number($table = 'group_user')
	{
		return $this->db->get($table)->num_rows();
	}
	
	function get_members_uid_by_gid($gid, $table = 'group_user') {
		$this->db->where('gid', $gid);
		return $this->db->get($table);
	}
	
	function get_gid_by_uid($uid, $table = 'group_user')
	{
		$this->db->where('uid', $uid);
		$query = $this->db->get($table);
		if ($query->num_rows() <= 0)
			return -1;
		return $query->row()->gid;
	}
	
	function get_group_by_uid($uid, $table = 'group_user')
	{
		$this->db->where('uid', $uid);
		$query = $this->db->get($table);
		if ($query->num_rows() <= 0)
			return $query;
		$gid = $query->row()->gid;
		return $this->get_group_by_gid($gid);
	}
	/*
	function add_group_user_item($data, $table = 'group_user')
	{
		if (!$this->db->insert($table, $data))
			return false;
		return true;
	}
	 * 
	 */
	
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
	
	function group_leader_transfer_to($uid, $table = 'group')
	{
		$gid = $this->get_gid_by_uid($uid);
		$query = $this->get_group_by_gid($gid);
		if ($query->num_rows() <= 0)
			return false;
		$cur_uid = $this->session->userdata('uid');
		if ($cur_uid != $query->row()->leader_id)
			return false;
		$data['gid'] = $gid;
		$data['group_name'] = $query->row()->group_name;
		$data['leader_id'] = $uid;
		$this->db->where('gid', $gid);
		if (!$this->db->update($table, $data))
			return false;
		return true;
	}
	
	function get_group_info_by_uid($uid)
	{
		$query = $this->get_group_by_uid($uid);
		if ($query->num_rows() <= 0)
			return 0;
		return $this->get_group_info_by_gid($query->row()->gid);
	}
	
	function get_group_info_by_gid($gid)
	{
		$group = $this->get_group_by_gid($gid)->row();
		$data['gid'] = $gid;
		$data['group_name'] = $group->group_name;
		$data['leader_id'] = $group->leader_id;
		$members_uid = $this->get_members_uid_by_gid($group->gid)->result_array();
		foreach ($members_uid as $member) {
			$data['members'][$member['uid']] = $this->User_model->get_user_name_by_uid($member['uid']);
		}
		return $data;
	}
	
	function get_group_by_gid($gid, $table = 'group')
	{
		$this->db->where('gid', $gid);
		return $this->db->get($table);
	}
	
	public function get_all_groups($table = "group") 
	{
		return $this->db->get($table);
	}
	
	public function get_all_groups_info() 
	{
		$return_data['groups'] = $this->get_all_groups()->result_array();
		$return_data['uid2user_name'] = array('key' => 'value');
		$all_grouped_stu = array(array());
		foreach ($return_data['groups'] as $group) {
			$query = $this->get_members_uid_by_gid($group['gid'])->result_array();
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
        $this->db->where('uid', $data['leader_id']);
		$query = $this->db->get('group_user');
		if ($query->num_rows() > 0)
			return false;
        
        if (!$this->db->insert($table, $data))
            return false;
		
		$gid = $this->get_gid_by_create_info($data);
		$info['gid'] = $gid;
		$info['uid'] = $this->session->userdata('uid');
		if (!$this->add_stu_to_group($info))
			return false;
        return true;
    }
	
	function get_gid_by_create_info($data, $table = 'group')
	{
		$this->db->where('leader_id', $data['leader_id']);
		$this->db->where('group_name', $data['group_name']);
		return $this->db->get($table)->row()->gid;
	}
	
    function delete_group_by_gid($gid, $table = 'group') {
        $this->db->where('gid', $gid);
        if (!$this->db->delete($table))
            return false;
        return true;
    }
}

?>