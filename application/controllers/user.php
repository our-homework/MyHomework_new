<?php 
	if ( ! defined('BASEPATH')) 
		exit('No direct script access allowed');
	
/*default controller*/

class User extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('User_model','', TRUE);
		$this->load->model(array('Homework_model','Group_model'));
	}
	
	public function index($data = array())
	{
		$session['is_login'] = FALSE;
		$data['css'] = 'typeAlert';
		$this->load->view('header', $data);
		$this->load->view('login_view');
		$this->load->view('footer');
	}
	
	public function loginCheck()
	{
		$this->form_validation->set_rules('uid', 'uid', 'required');
  		$this->form_validation->set_rules('password', 'password', 'required');

		if ($this->form_validation->run() === FALSE) 
		{
			$data['errorMsg'] = '请输入用户名和密码！'; 
			$this->index($data);
		}
  		else{
  			$uid = $this->input->post('uid');
			$psd = $this->input->post('password');
			$query = $this->User_model->check_user($uid, $psd);
			if (!$query->num_rows()) {
				$data['errorMsg'] = '用户名和密码不匹配！';
				$this->index($data);
			}
			else {
				$user = $query->row();
				$session['is_login'] = TRUE;
				$session['user_name'] = $user->user_name;
				$session['uid'] = $user->uid;
				$session['role'] = $user->role;
				$this->session->set_userdata($session);	
				if ($session['role'] == 'ta' || $session['role'] == 'teacher'){
					redirect('teacher');
				}
				else {
					redirect('student');
				}
			}
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('is_login');
		redirect(base_url());
	}
}