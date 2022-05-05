<div class="container wrapper">

	<!--show alert messager-->

	<!--end show alert messager-->

	<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data">
		<fieldset>
			<legend>
				<?php echo lang('msg_settings');?>&nbsp;-&nbsp;<?php echo lang('msg_contact_info');?>
			</legend>

			<div class="form-group">
				<label class="control-label col-xs-3" for="txtName"><?php echo lang('msg_email');?></label>
				<div class="controls col-xs-9">
					<input type="text" class="form-control" name="email" id="email" value="<?php echo $obj['email']; ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-3" for="txtName"><?php echo lang('msg_skype');?></label>
				<div class="controls col-xs-9">
					<input type="text" class="form-control" name="skype" id="skype" value="<?php echo $obj['skype']; ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-3" for="txtName"><?php echo lang('msg_phone');?></label>
				<div class="controls col-xs-9">
					<input type="text" class="form-control" name="phone" id="phone" value="<?php echo $obj['phone']; ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-3" for="txtName"><?php echo lang('msg_fax');?></label>
				<div class="controls col-xs-9">
					<input type="text" class="form-control" id="fax" name="fax" value="<?php echo $obj['fax']; ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-3" for="txtName"><?php echo lang('msg_address');?></label>
				<div class="controls col-xs-9">
					<textarea rows="10" class="form-control" id="address" name="address"><?php echo $obj['address']; ?></textarea>	
				</div>
			</div>

			<div class="form-group">
				<div class="col-xs-9 col-xs-offset-3">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save');?>
					</button>
					<a href="<?php echo base_url();?>admin/settings/reset_contact_info_settings" class="btn btn-default">
						<?php echo lang('reset_default');?>
					</a>
				</div>
			</div>
		</fieldset>
	</form>
</div>
</div>