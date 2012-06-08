<?php 
	if ( ! defined('BASEPATH')) 
		exit('No direct script access allowed');
	
/*default controller*/
include_once 'User.php';

class Student extends User {
	function __construct() {
        parent::__construct();
		$this->load->model('Homework_model','',TRUE);
	}
	
	function index()
	{
		$data['homeworks'] = $this->Homework_model->get_homeworks_by_uid($this->session->userdata('uid'))->result_array();
		$data['css'] = 'typeLittleMetro';
		$this->load->view('header', $data);
		$this->load->view('stuHm_view');
		$this->load->view('footer');
	}
	
	public function show_my_team() {
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
  		$this->load->view('myTm_view');
		$this->load->view('footer');
	}
	
	public function create_team($data = array()) {
		$data['css'] = 'typeAlert';
		$this->load->view('header', $data);
  		$this->load->view('createTm_view', $data);
		$this->load->view('footer');
	}
	
	public function join_team() {
		$data['css'] = 'typeBigMetro';
		$data['title'] = "选择小组";
		
		$data['groups'] = $this->Group_model->get_all_group()->result_array();
		
		$this->load->view('header', $data);
  		$this->load->view('manageGrp_view', $data);
		$this->load->view('footer');
	}

	public function create_team_check() {
		$this->form_validation->set_rules('group_name', 'group_name', 'required');
		
		if ($this->form_validation->run() === FALSE) 
		{
			$data['errorMsg'] = '小组名不能为空'; 
			$this->create_team($data);
		} else {
			$data['group_name'] = $this->input->post('group_name');
			$data['leader_id'] = $this->session->userdata('uid');
			if (!$this->Group_model->add_group($data)) {
				$data['errMsg'] = '小组名重复';
				$this->create_team($data);
			} else {
				$this->join_team();
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
			$data['homework'] = $this->Homework_model->get_homework_by_hid($hid)->row();
			$data['css'] = 'typeTextMetro';
			$this->load->view('header', $data);
			$this->load->view('detailedHw_stu_view', $data);
			$this->load->view('footer');
		 }
	}
}