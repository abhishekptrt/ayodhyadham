<?php
require_once("../includes/midas.inc.php");

if(is_post_back()) {
	$arr_page_ids = $_REQUEST['arr_page_ids'];
	if(is_array($arr_page_ids)) {
		$str_page_ids = implode(',', $arr_page_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from tbl_pages where page_id in ($str_page_ids)";
			db_query($sql);
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update tbl_pages set page_status = 'Active' where page_id in ($str_page_ids)";
			db_query($sql);
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			$sql = "update tbl_pages set page_status = 'Inactive' where page_id in ($str_page_ids)";
			db_query($sql);
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}


$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;

$sql = " select * from tbl_pages where page_parent_id=0 ";
//$sql = apply_filter($sql, $page_parent_id, $page_parent_id_filter,'page_parent_id');
$order_by == '' ? $order_by = 'page_display_order' : true;
$order_by2 == '' ? $order_by2 = 'asc' : true;
$sql .= "order  by $order_by $order_by2 limit $start, $pagesize ";

$pager = new midas_pager_sql($sql, $pagesize, $start);
if($pager->total_records) {
	$result = db_query($sql);
}
?>
<link href="styles.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../includes/general.js"></script>
<? include("top.inc.php");?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="pageHead"><div id="txtPageHead">
      Pages    List </div></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="content"><? if($pager->total_records==0){?>
<div class="msg">Sorry, no records found.</div>
      <? } else{ ?>
      <div align="right"> <? $pager->show_displaying()?> </div>
      <div>Records Per Page:
        <?=pagesize_dropdown('pagesize', $pagesize);?>
      </div>
      <form method="post" name="form1" id="form1" onsubmit="confirm_submit(this)">
        <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
          <tr>
                                    
            <th width="89%" nowrap="nowrap">Name            <?= sort_arrows('page_name')?></th>
                      
            <th width="11%" nowrap="nowrap">Change Order </th>
            <th width="11%">&nbsp;</th>                         
          </tr>
          <?
while ($line_raw = mysql_fetch_array($result)) {
	$line = ms_display_value($line_raw);
	@extract($line);
	$css = ($css=='trOdd')?'trEven':'trOdd';
?>
          <tr class="<?=$css?>">
                        <td nowrap="nowrap"><?=$page_name?></td>
                        <td align="center"><?=midas_ordering::dropdown('tbl_pages', 'page_display_order', $page_display_order, 'page_id','page_parent_id=0')?></td>
                        <td align="center"><a href="pages_f.php?page_id=<?=$page_id?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td>                         
          </tr>
          <? }
?>
        </table>
      </form>
    <? }?>    <? $pager->show_pager()?><?// include("paging.inc.php");?>    </td>
  </tr>
</table>

<? include("bottom.inc.php");?>
