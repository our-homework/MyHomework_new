<?php 
	if ( ! defined('BASEPATH')) 
		exit('No direct script access allowed');
	
/*default controller*/
include_once 'User.php';

class Teacher extends User {
	function __construct() {
        parent::__construct();
		$this->load->model(array('Homework_model','Teacher_model', 'Group_model'));
	}
	
	public function index()
	{
		$this->session->set_userdata('group_lock', $this->Group_model->is_lock());
		$data['homeworks'] = $this->Homework_model->get_all_homeworks()->result_array();
		$data['css'] = 'typeLittleMetro';
		$this->load->view('header', $data);
		$this->load->view('tchHm_view');
		$this->load->view('footer');
	}
	
	public function user_admin($data = array())
	{
		if ($this->session->userdata('role') == 'ta') 
			$data['users'] = $this->Teacher_model->get_all_studnets()->result_array();
		else if ($this->session->userdata('role') == 'teacher')
			$data['users'] = $this->Teacher_model->get_all_tas_students()->result_array();

		$index = 0;
		foreach ($data['users'] as $user) {	
			if ($user['role'] == 'student') {
				$gid = $this->Group_model->get_gid_by_uid($user['uid']);
				if ($gid != -1)
					$data['users'][$index]['group_name'] = $this->Group_model->get_group_by_gid($gid)->row()->group_name;
			}
			$index++;
		}
		//print_r($data['users']);
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
		$this->load->view('manageUsr_view');
		$this->load->view('footer');
	}
	
	public function add_user($data = array())
	{
		$data['css'] = 'typeAlert';
		$this->load->view('header', $data);
  		$this->load->view('addUsr_view');
		$this->load->view('footer');
	}
	
	public function add_user_check()
	{
		$data['uid'] = $this->input->post('uid');
		$data['user_name'] = $this->input->post('user_name');
		$data['password'] = $this->input->post('uid');
		$data['role'] = $this->input->post('role');
		
		if (!$this->Teacher_model->add_user($data)) {
			$data['errorMsg'] = '该用户已存在！';
			$this->add_user($data);
		}
		else {
			redirect('teacher/user_admin');
		}
	}
	
	public function delete_user()
	{
		if (!isset($_POST['delete_uid'])) {
		
			$data['errorMsg'] = '请选择要删除的用户！';
			$this->user_admin($data);
		}
		else {
			$data['alertMsg'] = '确定删除已选用户？';
			$data['selectedMsg'] = $this->input->post('delete_uid');
			$data['css'] = 'typeAlert';
			$this->load->view('header', $data);
	  		$this->load->view('alert_view', $data);
			$this->load->view('footer');
		}
	}
	
	public function delete_user_check()
	{
		$delete_uids = $this->uri->segment_array();
		for ($i = 3; $i <= sizeof($delete_uids); $i++) {
			$this->Teacher_model->delete_user_by_uid($delete_uids[$i]);
		}
		redirect('teacher/user_admin');
	}
	
	public function publishHw($data = array()) {
		isset($data['title']) ? : $data['title'] = '发布作业';
		$data['css'] = 'typeAlert';
		$this->load->view("header", $data);
		$this->load->view("publishHw_view", $data);
		$this->load->view("footer");
	}
	
	public function publishHw_check() {
		$hid = $this->uri->segment(3);
		$data['title'] = $this->input->post('name');
		$data['deadline'] = $this->input->post('deadline');
		$data['content'] = $this->input->post('request');
		$data['author'] = $this->session->userdata("user_name");
		
		if ($hid != '0') {
			if (!$this->Homework_model->update_homework($hid, $data)) {
				$data['errorMsg'] = '修改失败！';
				$this->publishHw($data);
			}
			else {
				redirect('teacher/hw_history');
			}
		}
		else {
			if(!$this->Homework_model->add_homework($data)) {
				$data['errorMsg'] = 'unknown error！';
				$this->publishHw($data);
			}
			else {
				redirect('teacher/hw_history');
			}
		}
	}
	
	public function hw_history() {
		//$this->load
		$data['css'] = 'typeBigMetro';
		$data['homeworks'] = $this->Homework_model->get_all_homeworks()->result_array();
		$this->load->view('header', $data);
		$this->load->view('groupedHw_view', $data);
		$this->load->view('footer');
	}
	/*
	public function show_hw_detail() 
	{
		$data['hid'] = $this->uri->segment(3);
		$query = $this->Homework_model->get_homework_by_hid($data['hid']);
		if ($query->num_rows() > 0)
			$data['homework'] = $query->row();
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
		$this->load->view('detailedHw_tch_view', $data);
		$this->load->view('footer');
<<<<<<< HEAD
	}	
=======
	}*/
	
	public function edit_hw()
	{
		$hid = $this->uri->segment(3);
		$data['title'] = '修改作业';
		$data['homework'] = $this->Homework_model->get_homework_by_hid($hid)->row();
		$this->publishHw($data);
	}
	
	public function rate_hw($hid = '')
	{
		$hid = $this->uri->segment(3, $hid);
		$data['hid'] = $hid;
		$data['users'] = $this->Homework_model->get_all_students_hw_by_hid($hid)->result_array();
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
  		$this->load->view('rateHw_view', $data);
		$this->load->view('footer');
	}
	
	public function update_grade_check()
	{
		$hid = $this->uri->segment(3);
		$users = $this->Homework_model->get_handin_users_by_hid($hid)->result_array();
		for ($i = 0; $i < count($users); $i++){
			if ($_POST[$users[$i]['uid']] != NULL) {
				$users[$i]['grade'] = $_POST[$users[$i]['uid']];
				$this->Homework_model->update_hw_user_by_uid($users[$i]['hid'], $users[$i]['uid'], $users[$i]);
			}
		}
		
		redirect('teacher/rate_hw'.'/'.$hid);
	}
	
	public function triggle_group_lock()
	{
		if ($this->session->userdata('group_lock') == TRUE)
			$this->Group_model->unlock_group();
		else 
			$this->Group_model->lock_group();
		redirect('teacher/group_admin');
	}
	
	public function group_admin($data = array())
	{
		$data = $this->Group_model->get_all_groups_info();
		$data['title'] = "小组信息";
		$data['css'] = 'typeBigMetro';

		$this->session->set_userdata('group_lock', $this->Group_model->is_lock());
		$data['groups'] = $this->Group_model->get_all_group()->result_array();
		$this->load->view('header', $data);
		$this->load->view('manageGrp_view');
		$this->load->view('footer');
	}
}