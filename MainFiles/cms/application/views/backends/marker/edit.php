<?php
$CI =& get_instance();
?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#name').focus();
});
</script>
<div class="container-fluid wrapper">
	<form class="form-horizontal" id="form" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id_post" value="<?php echo $obj[0]->id; ?>">
		<fieldset>
			<legend>
				<?php echo lang('msg_edit_marker'); ?>
			</legend>

			<?php 
			if($CI->session->flashdata('msg_ok')){
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
			}
			if($CI->session->flashdata('msg_error')){
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_error').'</div>';
			}
			?>
			<div class="form-group">
				<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_marker');?></label>
				<div class="col-xs-10">
					<img src="<?php echo base_url().$obj[0]->path; ?>" style="max-width:80;max-height:100">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_browser'); ?></label>
				<div class="col-xs-10">
					<input type="file" id="marker" name="marker" class="form-control" >
					<span style="margin-top:5px;display:block">JPEG|JPN|PNG 5MB</span>
				</div>
			</div>

			<div class="form-group">
				<div class="col-xs-10 col-xs-offset-2">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save'); ?>
					</button>
					<input type="reset" class="btn" value="<?php echo lang('msg_reset'); ?>"/>
				</div>
			</div>
		</fieldset>
	</form>
