<?php 
$CI =& get_instance();
$CI->load->view('custom_validation');
?>
<script type="text/javascript" src="<?php echo base_url()?>statics/tinymce/jquery.tinymce.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/css/backend/estates.css"/>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script src="<?php echo base_url(); ?>statics/js/jquery_upload/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>statics/js/jquery_upload/js/jquery.iframe-transport.js"></script>
<script src="<?php echo base_url(); ?>statics/js/jquery_upload/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>statics/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>statics/js/jquery.ddslick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>statics/js/growl/jquery.growl.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/js/growl/jquery.growl.css">
<script>
jQuery(document).ready(function($) {
	$('#form input, #form select,#form textarea,#submit').attr('disabled','disabled');
	map=null;
	latLng=null;
	marker=null;
	is_add_pin=false;
	function add_pin(){
		$('body').addClass('pin-cursor');
		map.setOptions({ 
			draggableCursor: 'url(<?php echo base_url();?>statics/images/pin.png),auto'
		});
		is_add_pin=true;
	}

	function reset_all(){
		$('#form')[0].reset();
		$('#form input, #form select,#form textarea,#submit').attr('disabled','disabled');
		$('.add').removeAttr('disabled');
		latLng=null;
		if(marker!=null){
			marker.setMap(null);
			marker=null;
		}
		is_add_pin=false;
		if(map!=null){
			map.setOptions({ 
				draggableCursor: 'default'
			});
		}
	}

	reset_all();

	$('.add').bind('click',function(event) {
		$(this).attr('disabled','disabled');
		$(this).css('cursor', 'url(<?php echo base_url();?>statics/images/pin.png)');
		add_pin();
	});

	<?php 
	$default_location=getSettings(DEFAULT_LOCATION_FILE);
	?>

	function init_map() {
		var location=new google.maps.LatLng(<?php echo $default_location['lat'] ?>,<?php echo $default_location['lng'] ?>);
		var map_options={
			zoom:5,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			center:location
		}
		map = new google.maps.Map($('#map-canvas')[0], map_options);

		var input=$('#pac-input')[0];
		map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

		var searchBox = new google.maps.places.SearchBox((input));

		google.maps.event.addListener(searchBox, 'places_changed', function() {
			var places = searchBox.getPlaces();
			markers = [];
			for (var i = 0, marker; marker = markers[i]; i++) {
				marker.setMap(null);
			}

			var bounds = new google.maps.LatLngBounds();
			for (var i = 0, place; place = places[i]; i++) {
				var image = {
					url: place.icon,
					size: new google.maps.Size(71, 71),
					origin: new google.maps.Point(0, 0),
					anchor: new google.maps.Point(17, 34),
					scaledSize: new google.maps.Size(25, 25)
				};

				var markerSearch = new google.maps.Marker({
					map: map,
					icon: image,
					title: place.name,
					position: place.geometry.location
				});

				markers.push(markerSearch);
				bounds.extend(place.geometry.location);
			}
			map.fitBounds(bounds);
		});

		google.maps.event.addListener(map, 'bounds_changed', function() {
			var bounds = map.getBounds();
			searchBox.setBounds(bounds);
		});

		google.maps.event.addListener(map, 'rightclick', function(event) {
			if(is_add_pin==true){
				$('#form input, #form select, #form textarea,#submit').removeAttr('disabled');
				if(marker!=null){
					marker.setMap(null);
				}
				marker = new google.maps.Marker({
					position: event.latLng, 
					map: map,
            	draggable:true, //set marker draggable 
            	animation: google.maps.Animation.DROP, //bounce animation
            	icon: "<?php echo base_url() ?>statics/images/pin.png" //custom pin icon
            });

				latLng=event.latLng;
				lat=latLng.lat();
				$('#lat').val(lat);
				lng=latLng.lng();
				$('#lng').val(lng);
				google.maps.event.addListener(marker, 'dragend', function (event) {
					latLng=this.getPosition();
					lat=latLng.lat();
					$('#lat').val(lat);
					lng=latLng.lng();
					$('#lng').val(lng);
				});
			}
			});//end right click
	}

	init_map();
	$('#form').validate({
		rules: {
			title: {
				required: true
			},
			price:{
				required:true,
				currency:true
			},
			types:{
				required:true
			},
			county:{
				required:true
			},
			address:{
				required:true
			},
			bedrooms:{
				number:true
			},
			bathrooms:{
				number:true
			},
			area:{
				required:true,
				number:true
			},
			purpose:{
				required:true
			},
			content:{
				required:true
			}
		},

		errorClass: "msg-error",
		errorElement: "span",
		submitHandler: function () {
			marker_data = $('#marker').data('ddslick');
			$('#hidden_marker').val(marker_data.selectedData.value);
			pass_data=$('#form').serialize();
			$.ajax({
				url: '<?php echo base_url() ?>admin/estates/remote_add',
				type: 'post',
				dataType: 'json',
				data:pass_data,
				beforeSend : function (){
					$.blockUI({overlayCSS: { backgroundColor: '#00f'}}); 
				}
			})
			.done(function() {
				console.log("done");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function(data) {
				$.unblockUI();
				if(data.ok==1){
					$.growl.notice({message:'<?php echo lang('add_successfully') ?>'});  
					reset_all();
				}

				if(data.ok==2){
					//need login to cotinue;
					window.location.href="<?php echo base_url().'admin/dashboard/login'; ?>"
				}
			});
		}
	});

$('#county').change(function(){
	$county_id=$(this).val();
	$.ajax({
		url: '<?php echo base_url()?>admin/cities/get_list',
		type: 'POST',
		dataType: 'html',
		data: {county_id: $county_id },
	})
	.always(function(data) {
		$('#cities').html(data);
	});
})

$('#marker').ddslick({
	width:'100%'
});
});
</script>

<div class="container">
	<div class="row">
		<div class="page-header normal">
			<a href="#" class="btn btn-primary add"><?php echo lang('msg_click_to_add'); ?></a>&nbsp;&nbsp;<?php echo lang('msg_right_click_to_add_pin'); ?>
		</div>

		<div>
			<input id="pac-input" class="controls" type="text" placeholder="Search Box"/>
			<div id="map-canvas"></div>
		</div>		

		<div class="row form">
			<form class="form-horizontal" id="form" name="form" method="post">
				<fieldset>
					<input type="hidden" name="lat" id="lat"/>
					<input type="hidden" name="lng" id="lng"/>
					<input type="hidden" name="marker" id="hidden_marker">

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_status'); ?></label>
						<div class="controls col-xs-11">
							<select id="status" name="status" class="form-control">
								<option value="">-----<?php echo lang('msg_status'); ?>-----</option>
								<option value="<?php echo FEATURED; ?>"><?php echo lang('msg_featured'); ?></option>
								<option value="<?php echo SOLD; ?>"><?php echo lang('msg_sold'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_activate'); ?></label>
						<div class="controls col-xs-11">
							<select id="activate" name="activate" class="form-control">
								<option value="<?php echo DEACTIVATED; ?>"><?php echo lang('msg_deactivate'); ?></option>
								<option value="<?php echo ACTIVATED; ?>"><?php echo lang('msg_activate') ?></option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_title'); ?></label>
						<div class="controls col-xs-11">
							<input type="text" class="form-control" id="title" name="title"/>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_types'); ?></label>
						<div class="controls col-xs-11">
							<select id="types" name="types" class="form-control">
								<option value="">-----types----</option>
								<?php 
								foreach ($types as $r) {
									echo '<option value="'.$r->id.'">'.$r->name.'</option>';
								}
								?>
							</select>

						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_county'); ?></label>
						<div class="controls col-xs-11">
							<select id="county" name="county" class="form-control">
								<option value="">-----County------</option>
								<?php 
								foreach ($county as $r) {
									echo '<option value="'.$r->id.'">'.$r->name.'</option>';
								}
								?>
							</select>

						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_city'); ?></label>
						<div class="controls col-xs-11">
							<select id="cities" name="cities" class="form-control">
								<option value="">-----City------</option>
								<?php 
								foreach ($data['cities'] as $r) {
									echo '<option value="'.$r->id.'">'.$r->name.'</option>';
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_address'); ?></label>
						<div class="controls col-xs-11">
							<input type="text" name="address" class="form-control"/>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_bedroom'); ?></label>
						<div class="controls col-xs-11">
							<input type="text" id="bedrooms" name="bedrooms" class="form-control"/>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_bathroom'); ?></label>
						<div class="controls col-xs-11">
							<input type="text" id="bathrooms" name="bathrooms" class="form-control"/>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_area') ?> (m<sup>2</sup>)</label>
						<div class="controls col-xs-11">
							<input type="text" id="area" name="area" class="form-control"/>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_purpose'); ?></label>
						<div class="controls col-xs-11">
							<select id="purpose" name="purpose" class="form-control">
								<option value="">-----<?php echo lang('msg_purpose'); ?>-----</option>
								<option value="<?php echo SALES?>"><?php echo lang('msg_sale') ?></option>
								<option value="<?php echo RENT?>"><?php echo lang('msg_rent') ?></option>
								<option value="<?php echo SALES_AND_RENT ?>"><?php echo lang('msg_sale_and_rent'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_price'); ?></label>
						<div class="row">
							<div class="controls col-xs-7">
								<input type="text" class="form-control" id="price" name="price" value="">
							</div>
							<div class="controls col-xs-4">
								<label style="margin-top:5px">per</label>
								<select id="time_rate" name="time_rate" class="form-control" style="width:85%;float:right">
									<option value="-1"><?php echo lang('msg_not_set'); ?></option>
									<option value="<?php echo WEEK; ?>"><?php echo lang('msg_week');?></option>
									<option value="<?php echo MONTH; ?>"><?php echo lang('msg_month');?></option>
									<option value="<?php echo YEAR; ?>"><?php echo lang('msg_year');?></option>
								</select>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_marker'); ?></label>
						<div class="controls col-xs-11">
							<select id="marker" class="form-control">
								<option value="" data-imagesrc="<?php echo base_url().'statics/images/pin.png' ?>"></option>
								<?php 
								foreach ($marker as $r) {
									?>
									<option value="<?php echo $r->id ?>" data-imagesrc="<?php echo base_url().$r->path; ?>"></option>
									<?php
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_amenitites'); ?></label>
						<div class="col-xs-11">
							<?php
							if($amenities!=null){
								foreach ($amenities as $r) {
									?>
									<div class="checkbox">
										<label>
											<input type="checkbox" class="amenities" name="amen[]" value="<?php echo $r->id ?>"> <?php echo $r->name; ?>
										</label>
									</div>
									<?php 
								}
							}
							?>
						</div>
					</div>
					<?php
					?>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_content'); ?></label>
						<div class="controls col-xs-11">
							<textarea id="content" name="content" class="form-control"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_description'); ?></label>
						<div class="controls col-xs-11">
							<textarea rows="10" id="description" name="description" class="form-control"></textarea>
						</div>
					</div>


					<div class="form-group">
						<div class="col-xs-11 col-xs-offset-2">
							<input class="btn btn-primary" type="submit" class="form-control" value="<?php echo lang('msg_save');?>">
							<input class="btn" type="reset" value="<?php echo lang('msg_reset');?>" class="form-control">
						</div>
					</div>
				</fieldset>
			</form>
		</div>	
	</div>

	<div class="page-header normal"><h3><?php echo lang('msg_gallery'); ?></h3></div>
	<div class="row gallery">
		<div <div class="alert alert-info">
			<?php echo lang('msg_gallery_create') ?>
		</div>
	</div>
</div>
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
