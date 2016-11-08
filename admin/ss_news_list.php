<?
require_once("../includes/midas.inc.php");
protect_admin_page();
if(is_post_back()) {
	$arr_nw_ids = $_REQUEST['arr_nw_ids'];
	if(is_array($arr_nw_ids)) {
		$str_nw_ids = implode(',', $arr_nw_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from ss_news where nw_id in ($str_nw_ids)";
			db_query($sql);
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update ss_news set nw_status = 'Active' where nw_id in ($str_nw_ids)";
			db_query($sql);
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			$sql = "update ss_news set nw_status = 'Inactive' where nw_id in ($str_nw_ids)";
			db_query($sql);
		}
		else if(isset($_REQUEST['home_feat']) || isset($_REQUEST['home_feat_x']) ) {
			$sql = "update ss_news set nw_featured = 'home' where nw_id in ($str_nw_ids)";
			db_query($sql);
		}
		else if(isset($_REQUEST['no_feat']) || isset($_REQUEST['no_feat_x']) ) {
			$sql = "update ss_news set nw_featured = 'none' where nw_id in ($str_nw_ids)";
			db_query($sql);
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}


$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ss_news ";
$sql .= " where 1 ";

$sql = apply_filter($sql, $nw_title, $nw_title_filter,'nw_title');

$order_by == '' ? $order_by = 'nw_id' : true;
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
       News    List </div></td>
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
            <td><input name="nw_title" type="text" value="<?=$nw_title?>" />
            <?=filter_dropdown('nw_title_filter', $nw_title_filter)?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="pagesize" type="hidden" id="pagesize" value="<?=$pagesize?>" />
            <input type="image" name="imageField" src="images/buttons/search.gif" /></td>
          </tr>
        </table>
      </form>
      <br />
            <div align="right"> <a href="ss_news_f.php">Add New
        Ss News      </a></div>
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
                                    
            <th nowrap="nowrap">Title            <?= sort_arrows('nw_title')?></th>
                      
            <th nowrap="nowrap">Status            <?= sort_arrows('nw_status')?></th>
                                    <th>Featured <?= sort_arrows('nw_featured')?></th>
                                    <th>Date</th>
                                    <th>&nbsp;</th>                         <th><input name="check_all" type="checkbox" id="check_all" value="1" onclick="checkall(this.form)" /></th>
                      </tr>
          <?
while ($line_raw = mysql_fetch_array($result)) {
	$line = ms_display_value($line_raw);
	@extract($line);
	$css = ($css=='trOdd')?'trEven':'trOdd';
?>
          <tr class="<?=$css?>">
                                    <td nowrap="nowrap"><?=$nw_title?></td>
                        <td nowrap="nowrap"><?=$nw_status?></td>
                                    <td align="center"><?=$nw_featured?></td>
                                    <td align="center"><?=l_datetime_format($nw_date)?></td>
                                    <td align="center"><a href="ss_news_f.php?nw_id=<?=$nw_id?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td>                         <td align="center"><input name="arr_nw_ids[]" type="checkbox" id="arr_nw_ids[]" value="<?=$nw_id?>" /></td>
                      </tr>
          <? }
?>
        </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px"><input name="no_feat" type="image" id="no_feat" src="images/no_feature.gif" /> <input name="home_feat" type="image" id="home_feat" src="images/page_feature.gif" />             <input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" />
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" />
                          <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" /></td>
          </tr>
        </table>
            </form>
    <? }?>      <? include("paging.inc.php");?>    </td>
  </tr>
</table>

<? include("bottom.inc.php");?>
