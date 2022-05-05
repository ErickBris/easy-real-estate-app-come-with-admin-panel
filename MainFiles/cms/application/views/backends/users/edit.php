<?php
$CI =& get_instance();
?>
<div class="container-fluid wrapper">
	<form class="form-horizontal" id="form" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>
				<?php echo lang('msg_edit_users');?>
			</legend>
			<?php 
			if($CI->session->flashdata('msg_ok')){
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
			}
			?>
			<input type="hidden" name="id_post" id="id_post" value="<?php echo $obj[0]->id;?>">
			<div class="form-group">
				<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_user_name'); ?></label>
				<div class="col-xs-10">
					<input type="text" id="user_name" class="form-control" name="user_name" value="<?php echo $obj[0]->user_name;?>">
					<?php echo form_error('user_name');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_full_name'); ?></label>
				<div class="col-xs-10">
					<input type="text" id="full_name" class="form-control" name="full_name"  value="<?php echo $obj[0]->full_name;?>">
					<?php echo form_error('full_name');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_email'); ?></label>
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
					<?php echo form_error('skype');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_address'); ?></label>
				<div class="col-xs-10">
					<input type="text" id="address" class="form-control" name="address" value="<?php echo $obj[0]->address;?>">
					<?php echo form_error('address');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_perm');?></label>
				<div class="col-xs-10">
					<select name="perm" class="form-control">
						<option value="<?php echo USER;?>" <?php if($obj[0]->perm==USER){ echo 'selected'; }  ?>><?php echo lang('msg_user');?></option>
						<option value="<?php echo AGENT;?>" <?php if($obj[0]->perm==AGENT){ echo 'selected'; }  ?>><?php echo lang('msg_agent');?></option>
						<option value="<?php echo ADMIN;?>" <?php if($obj[0]->perm==ADMIN){ echo 'selected'; }  ?>><?php echo lang('msg_admin');?></option>
					</select>
					<?php echo form_error('perm');?>
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

	