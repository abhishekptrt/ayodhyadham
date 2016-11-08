<? require_once("../includes/midas.inc.php");
protect_admin_page();
$sql="update ss_home_page_settings set $type='$value' ";
db_query($sql);
$_SESSION['sess_message']="Home page setting is changed successfully";
header("Location: ".$_SERVER['HTTP_REFERER']);exit;

?>