<?php
include_once(APPPATH . 'core/Backend_Controller.php');
class Users extends Backend_Controller{
	function __construct()
	{
		parent::__construct();
		$user=$_SESSION['user'][0];
		if($user->perm==AGENT){
			redirect('admin/denied');
		}
		$this->load->model('users_model');
		$this->load->helper('Ultils');
		$this->bk_menu = 5;
		$this->bk_title=$this->lang->line('msg_users');
	}

	function index(){
		$base_url=base_url().'admin/users';
		$page=$this->uri->segment(3);
		if(!is_numeric($page) || $page<=0){
			$page=1;
		}
		$first=($page-1)*$this->pg_per_page;
		$total_rows=$this->users_model->total(array(),array());

		$data['list'] = $this->users_model->get("*", array(),array(),$first,$this->pg_per_page, array('id' => 'DESC'));
		$data['page_link'] =parent::pagination_config($base_url,$total_rows,$this->pg_per_page);
		$this->render_backend_tp('backends/users/index',$data);
	}

	public function create(){
		$error=null;
		if(isset($_POST['user_name'])){
			$this->form_validation->set_rules('user_name','username', 'trim|required|min_length[5]|max_length[60]|xss_clean|callback_check_username_exist_add');
			$this->form_validation->set_rules('pwd','password', 'trim|required|min_length[5]|max_length[60]|xss_clean');
			$this->form_validation->set_rules('full_name','full name', 'trim|required|min_length[5]|max_length[60]|xss_clean');
			$this->form_validation->set_rules('email','email', 'required|xss_clean|valid_email|callback_check_email_exist_add');
			$this->form_validation->set_rules('phone','phone', 'trim|required|min_length[9]|max_length[60]|xss_clean');
			if($this->form_validation->run()!=false){
				$data['user_name']=$this->input->post('user_name');
				$data['pwd']=encrypt_pwd($this->input->post('pwd'));
				$data['full_name']=$this->input->post('full_name');
				$data['email']=$this->input->post('email');
				$data['address']=$this->input->post('address');
				$data['perm']=$this->input->post('perm');
				$data['skype']=$this->input->post('skype');
				$data['phone']=$this->input->post('phone');
				$insert_id=$this->users_model->insert($data);
				if($insert_id!=0){
					$this->session->set_flashdata('msg_ok',$this->lang->line('add_successfully'));
					redirect(base_url().'admin/users/create');
				}
			}
		}
		$this->render_backend_tp('backends/users/add');
	}


	function check_username_exist_add($name){
		$data=$this->users_model->get_by_exact_name($name);
		if ($data!=null)
		{
			$this->form_validation->set_message('check_username_exist_add', $this->lang->line('vl_feild_value_exist'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function check_email_exist_add($email){
		$data=$this->users_model->get_by_exact_email($email);
		if ($data!=null)
		{
			$this->form_validation->set_message('check_email_exist_add', $this->lang->line('vl_feild_value_exist'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function check_username_exist_edit(){
		$id=$this->input->post('id_post');
		$name=$this->input->post('user_name');
		$data=$this->users_model->get_by_name_and_diff_id($id,$name);
		if($data!=null) {
			$this->form_validation->set_message('check_username_exist_edit',$this->lang->line('vl_feild_value_exist'));
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function check_email_exist_edit(){
		$id=$this->input->post('id_post');
		$name=$this->input->post('email');
		$data=$this->users_model->get_by_exact_email_and_diff_id($id ,$name);
		if($data!=null) {
			$this->form_validation->set_message('check_email_exist_edit', $this->lang->line('vl_feild_value_exist'));
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
				$id=$this->input->post('id_post');
				$this->form_validation->set_rules('user_name','username', 'trim|required|min_length[3]|max_length[60]|xss_clean|callback_check_username_exist_edit');
				$this->form_validation->set_rules('full_name','full name', 'trim|required|min_length[3]|max_length[60]|xss_clean');
				$this->form_validation->set_rules('email','email', 'trim|required|min_length[5]|max_length[60]|xss_clean|valid_email|callback_check_email_exist_edit');
				$this->form_validation->set_rules('address','address', 'trim|required|min_length[5]|max_length[60]|xss_clean');
				$this->form_validation->set_rules('phone','phone', 'trim|xss_clean|min_length[10]|max_length[60]|');
				if($this->form_validation->run()){
					$update_data['user_name']=$this->input->post('user_name');
					$update_data['skype']=$this->input->post('skype');
					$update_data['full_name']=$this->input->post('full_name');
					$update_data['email'] = $this->input->post('email');
					$update_data['address'] =$this->input->post('address');
					$update_data['perm'] = $this->input->post('perm');
					$update_data['phone']=$this->input->post('phone');
					$this->users_model->update($update_data,array('id'=>$id));
					$this->session->set_flashdata('msg_ok',$this->lang->line('edit_successfully'));
					redirect(base_url().'admin/users/edit?id='.$id);
				}
			}
			$data['obj']=$this->users_model->get_by_id($id);
			if($data['obj']==null){
				redirect('notfound');
			}
			$this->render_backend_tp('backends/users/edit',$data);
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
			$user=$this->users_model->get_by_id($id);
			if($user==null){
				redirect('notfound');
			}
			if($user[0]->perm != ADMIN){
				try {
					unlink($user[0]->avt);
				} catch (Exception $e) {
					
				}
				$this->users_model->remove_by_id($id);
			}
		}
		redirect('admin/users');
	}

	function activate(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$this->users_model->update(array('activated'=>ACTIVATED),array('id'=>$id));
		}
		redirect('admin/users');
	}

	function deactivate(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			$this->users_model->update(array('activated'=>DEACTIVATED),array('id'=>$id));
		}
		redirect('admin/users');
	}


	public function search(){
		if(isset($_GET['query'])){
			$query=$this->input->get('query');
			$data=parent::getDataView();
			$page     = $this->input->get('page') ? $this->input->get('page') : 0;
			$per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
			$order    = $this->input->get('order') ? $this->input->get('order') : 'DESC';
			$config['total_rows'] = $this->users_model->total(array(), array('user_name'=>$query));
			$config['base_url']= base_url() . 'admin/users/search?order='.$order.'&query='.$query;
			$config['per_page']=$per_page;
			$data['msg_label']=$this->config->item('msg_label');
			$this->pagination->initialize($config);
			$data['list'] = $this->users_model->get_by_name($query,$page,$per_page);
			$data['page_link'] = $this->pagination->create_links();
			$data['search_title']=$this->lang->line('result_search_for').'&nbsp;"'.$query.'"';
			$this->render_backend_tp('backends/users/index',$data);

		}
	}


}
?>