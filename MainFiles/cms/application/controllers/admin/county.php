<?php
include_once(APPPATH . 'core/Backend_Controller.php');
class county extends Backend_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('county_model');
		$this->bk_menu=2;
		$this->bk_title=$this->lang->line('msg_county');
	}

	function index(){
		$base_url=base_url().'admin/county';
		$page=$this->uri->segment(3);
		if(!is_numeric($page) || $page<=0){
			$page=1;
		}
		$first=($page-1)*$this->pg_per_page;
		$total_rows=$this->county_model->total(array(),array());
		$data['list'] = $this->county_model->get("*", array(),array(),$first,$this->pg_per_page, array('id' => 'DESC'));
		$data['page_link'] =parent::pagination_config($base_url,$total_rows,$this->pg_per_page);
		$this->render_backend_tp('backends/county/index',$data);
	}

	public function create(){
		if(isset($_POST['name'])){
			$data['name']=$this->input->post('name');
			$this->form_validation->set_rules('name','name', 'trim|required|min_length[2]|max_length[60]|xss_clean|callback_check_name_exist_add');
			if($this->form_validation->run()!=false){
				$insert_id=$this->county_model->insert($data);
				if($insert_id!=0){
					$this->session->set_flashdata('msg_ok',$this->lang->line('add_successfully'));
					redirect(base_url().'admin/county/create');
				}
			}
		}
		$this->render_backend_tp('backends/county/add');
	}

	public function check_name_exist_add($name){
		$data=$this->county_model->get_by_exact_name($name, 0, 1);
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
		$id=$this->input->post('id_post');
		$name=$this->input->post('name');
		$data=$this->county_model->get_by_name_and_diff_id($id,$name);
		if($data!=null) {
			$this->form_validation->set_message('check_name_exist_edit', $this->lang->line('vl_feild_value_exist'));
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function edit(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			if(!is_numeric($id) || $id<=0){
				redirect('notfound');
			}
			if(isset($_POST['id_post'])){
				$id = $this->input->post('id_post');
				$this->form_validation->set_rules('name',$this->lang->line('msg_name'), 'trim|required|min_length[2]|max_length[60]|xss_clean|callback_check_name_exist_edit');
				if($this->form_validation->run()){
					$name=$this->input->post('name');
					$this->county_model->update(array('name'=>$name),array('id'=>$id));
					$this->session->set_flashdata('msg_ok',$this->lang->line('edit_successfully'));
					redirect(base_url().'admin/county/edit?id='.$id);	
				}
			}
			$data['obj']=$this->county_model->get_by_id($id);
			if($data['obj']==null){
				redirect('notfound');
			}
			$this->render_backend_tp('backends/county/edit',$data);
		}else{
			redirect('notfound');
		}
	}

	public function delete(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			if(!is_numeric($id) || $id<=0){
				redirect('notfound');
			}
			$this->county_model->remove_by_id($id);
			redirect('admin/county');
		}else{
			redirect('notfound');
		}
	}

	public function search(){
		if(isset($_GET['query'])){
			$query=$this->input->get('query');
			$page     = $this->input->get('page') ? $this->input->get('page') : 0;
			$per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
			$order    = $this->input->get('order') ? $this->input->get('order') : 'DESC';
			$config['total_rows'] = $this->county_model->total(array(), array('name'=>$query));
			$config['base_url']= base_url() . 'admin/county/search?order='.$order.'&query='.$query;
			$config['per_page']=$per_page;
			$data['msg_label']=$this->config->item('msg_label');
			$this->pagination->initialize($config);
			$data['list'] = $this->county_model->get_by_name($query,$page,$per_page);
			$data['page_link'] = $this->pagination->create_links();
			$data['search_title']=$this->lang->line('result_search_for').'&nbsp;"'.$query.'"';
			$this->render_backend_tp('backends/county/index',$data);
		}else{
			redirect('notfound');
		}
	}
}
?>