<<?php 
	if ( ! defined('BASEPATH')) 
		exit('No direct script access allowed');
	
include_once 'User.php';	

class Homework extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('Homework_model','',TRUE);
	}
	
	public function show_hw_detail() 
	{
		if ($this->session->userdata('role') == 'ta') {
			$data['hid'] = $this->uri->segment(3);
			$query = $this->Homework_model->get_homework_by_hid($data['hid']);
			if ($query->num_rows() > 0)
				$data['homework'] = $query->row();
			$view = 'detailedHw_tch_view';
		} else {
			$data['homework'] = $this->Homework_model->get_homeworks_by_uid(
									$this->session->userdata('uid'))->row();
			$view = 'detailedHw_stu_view';
		}
		
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
		$this->load->view($view, $data);
		$this->load->view('footer');
	}
}