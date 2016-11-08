<?php
if(!defined('LOCAL_MODE')) {
	die('<span style="font-family: tahoma, arial; font-size: 11px">config file cannot be included directly');
}

if (LOCAL_MODE) {
    // Settings for local midas server do not edit here
	
	// database settings
    $ARR_CFGS["db_host"] = 'localhost';
	$ARR_CFGS["db_name"] = 'ayodhyadham';
    $ARR_CFGS["db_user"] = 'root';
    $ARR_CFGS["db_pass"] = 'root';
	define('SITE_SUB_PATH', '/ayodhyadham');
} else {
    // Settings for live server edit whenever shifting site to different server

	//database setting for midas server
	
	 $ARR_CFGS["db_host"] = 'localhost';
	$ARR_CFGS["db_name"] = 'ayodhyadham';
    $ARR_CFGS["db_user"] = 'ayoadmin';
    $ARR_CFGS["db_pass"] = 'Ayodhya$$';
	
	
	
	// Path for site
	define('SITE_SUB_PATH', '');
}

define('SITE_WS_PATH', 'http://'.$_SERVER['HTTP_HOST'].SITE_SUB_PATH);

define('THUMB_CACHE_DIR', 'thumb_cache');
define('PLUGINS_DIR', 'includes/plugins');

define('UP_FILES_FS_PATH', SITE_FS_PATH.'/uploaded_files');
define('UP_FILES_WS_PATH', SITE_WS_PATH.'/uploaded_files');

define('DEFAULT_START_YEAR', 2006);
define('DEFAULT_END_YEAR', date('Y')+10);

define('ADMIN_EMAIL', 'support@ayodhyadham.com');
define('SITE_NAME', 'ayodhyadham.com');
define('TEST_MODE', false);

define('DEF_PAGE_SIZE', 25);
?>