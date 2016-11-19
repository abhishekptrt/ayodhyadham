<?
require_once('../includes/midas.inc.php');
protect_admin_page();
if(is_post_back()) {
  if(!empty($_FILES['user_picture']['name'])){
    $a  = move_uploaded_file($_FILES['user_picture']['tmp_name'], 'media/'.$_FILES['user_picture']['name']) ;
    $user_picture = $_FILES['user_picture']['name'];
  }
	if($user_id!='') {
		$sql = "update ss_users set 
            user_email = '$user_email', 
            user_password = '$user_password', 
            user_fname = '$user_fname', 
            user_lname = '$user_lname',
            user_gender = '$user_gender',
            user_phone = '$user_phone',
            user_picture = '$user_picture'
            $sql_edit_part where user_id = $user_id";
		db_query($sql);
	} else{
		$sql = "insert into ss_users set 
            user_email = '$user_email', 
            user_password = '$user_password', 
            user_fname = '$user_fname',
            user_lname = '$user_lname',
            user_gender = '$user_gender',
            user_phone = '$user_phone',
            user_picture = '$user_picture'
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
<script type="text/javascript">
  function form_validation( ) {
      var user_email = document.forms["form1"]["user_email"].value;
      if(!validateEmail(user_email)){
        alert('Please enter valid Email');
       return false;
      }
      var user_password = document.forms["form1"]["user_password"].value;
     if( user_password == ''){
      alert('Please enter Password');

      return false;
     } 
     var user_fname = document.forms["form1"]["user_fname"].value; 
     //alert(user_fname); 
     if( user_fname == ''){
      alert('Please enter user_fname');
      return false;
     } 
     var user_lname= document.forms["form1"]["user_lname"].value;
     if( user_lname == ''){
      alert('Please enter lname');
      return false;
     }
   /*  var user_gender = document.forms["form1"]["user_gender"].value;
     if( user_gender == ''){
      alert('Please enter gender');
      return false;
     }  */
     var user_phone = document.forms["form1"]["user_phone"].value; //alert(user_phone);
     if( !isPhonenumber(user_phone)){
      alert('Please enter valid Phone numbe');
      return false;
     }  
     
    return true;
  }

  function validateEmail(email) { 
    var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;

    return re.test(email);
}

function isPhonenumber(inputtxt)  
{  
  var phoneno = /^\d{10}$/;  
  return phoneno.test(inputtxt); 

}  
</script>>
<? include("top.inc.php");?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="pageHead"><div id="txtPageHead">
      Ss Users</div></td>
  </tr>
</table>
<div align="right"><a href="ss_users_list.php">Back to 
         Users        List</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onsubmit="return form_validation();" >
 
    
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">
       

    <tr>
      <td width="141" class="tdLabel">Email:</td>
      <td width="270" class="tdData"><input name="user_email" type="text" id="user_email" value="<?=$user_email?>"  class="textfield"></td>
    </tr>
    <?php if($user_picture != ''){?>
     <tr>
      <td width="141" class="tdLabel">Picture:</td>
      <td width="270" class="tdData"><img src="media/<?=$user_picture?>" height="50" width="50" ></td>
    </tr>
    <? } ?>
    <tr>
      <td width="141" class="tdLabel">&nbsp;</td>
      <td width="270" class="tdData"><input name="user_picture" type="file"  id="user_picture"   class="textfield">
      <input name="user_picture" type="hidden"  id="user_picture"  value="<?=$user_picture?>"> 
      </td>
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
      <td width="270" class="tdData">Male<input type ="radio" name="user_gender" value="male" <?php echo ($user_gender == 'male') ? 'checked="checked"' : ""?> />
       Female <input  name="user_gender" type ="radio" value="Female" <?php echo ($user_gender == 'female') ? 'checked="checked"' : ""?>/>
        
      </td>
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