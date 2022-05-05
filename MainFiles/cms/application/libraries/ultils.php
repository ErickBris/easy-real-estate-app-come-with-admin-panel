<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Ultils {
	const TOKEN_SEPARATOR = '**____**';
	public function view_counter($estates_id) {
		$cookie_name = 'estates_' . $estates_id;
		$CI = &get_instance();
		if (!isset($_COOKIE[$cookie_name])) {
			$CI -> load -> model('estates_model');
			$data = $CI -> estates_model -> get_by_id($estates_id);
			$count_of_views = $data[0] -> view_counter;
			$count_of_views += 1;
			$data_array = array('view_counter' => $count_of_views);
			$array_where = array('id' => $estates_id);
			$CI -> estates_model -> update($data_array, $array_where);
			$CI -> input -> set_cookie($cookie_name, $estates_id, time() + 3600);
		};
	}


	static function get_new_link($word) {
		$ttk = array('a' => array('ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'Ấ', 'Ầ', 'Ẩ', 'Ẫ', 'Ậ', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'Ắ', 'Ằ', 'Ẳ', 'Ẵ', 'Ặ', 'á', 'à', 'ả', 'ã', 'ạ', 'â', 'ă', 'Á', 'À', 'Ả', 'Ã', 'Ạ', 'Â', 'Ă'), 'e' => array('ế', 'ề', 'ể', 'ễ', 'ệ', 'Ế', 'Ề', 'Ể', 'Ễ', 'Ệ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'É', 'È', 'Ẻ', 'Ẽ', 'Ẹ', 'Ê'), 'i' => array('í', 'ì', 'ỉ', 'ĩ', 'ị', 'Í', 'Ì', 'Ỉ', 'Ĩ', 'Ị'), 'o' => array('ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'Ố', 'Ồ', 'Ổ', 'Ô', 'Ộ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'Ớ', 'Ờ', 'Ở', 'Ỡ', 'Ợ', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ơ', 'Ó', 'Ò', 'Ỏ', 'Õ', 'Ọ', 'Ô', 'Ơ'), 'u' => array('ứ', 'ừ', 'ử', 'ữ', 'ự', 'Ứ', 'Ừ', 'Ử', 'Ữ', 'Ự', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'Ú', 'Ù', 'Ủ', 'Ũ', 'Ụ', 'Ư'), 'y' => array('ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ', 'Ý', 'Ỳ', 'Ỷ', 'Ỹ', 'Ỵ'), 'd' => array('đ', 'Đ'), );
		foreach ($ttk as $key => $arr) {
			foreach ($arr as $val) {
				$word = str_replace($val, $key, $word);
			}

		}
		$word=rtrim($word);
		$word=ltrim($word);
		$word= preg_replace('/[^a-zA-Z0-9\s]/', '', $word);
		$new_word = str_replace(' ', '-', strtolower($word));
		return $new_word;
	}
	
	static function _encrypt_password($password){
		return md5(md5($password));
	}

	static function _generate_remember_me_token($username,$password){
		return base64_encode($username.self::TOKEN_SEPARATOR.$password) ;
	}

	static function validate_remember_me_token($token,$username,$password){
		$parts=explode(self::TOKEN_SEPARATOR, base64_decode($token));
		if($parts[0]==$username && $parts[1]==$password){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	static function _generate_unqid_token(){
		return sha1(uniqid(mt_rand(),true));
	}   
}
/* End of file phpthumb_lib.php */
/* Location: ./system/app/libraries/phpthumb_lib.php */
