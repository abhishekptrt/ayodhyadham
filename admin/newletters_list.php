<?
require_once("../includes/midas.inc.php");

if(is_post_back()) {
	$arr_nl_ids = $_REQUEST['arr_nl_ids'];
	if(is_array($arr_nl_ids)) {
		$str_nl_ids = implode(',', $arr_nl_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from ss_newletters where nl_id in ($str_nl_ids)";
			db_query($sql);
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update ss_newletters set nl_status = 'Active' where nl_id in ($str_nl_ids)";
			db_query($sql);
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			$sql = "update ss_newletters set nl_status = 'Inactive' where nl_id in ($str_nl_ids)";
			db_query($sql);
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}


$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ss_newletters   where 1 ";

$sql = apply_filter($sql, $nl_title, 'like','nl_title');

$sql_count = "select count(*) ".$sql; 
$reccnt = db_scalar($sql_count);

if($reccnt>0) {
	$order_by == '' ? $order_by = 'nl_date' : true;
	$order_by2 == '' ? $order_by2 = 'desc' : true;
	$sql .= "order by $order_by $order_by2 ";
	$sql .= "limit $start, $pagesize ";
	$sql = $columns.$sql;
	$result = db_query($sql);
}
?>
<link href="styles.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../includes/general.js"></script>
<? include("top.inc.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="pageHead"><div id="txtPageHead">
      Newletters    List </div></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="content">
            <form method="get" name="form2" id="form2" onsubmit="return confirm_submit(this)">
        <br />
        <table  border="0" align="center" cellpadding="2" cellspacing="0" class="tableSearch">
          <tr align="center">
            <th colspan="2">Search</th>
          </tr>
                   <tr>
            <td class="tdLabel">Title</td>
            <td><input name="nl_title" type="text" value="<?=$nl_title?>" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="pagesize" type="hidden" id="pagesize" value="<?=$pagesize?>" />
            <input type="image" name="imageField" src="images/buttons/search.gif" /></td>
          </tr>
        </table>
      </form>
      <br />
	  <div align="right"> <a href="export.php">Export List</a></div><br />
      <div align="right"> <a href="newletters_f.php">Add New Newletters</a></div><br />
			
      <? if($reccnt==0 || mysql_num_rows($result)==0){?>
      <div class="msg">Sorry, no records found.</div>
      <? } else{ ?>
      <div align="right"> Showing Records:
        <?= $start+1?>
        to
        <?=($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?>
        of
        <?= $reccnt?>
      </div>
      <div>Records Per Page:
	  
        <?=pagesize_dropdown('pagesize', $pagesize);?>
      </div>
	  <?php if(isset($_SESSION['sess_msg'])){?>
	  <div style="color:#669966;" align="center">
	  <strong><? echo $_SESSION['sess_msg'];unset($_SESSION['sess_msg']); ?></strong>
	  </div><? } ?>
      <form method="post" name="form1" id="form1" onsubmit="confirm_submit(this)">
        <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
          <tr>
            <th>Title<?= sort_arrows('nl_title')?></th>
            <th width="100px;">Date<?= sort_arrows('nl_date')?></th>
            <th width="100">Status<?= sort_arrows('nl_status')?></th>
            <th width="50">&nbsp;</th><th>&nbsp;</th>
			<th><input name="check_all" type="checkbox" id="check_all" value="1" onclick="checkall(this.form)" /></th>
          </tr>
          <?
while ($line_raw = mysql_fetch_array($result)) {
	$line = ms_display_value($line_raw);
	@extract($line);
	$css = ($css=='trOdd')?'trEven':'trOdd';
?>
          <tr class="<?=$css?>">
                                    <td valign="top"><?=$nl_title?></td>
                        <td valign="top"><?=midas_date_format($nl_date)?></td>
                        <td valign="top"><?=$nl_status?></td>
<td align="center" valign="top"><a href="send_newsletter.php?nl_id=<?php echo $nl_id; ?>">Send Mail</a></td>
<td align="center" valign="top">
<a href="newletters_f.php?nl_id=<?=$nl_id?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td>                         
	<td align="center"><input name="arr_nl_ids[]" type="checkbox" id="arr_nl_ids[]" value="<?=$nl_id?>" /></td>
                      </tr>
          <? }
?>
        </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px">              <input type="submit" name="Activate" value="Activate" class="button"/>
              <input type="submit" name="Deactivate" value="Deactivate" class="button" /> 
              			  <input type="submit" name="Delete" value="Delete"  class="buttonDelete"/> </td>
          </tr>
        </table>
              </form>
    <? }?>      <? include("paging.inc.php");?>    </td>
  </tr>
</table>

<? include("bottom.inc.php");?>
