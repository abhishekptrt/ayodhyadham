<?
require_once("../includes/midas.inc.php");
protect_admin_page();
if(is_post_back()) {
	$arr_sp_ids = $_REQUEST['arr_sp_ids'];
	if(is_array($arr_sp_ids)) {
		$str_sp_ids = implode(',', $arr_sp_ids);
			$sql = "delete from ss_static_pages where sp_id in ($str_sp_ids)";
			db_query($sql);
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}


$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ss_static_pages ";
$sql .= " where 1 and sp_name not like '%account_box%'";

$sql = apply_filter($sql, $sp_name, $sp_name_filter,'sp_name');

$order_by == '' ? $order_by = 'sp_id' : true;
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
      Static Pages    List </div></td>
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
            <td class="tdLabel">Name</td>
            <td><input name="sp_name" type="text" value="<?=$sp_name?>" />
            <?=filter_dropdown('sp_name_filter', $sp_name_filter)?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="pagesize" type="hidden" id="pagesize" value="<?=$pagesize?>" />
            <input type="image" name="imageField" src="images/buttons/search.gif" /></td>
          </tr>
        </table>
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
                                    
            <th nowrap="nowrap">Name            <?= sort_arrows('sp_name')?></th>
                      
            <th nowrap="nowrap">Description            <?= sort_arrows('sp_description')?></th>
                
                                
            <th nowrap="nowrap">Modify Date            <?= sort_arrows('sp_modify_date')?></th>
                                    <th>&nbsp;</th>                        
                      </tr>
          <?
while ($line_raw = ms_display_value(mysql_fetch_array($result))) {
	$line = $line_raw;
	@extract($line);
	$css = ($css=='trOdd')?'trEven':'trOdd';
?>
          <tr class="<?=$css?>">
<td nowrap="nowrap"><?=str_replace("_", " ", $sp_name)?></td>
                        <td nowrap="nowrap"><?=limited_str($line['sp_description'],75)?> <a href="ss_static_pages_f.php?sp_id=<?=$sp_id?>">More..</a></td>
<td nowrap="nowrap"><?=datetime_format($sp_modify_date);?></td>
                                    <td align="center"><a href="ss_static_pages_f.php?sp_id=<?=$sp_id?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td>                         
                      </tr>
          <? }
?>
        </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px">&nbsp;</td>
          </tr>
        </table>
              </form>
    <? }?>      <? include("paging.inc.php");?>    </td>
  </tr>
</table>

<? include("bottom.inc.php");?>
