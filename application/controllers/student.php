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
	
	public function create_team() {
		$data['css'] = 'typeAlert';
		$this->load->view('header', $data);
  		$this->load->view('createTm_view');
		$this->load->view('footer');
	}
	
	public function join_team() {
		$data['css'] = 'typeBigMetro';
		$data['title'] = "选择小组";
		$this->load->view('header', $data);
  		$this->load->view('manageGrp_view', $data);
	}
	
	function show_hw_detail($hid = '')
	{
		$hid = $this->uri->segment(3, $hid);
		$data['homework'] = $this->Homework_model->get_homework_by_hid($hid)->row();
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
  		$this->load->view('detailedHw_stu_view', $data);
		$this->load->view('footer');
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