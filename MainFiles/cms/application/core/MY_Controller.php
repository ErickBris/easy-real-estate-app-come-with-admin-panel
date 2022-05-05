<?php if (!defined('BASEPATH'))
exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	protected $bk_menu = 0;
	protected $ft_menu=0;
	protected $bk_title = SITE_NAME;
	protected $ft_title=SITE_NAME;
	protected $pg_per_page=10;
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
		$this->load->helper('language');
		$this->lang->load('msg',$this->config->item('language'));
		$this->form_validation->set_error_delimiters('<span class="help-inline msg-error" generated="true">', '</span>');
		$this->load->helper('settings');
	}

	function render_backend_tp($content, $data = null){
		$data['general_setting']=getSettings(GENERAL_SETTING_FILE);
		$data['contact_info_setting']=getSettings(CONTACT_INFO_SETTING_FILE);
		$this->template->set_template('backend');
		$data['menu']=$this->bk_menu;
		$data['title']=$this->bk_title;
		$this->template->write_view('content',$content,$data);
		$this->template->render();
	}

	
	function render_frontend_tp($content, $template = 'default', $data = null )
	{
		$data['general_setting']=getSettings(GENERAL_SETTING_FILE);
		$data['contact_info_setting']=getSettings(CONTACT_INFO_SETTING_FILE);
		$this->template->set_template($template);
		$data['title']=$this->ft_title;
		$data['menu']=$this->ft_menu;
		$this->template->write_view('content',$content,$data);
		$this->template->render();
	}

	protected function authentication_backend(){
		if(!isset($_SESSION['user'])){
			redirect('admin/dashboard');
		}else{
			$user=$_SESSION['user'][0];
			if($user->perm==USER){
				redirect('admin/denied');
			}
		}
	}

	protected function authentication_frontend(){
		if(!isset($_SESSION['user'])){
			redirect(base_url().'users/login');
		}
	}

	function pagination_config($base_url,$total_rows,$per_page=10,$uri_segment=3){
		$config['total_rows'] = $total_rows;
		$config['base_url']=$base_url;
		$config['per_page']=$per_page;
		$config['uri_segment']=$uri_segment;
		$this->pagination->initialize($config);
		$data=$this->pagination->create_links();
		return $data;
	}

	function search_pagination_config($base_url,$total_rows,$per_page=10,$uri_segment=3){
		$config['total_rows'] = $total_rows;
		$config['base_url']=$base_url;
		$config['per_page']=$per_page;
		//$config['uri_segment']=$uri_segment;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		$this->pagination->initialize($config);
		$data=$this->pagination->create_links();
		return $data;
	}

	function demo(){
		//demo code
		redirect('admin/denied/demo');
	}

	function post_demo(){
		if($_POST){
			//$this->demo();
		}
	}
	
}

/* End of file MY_Controller.php */

/* Location: ./application/core/MY_Controller.php */

