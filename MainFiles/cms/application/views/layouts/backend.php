<!doctype html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<?php 
	$CI =& get_instance();
	$CI->load->view('backends/commons/header');
	echo $general_setting['ga_code'];
	?>
	<style type="text/css">
	@font-face {
		font-family: 'OpenSans'; /*a name to be used later*/
		src: url('<?php echo base_url();?>statics/fonts/OpenSans-Light.ttf'); /*URL to font*/
	}

	.thumbnail{
		max-width: 235px;
		max-height: 150px;
	}

	.navbar{
		border-radius: 0px;
		-moz-border-radius:0px;
		-webkit-border-radius:0px;
	}
	</style>


	<script type="text/javascript">
	$(document).ready(function() {
		//Add Hover effect to menus
		jQuery('ul.nav li.dropdown').hover(function() {
			jQuery(this).find('.dropdown-menu').stop(true, true).delay(0).fadeIn();
		}, function() {
			jQuery(this).find('.dropdown-menu').stop(true, true).delay(0).fadeOut();
		});
		$('.dropdown-toggle').dropdown();
		$('#article-tab a').click(function(e) {
			e.preventDefault();
			$(this).tab('show');
		})
	})
	</script>


</head>
<body>
	<?php
	$CI->load->view('backends/commons/topmenu');
	?>

	<?php
	echo $content;
	?>

	<?php
	$CI->load->view('backends/commons/footer');
	?>
</body>
</html>