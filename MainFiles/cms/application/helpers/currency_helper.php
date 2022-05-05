<?php
function format_money( $number, $dec_point = ".", $thousands_sep = ",")
{
	$data = preg_replace( "/\\" . $dec_point . "00$/", "", number_format($number, 2, $dec_point, $thousands_sep));
	$CI =& get_instance();
	$CI->load->helper('settings');
	$settings=getSettings(CURRENCY_SETTING_FILE);
	if($settings['position']==CURRENCY_SYMBOL_BEFORE){
		$data=$settings['currency_symbol'].' '.$data;
	}else{
		$data=$data.' '.$settings['currency_symbol'];
	}
	return $data;
}
?>