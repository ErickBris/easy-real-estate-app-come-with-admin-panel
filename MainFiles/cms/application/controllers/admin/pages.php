<?php
include_once(APPPATH . 'core/Backend_Controller.php');
class pages extends Backend_Controller{


	function __construct()
	{
		parent::__construct();
		$this->load->model('page_model');
		$this->bk_menu=8;
		$this->bk_title=$this->lang->line('msg_pages');
	}

	function index(){
		$base_url=base_url().'admin/pages';
		$page=$this->uri->segment(3);
		if(!is_numeric($page) || $page<=0){
			$page=1;
		}
		$first=($page-1)*$this->pg_per_page;
		$total_rows=$this->page_model->total(array(),array());

		$data['list'] = $this->page_model->get("*,", array(),array(),$first, $this->pg_per_page, array('id' => 'DESC'));
		$data['page_link'] =parent::pagination_config($base_url,$total_rows,$this->pg_per_page);
		$this->render_backend_tp('backends/pages/index',$data);
	}

	public function create(){
		if(isset($_POST['title'])){
			$this->form_validation->set_rules('title',$this->lang->line('msg_title'),
				'trim|required|min_length[2]|max_length[200]|xss_clean');
			$this->form_validation->set_rules('slug', $this->lang->line('msg_slug'),
				'trim|required|min_length[1]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('keyword', $this->lang->line('msg_keywords'), 
				'trim|required|min_length[5]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('description', $this->lang->line('msg_description'),
				'trim|required|min_length[5]|max_length[500]|xss_clean');
			$this->form_validation->set_rules('content', $this->lang->line('msg_content'),
				'trim|required|min_length[5]|max_length[10000]|xss_clean');
			if($this->form_validation->run()!=false){
				$data['title']=$this->input->post('title');
				$data['slug']=$this->input->post('slug');
				$data['keyword']=$this->input->post('keyword');
				$data['description']=$this->input->post('description');
				$data['content']= htmlspecialchars($this->input->post('content'));
				$is_menu=$this->input->post('is_menu');
				if($is_menu==IS_MENU){
					$data['is_menu']=IS_MENU;
				}
				$insert_id=$this->page_model->insert($data);
				if($insert_id!=0){
					$this->session->set_flashdata('msg_ok',$this->lang->line('add_successfully'));
					redirect(base_url().'admin/pages/create');
				}
			}
		}
		$this->render_backend_tp('backends/pages/add');
	}

	public function edit(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			if($id==null || !is_numeric($id) || $id<0){
				redirect('notfound');
			}
			if(isset($_POST['id_post'])){
				$id=$this->input->post('id_post');
				$this->form_validation->set_rules('title',$this->lang->line('msg_title'),
					'trim|required|min_length[2]|max_length[200]|xss_clean');
				$this->form_validation->set_rules('slug', $this->lang->line('msg_slug'),
					'trim|required|min_length[1]|max_length[100]|xss_clean');
				$this->form_validation->set_rules('keyword', $this->lang->line('msg_keywords'), 
					'trim|required|min_length[5]|max_length[100]|xss_clean');
				$this->form_validation->set_rules('description', $this->lang->line('msg_description'),
					'trim|required|min_length[5]|max_length[500]|xss_clean');
				$this->form_validation->set_rules('content', $this->lang->line('msg_content'),
					'trim|required|min_length[5]|max_length[10000]|xss_clean');
				if($this->form_validation->run()!=false){
					$data['title']=$this->input->post('title');
					$data['slug']=$this->input->post('slug');
					$data['keyword']=$this->input->post('keyword');
					$data['description']=$this->input->post('description');
					$data['content']=htmlspecialchars($this->input->post('content'));
					$is_menu=$this->input->post('is_menu');
					if($is_menu==IS_MENU){
						$data['is_menu']=IS_MENU;
					}
					$this->page_model->update($data,array('id'=>$id));
					$this->session->set_flashdata('msg_ok',$this->lang->line('edit_successfully'));
					redirect(base_url().'admin/pages/edit?id='.$id);	
				}
			}
			$data['obj']=$this->page_model->get_by_id($id);
			if($data['obj']==null){
				redirect('notfound');
			}
			$this->render_backend_tp('backends/pages/edit',$data);
		}else{
			redirect('notfound');
		}
	}


	public function delete(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$this->page_model->remove_by_id($id);
			redirect('admin/pages');
		}
	}

	public function search(){
		if(isset($_GET['query'])){
			$query=$this->input->get('query');
			$page     = $this->input->get('page') ? $this->input->get('page') : 0;
			$per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
			$order    = $this->input->get('order') ? $this->input->get('order') : 'DESC';
			$config['total_rows'] = $this->page_model->total(array(), array('title'=>$query));
			$config['base_url']= base_url() . 'index.php/admin/pages/search?order='.$order.'&query='.$query;
			$config['per_page']=$per_page;
			$data['msg_label']=$this->config->item('msg_label');
			$this->pagination->initialize($config);
			$data['list'] = $this->page_model->get_by_title($query,$page,$per_page);
			$data['page_link'] = $this->pagination->create_links();
			$data['search_title']=$this->lang->line('result_search_for').'&nbsp;"'.$query.'"';
			$this->render_backend_tp('backends/pages/index',$data);
		}
	}
}
?>