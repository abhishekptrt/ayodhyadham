<?

require_once("../includes/midas.inc.php");

protect_admin_page();

if(is_post_back()) {

	$arr_cu_ids = $_REQUEST['arr_cu_ids'];

	if(is_array($arr_cu_ids)) {

		$str_cu_ids = implode(',', $arr_cu_ids);

		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {

			$sql = "delete from ss_contact_us where cu_id in ($str_cu_ids)";

			db_query($sql);

		} 

	}

	header("Location: ".$_SERVER['HTTP_REFERER']);

	exit;

}





$start = intval($start);

$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;

$columns = "select * ";

$sql = " from ss_contact_us ";

$sql .= " where 1 ";



$sql = apply_filter($sql, $cu_name, $cu_name_filter,'cu_name');



$order_by == '' ? $order_by = 'cu_id' : true;

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

       Contact Us    List </div></td>

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

            <td><input name="cu_name" type="text" value="<?=$cu_name?>" />

            <?=filter_dropdown('cu_name_filter', $cu_name_filter)?></td>

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

                                    

            <th width="10%" nowrap="nowrap">Name            <?= sort_arrows('cu_name')?></th>

                      

            <th width="18%" nowrap="nowrap">Email            <?= sort_arrows('cu_email')?></th>

                      

            <th width="9%" nowrap="nowrap">Title            <?= sort_arrows('cu_title')?></th>

                      

            <th width="14%" nowrap="nowrap">Date              <?= sort_arrows('cu_datetime')?></th>

                      

            <th width="11%" nowrap="nowrap">Status            <?= sort_arrows('cu_status')?></th>

                      

            <th width="15%" nowrap="nowrap">Reply Date            <?= sort_arrows('cu_reply_date')?></th>

                                    <th width="4%">&nbsp;</th>                         

                                    <th width="5%"><input name="check_all" type="checkbox" id="check_all" value="1" onclick="checkall(this.form)" /></th>
                      </tr>

          <?

while ($line_raw = mysql_fetch_array($result)) {

	$line = ms_display_value($line_raw);

	@extract($line);

	$css = ($css=='trOdd')?'trEven':'trOdd';

?>

          <tr class="<?=$css?>">

                                    <td nowrap="nowrap"><?=$cu_name?></td>

                        <td nowrap="nowrap"><?=$cu_email?></td>

                        <td nowrap="nowrap"><?=$cu_title?></td>

                        <td nowrap="nowrap"><?=datetime_format($cu_datetime)?></td>

                        <td nowrap="nowrap"><?=$cu_status?></td>

                        <td nowrap="nowrap"><?=$cu_reply_date?></td>

						<td align="center"><a href="contact_us_f.php?cu_id=<?=$cu_id?>">

						view</a></td>                         <td align="center"><input name="arr_cu_ids[]" type="checkbox" id="arr_cu_ids[]" value="<?=$cu_id?>" /></td>
                      </tr>

          <? }

?>
        </table>

                <table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td align="right" style="padding:2px">           

              			  <input type="submit" name="Delete" value="Delete"  class="buttonDelete"/> </td>

          </tr>

        </table>

            </form>

    <? }?>      <? include("paging.inc.php");?>    </td>

  </tr>

</table>



<? include("bottom.inc.php");?>

