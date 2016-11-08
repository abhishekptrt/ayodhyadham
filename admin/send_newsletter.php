<?
require_once('../includes/midas.inc.php');
$nl_id = $_REQUEST['nl_id'];
$sql = "select * from ss_newletters where nl_id = '$nl_id'";
$result = db_query($sql);
if ($line_raw = mysql_fetch_array($result)) 
{
	@extract($line_raw);
}
if(is_post_back()) 
{
	$headers  = "MIME-Version: 1.0\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
	$headers .= 'From:'.SITE_NAME;
	$query=" select * from ss_users where 1 ";
	foreach($_POST['user_type'] as $key => $val)
	{
		//when athlete is present in post
		if(!in_array('Al',$_POST['user_type']))
		{
			if($val == 'At')
			{
				$query1= " and ( user_type = 'Athlete' ";
			}
			if($val == 'Co' && in_array("At",$_POST['user_type']))
			{
				$query1.= " or user_type = 'Company' ";
			}
			if($val == 'Fa' && in_array("At",$_POST['user_type']))
			{
				$query1.= " or user_type = 'Fan' ";
			}
			//when athlete is not present in post and company is present
			if($val == 'Co' && !in_array("At",$_POST['user_type']))
			{
				$query1.= " and (user_type = 'Company' ";
			}
			if($val == 'Fa' && !in_array("At",$_POST['user_type']) && in_array("Co",$_POST['user_type']))
			{
				$query1.= " or user_type = 'Fan' ";
			}
			//when athlete is not present in post and company is not present and only fan is present
			if($val == 'Fa' && !in_array("At",$_POST['user_type']) && !in_array("Co",$_POST['user_type']))
			{
				$query1.= " and ( user_type = 'Fan' ";
			}
		}
	}

	if(!empty($query1))
	{
		$query1.= " ) ";
		$query .= $query1;
	}
	$email_id=db_query($query);
	$subject = $nl_title;
	while($email=mysql_fetch_array($email_id))
	{
		$full_msg=str_replace("{username}",$email['user_email'],"$nl_desc");
		$mail_to = $email['user_email'];
		@mail($mail_to,$subject,$full_msg,$headers);	
	}
//	$subject = "a";
//	$full_msg="b";
//	$headers = "$headers = From:c";
//	mail("vanit_sharma@localhost.com",$subject,$full_msg,$headers);	
	$_SESSION['sess_msg'] = " Newsletter has been sent successfully to selected email ids. ";
	header("location:newletters_list.php");
	exit;
}
?>
<link href="styles.css" rel="stylesheet" type="text/css">
<? include("top.inc.php");?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="pageHead"><div id="txtPageHead">
      News Letter </div></td>
  </tr>
</table>
<div align="right">&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" >
 
    
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">
        <tr>
          <td colspan="2" valign="top" class="tdLabel"><br />
            <div align="right"><a href="newletters_list.php">Back to Newsletter List</a>&nbsp;</div>
            <br />
            <table width="94%"  border="0" align="center" cellpadding="0" cellspacing="1" class="tableForm">
              <tr>
                <td  align="left" colspan="2" ><? include("error_msgs.inc.php");?></td>
              </tr>
              
<tr>
    <td width="20%" align="right" valign="top" class="tdLabel"><strong>Select Users</strong></td>
	<td   class="tdData" valign="top" colspan="2">
	<select name="user_type[]" multiple="multiple" style="width:200px; height:100px;">
		<option value="Al" selected="selected">All</option>
		<option value="At">Athletes</option>
		<option value="Co">Company</option>
		<option value="Fa">Fan</option>
	</select></td>				
</tr>
			  
			   <tr align="right">
                <td>&nbsp;</td>
              </tr>
			  
              <tr>
                <td width="20%" align="right" valign="top" class="tdLabel"><strong>Subject</strong></td>
                <td  bgcolor="#FFFFFF" class="tdData" valign="top" colspan="2"><?=$nl_title?></td>
              </tr>
              <tr align="right">
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="20%" align="right" valign="top" class="tdLabel"><strong> Message</strong></td>
                <td height="25" bgcolor="#FFFFFF" class="tdData"><strong><?=$nl_desc?></strong></td>
              </tr>
              <tr align="right">
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right" class="tdLabel"></td>
                <td class="tdData"><br/>
                <input type="image" name="imageField" src="images/send_mail.gif" />				</td>
              </tr>
              <tr>
                <td class="tdLabel">&nbsp;</td>
                <td class="tdData" >&nbsp;</td>
              </tr>
            </table></td>
          </tr>
</table>
</form>
<? include("bottom.inc.php");?>