<div class="container wrapper">

	<!--show alert messager-->

	<!--end show alert messager-->

	<form class="form-horizontal" id="form" method="post" action="" enctype="multipart/form-data">
		<fieldset>
			<legend>
				<?php echo lang('msg_settings');?>&nbsp;-&nbsp;<?php echo lang('msg_default_location');?>
			</legend>

			<div class="form-group">
				<label class="control-label col-xs-3" for="txtName"><?php echo lang('msg_latitude');?></label>
				<div class="controls col-xs-9">
					<input type="text" class="form-control" name="lat" value="<?php echo $obj['lat']; ?>">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-3" for="txtName"><?php echo lang('msg_longitude');?></label>
				<div class="controls col-xs-9">
					<input type="text" class="form-control" name="lng" value="<?php echo $obj['lng']; ?>">
				</div>
			</div>


			<div class="form-group">
				<div class="col-xs-9 col-xs-offset-3">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save');?>
					</button>
					<a href="<?php echo base_url();?>admin/settings/reset_default_location" class="btn btn-default">
						<?php echo lang('reset_default');?>
					</a>
					<?php echo lang('msg_how_to_get_lat_long');?>
					<a href="http://universimmedia.pagesperso-orange.fr/geo/loc.htm">
						<?php echo lang('msg_here'); ?>
					</a>
				</div>
			</div>
		</fieldset>
	</form>
</div>
</div>