<style type="text/css">
#content .container{
	background: #ffffff
}

#content .btn-wrapper{
	margin: 5px auto;
}
</style>
<div id="content">
	<div class="container block-shadow">
		<div class="page-header"><h4>
			<?php echo lang('msg_update_pwd');?>
		</h4></div>
		<!--show alert messager-->
		<?php 
		$CI =& get_instance();
		if($CI->session->flashdata('msg_ok')){
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
		}
		if($CI->session->flashdata('msg_failed')){
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_failed').'</div>';
		}
		?>
		<!--end show alert messager-->
		<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data">
			<fieldset>
				<input type="hidden" name="id" id="id" value="<?php echo $obj[0]->id;?>">

				<div class="form-group">
					<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_old_pwd');?></label>
					<div class="col-xs-10">
						<input type="password" id="old_pwd" class="form-control" name="old_pwd"  value="<?php echo set_value('old_pwd');?>">
						<?php echo form_error('old_pwd');?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_new_pwd');?></label>
					<div class="col-xs-10">
						<input type="password" id="new_pwd" class="form-control" name="new_pwd" value="<?php echo set_value('new_pwd');?>">
						<?php echo form_error('new_pwd');?>
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_cfm_pwd');?></label>
					<div class="col-xs-10">
						<input type="password" id="cfm_pwd" class="form-control" name="cfm_pwd" value="<?php echo set_value('cfm_pwd');?>">
						<?php echo form_error('cfm_pwd');?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-offset-2 col-xs-10">
						<button type="submit" class="btn btn-primary" >
							<?php echo lang('msg_save');?>
						</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>