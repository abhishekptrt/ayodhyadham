<?
require_once('../includes/midas.inc.php');
protect_admin_page();
if(is_post_back()) {
	if($ec_id!='') {
		$sql = "update ss_event_comments set ec_description = '$ec_description' $sql_edit_part where ec_id = $ec_id";
		db_query($sql);
	} 
	header("Location: ss_event_comments_list.php?ev_id=$ec_ue_id");
	exit;
}

$ec_id = $_REQUEST['ec_id'];
if($ec_id!='') {
	$sql = "select * from ss_event_comments where ec_id = '$ec_id'";
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
       Event Comments</div></td>
  </tr>
</table>
<div align="right"><a href="ss_event_comments_list.php?ev_id=<?=$ec_ue_id?>">Back to 
        Event Comments        List</a>&nbsp;</div>
<form name="form1" method="post" enctype="application/x-www-form-urlencoded" <?= validate_form()?>>
 
    
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">

        <tr>
      <td width="141" class="tdLabel">Comment</td>
      <td width="270" class="tdData"><textarea name="ec_description" cols="60" rows="10" alt="blank" emsg="Plz enter comment" ><?=$ec_description?></textarea></td>
    </tr>

     	    <tr>
	    <td class="tdLabel">&nbsp;</td>
	    <td class="tdData"><input type="hidden" name="ec_id" value="<?=$ec_id?>">
	<input type="hidden" name="ec_ue_id" value="<?=$ec_ue_id?>">
		                <input type="image" name="imageField" src="images/buttons/submit.gif" /></td>
    </tr>
  </table>
</form>
<? include("bottom.inc.php");?>