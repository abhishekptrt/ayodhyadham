<?
require_once("../includes/midas.inc.php");
protect_admin_page();
if(is_post_back()) {
	$arr_ec_ids = $_REQUEST['arr_ec_ids'];
	if(is_array($arr_ec_ids)) {
		$str_ec_ids = implode(',', $arr_ec_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from ss_event_comments where ec_id in ($str_ec_ids)";
			db_query($sql);
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update ss_event_comments set ec_status = 'Active' where ec_id in ($str_ec_ids)";
			db_query($sql);
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			$sql = "update ss_event_comments set ec_status = 'Inactive' where ec_id in ($str_ec_ids)";
			db_query($sql);
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}


$start = intval($start);
$pagesize =intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ss_event_comments inner join ss_users on ec_user_id=user_id ";
$sql .= " where ec_ue_id='$ev_id' ";

$sql = apply_filter($sql, $ec_ue_id, $ec_ue_id_filter,'ec_ue_id');

$order_by == '' ? $order_by = 'ec_id' : true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 

$sql .= "order by $order_by $order_by2 ";

$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<link href="styles.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../includes/general.js"></script>
<? include("top.inc.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="pageHead"><div id="txtPageHead">
      Event Comments    List </div></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="content">
            <form method="get" name="form2" id="form2" onsubmit="return confirm_submit(this)">
        <br />
            </form>
      <br />
      <? if(mysql_num_rows($result)==0){?>
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
      <form method="post" name="form1" id="form1" onsubmit="confirm_submit(this)">
        <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
          <tr>
                                    
            <th nowrap="nowrap">Added by <?= sort_arrows('user_public_display_name')?></th>
                      
            <th nowrap="nowrap">Description            <?= sort_arrows('ec_description')?></th>
                      
            <th nowrap="nowrap">Post Date            <?= sort_arrows('ec_post_date')?></th>
                      
            <th nowrap="nowrap">Status            <?= sort_arrows('ec_status')?></th>
                                    <th>&nbsp;</th>                         <th><input name="check_all" type="checkbox" id="check_all" value="1" onclick="checkall(this.form)" /></th>
                </tr>
          <?
while ($line_raw = mysql_fetch_array($result)) {
	$line = ms_display_value($line_raw);
	@extract($line);
	$css = ($css=='trOdd')?'trEven':'trOdd';
?>
          <tr class="<?=$css?>">
                                    <td nowrap="nowrap"><?=$user_public_display_name?></td>
                        <td nowrap="nowrap"><?=$ec_description?></td>
                        <td nowrap="nowrap"><?=l_date_format($ec_post_date);?></td>
                        <td nowrap="nowrap"><?=$ec_status?></td>
                                    <td align="center"><a href="ss_event_comments_f.php?ec_id=<?=$ec_id?>&ec_ue_id=<?=$ec_ue_id?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td>                         <td align="center"><input name="arr_ec_ids[]" type="checkbox" id="arr_ec_ids[]" value="<?=$ec_id?>" /></td>
                </tr>
          <? }
?>
        </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px">              <input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" />
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" />
                          <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" /></td>
          </tr>
        </table>
            </form>
    <? }?>      <? include("paging.inc.php");?>    </td>
  </tr>
</table>

<? include("bottom.inc.php");?>
