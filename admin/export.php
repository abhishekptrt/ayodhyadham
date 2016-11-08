<?php 
require_once("../includes/midas.inc.php");
//$arr_gf_ids = $_REQUEST['arr_gf_ids'];
$select=" select user_type AS Type, user_email AS Email from ss_users order by user_type asc ";
$export_v = db_query($select);
$count = mysql_num_fields($export_v);
/********************************************
Extract field names and write them to the $header
variable
/********************************************/
for ($i = 0; $i < $count; $i++) {
	$header .= mysql_field_name($export_v, $i)."\t";
}
$header .= "\n";
/********************************************
Extract all data, format it, and assign to the $data
variable
/********************************************/
while($row_v = mysql_fetch_row($export_v)) {
	$line = '';
	foreach(ms_display_value($row_v) as $value) {											
		if ((!isset($value)) OR ($value == "")) {
			$value = "\t";
		} else {
			$value = str_replace('"', '""', $value);
			$value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
	}
	$data .= trim($line)."\n";
}
$data = str_replace("\r", "", $data);
/********************************************
Set the default message for zero records
/********************************************/
if ($data == "") {
	$data = "\n(0) Records Found!\n";						
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=user_email_list.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";

?>	