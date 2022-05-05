<script type="text/javascript" src="<?php echo base_url()?>statics/tinymce/jquery.tinymce.js"></script>
<?php
$CI =& get_instance();
;?>
<div class="container wrapper">
	<form class="form-horizontal" id="form" method="post" action="<?php echo base_url().'admin/pages/edit?id='.$obj[0]->id; ?>">
		<fieldset>
			<legend>
				<?php echo lang('msg_edit_page');?>
			</legend>
			<?php 
			if($CI->session->flashdata('msg_ok')){
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>'.$CI->session->flashdata('msg_ok').'</div>';
			}
			;?>
			<input type="hidden" id="id_post" name="id_post" value="<?php echo $obj[0]->id; ?>"> 

			<div class="form-group">
				<label class="control-label col-xs-2" for="txtName"></label>
				<div class="col-xs-10">

					<div class="checkbox">
						<label>
							<input type="checkbox" name="is_menu" value="<?php echo IS_MENU; ?>" <?php if($obj[0]->is_menu==IS_MENU){echo 'checked';} ?>> <?php echo lang('msg_is_menu'); ?>
						</label>
					</div>

				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-2"><?php echo lang('msg_title');?></label>
				<div class="col-xs-10">
					<input type="text" id="title" name="title" class="form-control" value="<?php echo $obj[0]->title; ?>" placeholder="<?php echo lang('msg_title'); ?>">
					<?php echo form_error('title');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-2"><?php echo lang('msg_slug');?></label>
				<div class="col-xs-10">
					<input type="text" id="slug" name="slug" class="form-control" value="<?php echo $obj[0]->slug ?>" placeholder="<?php echo lang('msg_slug'); ?>" >
					<?php echo form_error('slug');?>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_keywords');?></label>
				<div class="col-xs-10">
					<textarea class="form-control" rows="10" name="keyword"  placeholder="<?php echo lang('msg_keywords'); ?>"><?php echo $obj[0]->keyword ?></textarea>
					<?php echo form_error('keyword');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_description');?></label>
				<div class="col-xs-10">
					<textarea class="form-control" rows="10" name="description" placeholder="<?php echo lang('msg_description'); ?>"><?php echo $obj[0]->description ?></textarea>
					<?php echo form_error('description');?>
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-xs-2" for="txtName"><?php echo lang('msg_content');?></label>
				<div class="col-xs-10">
					<textarea class="form-control" rows="10" id="content" name="content" placeholder="<?php echo lang('msg_content'); ?>"><?php echo htmlspecialchars_decode($obj[0]->content); ?></textarea>
					<?php echo form_error('content');?>
				</div>
			</div>




			<?php ///echo htmlspecialchars_decode($obj[0]->content); ?>

			<div class="form-group">
				<div class="col-xs-10 col-xs-offset-2">
					<button type="submit" class="btn btn-primary" >
						<?php echo lang('msg_save');?>
					</button>
					<input type="reset" class="btn" value="<?php echo lang('msg_reset');?>"/>
				</div>
			</div>

		</fieldset>
	</form>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#content').tinymce({
                        // Location of TinyMCE script
                        script_url : '<?php echo base_url()?>statics/tinymce/tiny_mce.js',
                        language : "vi",
                        width:'100%',
                        height:'500',
                        // General options
                        theme : "advanced",
                        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

                        // Theme options
                        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                        theme_advanced_toolbar_location : "top",
                        theme_advanced_toolbar_align : "left",
                        theme_advanced_statusbar_location : "bottom",
                        theme_advanced_resizing : true,

                        // Example content CSS (should be your site CSS)
                        //content_css : "css/content.css",

                        // Drop lists for link/image/media/template dialogs
                        template_external_list_url : "lists/template_list.js",
                        external_link_list_url : "lists/link_list.js",
                        external_image_list_url : "lists/image_list.js",
                        media_external_list_url : "lists/media_list.js",

                        // Replace values for the template plugin
                        template_replace_values : {
                        	username : "Some User",
                        	staffid : "991234"
                        }
                    });	
});
</script>
