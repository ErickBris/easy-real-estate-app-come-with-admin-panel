<div class="container wrapper">
	<div class="page-header controls-wrapper">
		<a href="<?php echo base_url().'admin/marker/create';?>" class="btn btn-primary"><?php echo lang('msg_add');?></a>
	</div>
	<h4>
		<?php if(isset($search_title)){
			echo $search_title;
		}
		?>
		
	</h4>

	<!--end show alert messager-->
	<div class="row wrapper">
		<div class="col-lg-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th><a href="">#</a></th>
						<th><?php echo lang('msg_marker');?></th>
						<th colspan="2"><?php echo lang('msg_operation');?></th>
					</tr>
				</thead>
				<tbody>
					<?php if($list!=null)
					foreach($list as $r){
						?>
						<tr>
							<td><?php echo $r->id;?></td>
							<td><img src="<?php echo base_url().$r->path;?>"/></td>
							<td><a class="btn btn-info" href="<?php echo base_url().'admin/marker/edit?id='.$r->id;?>" ><?php echo lang('msg_edit');?></a></td>
							<td><a class="btn btn-danger" href=" <?php echo base_url().'admin/marker/delete?id='.$r->id;?>" onclick="return confirm('<?php echo lang('msg_confirm_delete');?>')"><?php echo lang('msg_delete');?></a></td>
						</tr>
						<?php };?>
					</tbody>
				</table>
				<?php echo $page_link;?>
			</div>
		</div>
	</div>