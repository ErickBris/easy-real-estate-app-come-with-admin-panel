<!doctype html>
<html>
<head>
	<?php
	$CI =& get_instance();
	$CI->load->view('backends/commons/header');
	?>
</head>
<body>
	<div class="row">
		<div class="alert alert-danger">
			<?php echo lang('msg_access_denied'); ?><a href="<?php echo base_url()?>"><?php echo lang('msg_home_page'); ?></a>
		</div>
	</div>
	<style type="text/css">
	.alert{
		text-align: center;
		margin-top: 10px;
		margin-left: 50px;
		margin-right: 20px;
	}
	</style>
</body>
</html>