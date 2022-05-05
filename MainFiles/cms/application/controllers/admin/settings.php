<?php
include_once(APPPATH . 'core/Backend_Controller.php');
class Settings extends Backend_Controller{
	function __construct()
	{
		parent::__construct();
		$user=$_SESSION['user'][0];
		if($user->perm==AGENT){
			redirect('admin/denied');
		}
		$this->bk_menu=9;
		$this->bk_title=$this->lang->line('msg_settings');
		$this->load->helper('settings');
	}

	function currency(){
		if(isset($_POST['currency'])){
			$currency=$this->input->post('currency');
			$id=$this->input->post('id');
			$settings['currency_symbol']=$currency;
			$settings['currency_id']=$id;

			if(isset($_POST['position'])){
				$position=$this->input->post('position');
				$settings['position']=$position;
			}
			
			setSettings($settings,CURRENCY_SETTING_FILE);
		}
		$this->load->model('countries_model');
		$data['list']=$this->countries_model->get_currency();
		$data['obj']=getSettings(CURRENCY_SETTING_FILE);
		$this->render_backend_tp('backends/settings/currency',$data);
	}

	function mail(){
		if(isset($_POST['host'])){
			$host=$this->input->post('host');
			$user=$this->input->post('user');
			$pwd=$this->input->post('pwd');
			$port=$this->input->post('port');
			$mailpath=$this->input->post('mail_path');
			$from_user=$this->input->post('from_user');
			$from_email=$this->input->post('from_email');
			$settings=getSettings(EMAIL_SETTING_FILE);
			$settings['smtp_host']        = $host;
			$settings['smtp_user']        = $user;
			$settings['smtp_pass']        = $pwd;
			$settings['smtp_port']        = $port;
			$settings['from_email']       = $from_email;
			$settings['from_user'] =        $from_user;
			$settings['mailpath']         = $mailpath;
			setSettings($settings,EMAIL_SETTING_FILE);
		}
		$data['obj']=getSettings(EMAIL_SETTING_FILE);
		$this->render_backend_tp('backends/settings/email',$data);
	}

	function reset_mail_settings(){
		resetEmail();
		redirect('admin/settings/mail');
	}

	function reset_general_settings(){
		resetGeneral();
		redirect('admin/settings/general');
	}


	function reset_currency_settings(){
		resetCurrency();
		redirect('admin/settings/currency');
	}
	function reset_contact_info_settings(){
		resetContactInfo();
		redirect('admin/settings/contact_info');
	}

	function general(){
		if(isset($_POST['facebook_fanpage'])){
			$facebook_id=$this->input->post('facebook_fanpage');
			$copyright=$this->input->post('copyright');
			$ga_code=$this->input->post('ga_code');
			$twitter=$this->input->post('twitter');
			$pinterest=$this->input->post('pinterest');
			$google_plus=$this->input->post('google_plus');

			$settings=getSettings(GENERAL_SETTING_FILE);
			$settings['facebook_fanpage']        = $facebook_id;
			$settings['ga_code']        = $ga_code;
			$settings['copyright']=$copyright;
			$settings['twitter']=$twitter;
			$settings['pinterest']=$pinterest;
			$settings['google_plus']=$google_plus;
			setSettings($settings,GENERAL_SETTING_FILE);
		}
		$data['obj']=getSettings(GENERAL_SETTING_FILE);
		$this->render_backend_tp('backends/settings/general',$data);
	}

	function contact_info(){
		if(isset($_POST['email'])){
			$email=$this->input->post('email');
			$phone=$this->input->post('phone');
			$skype=$this->input->post('skype');
			$fax=$this->input->post('fax');
			$address=$this->input->post('address');

			$settings=getSettings(CONTACT_INFO_SETTING_FILE);
			$settings['email']        = $email;
			$settings['phone']        = $phone;
			$settings['skype']        = $skype;
			$settings['fax'] = $fax;
			$settings['address']=$address;
			setSettings($settings,CONTACT_INFO_SETTING_FILE);
		}
		$data['obj']=getSettings(CONTACT_INFO_SETTING_FILE);
		$this->render_backend_tp('backends/settings/contact_info',$data);
	}

	function default_location(){
		if(isset($_POST['lat'])){
			$lat=$this->input->post('lat');
			$lng=$this->input->post('lng');
			$settings=getSettings(DEFAULT_LOCATION_FILE);
			$settings['lat']        = $lat;
			$settings['lng']        = $lng;
			setSettings($settings,DEFAULT_LOCATION_FILE);
		}
		$data['obj']=getSettings(DEFAULT_LOCATION_FILE);
		$this->render_backend_tp('backends/settings/default_location',$data);
	}

	function reset_default_location(){
		resetDefaultLocation();
		redirect('admin/settings/default_location');
	}
}
?>