<?
require_once('../includes/midas.inc.php');
protect_admin_page();
if(is_post_back()) {
	if($admin_id!='') {
		$sql = "update ss_admin set admin_user_name = '$admin_user_name', admin_password = '$admin_password' $sql_edit_part where admin_id = $admin_id";
		db_query($sql);
	} else{
		$sql = "insert into ss_admin set admin_user_name = '$admin_user_name', admin_password = '$admin_password' ";
		db_query($sql);
	}
	header("Location: ss_admin_list.php");
	exit;
}

$admin_id = $_REQUEST['admin_id'];
if($admin_id!='') {
	$sql = "select * from ss_admin where admin_id = '$admin_id'";
	$result = db_query($sql);
	if ($line_raw = mysql_fetch_array($result)) {
		$line = ms_form_value($line_raw);
		@extract($line);
	}
}
?>
<link href="styles.css" rel="stylesheet" type="text/css">
<? include("top.inc.php");?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="pageHead"><div id="txtPageHead">
      Admin</div></td>
  </tr>
</table>
<div align="right"><a href="ss_admin_list.php">Back to Admin        List</a>&nbsp;</div>
<form name="form1" method="post" enctype="application/x-www-form-urlencoded" <?= validate_form()?>>
 
    
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">
        <tr>
      <td width="141" class="tdLabel">User Name:</td>
      <td width="270" class="tdData"><input name="admin_user_name" type="text" id="admin_user_name" value="<?=$admin_user_name?>"  alt="blank" class="textfield"></td>
    </tr>

        <tr>
      <td width="141" class="tdLabel">Password:</td>
      <td width="270" class="tdData"><input name="admin_password" type="text" id="admin_password" value="<?=$admin_password?>"  alt="blank" class="textfield"></td>
    </tr>

     	    <tr>
	    <td class="tdLabel">&nbsp;</td>
	    <td class="tdData"><input type="hidden" name="admin_id" value="<?=$admin_id?>">
		                <input type="image" name="imageField" src="images/buttons/submit.gif" /></td>
    </tr>
  </table>
</form>
<? include("bottom.inc.php");?>