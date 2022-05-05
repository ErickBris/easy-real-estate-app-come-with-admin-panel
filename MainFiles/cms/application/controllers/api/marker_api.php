<?php
require APPPATH.'/libraries/REST_Controller.php';
class marker_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('marker_model');
	}

	function marker_get() 
	{ 
		$data=$this->marker_model->get();
		if($data!=null){
			$defaultPin = new stdClass();
			$defaultPin->path = 'statics/images/pin.png';
			$defaultPin->id="0";
			array_unshift($data, $defaultPin);	
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	} 

	function marker_post() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	} 

	function marker_put() 
	{ 
		$data = array('this not available'); 
		$this->response($data); 
	} 

	function marker_delete() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	}  
}
?>