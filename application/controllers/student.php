<?php 
	if ( ! defined('BASEPATH')) 
		exit('No direct script access allowed');
	
/*default controller*/
include_once 'User.php';

class Student extends User {
	function __construct() 
	{
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
	
	function show_my_team() {
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
  		$this->load->view('myTm_view');
		$this->load->view('footer');
	}
	
	function create_team($data = array()) {
		$data['css'] = 'typeAlert';
		$this->load->view('header', $data);
  		$this->load->view('createTm_view', $data);
		$this->load->view('footer');
	}
	
	function join_team() {
		$data['css'] = 'typeBigMetro';
		$data['title'] = "选择小组";
		
		$data['groups'] = $this->Group_model->get_all_group()->result_array();
		
		$this->load->view('header', $data);
  		$this->load->view('manageGrp_view', $data);
		$this->load->view('footer');
	}

	function create_team_check() {
		$this->form_validation->set_rules('group_name', 'group_name', 'required');
		
		if ($this->form_validation->run() === FALSE) 
		{
			$data['errorMsg'] = '小组名不能为空'; 
			$this->create_team($data);
		} 
		else {
			$data['group_name'] = $this->input->post('group_name');
			$data['leader_id'] = $this->session->userdata('uid');
			if (!$this->Group_model->add_group($data)) {
				$data['errMsg'] = '小组名重复';
				$this->create_team($data);
			} 
			else {
				$this->join_team();
			}
		}
	}
	
	function upload_hw()
	{
		$hid = $this->uri->segment(3);
		 if (is_uploaded_file($_FILES["src"]["tmp_name"]))  {
			$uid = $this->uri->segment(4);
			$ext = strtolower(substr($_FILES['src']['name'], strrpos($_FILES['src']['name'], '.' ) + 1 ));
			$src = 'homework_upload/'.$hid.'/'.$hid.'_'.$uid.'.'.$ext;
			if (!is_dir('homework_upload/'.$hid))
				mkdir('homework_upload/'.$hid, 0777);
			move_uploaded_file($_FILES['src']['tmp_name'], $src);
			$this->Homework_model->upload_homework($hid, $uid, $src);
		 }
		 redirect('homework/show_hw_detail/'.$hid);
	}
	
	function download_hw()
	{
		$full_path = explode('/', $this->uri->uri_string());
		//$hid = $full_path[2];
		$src = $full_path[3];
		for ($i = 4; $i < count($full_path); $i++)
			$src = $src . '/'.$full_path[$i];
		$data = file_get_contents($src);
		force_download($full_path[count($full_path) - 1], $data);
	}
}