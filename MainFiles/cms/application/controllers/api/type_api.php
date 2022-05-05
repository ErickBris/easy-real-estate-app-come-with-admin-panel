<?php
require APPPATH.'/libraries/REST_Controller.php';
class type_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('type_model');
	}

	function type_get() 
	{ 
		$first=$this->get('first');
		$offset=$this->get('offset');
		$data=$this->type_model->get('*',array(),array(),$first,$offset,array('id'=>'DESC'));
		if($data!=null){
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	} 

	function type_post() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	} 

	function type_put() 
	{ 
		$data = array('this not available'); 
		$this->response($data); 
	} 

	function type_delete() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	}  
}
?>