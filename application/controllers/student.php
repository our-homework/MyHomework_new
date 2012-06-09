<?php 
	if ( ! defined('BASEPATH')) 
		exit('No direct script access allowed');
	
/*default controller*/
include_once 'User.php';
include_once 'Teacher.php';

class Student extends User {
	function __construct() {
        parent::__construct();
		$this->load->model('Homework_model','',TRUE);
	}
	
	function index()
	{
		$uid = $this->session->userdata('uid');
		$gid = $this->Group_model->get_gid_by_uid($uid);
		if ($gid !== -1)
			$data['my_group_id'] = $gid;
		$data['homeworks'] = $this->Homework_model->get_homeworks_by_uid($uid)->result_array();
		$data['css'] = 'typeLittleMetro';
		$this->load->view('header', $data);
		$this->load->view('stuHm_view', $data);
		$this->load->view('footer');
	}
	
	public function show_my_group($info = '') {
		$result = $this->Group_model->get_group_info_by_uid($this->session->userdata('uid'));
		if ($result !== 0)
			$data = $result;
		if ($info != '')
			$data['transfer_leader_errorMsg'] = $info;
		$data['uid'] = $this->session->userdata('uid');
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
  		$this->load->view('myTm_view');
		$this->load->view('footer');
	}
	
	public function create_group($data = array()) {
		$data['css'] = 'typeAlert';
		$this->load->view('header', $data);
  		$this->load->view('createTm_view', $data);
		$this->load->view('footer');
	}
	
	
	
	//TODO: be refactoring... unsuitable fcn name
	public function join_group() {
		$data = $this->Group_model->get_all_groups_info();
		$data['css'] = 'typeBigMetro';
		$data['title'] = "选择小组";
		$this->load->view('header', $data);
  		$this->load->view('manageGrp_view', $data);
		$this->load->view('footer');
	}
	
	public function select_group($gid, $errorMsg = '') {
		$data = $this->Group_model->get_group_info_by_gid($gid);
		$data['uid'] = $this->session->userdata('uid');
		$data['css'] = 'typeTextMetro';
		if ($errorMsg !== '')
			$data['join_group_errorMsg'] = $errorMsg;
		$this->load->view('header', $data);
  		$this->load->view('myTm_view', $data);
		$this->load->view('footer');
	}
	
	public function transfer_group_leader()
	{
		$this->form_validation->set_rules('leader', 'leader', 'required');
		if ($this->form_validation->run() === FALSE) 
		{
			$transfer_leader_errorMsg = '请先选定所要转移的组长！'; 
			$this->show_my_group($transfer_leader_errorMsg);
			return;
		}
		$to_uid = $this->input->post('leader');
		if (!$this->Group_model->group_leader_transfer_to($to_uid))
		{
			echo 'something wrong';
		} else {
			redirect('student/show_my_group');
		}
	}
	
	public function join_group_check($gid) 
	{
		$data['gid'] = $gid;
		$data['uid'] = $this->session->userdata('uid');
		if (!$this->Group_model->add_stu_to_group($data)) {
			$errorMsg = "你已加入小组，不能同时加入多个小组";
		} else {
			$errorMsg = '';
		}
		$this->select_group($gid, $errorMsg);
	}
	
	public function quit_group_check($gid)
	{
		$data['gid'] = $gid;
		$data['uid'] = $this->session->userdata('uid');
		if ($this->Group_model->del_stu_in_group($data))
			redirect('student/select_group'.'/'.$gid);
	}

	public function create_group_check() {
		$this->form_validation->set_rules('group_name', 'group_name', 'required');
		
		if ($this->form_validation->run() === FALSE) 
		{
			$data['errorMsg'] = '小组名不能为空'; 
			$this->create_group($data);
		} else {
			$info['group_name'] = $this->input->post('group_name');
			$info['leader_id'] = $this->session->userdata('uid');
			if (!$this->Group_model->add_group($info)) {
				$data['errorMsg'] = '你已创建或加入小组，无法创建小组';
				$this->create_group($data);
			} else {
				redirect('student/join_group');
			}
		}
	}
	
	function upload_hw()
	{
		 if (is_uploaded_file($_FILES["src"]["tmp_name"]))  {
			$hid = $this->uri->segment(3);
			$uid = $this->uri->segment(4);
			$ext = strtolower(substr($_FILES['src']['name'], strrpos($_FILES['src']['name'], '.' ) + 1 ));
			$src = 'homework_upload/'.$hid.'/'.$hid.'_'.$uid.'.'.$ext;
			if (!is_dir('homework_upload/'.$hid))
				mkdir('homework_upload/'.$hid, 0777);
			move_uploaded_file($_FILES['src']['tmp_name'], $src);
		//	$this->Homewrok_model->upload_homework('src','link');
			redirect('homework/show_hw_detail');
		 }
	}
}