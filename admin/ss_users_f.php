<?
require_once('../includes/midas.inc.php');
protect_admin_page();
if(is_post_back()) {
	if($user_id!='') {
		$sql = "update ss_users set 
            user_email = '$user_email', 
            user_password = '$user_password', 
            user_fname = '$user_fname', 
            user_lname = '$user_lname',
            user_gender = '$user_gender',
            user_phone = '$user_phone',
            $sql_edit_part where user_id = $user_id";
		db_query($sql);
	} else{
		$sql = "insert into ss_users set 
            user_email = '$user_email', 
            user_password = '$user_password', 
            user_fname = '$user_fname',
            user_lname = '$user_lname',
            user_gender = '$user_gender',
            user_phone = '$user_phone'
             ";
		db_query($sql);
	}
	header("Location: ss_users_list.php");
	exit;
}

$user_id = $_REQUEST['user_id'];
if($user_id!='') {
	$sql = "select * from ss_users where user_id = '$user_id'";
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
      Ss Users</div></td>
  </tr>
</table>
<div align="right"><a href="ss_users_list.php">Back to 
         Users        List</a>&nbsp;</div>
<form name="form1" method="post" enctype="application/x-www-form-urlencoded" <?= validate_form()?>>
 
    
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">
       

    <tr>
      <td width="141" class="tdLabel">Email:</td>
      <td width="270" class="tdData"><input name="user_email" type="text" id="user_email" value="<?=$user_email?>"  class="textfield"></td>
    </tr>

        <tr>
      <td width="141" class="tdLabel">Password:</td>
      <td width="270" class="tdData"><input name="user_password" type="text" id="user_password" value="<?=$user_password?>"  class="textfield"></td>
    </tr>

     
        <tr>
      <td width="141" class="tdLabel">Fname:</td>
      <td width="270" class="tdData"><input name="user_fname" type="text" id="user_fname" value="<?=$user_fname?>"  class="textfield"></td>
    </tr>

        <tr>
      <td width="141" class="tdLabel">Lname:</td>
      <td width="270" class="tdData"><input name="user_lname" type="text" id="user_lname" value="<?=$user_lname?>"  class="textfield"></td>
    </tr>

        <tr>
      <td width="141" class="tdLabel">Gender:</td>
      <td width="270" class="tdData"><input name="user_gender" type="text" id="user_gender" value="<?=$user_gender?>"  class="textfield"></td>
    </tr>

       

       

       

        <tr>
      <td width="141" class="tdLabel">Phone:</td>
      <td width="270" class="tdData"><input name="user_phone" type="text" id="user_phone" value="<?=$user_phone?>"  class="textfield"></td>
    </tr>

       
       
       

      

    
      
      
     	    <tr>
	    <td class="tdLabel">&nbsp;</td>
	    <td class="tdData"><input type="hidden" name="user_id" value="<?=$user_id?>">
		                <input type="image" name="imageField" src="images/buttons/submit.gif" /></td>
    </tr>
  </table>
</form>
<? include("bottom.inc.php");?>