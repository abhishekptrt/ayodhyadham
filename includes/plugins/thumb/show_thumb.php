<?php 
require_once("../../midas.inc.php");
$path = stripslashes($path);
$cache_file = stripslashes($cache_file);
midas_thumb::make_thumb(absolute_to_fs($path), SITE_FS_PATH."/".THUMB_CACHE_DIR."/".$cache_file, $width, $height, $ratio_type);
header("location: ".fs_to_absolute(SITE_FS_PATH."/".THUMB_CACHE_DIR."/".$cache_file));
?>