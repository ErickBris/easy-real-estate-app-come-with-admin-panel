<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('ADMIN', 0);
define('AGENT', 1);
define('USER', 2);


/*PURPOSE*/
define('SALES', 0);
define('RENT', 1);
define('SALES_AND_RENT',2);
/*END*/


/*STATUS*/
define('SOLD',0);
define('FEATURED', 1);
/*END*/


/*PER PRICE*/
define('WEEK', 0);
define('MONTH',1);
define('YEAR', 2);
/*END*/

/*ACTIVATED*/
define('BAN', 2);
define('ACTIVATED', 1);
define('DEACTIVATED', 0);
/*END*/

define('EMAIL_SETTING_FILE', APPPATH.'/settings/email.dat');
define('GENERAL_SETTING_FILE', APPPATH.'/settings/general.dat');
define('CURRENCY_SETTING_FILE', APPPATH.'/settings/currency.dat');
define('CONTACT_INFO_SETTING_FILE', APPPATH.'/settings/contact_info.dat');
define('DEFAULT_LOCATION_FILE', APPPATH.'/settings/default_location.dat');

/*site name*/
define('SITE_NAME','Easy real estates');
/* End of file constants.php */

define('DEFAULT_PIN','statics/images/pin.png');

/*read or no*/
define('IS_READED', 1);
define('IS_PENDING', 0);
/*end*/

define('CURRENCY_SYMBOL_AFTER',1);
define('CURRENCY_SYMBOL_BEFORE',0);

/*is menu*/
define('IS_MENU',1);
/*end*/
/* Location: ./application/config/constants.php */