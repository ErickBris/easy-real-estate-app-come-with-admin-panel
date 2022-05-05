<?php
include_once(APPPATH . 'core/Backend_Controller.php');
class marker extends Backend_Controller{


	function __construct()
	{
		parent::__construct();
		$this->load->model('marker_model');
		$this->bk_menu=4;
		$this->bk_title=$this->lang->line('msg_marker');
	}

	function index(){
		$base_url=base_url().'admin/marker';
		$page=$this->uri->segment(3);
		if(!is_numeric($page) || $page<=0){
			$page=1;
		}
		$first=($page-1)*$this->pg_per_page;
		$total_rows=$this->marker_model->total(array(),array());

		$data['list'] = $this->marker_model->get("*", array(),array(),$first, $this->pg_per_page, array('marker.id' => 'DESC'));
		$data['page_link'] =parent::pagination_config($base_url,$total_rows,$this->pg_per_page);
		$this->render_backend_tp('backends/marker/index',$data);
	}

	public function create(){
		if(isset($_FILES['marker'])){
			$this->load->helper('Ultils');
			$dir='uploads/marker';
			$filename=$_FILES['marker']['name'];
			$_FILES['marker']['name']=rename_upload_file($filename);
			$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
			$config['max_size']	= '5000';
			$config['upload_path']=$dir;
			$this->load->library('upload',$config);
			if ($this->upload->do_upload('marker'))
			{
				$this->load->model('marker_model');
				$data['path']=$dir.'/'.$_FILES['marker']['name'];
				$this->marker_model->insert($data);
				$this->session->set_flashdata('msg_ok', $this->lang->line('add_successfully'));
				redirect('admin/marker/create');
			}else{
				$this->session->set_flashdata('msg_error', $this->upload->display_errors());
				redirect('admin/marker/create');
			}	
		}	
		$this->render_backend_tp('backends/marker/add');
	}

	public function edit(){
		if(isset($_GET['id'])){
			$id=$this->input->get('id');
			if(!is_numeric($id) || $id<=0){
				redirect('notfound');
			}
			
			if(isset($_FILES['marker'])){
				$id=$this->input->post('id_post');
				$this->load->helper('Ultils');
				$dir='uploads/marker';
				$filename=$_FILES['marker']['name'];
				$_FILES['marker']['name']=rename_upload_file($filename);
				$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
				$config['max_size']	= '5000';
				$config['upload_path']=$dir;
				$this->load->library('upload',$config);
				if ($this->upload->do_upload('marker'))
				{
					$this->load->model('marker_model');
					try {
						$marker=$this->marker_model->get_by_id($id);
						if($marker[0]->path!=null){
							unlink($marker[0]->path);
						}
					} catch (Exception $e) {
					}
					$data['path']=$dir.'/'.$_FILES['marker']['name'];
					$this->marker_model->update($data,array('id'=>$id));
					$this->session->set_flashdata('msg_ok', $this->lang->line('edit_successfully'));
					redirect('admin/marker/edit?id='.$id);
				}else{
					$this->session->set_flashdata('msg_error', $this->upload->display_errors());
					redirect('admin/marker/edit?id='.$id);
				}	
			}	

			$data['obj']=$this->marker_model->get_by_id($id);
			if($data['obj']==null){
				redirect('notfound');
			}
			$this->render_backend_tp('backends/marker/edit',$data);
		}else{
			redirect('notfound');
		}
	}

	public function delete(){
		if(isset($_GET['id'])){
			$this->load->model('marker_model');
			$id=$this->input->get('id');
			try {
				$marker=$this->marker_model->get_by_id($id);
				if($marker[0]->path!=null){
					unlink($marker[0]->path);
				}
			} catch (Exception $e) {
				
			}
			$this->marker_model->remove_by_id($id);
			redirect('admin/marker');
		}
	}
}
?>