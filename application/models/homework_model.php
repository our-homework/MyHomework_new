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
	
	public function get_all_students_hw_by_hid($hid, $table = 'hw_user')
	{
		$this->db->where('hid', $hid);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('group_user', 'hw_user.uid = group_user.uid');
		$this->db->join('user', 'hw_user.uid = user.uid');
		$this->db->order_by('gid', 'asc');
		$this->db->order_by('group_rank', 'asc');
		return $this->db->get();
	} 
	
	public function get_handin_users_by_hid($hid, $table= 'hw_user')
	{
		$this->db->where('hid', $hid);
		return $this->db->get($table);
	}
	
	public function get_homeworks_by_uid($uid, $table = 'hw_user')
	{
		$this->db->where('uid', $uid);
		$users = $this->db->get($table)->result();
		$homeworks = $this->db->get('homework')->result();
		for ($i = 0; $i < count($homeworks); $i++) {
			$homeworks[$i]->uid = NULL;
			$homeworks[$i]->src = NULL;
			$homeworks[$i]->grade = NULL;
			$homeworks[$i]->group_rank = NULL;
			for ($j = 0; $j < count($users); $j++) {
				if ($users[$j]->hid == $homeworks[$i]->hid) {
					$homeworks[$i]->uid = $users[$j]->uid;
					$homeworks[$i]->src = $users[$j]->src;
					$homeworks[$i]->grade = $users[$j]->grade;
					$homeworks[$i]->group_rank = $users[$j]->group_rank;
				}
			}
		}
		return $homeworks;
	}
	
	public function get_homework_by_uid($hid, $uid, $table = 'hw_user')
	{
		$query = $this->get_homeworks_by_uid($uid);
		foreach ($query as $hw) {
			if ($hw->hid== $hid) {
				return $hw;
			}
		}
	}
	
	public function get_excellent_hw($hid, $table = 'hw_user')
	{
		$this->db->where('hid', $hid);
		$this->db->join('user', 'user.uid = hw_user.uid');
		$this->db->order_by('grade','desc');
		$this->db->limit(3);
		return $this->db->get($table);
	}
	
	public function get_others_hw($hid, $uid, $gid, $table = 'hw_user')
	{
		$this->db->where('hid', $hid);
		$this->db->order_by('grade', 'desc');
		$this->db->limit($this->db->count_all_results() - 3, 3);
		$this->db->where('uid!=', $uid);
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join('group_user', 'hw_user.uid = group_user.uid');
		$this->db->where('gid!=', $gid);
		$this->db->join('user', 'hw_user.uid = user.uid');
		return $this->db->get();
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
	
	public function update_hw_user_by_uid($hid, $uid, $data, $table = 'hw_user')
	{
		$this->db->where('uid', $uid);
		$this->db->where('hid', $hid);
		$this->db->update($table, $data);
	}
}

?>