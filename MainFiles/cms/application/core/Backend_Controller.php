<?php
class Backend_Controller extends MY_Controller{
	function __construct()
	{
		parent::__construct();
		parent::authentication_backend();
	}

	function demo(){
		//demo code
		redirect('admin/denied/demo');
	}

	function post_demo(){
		if($_POST){
			//$this->demo();
		}
	}
	
}
?>