<?

require_once('../includes/midas.inc.php');

protect_admin_page();



if(is_post_back()) {



		$sql = "update ss_contact_us set cu_reply_message = '$cu_reply_message', cu_status='Reply', cu_reply_date= now() where cu_id = $cu_id";

		db_query($sql);

	
	$mail_text =readmyfile("../includes/emails/contact_us_reply.txt"); 
	
	
	$text= array("{sitename}","{cu_reply_message}", "{cu_message}" ,"{cu_name}", "{path}");
	
	
	$sql = db_query("select * from ss_contact_us where cu_id='$cu_id'");
	$rs = mysql_fetch_array($sql);
	@extract($rs);
	$value= array(SITE_NAME, $cu_reply_message, $cu_message, $cu_name, SITE_WS_PATH); 
	$mail_body= str_replace($text,$value,$mail_text);

	$subject=SITE_NAME." Admin Reply of your query";
	
	$mail_body='<span style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;color:#006699;font-weight:normal;">'.$mail_body.'</span>'; 
	$_SESSION['sess_message']=$arr_message['message_sent'];
  $headers = 'Content-type: text/html; charset=iso-8859-1' . "\n";
	$headers .= 'From:'. SITE_NAME.'<'.ADMIN_EMAIL.'>' . "\n";
		$mail_body=nl2br($mail_body);
		/*if(!@mail($cu_email, $subject, $mail_body, $headers)){
		echo "Problem while sending mail";
		exit();
		}*/
		@mail($cu_email, $subject, $mail_body, $headers);
	
	
	
	$_SESSION['sess_message']="Your message has been send!";



	header("Location: contact_us_list.php");

	exit;

}

$cu_id = $_REQUEST['cu_id'];
if($cu_id!='') {

	$sql = "select * from ss_contact_us where cu_id = '$cu_id'";

	$result = db_query($sql);

	if ($line_raw = mysql_fetch_array($result)) {

		$line = ms_form_value($line_raw);

		@extract($line);

	}

	if ($cu_status == "New") {

		$sql = "update ss_contact_us set cu_status='Read' where cu_id = $cu_id";

		db_query($sql);	

	}

}



?>

<link href="styles.css" rel="stylesheet" type="text/css">

<? include("top.inc.php");?>



<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td id="pageHead"><div id="txtPageHead">

       Contact Us</div></td>

  </tr>

</table>

<div align="right"><a href="contact_us_list.php">Back to 

         Contact Us        List</a>&nbsp;</div>

<form name="form1" method="post" enctype="application/x-www-form-urlencoded" <?= validate_form()?>>

 

    

  <table width="95%"  border="0" align="center" cellpadding="3" cellspacing="4" class="tableForm">

        <tr>

      <td width="141" class="tdLabel">Name:</td>

      <td width="270" class="tdData"><?=$cu_name?></td>

    </tr>

	<tr>

      <td width="141" class="tdLabel">Email:</td>

      <td width="270" class="tdData"><?=$cu_email?></td>

    </tr>



    <tr>

      <td width="141" class="tdLabel">Membership Type:</td>

      <td width="270" class="tdData"><?=$cu_membership_type?></td>

    </tr>



	<tr>

      <td width="141" class="tdLabel">Status :</td>

      <td width="270" class="tdData"><?=$cu_status?></td>

    </tr>



        <tr>

      <td width="141" class="tdLabel">Title:</td>

      <td width="270" class="tdData"><?=$cu_title?></td>

    </tr>

	

	<tr>

      <td width="141" class="tdLabel">Question:</td>

      <td width="270" class="tdData"><p><?=nl2br($cu_message)?>

      </p></td>

    </tr>

	<tr>

      <td colspan="2">&nbsp;</td>

      </tr>

	<tr>

      <td width="141" class="tdLabel">Answer:</td>

      <td width="270" class="tdData"><textarea name="cu_reply_message" id="cu_reply_message" rows="5" cols="50"  class="textfield"><?=$cu_reply_message?></textarea></td>

    </tr>



     	    <tr>

	    <td class="tdLabel">&nbsp;</td>

	    <td class="tdData"><input type="hidden" name="cu_id" value="<?=$cu_id?>">

		<input type="image" name="imageField" src="images/buttons/submit.gif" /></td>

    </tr>

  </table>

</form>

<? include("bottom.inc.php");?>