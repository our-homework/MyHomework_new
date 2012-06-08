<<?php 
	if ( ! defined('BASEPATH')) 
		exit('No direct script access allowed');
	
include_once 'User.php';	

class Homework extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('Homework_model','',TRUE);
	}
	
	public function show_hw_detail($hid = '') 
	{
		$data['hid'] = $this->uri->segment(3, $hid);
		if ($this->session->userdata('role') == 'ta') {
			$query = $this->Homework_model->get_homework_by_hid($data['hid']);
			if ($query->num_rows() > 0)
				$data['homework'] = $query->row();
			$view = 'detailedHw_tch_view';
			
		} 
		else {
			$data['homework'] = $this->Homework_model->get_homework_by_uid(
									$data['hid'],$this->session->userdata('uid'));
			$view = 'detailedHw_stu_view';
		}
		if (isset($data['homework']))
			$data['reach_deadline'] = $this->is_reach_deadline($data['homework']->deadline);
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
		$this->load->view($view, $data);
		$this->load->view('footer');
	}
	
	public function is_reach_deadline($deadline)
	{
		$today = explode('-', date("Y-m-d"));
		$deadline = explode('-', $deadline);
		for ($i = 0; $i <3; $i++) {
			if ($today[$i] > $deadline[$i]) {
				return FALSE;
			}
		}
		return TRUE;
	}
}