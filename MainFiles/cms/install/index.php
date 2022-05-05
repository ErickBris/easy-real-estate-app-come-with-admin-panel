<?php
ob_start();
$db_config_path = '../application/config/database.php';
if($_POST) {
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();
	$flag=true;

	$error_msg='Something wrong, please check note below: ';

	$hostname=$_POST['host_name'];
	$db_username=$_POST['db_username'];
	$db_pwd=$_POST['db_pwd'];
	$db_name=$_POST['db_name'];
	$user_name=$_POST['user_name'];
	$pwd=$_POST['pwd'];
	$email=$_POST['email'];

	if($hostname==null){
		$error_msg.='</br>+, hostname is required';
		$flag=false;
	}

	if($db_username==null){
		$error_msg.='</br>+, username database is required';
		$flag=false;
	}else{

	}


	if($db_name==null){
		$error_msg.='</br>+, database name is required';
		$flag=false;
	}

	if($user_name==null){
		$error_msg.='</br>+, username account is required';
		$flag=false;
	}else{
		if(!preg_match('/^\w{5,60}$/', $user_name)) { 
			$error_msg.='</br>+, username account is invalid, from 5 to 60 character, not contain spaces and special character';
			$flag=false;
		}
	}


	if($pwd==null){
		$error_msg.='</br>+, password account is required';
		$flag=false;
	}else{
		if(!preg_match('/^\w{5,60}$/', $pwd)) { 
			$error_msg.='</br>+, password account is invalid, from 5 to 60 character, not contain spaces and special character';
			$flag=false;
		}
	}


	if($email!=null){
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
		if (!preg_match($regex, $email)) {
			$error_msg.='</br>+, your email you supply is not valid';
			$flag=false;
		} 
	}



	if($flag==false){
		$message=$error_msg;
	}else{

		    // First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		}else if($database->create_admin_account($_POST)==false){
			$message = $core->show_message('error',"Cannot insert admin account. Please try re install");
		}

		if(!isset($message)) {
			$redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
			$redir .= "://".$_SERVER['HTTP_HOST'];
			$redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
			$redir = str_replace('install/','',$redir); 
			header( 'Location: ' . $redir . 'admin/dashboard' ) ;
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="">
	<title>Install | Easy Real Estates CMS</title>
	<script type="text/javascript" src="../statics/js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="../statics/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="../statics/bootstrap/css/bootstrap-responsive.min.css"/>
	<link rel="stylesheet" type="text/css" media="screen" href="../statics/css/custom-control.css"/>
	<script type="text/javascript" src="../statics/js/jquery.blockUI.js"></script>
	<link rel="shortcut icon" href="../statics/images/favicon.ico" />

	<style type="text/css">
	.required{
		color :red;
	}

	body .form-wrapper{
		display: block;
		max-width: 600px;
		top: -20px;
		display: block;
		position: relative;
		overflow: hidden;
		opacity: 1;
		-webkit-column-break-inside: avoid;
		-moz-column-break-inside: avoid;
		column-break-inside: avoid;
		-webkit-transition: all .2s ease;
		-moz-transition: all .2s ease;
		-o-transition: all .2s ease;
		transition: all .2s ease;
		background: #ffffff;
		margin: 0px auto;
	}

	@font-face {
		font-family: 'OpenSans'; /*a name to be used later*/
		src: url('../statics/fonts/OpenSans-Light.ttf'); /*URL to font*/
	}
	*{
		font-family: "OpenSans","Arial",sans-serif !important;
		font-weight:300;
	}

	</style>

	<script type="text/javascript">
	jQuery(document).ready(function($) {
			//$.blockUI({overlayCSS: { backgroundColor: '#00f'}}); 
			$( "#install_form" ).submit(function( event ) {
			//alert("fas");
			$.blockUI({overlayCSS: { backgroundColor: '#00f'}}); 
		});
		});
	</script>
</head>
<body>
	<div class="page-header" style="text-align:center">
		<h3><b>Easy Real Estates CMS</b> Install Wizard</h3>
	</div>
	<div class="container">
		<?php if(is_writable($db_config_path)){?>

		<?php if(isset($message)) {echo '<div class="alert alert-danger">' . $message . '</div>';}?>
		<div class="row form-wrapper">
			<form id="install_form" name="install_form" class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<fieldset>
					<div class="page-header">
						<h3>Database info</h3>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-4">Host Name&nbsp;<span class="required">*</span></label>
						<div class="controls col-xs-8">
							<input type="text" name="host_name" value="<?php echo isset($hostname)?$hostname:''; ?>" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-4">Username&nbsp;<span class="required">*</span></label>
						<div class="controls col-xs-8">
							<input type="text" name="db_username" value="<?php echo isset($db_username)?$db_username:''; ?>" class="form-control">
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-xs-4">Password (Optional)</label>
						<div class="controls col-xs-8">
							<input type="password" name="db_pwd" value="<?php echo isset($db_pwd)?$db_pwd:''; ?>" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-4">DatabaseName&nbsp;<span class="required">*</span></label>
						<div class="controls col-xs-8">
							<input type="text" name="db_name" value="" class="form-control">
						</div>
					</div>



					<div class="page-header">
						<h3>Admin Account info</h3>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-4">UserName&nbsp;<span class="required">*</span></label>
						<div class="controls col-xs-8">
							<input type="text" name="user_name" value="<?php echo isset($user_name)?$user_name:''; ?>" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-4">Email (Optional)</label>
						<div class="controls col-xs-8">
							<input type="text" name="email" value="<?php echo isset($email)?$email:''; ?>" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-4">Password&nbsp;<span class="required">*</span></label>
						<div class="controls col-xs-8">
							<input type="password" name="pwd" value="<?php echo isset($pwd)?$pwd:''; ?>" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-8 col-xs-offset-4">
							<input type="submit" value="Install" id="submit" class="btn btn-default">
						</div>
					</div>
				</fieldset>
			</form>
		</div>

		<?php } else { ?>
		<p class="error">Please make the application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>
		<?php } ?>
	</div>
</body>
</html>