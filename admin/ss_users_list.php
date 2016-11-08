<?
require_once("../includes/midas.inc.php");
protect_admin_page();
if(is_post_back()) {
	$arr_user_ids = $_REQUEST['arr_user_ids'];
	if(is_array($arr_user_ids)) {
		$str_user_ids = implode(',', $arr_user_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from ss_users where user_id in ($str_user_ids)";
			db_query($sql);
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update ss_users set user_status = 'Active' where user_id in ($str_user_ids)";
			db_query($sql);
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			$sql = "update ss_users set user_status = 'Inactive' where user_id in ($str_user_ids)";
			db_query($sql);
		}
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}


$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ss_users ";
$sql .= " where 1 ";

$sql = apply_filter($sql, $user_email, $user_email_filter,'user_email');

$order_by == '' ? $order_by = 'user_id' : true;
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
       Users    List </div></td>
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
            <td class="tdLabel">E-Mail</td>
            <td><input name="user_email" type="text" value="<?=$user_email?>" />
            <?=filter_dropdown('user_email_filter', $user_email_filter)?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><input name="pagesize" type="hidden" id="pagesize" value="<?=$pagesize?>" />
            <input type="image" name="imageField" src="images/buttons/search.gif" /></td>
          </tr>
        </table>
      </form>
      <br />
            <div align="right"> <a href="ss_users_f.php">Add New
         Users      </a></div>
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
                 <th nowrap="nowrap">Name           <?= sort_arrows('user_fname')?></th>                   
            <th nowrap="nowrap">Type            <?= sort_arrows('user_type')?></th>
                      
            <th nowrap="nowrap">Email            <?= sort_arrows('user_email')?></th>
                      
            <th nowrap="nowrap">City            <?= sort_arrows('user_city')?></th>
            <th nowrap="nowrap">Title            <?= sort_arrows('user_title')?></th>
                      
            <th nowrap="nowrap">Status            <?= sort_arrows('user_status')?></th>
                      
            <th nowrap="nowrap">Reg Date            <?= sort_arrows('user_reg_date')?></th>
                                    <th>&nbsp;</th>      
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
		     <td nowrap="nowrap"><?=$user_fname?></td>
                                    <td nowrap="nowrap"><?=$user_type?></td>
                        <td nowrap="nowrap"><?=$user_email?></td>
                        <td nowrap="nowrap"><?=$user_city?></td>
                        <td nowrap="nowrap"><?=$user_title?></td>
                        <td nowrap="nowrap"><?=$user_status?></td>
                        <td nowrap="nowrap"><?=$user_reg_date?></td>
						<td nowrap="nowrap"><a href="ss_user_video_list.php?u_id=<?=$user_id?>">View Video</td>
                                    <td align="center"><a href="#"><img src="images/icons/edit.png" alt="Edit" width="8" height="16" border="0" /></a></td>                         
                                    <td align="center"><input name="arr_user_ids[]" type="checkbox" id="arr_user_ids[]" value="<?=$user_id?>" /></td>
                </tr>
          <? }
?>
        </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px">              <input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onclick="return activateConfirmFromUser('arr_user_ids[]')"/>
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onclick="return deactivateConfirmFromUser('arr_user_ids[]')"/>
                          <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onclick="return deleteConfirmFromUser('arr_user_ids[]')"/></td>
          </tr>
        </table>
              </form>
    <? }?>      <? include("paging.inc.php");?>    </td>
  </tr>
</table>

<? include("bottom.inc.php");?>
