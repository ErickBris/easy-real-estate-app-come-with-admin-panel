<nav class="navbar navbar-inverse navbar-default" role="navigation">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header active">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><?php echo SITE_NAME;?></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li <?php if($menu==0){echo 'class="active"';} ?>>
					<a href="<?php echo base_url().'admin/types'?>"><?php echo lang('msg_types')?></a>
				</li>
				<li <?php if($menu==1){echo 'class="active"';} ?>>
					<a href="<?php echo base_url().'admin/estates'?>"><?php echo lang('msg_estates')?></a>
				</li>
				<li <?php if($menu==2){echo 'class="active"';} ?>>
					<a href="<?php echo base_url().'admin/county'?>"><?php echo lang('msg_county')?></a>
				</li>
				<li <?php if($menu==3){echo 'class="active"';} ?>>
					<a href="<?php echo base_url().'admin/cities'?>"><?php echo lang('msg_city')?></a>
				</li>
				<li <?php if($menu==4){echo 'class="active"';} ?>>
					<a href="<?php echo base_url().'admin/marker'?>"><?php echo lang('msg_marker'); ?></a>
				</li>
				<li <?php if($menu==5){echo 'class="active"';} ?>>
					<a href="<?php echo base_url().'admin/users'?>"><?php echo lang('msg_users')?></a>
				</li>
				<li <?php if($menu==6){echo 'class="active"';} ?>>
					<a href="<?php echo base_url().'admin/amenities'?>"><?php echo lang('msg_amenities')?></a>
				</li>
				<li <?php if($menu==7){echo 'class="active"';} ?>>
					<a href="<?php echo base_url().'admin/contact'?>"><?php echo lang('msg_contact')?></a>
				</li>
				<li <?php if($menu==8){echo 'class="active"';} ?>>
					<a href="<?php echo base_url().'admin/pages'; ?>"><?php echo lang('msg_pages'); ?></a>
				</li>
				<li class="dropdown <?php if($menu==9){echo 'active';} ?>">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo lang('msg_settings')?><b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url().'admin/settings/general'?>" class="red"><?php echo lang('msg_general')?></a></li>
						<li><a href="<?php echo base_url().'admin/settings/currency'?>" class="red"><?php echo lang('msg_currency')?></a></li>
						<li><a href="<?php echo base_url().'admin/settings/mail'?>" class="red"><?php echo lang('msg_email')?></a></li>
						<li><a href="<?php echo base_url().'admin/settings/contact_info'?>" class="red"><?php echo lang('msg_contact_info')?></a></li>
						<li><a href="<?php echo base_url().'admin/settings/default_location'?>" class="red"><?php echo lang('msg_default_location')?></a></li>
					</ul>
				</li>
			</ul>
			<?php
			$CI =& get_instance();
			$CI->load->view('backends/commons/userbox');
			?>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>