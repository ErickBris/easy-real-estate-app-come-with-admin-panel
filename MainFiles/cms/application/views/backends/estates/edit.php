<?php 
$CI =& get_instance();
$CI->load->view('custom_validation');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/css/backend/estates.css"/>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url()?>statics/tinymce/jquery.tinymce.js"></script>
<script src="<?php echo base_url(); ?>/statics/js/jquery_upload/js/vendor/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>/statics/js/jquery_upload/js/jquery.iframe-transport.js"></script>
<script src="<?php echo base_url(); ?>/statics/js/jquery_upload/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/statics/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>/statics/js/colorbox/jquery.colorbox-min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/statics/js/colorbox/colorbox.css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>statics/js/jquery.ddslick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>statics/js/growl/jquery.growl.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>statics/js/growl/jquery.growl.css">
<script>
jQuery(document).ready(function($) {
	map=null;
	latLng=null;
	marker=null;
	id=null;
	function add_pin(){
		$('body').addClass('pin-cursor');
		map.setOptions({ 
			draggableCursor: 'url(<?php echo base_url() ?>statics/images/pin.png),auto'
		});
		is_add_pin=true;
	}

	function init_map() {
		var markers = [];
		var location= new google.maps.LatLng(<?php echo $obj[0]->lat; ?>, <?php echo $obj[0]->lng; ?>);
		var map_options={
			zoom:5,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			center:location
		}
		map = new google.maps.Map($('#map-canvas')[0], map_options);

		$('#form input, #form select, #form textarea,#submit').removeAttr('disabled');
		if(marker!=null){
			marker.setMap(null);
		}
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(<?php echo $obj[0]->lat; ?>,<?php echo $obj[0]->lng; ?>),
			map: map,
            	draggable:true, //set marker draggable 
            	animation: google.maps.Animation.DROP, //bounce animation
            	title:"Hello World!",
            	icon: "<?php echo base_url() ?>statics/images/pin.png" //custom pin icon
            });

		google.maps.event.addListener(marker, 'dragend', function (event) {
			latLng=this.getPosition();
			lat=latLng.lat();
			$('#lat').val(lat);
			lng=latLng.lng();
			$('#lng').val(lng);
			console.log(lat);
		});

		var input=$('#pac-input')[0];
		map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

		var searchBox = new google.maps.places.SearchBox((input));

		google.maps.event.addListener(searchBox, 'places_changed', function() {
			var places = searchBox.getPlaces();

			for (var i = 0, marker; marker = markers[i]; i++) {
				marker.setMap(null);
			}

			markers = [];
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
			categories:{
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
			aim:{
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
				url: '<?php echo base_url() ?>admin/estates/remote_edit',
				type: 'post',
				dataType: 'json',
				data: pass_data,
				beforeSend:function(){
					$.blockUI({overlayCSS: { backgroundColor: '#00f'}}); 
				}
			})
			.done(function() {

			})
			.fail(function() {
				console.log("error");
			})
			.always(function(data) {
				$.unblockUI();
				if(data.ok==1){
					$.growl.notice({message:'<?php echo lang('edit_successfully') ?>'});  
				}

				if(data.ok==2){
					//need login to cotinue;
					window.location.href="<?php echo base_url().'admin/dashboard/login'; ?>"
				}
			})
		}
	});

function apply_operation_photo(){
	$('.btn-image-remove').die();
	$('.btn-image-remove').live('click',function(){
		cf=confirm('<?php echo lang('msg_confirm_delete'); ?>');
		$data_id=$(this).attr('data-id');
		$estates_id=$(this).attr('estates-id');
		$image=$(this);
		if(cf){
			$.ajax({
				url: '<?php echo base_url()?>images/remove',
				type: 'POST',
				dataType: 'json',
				data: {data_id:$data_id,estates_id:$estates_id},
			})
			.always(function() {
				$image.parent().parent().remove();
			});
		}
	})
	$('.btn-set-thumb').die();
	$('.btn-set-thumb').live('click', function(){
		$thumb_path=$(this).attr('thumb-path');
		$estates_id=$(this).attr('estates-id');
		$.ajax({
			url: '<?php echo base_url()?>images/set_thumbnail',
			type: 'POST',
			dataType: 'json',
			data: {thumb_path:$thumb_path,estates_id:$estates_id},
		})
		.always(function() {

		});
	});
	$(".group_photo").colorbox({rel:'group_photo'});
}

$('#fudPhoto').fileupload({
	url:'<?php echo base_url() ?>admin/upload/upload_estates',
	dataType: 'json',
	formData: {'id':<?php echo $obj[0]->id; ?>},
	add:function(e,data){
		data.submit();
	},
	progressall: function (e, data) {
		var progress = parseInt(data.loaded / data.total * 100, 10);
		$('#progress .bar').css('width',progress + '%');
	},
	started:function(){
		$('#progress .bar').css('width',0 + '%');  
	},
	autoUpload:false,
	dropZone:$('.drag-drop-zone'),
	done: function (e, data) {
		$('#progress .bar').css('width',0 + '%');  
		$data= data.result;
		if($data.ok==1){
			source   = $('#thumb-template').html();
			template = Handlebars.compile(source);
			apply=template($data);
			$('.gallery').append(apply);
			apply_operation_photo();
		}
		if($data.ok==2){
			window.location.href="<?php echo base_url().'admin/dashboard/login'; ?>";
		}
	}
});
apply_operation_photo();
$('#marker').ddslick({
	width:"100%"
});
<?php
$defaultPin = new stdClass();
$defaultPin->path = 'statics/images/pin.png';
$defaultPin->id="";
if($marker==null){
	$marker=array();
}
array_unshift($marker, $defaultPin);	
$index=0; 
foreach ($marker as $r) {
	if($r->path==$obj[0]->path){
		break;
	}else{
		$index++;
	}
}

if($obj[0]->path==null){
	$index=0;
}

?>
$('#marker').ddslick('select', {index: <?php echo $index; ?> });

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
});
</script>

<script id="thumb-template" type="text/x-handlebars-template">
<div class="thumb-wrapper">
<a href="<?php echo base_url()?>{{path}}" class="group_photo">
<img src="<?php echo base_url() ?>{{thumb_path}}" width="270" height="200">
</a>
<div class="operation">
<a class="fa fa-trash-o btn-image-remove" title="Remove" data-id="{{id}}" estates-id='{{estates_id}}'></a>
<a class="fa fa-picture-o btn-set-thumb" title="Set as thumbnail" thumb-path="{{thumb_path}}" estates-id='{{estates_id}}'></a>
</div>
</div>
</script>

<div class="container">
	<div class="row">
		<div class="row add-wrapper">
			<h3><?php echo lang('msg_edit') ?></h3>
		</div>

		<div class="">
			<input id="pac-input" class="controls" type="text" placeholder="Search Box"/>
			<div id="map-canvas"></div>
		</div>		

		<div class="row form">
			<form class="form-horizontal" id="form" name="form" method="post">
				<fieldset>
					<input type="hidden" name="lat" id="lat" value="<?php echo $obj[0]->lat; ?>"/>
					<input type="hidden" name="lng" id="lng" value="<?php echo $obj[0]->lng; ?>"/>
					<input type="hidden" name="id" value="<?php echo $obj[0]->id; ?>"/>
					<input type="hidden" name="marker" id="hidden_marker">
					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_status'); ?></label>
						<div class="controls col-xs-11">
							<select id="status" name="status" class="form-control">
								<option value="">-----<?php echo lang('msg_not_set'); ?>-----</option>
								<option value="<?php echo FEATURED; ?>" <?php if($obj[0]->status==FEATURED)echo 'selected'; ?>><?php echo lang('msg_featured'); ?></option>
								<option value="<?php echo SOLD; ?>" <?php if($obj[0]->status==SOLD)echo 'selected'; ?>><?php echo lang('msg_sold'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_activate'); ?></label>
						<div class="controls col-xs-11">
							<select id="activate" name="activate" class="form-control">
								<option value="<?php echo DEACTIVATED; ?>" <?php if($obj[0]->activated==DEACTIVATED)echo 'selected'; ?>><?php echo lang('msg_deactivate'); ?></option>
								<option value="<?php echo ACTIVATED; ?>" <?php if($obj[0]->activated==ACTIVATED)echo 'selected'; ?>><?php echo lang('msg_activate') ?></option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_title') ?></label>
						<div class="controls col-xs-11">
							<input type="text" id="title" name="title" class="form-control" value="<?php echo $obj[0]->title; ?>" class/>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_types'); ?></label>
						<div class="controls col-xs-11">
							<select id="categories" name="types" class="form-control">
								<option value="">-----<?php echo lang('msg_types'); ?>----</option>
								<?php 
								foreach ($types as $r){
									?>
									<option value="<?php echo $r->id; ?>" <?php if($r->id==$obj[0]->types_id){ echo 'selected'; } ?>><?php echo $r->name;?></option>;
									<?php
								}
								?>
							</select>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_county'); ?></label>
						<div class="controls col-xs-11">
							<select id="county" name="county" class="form-control">
								<option value="">-----<?php echo lang('msg_county'); ?>------</option>
								<?php 
								foreach ($county as $r) {

									?>
									<option value="<?php echo $r->id; ?>" <?php if($r->id==$obj[0]->county_id){ echo 'selected'; } ?>><?php echo $r->name; ?></option>;
									<?php 
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
								foreach ($cities as $r) {
									?>
									<option value="<?php echo $r->id; ?>" <?php if($r->id==$obj[0]->cities_id){echo 'selected';} ?>><?php echo $r->name; ?></option>;
									<?php 
								}
								?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_address'); ?></label>
						<div class="controls col-xs-11">
							<input type="text" name="address" value="<?php echo $obj[0]->address; ?>" class="form-control"/>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_bedroom'); ?></label>
						<div class="controls col-xs-11">
							<input type="text" id="bedrooms" name="bedrooms" value="<?php echo $obj[0]->bedrooms; ?>" class="form-control"/>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_bathroom'); ?></label>
						<div class="controls col-xs-11">
							<input type="text" id="bathrooms" name="bathrooms" value="<?php echo $obj[0]->bathrooms; ?>" class="form-control"/>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_area'); ?> (m<sup>2</sup>)</label>
						<div class="controls col-xs-11">
							<input type="text" id="area" name="area" class="form-control" value="<?php echo $obj[0]->area; ?>"/>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_purpose'); ?></label>
						<div class="controls col-xs-11">
							<select id="purpose" name="purpose" class="form-control">
								<option value="">-----<?php echo lang('msg_purpose'); ?>-----</option>
								<option value="<?php echo SALES?>" <?php if($obj[0]->purpose==SALES){echo 'selected';} ?>><?php echo lang('msg_sale') ?></option>
								<option value="<?php echo RENT?>" <?php if($obj[0]->purpose==RENT){echo 'selected';} ?>><?php echo lang('msg_rent') ?></option>
								<option value="<?php echo SALES_AND_RENT ?>" <?php if($obj[0]->purpose==SALES_AND_RENT){echo 'selected';} ?>><?php echo lang('msg_sale_and_rent'); ?></option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_price'); ?></label>
						<div class="row">
							<div class="controls col-xs-7">
								<input type="text" class="form-control" id="price" name="price" value="<?php echo $obj[0]->price; ?>">
							</div>
							<div class="controls col-xs-4">
								<label style="margin-top:5px">per</label>
								<select id="time_rate" name="time_rate" class="form-control" style="width:85%;float:right">
									<option value="-1"><?php echo lang('msg_not_set'); ?></option>
									<option value="<?php echo WEEK; ?>" <?php if($obj[0]->time_rate==WEEK){echo 'selected';} ?>><?php echo lang('msg_week');?></option>
									<option value="<?php echo MONTH; ?>" <?php if($obj[0]->time_rate==MONTH){echo 'selected';} ?>><?php echo lang('msg_month');?></option>
									<option value="<?php echo YEAR; ?>" <?php if($obj[0]->time_rate==YEAR){echo 'selected';} ?>><?php echo lang('msg_year');?></option>
								</select>
							</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_marker'); ?></label>
						<div class="controls col-xs-11">
							<select id="marker" class="form-control">
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
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_amenities'); ?></label>
						<div class="col-xs-11">
							<?php
							if($amenities!=null){
								foreach ($amenities as $r) {
									?>
									<div class="checkbox">
										<label>
											<input type="checkbox" class="amenities" name="amen[]" value="<?php echo $r->id ?>"
											<?php
											if($amenities_check!=null)
											foreach ($amenities_check as $check) {
												if($check->amenities_id==$r->id){
													echo 'checked="checked"';
													break;
												}
											}
											?>
											><?php echo $r->name; ?>
										</label>
									</div>
									<?php 
								}
							}
							?>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_content'); ?></label>
						<div class="controls col-xs-11">
							<textarea id="content" name="content" class="form-control"><?php echo $obj[0]->content; ?></textarea>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-xs-1" for="txtName"><?php echo lang('msg_description'); ?></label>
						<div class="controls col-xs-11">
							<textarea rows="10" id="description" name="description" class="form-control"><?php echo $obj[0]->description; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="controls col-xs-11 col-xs-offset-2 ">
							<button type="submit" id="submit" name="submit" class="btn btn-primary">
								<?php echo lang('msg_save'); ?>
							</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>

	<div class="page-header normal"><h3><?php echo lang('msg_gallery'); ?></h3></div>
	<div class="row gallery">
		<?php if($images!=null){ foreach ($images as $r){?>
		<div class="thumb-wrapper">
			<a href="<?php echo base_url().$r->path; ?>" class="group_photo">
				<img src="<?php echo base_url().$r->thumb_path; ?>" width="270" height="200">
			</a>
			<div class="operation">
				<a class="fa fa-trash-o btn-image-remove" title="Remove" data-id="<?php echo $r->id; ?>" estates-id='<?php echo $obj[0]->id; ?>'></a>
				<a class="fa fa-picture-o btn-set-thumb" title="Remove" thumb-path="<?php echo $r->thumb_path; ?>" estates-id='<?php echo $obj[0]->id; ?>'></a>
			</div>
		</div>
		<?php
	} 
}?>
</div>
<div class="drag-drop-zone-wrapper">
	<div id="progress">
		<div class="bar" style="width: 0%;"></div>
	</div>
	<span class="fileinput-button drag-drop-zone">
		<span class="text"><i class="fa fa-plus"></i>&nbsp;Drag and drop file here or click !</span>
		<input type="file" id="fudPhoto" name="fileData" class="fudFile"  multiple="true" />
	</span>
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



