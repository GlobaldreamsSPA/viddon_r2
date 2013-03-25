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

/*Variables locas*/
define('UPLOAD_DIR', '../img/uploads');
define('IMAGES_DIR', '../img/profile');
define('USER_PROFILE_IMAGE', '../img/profile');
define('LOCAL_USER_PROFILE_IMAGE', 'img/profile/');
define('HUNTER_PROFILE_IMAGE', '/img/logo_hunter/');
define('HUNTER_UPLOAD_IMAGE', '../img/logo_hunter');
define('CASTINGS_PATH', '/img/casting_image/');
define('CASTINGS_FULL_PATH', '/img/casting_image_full/');
define('OPENID' , realpath(APPPATH.'../utils/openid.php'));
define('HOME', 'http://development.viddon.com/viddon_matil/viddon_r2');
define('GALLERY', HOME.'/img/gallery/');
define('LOCAL_GALLERY', 'img/gallery/');

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


/* End of file constants.php */
/* Location: ./application/config/constants.php */
