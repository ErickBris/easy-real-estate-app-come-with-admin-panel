<script type="text/javascript">
jQuery.extend(jQuery.validator.messages, {
	required: "<?php echo lang('vl_required') ?>",
	remote: "<?php echo lang('vl_remote') ?>",
	email: "<?php echo lang('vl_email') ?>",
	url: "<?php echo lang('vl_url') ?>",
	date: "<?php echo lang('vl_date') ?>",
	dateISO: "<?php echo lang('vl_dateISO') ?>",
	number: "<?php echo lang('vl_number') ?>",
	digits: "<?php echo lang('vl_digits') ?>",
	creditcard: "<?php echo lang('vl_creditcard') ?>",
	equalTo: "<?php echo lang('vl_equalTo') ?>",
	accept: "<?php echo lang('vl_accept') ?>",
	maxlength: <?php echo lang('vl_maxlength') ?>,
	minlength: <?php echo lang('vl_minlength') ?>,
	rangelength: <?php echo lang('vl_rangelength') ?>,
	range: <?php echo lang('vl_range') ?>,
	max: <?php echo lang('vl_max') ?>,
	min: <?php echo lang('vl_min') ?>
});
$.validator.addMethod('currency', function(value, element, regexp) {
	var re = /^\$?\-?([1-9]{1}[0-9]{0,2}(\,\d{3})*(\.\d{0,2})?|[1-9]{1}\d{0,}(\.\d{0,2})?|0(\.\d{0,2})?|(\.\d{1,2}))$|^\-?\$?([1-9]{1}\d{0,2}(\,\d{3})*(\.\d{0,2})?|[1-9]{1}\d{0,}(\.\d{0,2})?|0(\.\d{0,2})?|(\.\d{1,2}))$|^\(\$?([1-9]{1}\d{0,2}(\,\d{3})*(\.\d{0,2})?|[1-9]{1}\d{0,}(\.\d{0,2})?|0(\.\d{0,2})?|(\.\d{1,2}))\)$/;
	return this.optional(element) || re.test(value);
}, '<?php echo lang("vl_currency")?>');
</script>