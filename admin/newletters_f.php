<?
require_once('../includes/midas.inc.php');
if(is_post_back()) {
	if($nl_id!='') {
		$sql = "update ss_newletters set nl_title = '$nl_title', nl_desc = '$nl_desc', nl_date = now() $sql_edit_part where nl_id = $nl_id";
		db_query($sql);
	} else{
		$sql = "insert into ss_newletters(nl_title,nl_desc,nl_date) values('$nl_title','$nl_desc', now()) ";
		db_query($sql);
	}
	header("Location: newletters_list.php");
	exit;
}

$nl_id = $_REQUEST['nl_id'];
if($nl_id!='') {
	$sql = "select * from ss_newletters where nl_id = '$nl_id'";
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
      Newletters</div></td>
  </tr>
</table>
<div align="right"><a href="newletters_list.php">Back to 
        Newletters        List</a>&nbsp;</div>
<form name="form1" method="post" enctype="application/x-www-form-urlencoded" <?= validate_form()?>>
 
    
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">
        <tr>
      <td width="30" align="right" class="tdLabel"><strong>Title:</strong></td>
      <td width="100" class="tdData"><input name="nl_title" size="90" type="text" id="nl_title" value="<?=$nl_title?>"  alt="blank" class="textfield"></td>
    </tr>

        <tr>
      <td width="30" align="right" class="tdLabel"><strong>Description:</strong></td>
      <td width="270" class="tdData"><?=getSpawEditor('nl_desc', $line_raw[nl_desc], '700px', '400px');?>	  </td>
    </tr>

        

     	    
	
	       
	<tr>
	    <td align="right" class="tdLabel">&nbsp;</td>
	    <td class="tdData"><input type="hidden" name="nl_id" value="<?=$nl_id?>">
		                <input type="image" name="imageField" src="images/buttons/submit.gif" /></td>
    </tr>
  </table>
</form>
<? include("bottom.inc.php");?>