<?php
class Upload extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('estates_model');
		$this->load->helper('Ultils');
	}

	function upload_estates(){
		if(!isset($_SESSION['user'])){
			//need login to continue
			echo json_encode(array('ok'=>2));
			exit();
		}
		if(isset($_FILES['fileData']) && isset($_POST['id'])){
			$id=$this->input->post('id');
			$dir=create_dir_upload('uploads/');
			$thumb_dir= create_thumb_dir_upload($dir.'/thumbs');
			$filename=$_FILES['fileData']['name'];
			$_FILES['fileData']['name']=rename_upload_file($filename);
			$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|GIF|PNG';
			$config['max_size']	= '5000';
			$config['upload_path']=$dir;
			$this->load->library('upload',$config);
			if ($this->upload->do_upload('fileData'))
			{
				$this->load->model('images_model');
				$data['path']=$dir.'/'.$_FILES['fileData']['name'];
				$original_path=$data['path'];
				$data['estates_id']=$id;
				$images_id = $this->images_model->insert($data);
				$config=array(
                            "source_image" => $dir.'/'.$_FILES['fileData']['name'], //get original image
							"new_image" =>  $thumb_dir, //save as new image //need to create thumbs first
							"width" => 270,
							"height" => 200,
							'master_dim'=>'height'
							);
				$this->load->library('image_lib',$config);
				$this->image_lib->resize();
				$image_path= $thumb_dir.'/'.$_FILES['fileData']['name'];
				$data=null;
				$data['thumb_path']=$image_path;
				$this->estates_model->update(array('image_path'=>$image_path), array('id'=>$id));
				$this->images_model->update($data,array('id'=>$images_id));
				$return_data=array(
					'ok'=>1,
					'thumb_path'=>$image_path,
					'estates_id'=>$id,
					'id'=>$images_id,
					'path'=>$original_path
					);
				echo json_encode($return_data);
			}
			else
			{
				echo json_encode(array('ok'=>0));
			}
		}
	}
}
?>