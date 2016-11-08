<?
require_once('../includes/midas.inc.php');
protect_admin_page();
if(is_post_back()) {
	if($sp_id!='') {
		$sql = "update ss_static_pages set sp_description = '$sp_description',sp_modify_date=now() $sql_edit_part where sp_id = $sp_id";
		db_query($sql);
	} else{
		$sql = "insert into ss_static_pages set sp_name = '$sp_name', sp_description = '$sp_description', sp_modify_date = 'now()' ";
		db_query($sql);
	}
	header("Location: ss_static_pages_list.php");
	exit;
}

$sp_id = $_REQUEST['sp_id'];
if($sp_id!='') {
	$sql = "select * from ss_static_pages where sp_id = '$sp_id'";
	$result = db_query($sql);
	if ($line_raw = mysql_fetch_array($result)) {
		$line = $line_raw;
		@extract($line);
	}
}
?>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
<link href="styles.css" rel="stylesheet" type="text/css">
 <script language="javascript">
 function isUrl(s) {
	var regexp = /^(?:(http|ftp|https):\/\/)?(?:[\w-]+\.)+[a-z]{2,6}$/;
	return regexp.test(s);
}

function validate_form(objfrm)
{ 
	msg="Sorry, we cannot complete your request.\nKindly provide us the missing or incorrect information enclosed below.\n\n";
	if(objfrm.sp_any_url.value!='') {	
				if(!isUrl(objfrm.sp_any_url.value)){
							msg+='- Please Enter Valid Related URL Only\n';
				}
	}			
	if(msg!="Sorry, we cannot complete your request.\nKindly provide us the missing or incorrect information enclosed below.\n\n")
	{
		alert(msg);
		return false;
	}
	else
	{
		return true;
	}
}

</script>
<? include("top.inc.php");?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td id="pageHead"><div id="txtPageHead">
      Static Pages</div></td>
  </tr>
</table>
<div align="right"><a href="ss_static_pages_list.php">Back to 
         Static Pages        List</a>&nbsp;</div>
<form name="form1" method="post" enctype="application/x-www-form-urlencoded" onSubmit="return validate_form(this);">
 
    
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">
        <tr>
      <td width="141" class="tdLabel">Name:</td>
      <td width="270" class="tdData"><input name="sp_name" type="text" id="sp_name" value="<?=str_replace("_", " ", $sp_name)?>"  alt="blank" class="textfield" 	></td>
    </tr>

        <tr>
      <td width="141" class="tdLabel">Description:</td>
      <td width="270" ><textarea name="sp_description"><?php echo $sp_description;?></textarea></td>
    </tr>

     	    <tr>
	    <td class="tdLabel">&nbsp;</td>
	    <td class="tdData"><input type="hidden" name="sp_id" value="<?=$sp_id?>">
		                <input type="image" name="imageField" src="images/buttons/submit.gif" /></td>
    </tr>
  </table>
</form>
<? include("bottom.inc.php");?>