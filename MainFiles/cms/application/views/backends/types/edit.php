<?php
$CI =& get_instance();
;?>
<div class="container wrapper">
	<form class="form-horizontal" id="form" method="post" >
		<fieldset>
			<legend>
				<?php echo lang('msg_edit_types');?>
			</legend>
			<?php 
			if($CI->session->flashdata('msg_ok')){
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
			}
			;?>
			<input type="hidden" name="id_post" id="id_post" value="<?php echo $obj[0]->id;?>">
			<div class="form-group">
				<label class="control-label col-sm-2" for="txtName"><?php echo lang('msg_name');?></label>
				<div class="controls col-sm-10">
					<input type="text" id="name" name="name" value="<?php echo $obj[0]->name;?>" class="form-control">
					<?php echo form_error('name');?>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save');?>
					</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>
</div>