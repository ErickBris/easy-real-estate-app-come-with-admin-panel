<div id="content">
	<div class="container block-shadow">
		<div class="page-header"><h4><?php echo lang('msg_update_profile');?></h4></div>
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
					<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_avatar');?></label>
					<div class="col-xs-10">
						<img src="<?php echo ($obj[0]->avt!=null)?base_url().$obj[0]->avt:base_url().'statics/images/ic_avatar.png'; ?>" width="100" height="100">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_upload_avatar');?></label>
					<div class="col-xs-10">
						<input type="file" id="avt" class="form-control" name="avt">
						<span style="margin-top:5px;display:block">JPEG|JPN|PNG 5MB</span>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_full_name');?></label>
					<div class="col-xs-10">
						<input type="text" id="full_name" class="form-control" name="full_name"  value="<?php echo $obj[0]->full_name;?>">
						<?php echo form_error('full_name');?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_email');?></label>
					<div class="col-xs-10">
						<input type="text" id="email" class="form-control" name="email" value="<?php echo $obj[0]->email;?>">
						<?php echo form_error('email');?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_phone');?></label>
					<div class="col-xs-10">
						<input type="text" id="phone" class="form-control" name="phone" value="<?php echo $obj[0]->phone;?>">
						<?php echo form_error('phone');?>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_skype');?></label>
					<div class="col-xs-10">
						<input type="text" id="skype" class="form-control" name="skype" value="<?php echo $obj[0]->skype;?>">
					</div>
				</div>


				<div class="form-group">
					<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_address');?></label>
					<div class="col-xs-10">
						<input type="text" id="address" class="form-control" name="address" value="<?php echo $obj[0]->address;?>">
						<?php echo form_error('address');?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-10 col-xs-offset-2">
						<button type="submit" class="btn btn-primary" >
							<?php echo lang('msg_save');?>
						</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
