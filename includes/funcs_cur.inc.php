<?php //style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:10px;color:#006699;font-weight:normal;"

function validate_form()
{
	return ' onsubmit="return validateForm(this,0,0,0,1,8);" ';
}

function protect_admin_page() {
	//return true;
	$cur_dir = dirname($_SERVER['PHP_SELF']);
	if($cur_dir == SITE_SUB_PATH.'/admin') {
		$cur_page = basename($_SERVER['PHP_SELF']);
		//echo "<br>cur_page: $cur_page";
		if($cur_page != 'index.php') {
			if ($_SESSION['sess_admin_user_name']=='') {
				header('Location: index.php');
				exit;
			}
		}
	}
}


function get_fields_from_table_oneresult($tablename,$required_field_str,$where_condition_str)
{
	
	$sql="select $required_field_str from $tablename where 1 ";
	if($where_condition_str!='')
	{
	$sql.=" and $where_condition_str";
	}
	$row=db_query($sql);
	$res=ms_display_value(mysql_fetch_assoc($row));
	return($res);
}

function display_random_image()
{
	$sql="select random_image,random_image_url from ss_random_images order by rand() limit 0,1 ";
	$row=db_query($sql);
	$res=ms_display_value(mysql_fetch_assoc($row));
	return($res);
}

function get_sports_category($sc_id) {
	return db_scalar ("select sc_name from ss_sports_categories where sc_id ='$sc_id' ");
}

function fetch_discipline_name ($dsp_id) {
	return db_scalar ("select dsp_name from ss_discipline where dsp_id='$dsp_id'");

}
function get_sports_name  ($ue_sp_id) {
	return db_scalar ("select sp_name from ss_sports where sp_id='$ue_sp_id'");	
	
}


function smile($content){
	//global $arr_smile;
	$sql_smile	= "select * from ss_smilies";
	$res_sql_smile=db_query($sql_smile); 
	if(mysql_num_rows($res_sql_smile)>0){
	 $arr_smile	=	array();
	 while($row_smile=mysql_fetch_array($res_sql_smile)){
		@extract($row_smile);
	 	$arr_smile[$smile_url]	=	$code;		
	 }
	}
	if(is_array($arr_smile)){
		foreach($arr_smile as $key=>$value){
			if(strpos($content,$value)!=-1){
				$content	=	str_replace($value,'<img src="'.SITE_WS_PATH.'/images/smiles/'.$key.'" border=0>',$content);
			 }
		}
	}
	
	return $content;
}

// year_dropdown: Updated 31 may 2006
function l_dec_year_dropdown($name, $selected_date_year = '', $start_year =	'',	$end_year = '', $extra='')
{
	if ($start_year	== '') {
		$start_year	= DEFAULT_START_YEAR;
	}
	
	if ($end_year == '') {
		$end_year =	DEFAULT_END_YEAR;
	}

	$date_dropdown	.= "<select	name='$name' $extra>";
	$date_dropdown	.= "<option	value='0'>Year</option>";

	for($i = $end_year; $i >= $start_year; $i--) {
		$date_dropdown	.= " <option ";
		if ($i == $selected_date_year) {
			$date_dropdown	.= " selected ";
		}
		$date_dropdown	.= " value='" .	str_pad($i,	2, "0",	STR_PAD_LEFT) .	"'>" . str_pad($i, 2, "0", STR_PAD_LEFT) .	"</option>";
	}
	$date_dropdown	.= "</select>";
	return $date_dropdown;
}





function status_dropdown()
{
	$arr = array( "Active" => 'Active', 'Inactive' => 'Inactive');
	return array_dropdown($arr, $sel_value, $name);
}

function yes_no_dropdown()
{
	$arr = array( "Yes" => 'Yes', 'No' => 'No');
	return array_dropdown($arr, $sel_value, $name);
}
function get_sport_name($name='sport_name',$pv_id,$sport_id_name,$discipline_id_name,$selval='')
{
	
	$sql_sport="select * from ss_sports where sp_sc_id='$pv_id' and sp_status='Active' order by sp_name";
	$row_sport=db_query($sql_sport);
	$var='<select name="'.$sport_id_name.'" class="txtfield" onchange="do_get_discipline_name(this.options[this.selectedIndex].value,\''.$discipline_id_name.'\')" alt="select" emsg="Choose sport" style="width:90%">';
	$var.='<option value="">Select sports</option>';
	while($res_sport=mysql_fetch_array($row_sport))
	{
	
	$var.='<option value="'.$res_sport['sp_id'].'"';
	if($res_sport['sp_id']==$selval){ $var.='selected';}
	$var.=' >'.$res_sport['sp_name'].'</option>';
	}
	$var.='</select>';
	return($var);
}
//special for inner profile- my spoarts
function get_sport_fname($name='sport_name',$pv_id,$sport_id_name,$discipline_id_name)
{
	
	 $sql_sport="select * from ss_sports where sp_sc_id='$pv_id' and sp_status='Active' order by sp_name";
	$row_sport=db_query($sql_sport);
	$var='<select name="'.$sport_id_name.'" class="txtfield" onchange="do_get_discipline_fname(this.options[this.selectedIndex].value,\''.$discipline_id_name.'\')" style="width:200px">';
	$var.='<option value="">Select sports</option>';
	while($res_sport=mysql_fetch_array($row_sport))
	{
	$var.='<option value="'.$res_sport['sp_id'].'" >'.$res_sport['sp_name'].'</option>';
	}
	$var.='</select>';
	return($var);
}
function get_discipline_name($name='discipline_name',$dv_id,$discipline_id_name,$selval='')
{
	$sql_discipline="select * from ss_discipline where dsp_sp_id='$dv_id' and dsp_status='Active' order by dsp_name";
	$row_discipline=db_query($sql_discipline);
	$var='<select name="'.$discipline_id_name.'" class="txtfield" alt="select" emsg="Choose discipline" style="width:90%">';
	$var.='<option value="">Select discipline</option>';
	while($res_discipline=mysql_fetch_array($row_discipline))
	{
	$var.='<option value="'.$res_discipline['dsp_id'].'"';
		if($res_discipline['dsp_id']==$selval){ $var.='selected';}
	$var.=' >'.$res_discipline['dsp_name'].'</option>';
	}
	$var.='</select>';
	return($var);
}
//special for inner profile- my spoarts
function get_discipline_fname($name='discipline_name',$dv_id,$discipline_id_name)
{
	
	if($_SESSION['sess_user_type']=='Athlete')
	{
	$var=showing_checked_currently_disciplines_of_athletes($dv_id,$discipline_id_name);
	}
	else if($_SESSION['sess_user_type']=='Company')
	{
	$var=showing_checked_currently_disciplines_of_company($dv_id,$discipline_id_name);
	}
	else if($_SESSION['sess_user_type']=='Team')
	{
	$var=showing_checked_currently_disciplines_of_team($dv_id,$discipline_id_name);
	}
	else if($_SESSION['sess_user_type']=='Fan')
	{
	$var=showing_checked_currently_disciplines_of_fan($dv_id,$discipline_id_name);
	}
	return($var);
}
function limited_str($strName,$l=10)
{
  $tempStr=trim($strName);
  if(strlen($tempStr)>$l)
  {
  	$tempStr=substr($tempStr,0,$l);
	$tempStr.="...";
  }
  return $tempStr;
}

function getSpawEditor($field_name, $field_value='', $width, $height)
{
	$sw = new SPAW_Wysiwyg($field_name, $field_value, 'en', 'full', '', $width, $height, '',  '');
	$sw->show();
}
function get_make_headshot($name='headshot_name', $t)
{
	$sql_ph="select up_photo_name from ss_user_photos where up_id='$t'";
	$quer_ph=db_query($sql_ph);
	$res_ph=mysql_fetch_array($quer_ph);
	$sql_upt="update ss_users set user_headshot='".$res_ph['up_photo_name']."' where user_id='".$_SESSION['sess_user_id']."'";
	db_query($sql_upt);
	return("Headshot is set successfully");
}
function get_public_name_availibility($name='discipline_name',$t)
{
	$sql_pub_chk="select *  from ss_users where user_public_display_name='$t'";
	$row_pub_chk=db_query($sql_pub_chk);
	if(mysql_num_rows($row_pub_chk)>0)
	{
		$var1="Not Available for use, already reserved by another user";
	}
	else
	{
		$var1="Available, Yes you can use this public name";
	}
	return ($var1);
}

function get_shop_sport($name='sport_name',$pv_id,$td_id){

	$str='<table>';
	$sql_spt="select * from ss_sports where sp_sc_id='$pv_id' and sp_status='Active'";
	$row_spt=db_query($sql_spt);
	$cnt=1;
	//Getting previously added sports
	$sql_get_spt="select ss_sp_id from ss_shop_sports where ss_user_id='".$_SESSION['sess_user_id']."'";
	$row_get_spt=db_query($sql_get_spt);
	while($res_get_spt=mysql_fetch_array($row_get_spt)){
	$arr_get_spt[]=$res_get_spt['ss_sp_id'];
	}
	//--------------------                -------------//
	
	
	while($res=mysql_fetch_array($row_spt))
	{
			if($cnt%4==1)
			{
				$str.='<tr>';
			}
		if(is_array($arr_get_spt))
		{
				
				if(in_array($res['sp_id'],$arr_get_spt))
				{
				$ischeckyesno=" checked ";
				}
				else
				{
				$ischeckyesno="";
				}
		}
		$str.='<td class="verdana10_white" style="padding-left:20px;"><input type="checkbox"  name="ss_sp_id[]" value="'.$res['sp_id'].'" '.$ischeckyesno.'>&nbsp;'.$res['sp_name'].'</td>';
		
		$cnt++;
	}	
	
			if($cnt%4==0)
			{
				$str.='</tr>';
			}
	$str.='</table>';
	return($str);	
	

}


function protect_member_page($page_after_success) {
	
			$_SESSION['page_after_success']='';
			if ($_SESSION['sess_user_id']=='') {
				 $_SESSION['sess_message']='PLEASE LOGIN';
				$_SESSION['page_after_success']=$page_after_success;
				header('Location: ss_login.php');
				exit;
			}

	
}


function readmyfile($path)
{
	$text='';
	$fp = @fopen($path,"r");
	while (!@feof($fp))
	{
	$buffer = @fgets($fp, 4096);
	$text.= $buffer;
	}
	@fclose($fp);
	return $text;
}

function type_2_send_email_notification($user_email,$email_body,$from_string,$mail_type,$subject)
{
		$headers = "Content-type: $mail_type; charset=iso-8859-1" . "\n";
		$headers .= 'From:'. $from_string . "\n";
		@mail($user_email, $subject, $email_body, $headers);
		/*if(!mail($user_email, $subject, $email_body, $headers))
		{
				echo "Problem while sending mail";
				exit();
		}*/
		return;
}

function email_notification_user($toemail,$login_user_id,$extra_message='')
{
		
			$sql_email_notify="select * from ss_users where user_id='$login_user_id'";
 			$quer_email_notify=db_query($sql_email_notify);
 			$res_en=mysql_fetch_array($quer_email_notify);
 			$file_name='uploaded_files'.'/'.$res_en['user_headshot'];
   				if($res_en['user_headshot']!='' && file_exists($file_name)) { 
				
						 $show_image=show_thumb(UP_FILES_WS_PATH.'/'.$res_en['user_headshot'],'150','150','width_height'); }
  				else $show_image=SITE_WS_PATH."/images/no_images.jpg";
				
		     $message_bod='
		<table width="80%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#4574A3"		>
			  <tr><td bgcolor="#FFFFFF" style="border:#ADAAAD solid 2px;">
			 <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#4574A3">
  <tr><td colspan="2" align="center" bgcolor="#6594C2" style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:11px; font-weight:bold;"><b> '.$extra_message.'  <br>You got a new message from '.$res_en['user_public_display_name'].'</b></td>
  </tr>
 
  <tr>
    <td width="7%" align="left" valign="top" bgcolor="#5488BC"><a href="'.SITE_WS_PATH.'/ath_profile.php?memid='.$login_user_id.'"><img src="'.$show_image.'"   																					border="0"></a></td>
    <td width="93%" align="right" bgcolor="#5488BC" ><table width="98%" border="0" cellpadding="3" cellspacing="1" bgcolor="#4574A3" >
      <tr bgcolor="#6594C2"  >
        <td width="32%" align="left" class="latest_news_head" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; font-weight:bold;"><b>First Name</b>:</td>
                          <td width="68%" align="left"  class="blue_normal" style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:11px; font-weight:normal;">&nbsp;'.$res_en['user_fname'].'</td>
      </tr>
	 <tr>
        <td align="left" bgcolor="#5488BC" style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:11px; font-weight:bold;"><b>Last Name</b> :</td>
                          <td align="left" bgcolor="#5488BC" style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:11px; font-weight:normal;" >&nbsp;'.$res_en['user_lname'].'</td>
      </tr>
	  
      <tr bgcolor="#6594C2">
        <td align="left" style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:11px; font-weight:bold;"><b>Type</b>:</td>
                          <td align="left" style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:11px; font-weight:normal;" >&nbsp;'.$res_en['user_type'].'</td>
      </tr>
	 
    </table></td>
  </tr>
 </table>
</td>
</tr>
<table>';
		
		$html = true;
		$headers = 'Content-type: text/html; charset=iso-8859-1' . "\n";
		$headers .= 'From:'. SITE_NAME.'<'.ADMIN_EMAIL.'>' . "\n";
		$message_title="A new message for you ";
		@mail($toemail, $message_title, $message_bod, $headers);
			


}


function l_date_format($date)
{
	if (strlen($date) >= 10) {
		if ($date == '0000-00-00 00:00:00' || $date	== '0000-00-00') {
			return '';
		}
		$mktime	= mktime(0,	0, 0, substr($date,	5, 2), substr($date, 8,	2),	substr($date, 0, 4));
		return date("M j, Y", $mktime);
	} else {
		return $s;
	}
}
// datetime_format: Updated 31 may 2006
function l_datetime_format($date)
{
	global $arr_month_short;
	if (strlen($date) >= 10) {
		if ($date == '0000-00-00 00:00:00' || $date	== '0000-00-00') {
			return '';
		}
		$mktime	= mktime(substr($date, 11, 2), substr($date, 14, 2), substr($date, 17, 2),substr($date,	5, 2), substr($date, 8,	2),	substr($date, 0, 4));
		return date("M j, Y h:i A ", $mktime);
	} else {
		return $s;
	}
}

function get_lighter_color($color)
{
	$color2 = substr($color,1);
	$r = hexdec(substr($color2, 0,2));
	$g = hexdec(substr($color2, 2,2));
	$b = hexdec(substr($color2, 4,2));

	$rr = $r + (255-$r)/2;
	$gg = $g + (255-$g)/2;
	$bb = $b + (255-$b)/2;
	return '#'.dechex($rr).dechex($gg).dechex($bb);
}

function get_user_personolized_theme($mem_id)
{
/* ....................find css (profile themes...of user........... */
$sql_profile="select pc_css_name from ss_profile_css where pc_user_id='$mem_id'";
$row_profile=db_query($sql_profile);
$res_profile=mysql_fetch_array($row_profile);
@extract($res_profile);
if($pc_css_name!='')
	return($pc_css_name);
else 	return('default.css');
/*..............*/
}
function get_section_tothis_page($name='section_tothis_page',$section_name,$page,$mem_type)
{
global $arr_bydef_sections;
global $arr_section_corresponding_databasefields;
/* Table 'ss_extra_sections_onpage' used to manage section other than bydefault sections for a page , and to keep track of such 'bydefault sections' that were baned from user for a page*/
$sql_check_section="select * from ss_extra_sections_onpage where psm_user_id='".$_SESSION['sess_user_id']."' and psm_script_name='$page'";
$row_check_section=db_query($sql_check_section);
$res_check_section=mysql_fetch_array($row_check_section);
$tmp_col_name=$arr_section_corresponding_databasefields[$section_name];
	if(in_array($section_name,$arr_bydef_sections[$mem_type][$page]))
	{
		//section is  out  of one of by-deafult sections for this page
		//check if user blocked it to show, then activate it again
		if(mysql_num_rows($row_check_section)>0)
		{
		
			if($res_check_section[$tmp_col_name]=='no')
			{
			//Means, this was one of default section for this page, but user baned it to appear. So now user want to show it ..that's why update (change 'no') this record so that it'll apear automatically bcoz it is one of defualt section for this page. 
			$sql_del_ban_sec="update ss_extra_sections_onpage set $tmp_col_name='' where psm_user_id='".$_SESSION['sess_user_id']."' and psm_script_name='$page'";
			db_query($sql_del_ban_sec);
			$mess="This section is added on this page";
			}
			else
			{
			$mess="Sorry, this section is already added on this page";
			}
		}
		else
		{
			$mess="Sorry, this section is already added on this page";
		}
	
		
		
	}
	else
	{	//Not a by-default section for this page
				
				if(mysql_num_rows($row_check_section)>0)
				{
					if($res_check_section[$tmp_col_name]=='yes')
					{
					$mess="Sorry, this section is already added on this page";
					}
					else
					{
					$sql_up_sec="update ss_extra_sections_onpage set $tmp_col_name='yes' where psm_user_id='".$_SESSION['sess_user_id']."' and psm_script_name='$page'";
					db_query($sql_up_sec);
					$mess="Section is added on this page successfully";
					}
				}	
				else
				{
				$sql_in_sec="insert into ss_extra_sections_onpage (psm_script_name,psm_user_id,$tmp_col_name) values ('$page','".$_SESSION['sess_user_id']."','yes')";
				db_query($sql_in_sec);
				$mess="Section is added on this page successfully";
				}
				
	}
return($mess);
}
function get_remove($name='remove_sec',$sec_name,$script_name)
{
global $arr_section_corresponding_databasefields;
//update if...record exist for this user in ss_extra_sections_onpage
$sql_section_update="update ss_extra_sections_onpage set ".$arr_section_corresponding_databasefields[$sec_name]." ='no' where psm_user_id='".$_SESSION['sess_user_id']."' and psm_script_name='$script_name'";
db_query($sql_section_update);
//inser if not
$sql_section="select * from ss_extra_sections_onpage where psm_user_id='".$_SESSION['sess_user_id']."' and psm_script_name='$script_name'";		
$ct_section=db_query($sql_section);
		if(mysql_num_rows($ct_section)==0){
			$sql_sec_in="insert into ss_extra_sections_onpage (".$arr_section_corresponding_databasefields[$sec_name].",psm_user_id,psm_script_name) values ('no','".$_SESSION['sess_user_id']."','$script_name')";
			db_query($sql_sec_in);
		}
return;

}

function get_remove_from_network($name='remove_from_network',$type,$rt_id)
{
	if($type=="watchlist")
	{
	$sql_del_network="delete from ss_user_watchlists where uw_id=$rt_id";
	} 
	else if($type=="friends")
	{
	$sql_del_network="delete from ss_user_friends where uf_id=$rt_id";
	}
	else if($type=="events")
	{
	$sql_del_network="delete from ss_favorite_events where fe_id=$rt_id";
	}
	else if($type=="places")
	{
	$sql_del_network="delete from ss_favorite_places where fp_id=$rt_id";
	}
	
	db_query($sql_del_network);
	return("One entry is deleted from your network($type section) successfully");
	
}

function get_event_name($name='get_event_name',$t)
{  
$sql_event="select * from ss_user_events where date_format(ue_start_date,'%Y')>=$t";
$row_event=db_query($sql_event);
$str='<select name="ur_ue_id" class="txtfield" alt="select" emsg="Select an event">
	<option  value="">select an event</option>';
	 while($res_event=mysql_fetch_array($row_event)){
	$str.='<option  value="'.$res_event['ue_id'].'">'.$res_event['ue_event_name'].'</option>';
	 }
$str.='</select>';
return($str);
	
}
/*  Return  html code of question's answer format*/
function codeof_question_format($csq_type,$csq_choice_option,$selval='',$nameid,$viewmode='no')
{

	//if viewmode is yes...means we are showing view mode...so make disabled all property
	/*if($viewmode=='yes')
	{
		$disa_str=" disabled";
	}*/
	if($csq_choice_option!='')
	{
	$csq_choice_option=explode(",",$csq_choice_option);
	}
	
	switch($csq_type){
	case "textfield":
			$str_code="<input name=\"ans[$nameid]\" type=\"text\" class=\"txtfield\" value=\"$selval\" style=\"width:250px;\" $disa_str>";
			break;
	case "textarea":
			$str_code="<textarea name=\"ans[$nameid]\" cols=\"58\" rows=\"2\" class=\"txtfield\"  style=\"width:250px;\" $disa_str>$selval</textarea>";
			break;
	case "radio":
				$str_code="<table width=\"100%\">";
				if(is_array($csq_choice_option)){
						foreach($csq_choice_option as $value){
						$str_code.="<tr><td class=\"verdana11_white\"><input name=\"ans[$nameid]\" type=\"radio\" value=\"$value\" ";
						if($selval ==$value){
						$str_code.="checked";
						}	
						$str_code.=" $disa_str/>&nbsp;$value</td></tr>";
						}
				}
				$str_code.="</table>";
				break;
	case "checkbox":
				$str_code="<table width=\"100%\">";
				if($selval!='')
				{
				$arr_sel=explode(",",$selval);
				}
				if(is_array($csq_choice_option)){
						foreach($csq_choice_option as $value){
						$str_code.="<tr>
						<td class=\"verdana11_white\"><input name=\"ans[$nameid][]\" type=\"checkbox\" value=\"$value\"";
						if(is_array($arr_sel) && in_array($value,$arr_sel)){
						$str_code.="checked";
						}	
						$str_code.="  $disa_str/>&nbsp;$value</td></tr>";
						}
				}
				$str_code.="</table>";
				break;		
	 default: //used for both single choice & multiple chioce dropdown
				$str_code="<select name=\"ans[$nameid][]\" ";
				if($csq_type=="multiple choice dropdown"){
				$str_code.= " multiple ";
						if($selval!='')
						{
						$arr_sel=explode(",",$selval);
						}
				
				}
				$str_code.="class=\"txtfield\" $disa_str >";
				
				if(is_array($csq_choice_option)){
						foreach($csq_choice_option as $value){
				
						$str_code.="\n<option value=\"$value\"";
						if($csq_type=="multiple choice dropdown"){
								if(is_array($arr_sel) && in_array($value,$arr_sel)){
								$str_code.=" selected";
								}
						
						}
						else if ($selval==$value)
						{
								$str_code.=" selected";
						}
						
							$str_code.=" />$value</option>"."\n";
						}
				}
				$str_code.="</select>";
					
					
	}
	return($str_code);		
}

function showing_checked_currently_disciplines_of_athletes($dv_id,$discipline_id_name)
{

	$sql_discipline="select * from ss_discipline where dsp_sp_id='$dv_id' and dsp_status='Active' order by dsp_name";
	$row_discipline=db_query($sql_discipline);
	
	$var="<table width=\"90%\" align=\"center\" ><tr><th scope=\"col\" class=\"verdana10_white\">&nbsp;</th><th scope=\"col\" class=\"verdana10_white\">I Like</th><th scope=\"col\" class=\"verdana10_white\">I Do</th><th scope=\"col\" class=\"verdana10_white\">I Compete</th></tr>";
	while($res_discipline=mysql_fetch_array($row_discipline))
	{
	 $sql_usr_ans="select * from ss_athlete_sports where as_dsp_id='".$res_discipline['dsp_id']."' and as_user_id='".$_SESSION['sess_user_id']."'";
	$row_usr_ans=db_query($sql_usr_ans);
	$res_usr_ans=mysql_fetch_array($row_usr_ans);
		$ilike='';$ido='';$icompete='';
		if($res_usr_ans['as_involvement_like']=="yes")
		{
			$ilike="checked";
		}
		if($res_usr_ans['as_involvement_do']=="yes")
		{
			$ido="checked";
		}
		if($res_usr_ans['as_involvement_compete']=="yes")
		{
			$icompete="checked";
		}
		
	$var.='<tr><input type="hidden" name="as_dsp_id[]" value="'.$res_discipline['dsp_id'].'"><td class="verdana10_white">'.$res_discipline['dsp_name'].'</td><td align="center"><input type="checkbox" name="as_involvement_like['.$res_discipline['dsp_id'].']"'.$ilike.'  value="yes"></td><td  align="center"><input type="checkbox" name="as_involvement_do['.$res_discipline['dsp_id'].']"'.$ido.'  value="yes" ></td><td align="center"><input type="checkbox" name="as_involvement_compete['.$res_discipline['dsp_id'].']"'.$icompete.'  value="yes" ></td></tr>';
	}
	$var.="</table>";
	return($var);

}
function showing_checked_currently_disciplines_of_company($dv_id,$discipline_id_name)
{

	$sql_discipline="select * from ss_discipline where dsp_sp_id='$dv_id' and dsp_status='Active' order by dsp_name";
	$row_discipline=db_query($sql_discipline);
	
	$var="<table width=\"100%\"><tr><th scope=\"col\" class=\"verdana10_white\">&nbsp;</th><th scope=\"col\" class=\"verdana10_white\">Make Products</th><th scope=\"col\" class=\"verdana10_white\">Sell / Distribute Products</th><th scope=\"col\" class=\"verdana10_white\">Offer Services</th></tr>";
	while($res_discipline=mysql_fetch_array($row_discipline))
	{
	 $sql_usr_ans="select * from ss_company_sports where cs_dsp_id='".$res_discipline['dsp_id']."' and cs_user_id='".$_SESSION['sess_user_id']."'";
	$row_usr_ans=db_query($sql_usr_ans);
	$res_usr_ans=mysql_fetch_array($row_usr_ans);
		$make='';$sell='';$offer='';
		if($res_usr_ans['cs_make_products']=="yes")
		{
			$make="checked";
		}
		if($res_usr_ans['cs_sell_distribute_products']=="yes")
		{
			$sell="checked";
		}
		if($res_usr_ans['cs_offer_services']=="yes")
		{
			$offer="checked";
		}
		
	$var.='<tr><input type="hidden" name="cs_dsp_id[]" value="'.$res_discipline['dsp_id'].'"><td class="verdana10_white">'.$res_discipline['dsp_name'].'</td><td align="center"><input type="checkbox" name="cs_make_products['.$res_discipline['dsp_id'].']"'.$make.'  value="yes"></td><td  align="center"><input type="checkbox" name="cs_sell_distribute_products['.$res_discipline['dsp_id'].']"'.$sell.'  value="yes" ></td><td align="center"><input type="checkbox" name="cs_offer_services['.$res_discipline['dsp_id'].']"'.$offer.'  value="yes" ></td></tr>';
	}
	$var.="</table>";
	return($var);

}

function showing_checked_currently_disciplines_of_team($dv_id,$discipline_id_name)
{

	 $sql_discipline="select * from ss_discipline where dsp_sp_id='$dv_id' and dsp_status='Active' order by dsp_name";
	$row_discipline=db_query($sql_discipline);
	
	$var="<table width=\"100%\"><tr><th scope=\"col\" class=\"verdana10_white\">&nbsp;</th><th scope=\"col\" class=\"verdana10_white\">We Practice</th><th scope=\"col\" class=\"verdana10_white\">We Compete</th></tr>";
	while($res_discipline=mysql_fetch_array($row_discipline))
	{
	 $sql_usr_ans="select * from ss_team_sports where ts_dsp_id='".$res_discipline['dsp_id']."' and ts_user_id='".$_SESSION['sess_user_id']."'";
	$row_usr_ans=db_query($sql_usr_ans);
	$res_usr_ans=mysql_fetch_array($row_usr_ans);
		$weprac='';$wecompete='';
		if($res_usr_ans['ts_practice']=="yes")
		{
			$weprac="checked";
		}
		if($res_usr_ans['ts_compete']=="yes")
		{
			$wecompete="checked";
		}
		
	$var.='<tr><input type="hidden" name="ts_dsp_id[]" value="'.$res_discipline['dsp_id'].'"><td class="verdana10_white">'.$res_discipline['dsp_name'].'</td><td align="center"><input type="checkbox" name="ts_practice['.$res_discipline['dsp_id'].']"'.$weprac.'  value="yes"></td><td align="center"><input type="checkbox" name="ts_compete['.$res_discipline['dsp_id'].']"'.$wecompete.'  value="yes" ></td></tr>';
	}
	$var.="</table>";
	return($var);

}















/*function persons_age($BirthDate)
{
list($year, $month, $day) = split('[-.]', $BirthDate);
  $tmonth = date('n');
  $tday = date('j');
  $tyear = date('Y');
  $years = $tyear - $year;
  if ($tmonth <= $month)
  {
      if ($month == $tmonth)
      {
          if ($day > $tday)
              $years--;
      }
      else
          $years--;
  }
  
   $years;

} */
function reject_sponsorship_application($sr_id)
{
	db_query("update ss_sponsorship_requests set sr_status='rejected' where sr_id='$sr_id'");
	$_SESSION['sess_message']='You have rejected application successfully';
	header("location: spon_applications.php");
	exit;
}

function view_offer($uoc_id)
{
	$sql_view="select uoc_offer_text from ss_user_offers_contracts where uoc_id='$uoc_id'";		
	$row_view=db_query($sql_view);
	$res_view=mysql_fetch_assoc($row_view);
	$_SESSION['sess_message']=$res_view['uoc_offer_text'];
	header("location: message.php?msg_type=offer&uoc_id=$uoc_id");
	exit;
}

function view_contract($uoc_id)
{
	$sql_def="select uoc_contract_text,uoc_contract_pdf from ss_user_offers_contracts where uoc_id='$uoc_id'";	
	$row_def=db_query($sql_def);
	$res_def=mysql_fetch_array($row_def);
	@extract($res_def);
	if($uoc_contract_pdf!='')
	{
			header("location: uploaded_files/$uoc_contract_pdf");exit;
	}
	else
	{
			$_SESSION['sess_message']=$uoc_contract_text;header("location: message.php?msg_type=contract&uoc_id=$uoc_id");exit;
	}
}

 function accept_offer_by_user($uoc_id)
 {
 	$sql_off_user="update ss_user_offers_contracts set uoc_status='user_accepted' where uoc_id='$uoc_id'";
	db_query($sql_off_user);
	$_SESSION['sess_message']='Congratulation ! Offer has been sent to sponsor.You \'ll recieve an emailnotification after sponsor approv it';
	header("location: mem_pending_offers.php"); exit;
 
 }
function accept_offer_by_sponsor($uoc_id,$csu_sponsor_id,$csu_user_id,$csu_sr_id)
{
	
	$sql_off_spon="update ss_user_offers_contracts set uoc_status='spon_accepted' where uoc_id='$uoc_id'";
	//we'll think to delete it later
	db_query($sql_off_spon);
	//.........
	$sql_sp_rq="update ss_sponsorship_requests set sr_status='approved' where sr_id='$csu_sr_id' "; 
	db_query($sql_sp_rq);
	//-------------------------------------------//	
	$sql_spons="insert into ss_company_sponsored_users (csu_sponsor_id,csu_user_id,csu_sr_id) values('$csu_sponsor_id','$csu_user_id','$csu_sr_id')";
	db_query($sql_spons);
	$_SESSION['sess_message']='User has got your sponsorship.';
	//Send email notification to user
		  $arr_spon=get_fields_from_table_oneresult("ss_users","user_email,user_public_display_name"," user_id='$csu_sponsor_id'");
		   $arr_user=get_fields_from_table_oneresult("ss_users","user_email,user_public_display_name"," user_id='$csu_user_id'");
		   
		   $text= array("{name}" ,"{sponsor_name}" );
	 	  $value= array($arr_user['user_public_display_name'],$arr_spon['user_public_display_name']); 
		  $mail_text =readmyfile("includes/emails/sponsorship.txt"); 
	      $mail_body= str_replace($text,$value,$mail_text);
		  $email_body = nl2br($mail_body);
	      $headers = 'Content-type: text/html; charset=iso-8859-1' . "\n";
		  $headers .= 'From:'. SITE_NAME.'<'.ADMIN_EMAIL.'>' . "\n";
		 $message_title="congratulations! You have got sponsorship ";
		 /*if(!mail($arr_user['user_email'], $message_title, $email_body, $headers)){
		 echo "Problem while sending mail";
		 exit();
		 }
		*/
		@mail($arr_user['user_email'], $message_title, $email_body, $headers);
	//-----------------------------     ----------------------------   ---------------------//	
	header("location: spon_open_offers.php"); exit;
	
}

function get_offer_letter($name='offer_letter_name',$f)
{
	
	$sql_offer="select * from ss_cmp_offers_letters where col_id='$f'";
	$row_offer=db_query($sql_offer);
	$res_offer=mysql_fetch_array($row_offer);
	
	return($res_offer['col_offer_detail']);
} 
function get_contract_letter($name='contract_letter',$f)
{
	
	$sql_contract="select * from ss_cmp_contracts where cc_id='$f'";
	$row_contract=db_query($sql_contract);
	$res_contract=mysql_fetch_array($row_contract);
	
	if($res_contract['cc_contract_pdf']!='')
	{
		$cont_type="pdf";
		$var=$res_contract['cc_contract_pdf'];
		//$var.="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" aligned=\"center\"><tr><td><input type=\"radio\" name=\"user_contract_choice\"  value=\"pdf\" checked> </td><td class=\"verdana10_white\"> I want to use this PDF</td></tr><tr>   <td><input type=\"radio\" name=\"user_contract_choice\" value=\"mytext\"> </td><td class=\"verdana10_white\">I want to use my new written contract</td></tr></table>";
	}
	else{
	$cont_type="text";
	$var=$res_contract['cc_contracts'];
	}
	return($cont_type."||&&".$var);			//	'||&&' used for personal technical style.....nothing special...coding 
}

function get_spon_listings($us_id,$us_type)   //Getting sponsrohip listing matched with user's sports
{
	
	$sql_sl="select sl_id from ss_sponsorship_listing  inner join ss_company_sports on sl_user_id=cs_user_id ";
	if($us_type=='Athlete')
	{
	$sql_sl.=" inner join ss_athlete_sports on cs_dsp_id=as_dsp_id where as_user_id='$us_id' group by sl_id";
	}
	else if($us_type=='Team')
	{
	$sql_sl.=" inner join ss_team_sports on cs_dsp_id=ts_dsp_id where ts_user_id='$us_id' group by sl_id";
	}
	
	$quer_sl=db_query($sql_sl);
	$num_rec =mysql_num_rows($quer_sl);
	while($res_sl=mysql_fetch_array($quer_sl))
	{
			$sl_arr[]=$res_sl['sl_id'];
	}
	
	if(is_array($sl_arr))
	{	
	$str_sl_ids=implode(",",$sl_arr);
	}
	return($num_rec."&&".$str_sl_ids);	// Returning total no of sponsorship listing found and commasepered string of those
		

}

function get_total_new_listing($us_id,$us_type)
{
	$str_lst=get_spon_listings($us_id,$us_type);
	$arr_lst=explode("&&",$str_lst);
	
	if($arr_lst[0]==0)
	{
		return(0); 
	}
	$sql_cnt_list="select * from ss_sponsorship_listing where sl_id in (".$arr_lst[1].") and DATEDIFF(CURDATE(),sl_submit_date)<8";
	$quer_cnt_list=db_query($sql_cnt_list);
	return(mysql_num_rows($quer_cnt_list));
}


function ad($page,$count,$admin_view)
 {
  
  		$query="select * from ss_advertisements ad inner join ss_ads_to_pages atp on atp.atp_ad_id=ad.ad_id 
			where atp.atp_page_name='$page'  and ad_status='Active' order by rand() limit $count";
		if($admin_view!='')  //Page is used to show preview to administration.
		{
		$query="select * from ss_advertisements where ad_id='$admin_view'"; 
		}
//echo $query;
  $result=db_query($query);
  $count = mysql_num_rows($result);
  if($count > 0){
	  while($res=mysql_fetch_array($result))
	  { 
	  	if($res['ad_souce_code']!='')
	  	{
	   	$str=$res['ad_souce_code'];
	 	 }
	   else
	  	{
		  if($res['ad_href'])
		  {
			$str="<a href=".$res['ad_href']." target='_blank'><img src=".UP_FILES_WS_PATH.'/ads/'.$res['ad_image']."  border=0/></a>";
	       } 
		   else {
	  		$str="<img src=".UP_FILES_WS_PATH.'/ads/'.$res['ad_image']."  border=0/>";
	   		}
		} 
   	  $str2[]=$str;
	}
   return $str2;
 }
 return 0;
}

function getDateDifference($dateFrom, $dateTo, $unit = 'd') {
	$difference = null;
	$dateFromElements = split(' ', $dateFrom);
	$dateToElements = split(' ', $dateTo);
	$dateFromDateElements = split('-', $dateFromElements[0]);
	$dateFromTimeElements = split(':', $dateFromElements[1]);
	$dateToDateElements = split('-', $dateToElements[0]);
	$dateToTimeElements = split(':', $dateToElements[1]);
	// Get unix timestamp for both dates
	$date1 = mktime($dateFromTimeElements[0], $dateFromTimeElements[1], $dateFromTimeElements[2], $dateFromDateElements[1], $dateFromDateElements[0], $dateFromDateElements[2]);
	$date2 = mktime($dateToTimeElements[0], $dateToTimeElements[1], $dateToTimeElements[2], $dateToDateElements[1], $dateToDateElements[0], $dateToDateElements[2]);
	if( $date1 > $date2 )
	{
		return null;
	}
	$diff = $date2 - $date1;
	$days = 0;
	$hours = 0;
	$minutes = 0;
	$seconds = 0;
	if ($diff % 86400 <= 0)  // there are 86,400 seconds in a day
	{
		$days = $diff / 86400;
	}
	if($diff % 86400 > 0)
	{
		$rest = ($diff % 86400);
		$days = ($diff - $rest) / 86400;
		if( $rest % 3600 > 0 )
		{
			$rest1 = ($rest % 3600);
			$hours = ($rest - $rest1) / 3600;
			if( $rest1 % 60 > 0 )
			{
				$rest2 = ($rest1 % 60);
				$minutes = ($rest1 - $rest2) / 60;
				$seconds = $rest2;
			}
			else
			{
				$minutes = $rest1 / 60;
			}
		}
		else
		{
		$hours = $rest / 3600;
		}
	}
	switch($unit)
	{
	case 'd':
	case 'D':
		$partialDays = 0;
		$partialDays += ($seconds / 86400);
		$partialDays += ($minutes / 1440);
		$partialDays += ($hours / 24);
		$difference = $days + $partialDays;
		break;
	case 'h':
	case 'H':
		$partialHours = 0;
		$partialHours += ($seconds / 3600);
		$partialHours += ($minutes / 60);
		$difference = $hours + ($days * 24) + $partialHours;
		break;
	case 'm':
	case 'M':
		$partialMinutes = 0;
		$partialMinutes += ($seconds / 60);
		$difference = $minutes + ($days * 1440) + ($hours * 60) + $partialMinutes;
		break;
	case 's':
	case 'S':
		$difference = $seconds + ($days * 86400) + ($hours * 3600) + ($minutes * 60);
		break;
	case 'a':
	case 'A':
	$difference = array (
	"days" => $days,
	"hours" => $hours,
	"minutes" => $minutes,
	"seconds" => $seconds
	);
	break;
	}
	return $difference;
}



function cal_lastlogin($dateFrom){
//echo 'curdate='.$dateFrom;
#sb-- calculate login time in hrs and days   	
	#$dateFrom = "07-11-2006 06:00:00";
	// 60*60
	// 60*60*2*7
	if(strlen($dateFrom)>0)
	{
		$dateFrom = date("d-m-Y H:i:s",strtotime($dateFrom));
		$dateTo = date("d-m-Y H:i:s", strtotime('now'));
		$diffd = getDateDifference($dateFrom, $dateTo, 'd');
		$diffh = getDateDifference($dateFrom, $dateTo, 'h');
		$diffm = getDateDifference($dateFrom, $dateTo, 'm');
		$diffs = getDateDifference($dateFrom, $dateTo, 's');
		$diffa = getDateDifference($dateFrom, $dateTo, 'a');
		//echo 'diffd'.$diffd;
		if ($diffd <=1) {
			if ($diffh<=1) { $logintext = '<img src="images/onlinenow.gif">';} 
			else { 	$logintext = '<img src="images/offline.gif">';}
		} else {
			$logintext = '<img src="images/offline.gif">';	 
		}
	}
	else{
	$logintext = '<img src="images/offline.gif">';	 
	}
	return $logintext;
	/*
	echo 'Calculating difference between ' . $dateFrom . ' and ' . $dateTo . ' <br /><br />';
	echo $diffd . ' days.<br />';
	echo $diffh . ' hours.<br />';
	echo $diffm . ' minutes.<br />';
	echo $diffs . ' seconds.<br />';
	echo '<br />In other words, the difference is ' . $diffa['days'] . ' days, ' . $diffa['hours'] . ' hours, ' . $diffa['minutes'] . ' minutes and ' . $diffa['seconds'] . ' seconds.
	';
*/
}

function cal_age($DOB) { 
      $birth = explode("-", $DOB); 
         $age = date("Y") - $birth[0]; 
         if(($birth[1] > date("m")) || ($birth[1] == date("m") && date("d") < $birth[2])) { 
                $age -= 1; 
        } 
        return $age; 
}
function showing_checked_currently_disciplines_of_fan($dv_id,$discipline_id_name)
{

	$sql_discipline="select * from ss_discipline where dsp_sp_id='$dv_id' and dsp_status='Active' order by dsp_name";
	$row_discipline=db_query($sql_discipline);
	
	$var="<table width=\"90%\" align=\"center\" ><tr><th scope=\"col\" class=\"verdana10_white\">&nbsp;</th><th scope=\"col\" class=\"verdana10_white\">I Like</th><th scope=\"col\" class=\"verdana10_white\">I Do</th><th scope=\"col\" class=\"verdana10_white\">I Compete</th></tr>";
	while($res_discipline=mysql_fetch_array($row_discipline))
	{
	 $sql_usr_ans="select * from ss_fan_sports where fs_dsp_id='".$res_discipline['dsp_id']."' and fs_user_id='".$_SESSION['sess_user_id']."'";
	$row_usr_ans=db_query($sql_usr_ans);
	$res_usr_ans=mysql_fetch_array($row_usr_ans);
		$ilike='';$ido='';$icompete='';
		if($res_usr_ans['fs_involvement_like']=="yes")
		{
			$ilike="checked";
		}
		if($res_usr_ans['fs_involvement_do']=="yes")
		{
			$ido="checked";
		}
		if($res_usr_ans['fs_involvement_compete']=="yes")
		{
			$icompete="checked";
		}
		
	$var.='<tr><input type="hidden" name="fs_dsp_id[]" value="'.$res_discipline['dsp_id'].'"><td class="verdana10_white">'.$res_discipline['dsp_name'].'</td><td align="center"><input type="checkbox" name="fs_involvement_like['.$res_discipline['dsp_id'].']"'.$ilike.'  value="yes"></td><td  align="center"><input type="checkbox" name="fs_involvement_do['.$res_discipline['dsp_id'].']"'.$ido.'  value="yes" ></td><td align="center"><input type="checkbox" name="fs_involvement_compete['.$res_discipline['dsp_id'].']"'.$icompete.'  value="yes" ></td></tr>';
	}
	$var.="</table>";
	return($var);

}

function create_video_image($v_file,$flv_file,$img_name) {
	$o_file = UP_FILES_FS_PATH.'/video/flv/'.time().'.txt';
	$sv_length=get_video_length($v_file,$o_file);
	@unlink($o_file);
	$image_time=half_time($sv_length['length']);
	exec('ffmpeg -i "'.$v_file.'" -an -ss '.$image_time.' -an -r 1 -vframes 1 -y "'.SITE_FS_PATH.'/uploaded_files/video/flv/'.$img_name.'%d.jpg"');
	exec('mencoder "'.$v_file.'" -endpos '.$sv_length['length'].' -subcp cp1252 -vf harddup -ofps 25 -of lavf -lavfopts i_certify_that_my_video_stream_does_not_use_b_frames:format=flv -ovc lavc -lavcopts vcodec=flv:autoaspect:vbitrate=800 -af resample=44100:0:0 -oac mp3lame -lameopts vbr=2:q=6:highpassfreq=-1:lowpassfreq=-1 -o "'.$flv_file.'"');
}

function create_video_image_only($v_file,$flv_file,$img_name) {
	$o_file = UP_FILES_FS_PATH.'/video/flv/'.time().'.txt';
	$sv_length=get_video_length($v_file,$o_file);
	@unlink($o_file);
	$image_time=half_time($sv_length['length']);
	exec('ffmpeg -i "'.$v_file.'" -an -ss '.$image_time.' -an -r 1 -vframes 1 -y "'.SITE_FS_PATH.'/uploaded_files/video/flv/'.$img_name.'%d.jpg"');
	//exec('mencoder "'.$v_file.'" -endpos '.$sv_length['length'].' -subcp cp1252 -vf harddup -ofps 25 -of lavf -lavfopts i_certify_that_my_video_stream_does_not_use_b_frames:format=flv -ovc lavc -lavcopts vcodec=flv:autoaspect:vbitrate=800 -af resample=44100:0:0 -oac mp3lame -lameopts vbr=2:q=6:highpassfreq=-1:lowpassfreq=-1 -o "'.$flv_file.'"');
}
function half_time($length) {
	list($h, $i, $s)=explode(':',$length);
	$seconds=((intval($h)*60*60)+(intval($i)*60)+intval($s))/2; 
	$seconds = intval($seconds);
	$hour='00';
	$minutes='00';
	if($seconds>=10) {
		$secs='10';
	} else {
		$secs = str_pad($seconds, 2, "0", STR_PAD_LEFT);
	}
	$time = $hour.':'.$minutes.':'.$secs;
	return $time;
}
function get_video_length($v_file,$o_file) {
	$descriptorspec = array( 0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("file", $o_file, "w") ); 
	$cmd= 'ffmpeg -y -i "'.$v_file.'" ';
	$process = proc_open($cmd, $descriptorspec, $pipes); 
	if (is_resource($process)) {
	   fwrite($pipes[0], ""); 
	   fclose($pipes[0]); 
	   while(!feof($pipes[1])) { 
		   echo fgets($pipes[1], 1024); 
	   } 
	   fclose($pipes[1]); 
	   $return_value = proc_close($process); 
	   //echo "command returned: $return_value\n"; 
	}
	$values = array();
	$contents =file_get_contents($o_file);
	$pos = strpos($contents, 'Duration:');
	$substr=substr($contents, $pos);    
	$pos1 = strpos($substr, ',');
	$substr1=substr($substr, 0, $pos1);
	$pos2 = strpos($substr1, ' ');
	$substr2=substr($substr1, $pos2); //length
	$bp = strpos($substr, 'bitrate: ');
	$substr3=substr($substr, $bp);
	$bp1 = strpos($substr3, ' kb/s');
	$substr4=substr($substr3, 0, $bp1);
	$bp2 = strpos($substr4, ' ');
	$substr5=substr($substr4, $bp2); //bitrate
	$fp = strpos($substr3, ' fps(r)');
	$substr6=substr($substr3, 0,$fp);
	$substr7=substr($substr6, -5); //framerate
	$values['length'] = trim($substr2);
	$values['bitrate'] = trim($substr5);
	$values['framerate'] = trim($substr7);
	return $values;
}


function current_used_file_name($name_of_current_file) //Bcoz some url may be incoded according to .htaccess like sponsorspace/ath.profile.php may be seems as  sponsorspace/user_profile_display_name
{
	if($name_of_current_file=='') 
	{
	$name_of_current_file=str_replace(SITE_SUB_PATH.'/','', $_SERVER['SCRIPT_NAME']);
	}	
	return $name_of_current_file;
}

function user_checklist($check)
{
	//for email activation
	if($check == 'check_mail')
	{
	  if($_SESSION['sess_user_type'] == 'Athlete')
	 {
		 $sql_checklist=" update ss_athlete_checklist set ath_conf_email='Yes' where ath_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }
	 if($_SESSION['sess_user_type'] == 'Company')
	 {
		 $sql_checklist=" update ss_company_checklist set comp_conf_email='Yes' where comp_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }
	 
	  if($_SESSION['sess_user_type'] == 'Fan')
	 {
		 $sql_checklist=" update ss_fan_checklist set fan_conf_email='Yes' where fan_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }
	 
	 if($_SESSION['sess_user_type'] == 'Team')
	 {
		 $sql_checklist=" update ss_team_checklist set team_conf_email='Yes' where team_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }
	}

	//for edit about me section
	if($check == 'edit_about_me')
	{
		 if($_SESSION['sess_user_type'] == 'Athlete')
		 {
			 $sql_checklist=" update ss_athlete_checklist set ath_edit_me='Yes' where ath_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
		 if($_SESSION['sess_user_type'] == 'Company')
		 {
			 $sql_checklist=" update ss_company_checklist set comp_edit_me='Yes' where comp_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
		 if($_SESSION['sess_user_type'] == 'Fan')
		 {
			 $sql_checklist=" update ss_fan_checklist set fan_edit_me='Yes' where fan_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
		 if($_SESSION['sess_user_type'] == 'Team')
		 {
			$sql_checklist=" update ss_team_checklist set team_edit_me='Yes' where team_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }

	}
	
		//for edit about me section
	if($check == 'edit_general_info')
	{
	 if($_SESSION['sess_user_type'] == 'Athlete')
	 {
		 $sql_checklist=" update ss_athlete_checklist set ath_edit_gen='Yes' where ath_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }
	 if($_SESSION['sess_user_type'] == 'Company')
	 {
		 $sql_checklist=" update ss_company_checklist set comp_edit_gen='Yes' where comp_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }
	 
	if($_SESSION['sess_user_type'] == 'Fan')
	 {
		 $sql_checklist=" update ss_fan_checklist set fan_edit_gen='Yes' where fan_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }
	 	if($_SESSION['sess_user_type'] == 'Team')
	 {
		 $sql_checklist=" update ss_team_checklist set team_edit_gen='Yes' where team_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }

	}
	
		//for edit about me section
	if($check == 'upload_video')
	{
	 if($_SESSION['sess_user_type'] == 'Athlete')
	 {
		$sql_checklist=" update ss_athlete_checklist set ath_video='Yes' where ath_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }
	if($_SESSION['sess_user_type'] == 'Company')
	 {
		 $sql_checklist=" update ss_company_checklist set comp_video='Yes' where comp_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }
	 	 if($_SESSION['sess_user_type'] == 'Fan')
	 {
	 	 $sql_checklist=" update ss_fan_checklist set fan_video='Yes' where fan_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }
	 if($_SESSION['sess_user_type'] == 'Team')
	 {
	 	 $sql_checklist=" update ss_team_checklist set team_video='Yes' where team_user_id =".$_SESSION['sess_user_id'];
		 db_query($sql_checklist);
	 }

	}
	
		//for edit about me section
	if($check == 'upload_photo')
	{
				if($_SESSION['sess_user_type'] == 'Athlete')
				{
				$sql_checklist=" update ss_athlete_checklist set ath_photo='Yes' where ath_user_id =".$_SESSION['sess_user_id'];
				db_query($sql_checklist);
				}
				if($_SESSION['sess_user_type'] == 'Company')
				{
				 $sql_checklist=" update ss_company_checklist set comp_photo='Yes' where comp_user_id =".$_SESSION['sess_user_id'];
				 db_query($sql_checklist);
				}
				if($_SESSION['sess_user_type'] == 'Fan')
				{
				 $sql_checklist=" update ss_fan_checklist set fan_photo='Yes' where fan_user_id =".$_SESSION['sess_user_id'];
				 db_query($sql_checklist);
				}
				if($_SESSION['sess_user_type'] == 'Team')
				{
				 $sql_checklist=" update ss_team_checklist set team_photo='Yes' where team_user_id =".$_SESSION['sess_user_id'];
				 db_query($sql_checklist);
				}

	}
	
		//for edit about me section
	if($check == 'add_place')
	{
		if($_SESSION['sess_user_type'] == 'Athlete')
		{
			$sql_checklist=" update ss_athlete_checklist set ath_place='Yes' where ath_user_id =".$_SESSION['sess_user_id'];
			db_query($sql_checklist);
		}
		if($_SESSION['sess_user_type'] == 'Company')
		{
			 $sql_checklist=" update ss_company_checklist set comp_place='Yes' where comp_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		}
		if($_SESSION['sess_user_type'] == 'Fan')
		{
			 $sql_checklist=" update ss_fan_checklist set fan_place='Yes' where fan_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		}
		if($_SESSION['sess_user_type'] == 'Team')
		 {
			 $sql_checklist=" update ss_team_checklist set team_place='Yes' where team_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }

	}
	
		//for edit about me section
	if($check == 'edit_tag')
	{
		 if($_SESSION['sess_user_type'] == 'Athlete')
		 {
			 $sql_checklist=" update ss_athlete_checklist set ath_tag_video='Yes' where ath_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
		  if($_SESSION['sess_user_type'] == 'Fan')
		 {
			 $sql_checklist=" update ss_fan_checklist set fan_tag_video='Yes' where fan_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
		 if($_SESSION['sess_user_type'] == 'Team')
		 {
			 $sql_checklist=" update ss_team_checklist set team_tag_video='Yes' where team_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
	}
	
		//for edit about me section
	if($check == 'add_equipment')
	{
		 if($_SESSION['sess_user_type'] == 'Athlete')
		 {
			 $sql_checklist=" update ss_athlete_checklist set ath_equip='Yes' where ath_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
		 if($_SESSION['sess_user_type'] == 'Fan')
		 {
			 $sql_checklist=" update ss_fan_checklist set fan_equip='Yes' where fan_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
		 
		 if($_SESSION['sess_user_type'] == 'Team')
		 {
			 $sql_checklist=" update ss_team_checklist set team_equip='Yes' where team_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
	
	}
	
		//for edit about me section
	if($check == 'add_fri')
	{
		 if($_SESSION['sess_user_type'] == 'Athlete')
		 {
			 $sql_checklist=" update ss_athlete_checklist set ath_invite='Yes' where ath_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
		 if($_SESSION['sess_user_type'] == 'Fan')
		 {
			 $sql_checklist=" update ss_fan_checklist set fan_invite='Yes' where fan_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
		 if($_SESSION['sess_user_type'] == 'Team')
		 {
			 $sql_checklist=" update ss_team_checklist set team_invite='Yes' where team_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
		 

	}
	
	//for manage question for company
	if($check == 'question')
	{	
		 if($_SESSION['sess_user_type'] == 'Company')
		 {
			 $sql_checklist=" update ss_company_checklist set comp_ques='Yes' where comp_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
	}
	//for manage forms for company
	if($check == 'forms')
	{	
		 if($_SESSION['sess_user_type'] == 'Company')
		 {
			 $sql_checklist=" update ss_company_checklist set comp_forms='Yes' where comp_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
	}
		//for manage offer letters for company
	if($check == 'offers')
	{	
		 if($_SESSION['sess_user_type'] == 'Company')
		 {
			 $sql_checklist=" update ss_company_checklist set comp_letter_offer='Yes' where comp_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
	}
	
	//for manage contract for company
	if($check == 'contract')
	{	
		 if($_SESSION['sess_user_type'] == 'Company')
		 {
			 $sql_checklist=" update ss_company_checklist set comp_contract='Yes' where comp_user_id =".$_SESSION['sess_user_id'];
			 db_query($sql_checklist);
		 }
	}

		//for manage sponsor for company
		if($check == 'sponsor')
		{
			
		if($_SESSION['sess_user_type'] == 'Company')
		{
		$sql_checklist=" update ss_company_checklist set comp_app_sponsor='Yes' where comp_user_id =".$_SESSION['sess_user_id'];
		db_query($sql_checklist);
		}
		}
	
		//for add a member to team section
	if($check == 'add_team')
	{
		if($_SESSION['sess_user_type'] == 'Athlete')
		{
			$sql_checklist=" update ss_athlete_checklist set ath_add_team='Yes' where ath_user_id =".$_SESSION['sess_user_id'];
			db_query($sql_checklist);
		}
	}
 
}

function delete_category($catids)
{  
	$sql_forum_ids="select * from ss_forum where forum_catid in ($catids)";
	$rs_form_ids=db_query($sql_forum_ids);
	while($forum_ids=mysql_fetch_array($rs_form_ids))
	{
	     $sql_del_forum="delete  from ss_forum where forum_id='$forum_ids[forum_id]'";
		 db_query($sql_del_forum);
		 $sql_comments="select * from ss_forum_comment where forum_com_forumid='$forum_ids[forum_id]'";
		 $rs_comments=db_query($sql_comments);
		 while($comments=mysql_fetch_array($rs_comments))
		 {
		    $sql_del_comm="delete from ss_forum_comment where forum_com_forumid='$comments[forum_com_id]'";
			db_query($sql_del_comm);
		 }
	}

}

?>