<?php
if(!defined('WITHIN_SPAW')) {
	require(dirname(__FILE__)."/spaw_control.class.php");
}

function get_html_editor($control_name, $value='', $width='100%', $height='300px', $css_stylesheet='', $dropdown_data='', $lang='en', $mode = 'full',  $theme='')
{
	$sw = new SPAW_Wysiwyg($control_name, $value, $lang, $mode, $theme, $width, $height, $css_stylesheet, $dropdown_data);
	$sw->show();
}

?>