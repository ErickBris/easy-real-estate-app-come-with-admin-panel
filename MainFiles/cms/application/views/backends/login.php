<!doctype html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php echo (isset($title))?$title:''; ?></title> 
	<script type="text/javascript" src="<?php echo base_url().'statics/js/jquery.js'?>"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url().'statics/bootstrap/css/bootstrap.min.css'?>"/>
	<script type="text/javascript" src="<?php echo base_url().'statics/bootstrap/js/bootstrap.min.js'?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/css/backend/login.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>statics/css/custom-control.css">
	<link rel="shortcut icon" href="<?php echo base_url(); ?>statics/images/favicon.ico" />
	<style type="text/css">
	@font-face {
		font-family: 'OpenSans'; /*a name to be used later*/
		src: url('<?php echo base_url();?>statics/fonts/OpenSans-Light.ttf'); /*URL to font*/
	}
	*{
		font-family: "OpenSans","Arial",sans-serif !important;
		font-weight:300;
	}
	</style>
</head>
<body>
	<div class="container">
		<div class="row form-wrapper pin">
			<div class="page-header">
				<h3> <?php echo lang('msg_login') ?></h3>
			</div>

			<form class="form-login" method="post" action="<?php echo base_url()?>admin/dashboard/login">
				<div class="form-group">
					<label><?php echo lang('msg_user_name');?></label>
					<input name="user_name" id="user_name" type="text" class="form-control" placeholder="Username" size="50" >
					<?php echo form_error('user_name')?>
				</div>

				<div class="form-group">
					<!-- password -->
					<label><?php echo lang('msg_pwd');?></label>
					<input name="pwd" id="pwd" type="password" class="form-control" placeholder="Password" size="50">
					<?php echo form_error('pwd')?>
				</div>

				<?php
				if(isset($error_msg)){
					echo $error_msg;
				}
				?>
				<button class="btn btn-success" type="submit"><?php echo lang('msg_login') ?></button>
			</form>
		</div>
	</div>
</body>
</html>