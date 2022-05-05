<div class="container wrapper">
	<script type="text/javascript">
	$('.search-query').keypress(function(e) {
		var code = (e.keyCode ? e.keyCode : e.which);
		if (code == 13) {
			var q = $('.search-query').val();
			if (q != "") {
				location.href ="<?php echo base_url().'admin/contact/search';?>?query=" + q;
			}
		}
	})
	</script>

	<h4>
		<?php if(isset($search_title)){?>
		<?php echo $search_title;?>
		<?php }; ?>
	</h4>

	<!--end show alert messager-->
	<div class="row wrapper">
		<div class="col-md-12 col-xs-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th><a href="">#</a></th>
						<th><?php echo lang('subject');?></th>
						<th><?php echo lang('msg_full_name'); ?></th>
						<th><?php echo lang('msg_email');?></th>
						<th><?php echo lang('msg_phone');?></th>
						<th><?php echo lang('msg_content') ?></th>
						<th><?php echo lang('is_read'); ?></th>
						<th colspan="3"><?php echo lang('msg_operation');?></th>
					</tr>
				</thead>
				<tbody>
					<?php if($list!=null)
					foreach($list as $r){
						?>
						<tr>
							<td><?php echo $r->id;?></td>
							<td><?php echo $r->subject; ?></td>
							<td><?php echo $r->full_name; ?></td>
							<td><?php echo $r->email;?></td>
							<td><?php echo $r->phone ?></td>
							<td><?php echo $r->content; ?></td>
							<td>
								<?php 
									if($r->is_read==IS_READED){
										echo '<span class="label label-success">'.lang('msg_yes').'</span>';
									}else{
										echo '<span class="label label-danger">'.lang('msg_no').'</span>';
									}
								?>
							</td>
							<td><a class="btn btn-primary" href="<?php echo base_url().'admin/contact/mark_as_read?id='.$r->id?>"><?php echo lang('msg_mark_read'); ?></a></td>
							<td><a class="btn btn-info"  href="<?php echo base_url().'admin/contact/reply?id='.$r->id;?>"><?php echo lang('msg_reply');?></a></td>
							<td><a class="btn btn-danger" href="<?php echo base_url().'admin/contact/delete?id='.$r->id;?>" onclick="return confirm('<?php echo lang('msg_confirm_delete');?>')"><?php echo lang('msg_delete');?></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php echo $page_link;?>
			</div>
		</div>
	</div>