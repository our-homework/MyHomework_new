	public function manageGrp()
	{
		$data['css'] = 'typeBigMetro';
		$this->load->view('header', $data);
  		$this->load->view('manageGrp_view');
		$this->load->view('footer');
	}
	
		public function detailedHw_stu()
	{
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
  		$this->load->view('detailedHw_stu_view');
		$this->load->view('footer');
	}
	
	public function detailedHw_tch()
	{
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
  		$this->load->view('detailedHw_tch_view');
		$this->load->view('footer');
	}
	
	public function groupedHw()
	{
		$data['css'] = 'typeBigMetro';
		$this->load->view('header', $data);
  		$this->load->view('groupedHw_view');
		$this->load->view('footer');
	}

	public function manageUsr()
	{
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
  		$this->load->view('manageUsr_view');
		$this->load->view('footer');
	}

	public function rateHw()
	{
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
  		$this->load->view('rateHw_view');
		$this->load->view('footer');
	}
	
	public function myTm()
	{
		$data['css'] = 'typeTextMetro';
		$this->load->view('header', $data);
  		$this->load->view('myTm_view');
		$this->load->view('footer');
	}
	
		public function stuHm()
	{
		$data['css'] = 'typeLittleMetro';
		$this->load->view('header', $data);
  		$this->load->view('stuHm_view');
		$this->load->view('footer');
	}
		public function tchHm()
	{
		$data['css'] = 'typeLittleMetro';
		$this->load->view('header', $data);
  		$this->load->view('tchHm_view');
		$this->load->view('footer');
	}
	
	public function index()
	{
		$data['css'] = 'typeAlert';
		$this->load->view('header', $data);
		$this->load->view('login_view');
		$this->load->view('footer');
	}
	
	public function addUsr()
	{
		$data['css'] = 'typeAlert';
		$this->load->view('header', $data);
  		$this->load->view('addUsr_view');
		$this->load->view('footer');
	}
	
	public function alert_noTm()
	{
		$data['css'] = 'typeAlert';
		$this->load->view('header', $data);
  		$this->load->view('alert_noTm_view');
		$this->load->view('footer');
	}

	public function createTm()
	{
		$data['css'] = 'typeAlert';
		$this->load->view('header', $data);
  		$this->load->view('createTm_view');
		$this->load->view('footer');
	}

	public function publishHw()
	{
		$data['css'] = 'typeAlert';
		$this->load->view('header', $data);
  		$this->load->view('publishHw_view');
		$this->load->view('footer');
	}
	