<?
require_once("../includes/midas.inc.php");
protect_admin_page();
if(is_post_back()) {
	$arr_admin_ids = $_REQUEST['arr_admin_ids'];
	if(is_array($arr_admin_ids)) {
		$str_admin_ids = implode(',', $arr_admin_ids);
			$sql = "delete from ss_admin where admin_id in ($str_admin_ids)";
			db_query($sql);
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}


$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ss_admin ";
$sql .= " where 1 ";

$sql = apply_filter($sql, $admin_user_name, $admin_user_name_filter,'admin_user_name');

$order_by == '' ? $order_by = 'admin_id' : true;
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
      Admin    List </div></td>
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
            <td class="tdLabel">User Name</td>
            <td><input name="admin_user_name" type="text" value="<?=$admin_user_name?>" />
            <?=filter_dropdown('admin_user_name_filter', $admin_user_name_filter)?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="pagesize" type="hidden" id="pagesize" value="<?=$pagesize?>" />
            <input type="image" name="imageField" src="images/buttons/search.gif" /></td>
          </tr>
        </table>
      </form>
      <br />
            <div align="right"> <a href="ss_admin_f.php">Add New
         Admin      </a></div>
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
                                    
            <th nowrap="nowrap">User Name            <?= sort_arrows('admin_user_name')?></th>
                      
            <th nowrap="nowrap">Password            <?= sort_arrows('admin_password')?></th>
                                    <th>&nbsp;</th>    
									<th><input name="check_all" type="checkbox" id="check_all" value="1" onclick="checkall(this.form)" /></th>
                </tr>
          <?
while ($line_raw = mysql_fetch_array($result)) {
	$line = ms_display_value($line_raw);
	@extract($line);
	$css = ($css=='trOdd')?'trEven':'trOdd';
?>
          <tr class="<?=$css?>">
                                    <td nowrap="nowrap"><?=$admin_user_name?></td>
                        <td nowrap="nowrap"><?=$admin_password?></td>
                                    <td align="center"><a href="ss_admin_f.php?admin_id=<?=$admin_id?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td> 
									<td align="center"><input name="arr_admin_ids[]" type="checkbox" id="arr_admin_ids[]" value="<?=$admin_id?>" /></td>
                      </tr>
          <? }
?>
        </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px">            <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" /></td>
          </tr>
        </table>
            </form>
    <? }?>      <? include("paging.inc.php");?>    </td>
  </tr>
</table>

<? include("bottom.inc.php");?>
