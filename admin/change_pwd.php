<?
require_once ('../includes/midas.inc.php'); 
protect_admin_page();
if(is_post_back()) {
	import_request_variables('p');
	if($adm_password!=$readm_password) {
		$arr_error_msgs[] = "Password and retype password do not match";
	}
	$sql="select * from fmi_admins where adm_login_id = '".$_SESSION['sess_adm_login_id']."' ";
	$result = mysql_query($sql) or die(db_error($sql));
	if ($line = mysql_fetch_array($result)) {
		$db_adm_password=$line['adm_password'];
		if($db_adm_password == $old_adm_password) {
			$sql="update fmi_admins set adm_password = '$adm_password'where adm_login_id = '".$_SESSION['sess_adm_login_id']."'";
			mysql_query($sql) or die(db_error($sql));
			header("Location: change_pwd_conf.php");
			exit;
		} 
	} else {
		$arr_error_msgs[] = "Invalid old password.";
	}
}
?>
<? include ('top.inc.php'); ?>
<link href="styles.css" rel="stylesheet" type="text/css">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="pageHead"><div id="txtPageHead">Change Password
    </div></td>
  </tr>
</table>
<? include('error_msg.inc.php');?>
<form action="" method="post" name="form1" id="form1"> 
  <table width="258" border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm"> 
  <tr> 
  <td width="120" class="tdLabel">Old Password:</td> 
  <td> 
  <input type="password" name="old_password" class="textfield"> 
  </td> 
  </tr> 
  <tr> 
  <td class="tdLabel">New Password:</td> 
  <td> 
  <input type="password" name="password" class="textfield"> 
  </td> 
  </tr> 
  <tr> 
  <td class="tdLabel">Confirm Password:</td> 
  <td> 
  <input type="password" name="repassword" class="textfield"> 
  </td> 
  </tr>
  <tr>
    <td class="label">&nbsp;</td>
    <td><input type="image" name="imageField" src="images/buttons/submit.gif" /></td>
  </tr> 
  </table> 
</form>
<? include ('bottom.inc.php'); ?>