<?php
class cities extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->bk_menu=3;
		$this->bk_title=$this->lang->line('msg_cities');
		$this->load->model('cities_model');
	}

	function index(){
		parent::authentication_backend();
		$base_url=base_url().'admin/cities';
		$page=$this->uri->segment(3);
		if(!is_numeric($page) || $page<=0){
			$page=1;
		}
		$first=($page-1)*$this->pg_per_page;
		$total_rows=$this->cities_model->total(array(),array());
		$data['list'] = $this->cities_model->get(
			"*,cities.id as id,
			cities.name as name,
			county.name as county, 
			cities.created_at as created_at, 
			cities.updated_at as updated_at", array(),array(),$first, $this->pg_per_page, array('cities.id' => 'DESC'));
		$data['page_link'] =parent::pagination_config($base_url,$total_rows,$this->pg_per_page);
		$this->render_backend_tp('backends/cities/index',$data);
	}

	public function create(){
		parent::authentication_backend();
		if(isset($_POST['name'])){
			$data['name']=$this->input->post('name');
			$data['county_id']=$this->input->post('county');
			$this->form_validation->set_rules('name','name', 'trim|required|min_length[2]|max_length[60]|xss_clean');
			$this->form_validation->set_rules('county', 'county', 'trim|required|xss_clean');
			if($this->form_validation->run()!=false){
				$insert_id=$this->cities_model->insert($data);
				if($insert_id!=0){
					$this->session->set_flashdata('msg_ok',$this->lang->line('add_successfully'));
					redirect(base_url().'admin/cities/create');
				}
			}
		}
		$this->load->model('county_model');
		$data['county']=$this->county_model->get("*", false,  false,  false, false, false);
		$this->render_backend_tp('backends/cities/add',$data);
	}

	public function check_name_exist_add($name){
		$data=$this->cities_model->get_by_exact_name($name, 0, 1);
		if ($data!=null)
		{
			$this->form_validation->set_message('check_name_exist_add', $this->lang->line('vl_feild_value_exist'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function check_name_exist_edit(){
		$id=$this->input->post('id');
		$name=$this->input->post('name');
		$data=$this->cities_model->get_by_name_and_diff_id($id,$name);
		if($data!=null) {
			$this->form_validation->set_message('check_name_exist_edit', $this->lang->line('vl_feild_value_exist'));
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function edit(){
		parent::authentication_backend();
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			if(!is_numeric($id) || $id<=0){
				redirect('notfound');
			}
			if(isset($_POST['id_post'])){
				$id = $this->input->post('id_post');
				$name=$this->input->post('name');
				$county=$this->input->post('county');		
				$this->form_validation->set_rules('name','name', 'trim|required|min_length[2]|max_length[60]|xss_clean');
				$this->form_validation->set_rules('county', 'county', 'trim|required|xss_clean');
				if($this->form_validation->run()){
					$this->cities_model->update(array('name'=>$name,'county_id'=>$county),array('id'=>$id));
					$this->session->set_flashdata('msg_ok',$this->lang->line('edit_successfully'));
					redirect(base_url().'admin/cities/edit?id='.$id);
				}
			}
			$this->load->model('county_model');
			$data['county']=$this->county_model->get("*", false,  false,  false, false, false);
			$data['obj']=$this->cities_model->get_by_id($id);
			if($data['obj']==null){
				redirect('notfound');
			}
			$this->render_backend_tp('backends/cities/edit',$data);
		}else{
			redirect('notfound');
		}
	}


	public function delete(){
		parent::authentication_backend();
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$this->cities_model->remove_by_id($id);
			redirect('admin/cities');
		}
	}

	public function search(){
		parent::authentication_backend();
		if(isset($_GET['query'])){
			$query=$this->input->get('query');
			$data=parent::getDataView();
			$page     = $this->input->get('page') ? $this->input->get('page') : 0;
			$per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
			$order    = $this->input->get('order') ? $this->input->get('order') : 'DESC';
			$config['total_rows'] = $this->cities_model->total(array(), array('name'=>$query));
			$config['base_url']= base_url() . 'admin/cities/search?order='.$order.'&query='.$query;
			$config['per_page']=$per_page;
			$data['msg_label']=$this->config->item('msg_label');
			$this->pagination->initialize($config);
			$data['list'] = $this->cities_model->get_by_name($query,$page,$per_page);
			$data['page_link'] = $this->pagination->create_links();
			$data['search_title']=$this->lang->line('result_search_for').'&nbsp;"'.$query.'"';
			$this->render_backend_tp('backends/cities/index',$data);
		}
	}

	public function get_list(){
		if(isset($_POST['county_id'])){
			$county_id=$this->input->post('county_id');
			$this->load->model('cities_model');
			$data['list']=$this->cities_model->get_by_county_id($county_id);
			$this->load->view('backends/cities/list', $data);
		}
	}
}
?>