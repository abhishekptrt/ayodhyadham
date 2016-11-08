<?
require_once('../includes/midas.inc.php');
protect_admin_page();
if(is_post_back()) {
	if($nw_id!='') {
		$sql = "update ss_news set nw_title = '$nw_title', nw_description = '$nw_description', nw_date = now() $sql_edit_part where nw_id = $nw_id";
		db_query($sql);
	} else{
		$sql = "insert into ss_news set nw_title = '$nw_title', nw_description = '$nw_description', nw_date = now() ";
		db_query($sql);
	}
	header("Location: ss_news_list.php");
	exit;
}

$nw_id = $_REQUEST['nw_id'];
if($nw_id!='') {
	$sql = "select * from ss_news where nw_id = '$nw_id'";
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
       News</div></td>
  </tr>
</table>
<div align="right"><a href="ss_news_list.php">Back to 
         News        List</a>&nbsp;</div>
<form name="form1" method="post" enctype="application/x-www-form-urlencoded" <?= validate_form()?>>
 
    
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">
        <tr>
      <td width="141" class="tdLabel">Title:</td>
      <td width="270" class="tdData"><input name="nw_title" type="text" id="nw_title" value="<?=$nw_title?>"  alt="blank" class="textfield"></td>
    </tr>

        <tr>
      <td width="141" class="tdLabel">Description:</td>
      <td width="270" class="tdData"><textarea name="nw_description" id="nw_description" rows="5" cols="50"  alt="blank" class="textfield"><?=$nw_description?></textarea></td>
    </tr>

     	    <tr>
	    <td class="tdLabel">&nbsp;</td>
	    <td class="tdData"><input type="hidden" name="nw_id" value="<?=$nw_id?>">
		                <input type="image" name="imageField" src="images/buttons/submit.gif" /></td>
    </tr>
  </table>
</form>
<? include("bottom.inc.php");?>