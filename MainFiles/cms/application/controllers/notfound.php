<?php
class NotFound extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->load->view('notfound');
	}

}
?>