<?php 
	if ( ! defined('BASEPATH')) 
		exit('No direct script access allowed');
	
/*default controller*/

class Group extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->model('Group_model','', TRUE);
	}
}