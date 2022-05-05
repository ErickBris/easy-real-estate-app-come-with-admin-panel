<div class="container wrapper">
	<div class="row wrapper">
		<div class="col-xs-12 col-md-6">
			<div class="page-header"><h3><?php echo lang('msg_lastest_estates');  ?></h3></div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th><a href="">#</a></th>
						<th><?php echo lang('msg_title'); ?></th>
						<th><?php echo lang('msg_price'); ?></th>
						<th><?php echo lang('msg_post_user'); ?></th>
						<th>Operation</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					if($estates!=null)
						foreach($estates as $r){
							?>
							<tr>
								<td><?php echo $r->id;?></td>
								<td><?php echo $r->title;?></td>
								<td><?php echo $r->price;?></td>
								<td><?php echo $r->user_name;?></td>
								<td>
									<div class="btn-group">
										<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
											Operation
											<span class="caret"></span>
										</a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo base_url().'admin/estates/deactivated?id='.$r->id;?>"><?php echo lang('msg_deactivated'); ?></a></li>
											<li><a href="<?php echo base_url().'admin/estates/activated?id='.$r->id;?>"><?php echo lang('msg_activated'); ?></a></li>
											<li><a href="<?php echo base_url().'admin/estates/edit_get?id='.$r->id;?>"><?php echo lang('msg_edit');?></a></li>
											<li><a href="<?php echo base_url().'admin/estates/delete?id='.$r->id;?>" onclick="return confirm('<?php echo lang('msg_confirm_delete'); ?>')"><?php echo lang('msg_delete');?></a></li>
										</ul>
									</div>
								</td>
							</tr>
							<?php 
						}
						?>
					</tbody>
				</table>
			</div>

			<div class="col-md-6 col-xs-12">
				<div class="page-header"><h3><?php echo lang('msg_lastest_contact');  ?></h3></div>
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
							<th colspan="2"><?php echo lang('msg_operation');?></th>
						</tr>
					</thead>
					<tbody>
						<?php if($contact!=null)
						foreach($contact as $r){
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
								<td><a class="btn btn-info"  href="<?php echo base_url().'admin/contact/reply?id='.$r->id;?>"><?php echo lang('msg_reply');?></a></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

			</div>
		</div>
		<!--end row fluid-->