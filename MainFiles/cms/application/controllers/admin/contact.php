<?php
include_once(APPPATH . 'core/Backend_Controller.php');
class contact extends Backend_Controller{

	function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION['user'])){
			redirect('admin/dashboard');
		}else{
			$user=$_SESSION['user'][0];
			if($user->perm==USER){
				redirect('admin/denied');
			}
		}
		$this->load->model('contact_model');
		$this->bk_menu=7;
		$this->bk_title=$this->lang->line('msg_contact');
	}

	function index(){
		$base_url=base_url().'admin/contact';
		$page=$this->uri->segment(3);
		if(!is_numeric($page) || $page<=0){
			$page=1;
		}
		$first=($page-1)*$this->pg_per_page;
		$total_rows=$this->contact_model->total(array(),array());

		$data['list'] = $this->contact_model->get("*,", array(),array(),$first, $this->pg_per_page, array('id' => 'DESC'));
		$data['page_link'] =parent::pagination_config($base_url,$total_rows,$this->pg_per_page);
		$this->render_backend_tp('backends/contact/index',$data);
	}


	public function delete(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$this->contact_model->remove_by_id($id);
			redirect('admin/contact');
		}
	}

	public function search(){
		if(isset($_GET['query'])){
			$query=$this->input->get('query');
			$data=parent::getDataView();
			$page     = $this->input->get('page') ? $this->input->get('page') : 0;
			$per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
			$order    = $this->input->get('order') ? $this->input->get('order') : 'DESC';
			$config['total_rows'] = $this->contact_model->total(array(), array('name'=>$query));
			$config['base_url']= base_url() . 'admin/contact/search?order='.$order.'&query='.$query;
			$config['per_page']=$per_page;
			$data['msg_label']=$this->config->item('msg_label');
			$this->pagination->initialize($config);
			$data['list'] = $this->contact_model->get_by_name($query,$page,$per_page);
			$data['page_link'] = $this->pagination->create_links();
			$data['search_title']=$this->lang->line('result_search_for').'&nbsp;"'.$query.'"';
			$this->render_backend_tp('backends/contact/index',$data);
		}
	}


	public function reply(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			if($id==null || !is_numeric($id)){
				redirect('notfound');
			}
			if(isset($_POST['id_post'])){
				$id=$this->input->post('id_post');
				$subject=$this->input->post('subject');	
				$content=$this->input->post('content');
				$receive_email=$this->input->post('email');	
				$this->form_validation->set_rules('subject',$this->lang->line('subject'), 'trim|required|min_length[5]|max_length[60]|xss_clean');
				$this->form_validation->set_rules('content',$this->lang->line('msg_content'), 'trim|required|min_length[5]|max_length[1500]|xss_clean');
				if($this->form_validation->run()){
					$this->load->helper('email_ultils');
					reply_contact($subject,$content,$receive_email);
					$this->session->set_flashdata('msg_ok',$this->lang->line('msg_email_sent'));
					redirect(base_url().'admin/contact/reply?id='.$id);
				}
			}
			$this->contact_model->update(array('is_read'=>IS_READED),array('id'=>$id));
			$data['obj']=$this->contact_model->get_by_id($id);
			if($data['obj']!=null){
				$this->render_backend_tp('backends/contact/reply',$data);
			}else{
				redirect('notfound');
			}
		}else{
			redirect('notfound');
		}
	}

	function mark_as_read(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			if($id==null || !is_numeric($id)){
				redirect('notfound');
			}
			$this->contact_model->update(array('is_read'=>IS_READED),array('id'=>$id));
			redirect(base_url().'admin/contact');
		}else{
			redirect('notfound');
		}
	}
}
?>