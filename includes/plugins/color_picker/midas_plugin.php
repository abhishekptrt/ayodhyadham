<?php
define('COLOR_PICKER_WS_PATH', SITE_WS_PATH.'/'.PLUGINS_DIR.'/color_picker');

function color_picker_includes()
{
	if(!defined('COLPICK_INCLUDED')) {
		define('COLPICK_INCLUDED', true);
		ob_start();
		include(dirname(__FILE__).'/color_pick_files.inc.php');
		$color_picker = ob_get_contents();
		ob_end_clean();
	}
	return $color_picker ;
}

function get_color_picker($input_name, $def_color='', $input_attr='')
{
	$color_picker = color_picker_includes();
	ob_start();
	include(dirname(__FILE__).'/color_pick.inc.php');
	$color_picker .= ob_get_contents();
	ob_end_clean();
	return $color_picker;
}

?>