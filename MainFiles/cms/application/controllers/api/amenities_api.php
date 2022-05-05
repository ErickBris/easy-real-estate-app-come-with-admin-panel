<?php
require APPPATH.'/libraries/REST_Controller.php';
class amenities_api extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('amenities_model');
	}

	function amenities_get() 
	{ 
		$data=$this->amenities_model->get();
		if($data!=null){
			
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}
	} 

	function amenities_by_county_id_get(){
		$county_id=$this->get('id');
		$data=$this->amenities_model->get_by_county_id($county_id);
		if($data!=null){
			$this->response($data); 
		}else{
			$this->response(array('empty'=>'empty_data'));
		}	
	}

	function amenities_post() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	} 

	function amenities_put() 
	{ 
		$data = array('this not available'); 
		$this->response($data); 
	} 

	function amenities_delete() 
	{ 
		$data = array('this not available');
		$this->response($data); 
	}  
}
?>