<?php
#function to delete a team are panding

function delete_vedio($uv_id, $user_id) {
	if ($uv_id != '') {
		$sql = " uv_id in ($uv_id)";
	}
	elseif($user_id != '') {
		$sql = " uv_user_id in ($user_id)";
	}
	$db = db_query("select * from ss_user_video where $sql");
	
	while ($rs = mysql_fetch_array($db)) {
		$vc_uv_id_ar[] =  $rs['uv_id'];
		@unlink(UP_FILES_FS_PATH."/video/".$rs['uv_path']);
		@unlink(UP_FILES_FS_PATH."/video/flv/".$rs['uv_path']);
		@unlink(UP_FILES_FS_PATH."/video/flv/".$rs['uv_refer_photo']);
		#@unlink (UP_FILES_FS_PATH."/".$rs['uv_refer_photo']);
	
	}
	if (is_array($vc_uv_id_ar)) {
		
		$vc_uv_id = implode(",", $vc_uv_id_ar);
		delete_vedio_comment("", $vc_uv_id, ""); #deleting vedio comments on that vedio
		delete_vedio_rating ("", $vc_uv_id, "");
		delete_video_tags("", "", $vc_uv_id);
	}
	
	db_query ("delete from ss_user_video where $sql ");
	
}

function delete_vedio_rating ($vr_id, $vr_uv_id, $vr_user_id) {
	if ($vr_id != '') {
		$sql = " vr_id in ($vr_id)";
	}
	elseif ($vr_uv_id != '') {
		$sql = " vr_uv_id in ($vr_uv_id) ";	
	}
	elseif ($vr_user_id != '') {
		$sql = " vr_user_id in ($vr_user_id)";
	}
	db_query ("delete from ss_video_rating where $sql ");


}
function delete_vedio_comment($vc_id, $vc_uv_id, $vc_user_id) {
	
	if ($vc_id != '') {
		$sql = " vc_id='$vc_id' "; 
	}
	elseif ($vc_uv_id !='') {
		$sql = " vc_uv_id in ($vc_uv_id) ";
		
	}
	elseif ($vc_user_id != '') {
		$sql = " vc_user_id in ($vc_user_id) ";
	
	}
	
	db_query("delete from ss_video_comments where $sql");

}


function delete_photo($up_id, $up_user_id) {

	if ($up_id != '') {
		$sql = " up_id in ($up_id)";
	}
	elseif($up_user_id != '') {
		$sql = " up_user_id in ($up_user_id)";
	}
	$db = db_query("select * from ss_user_photos where $sql ");
	while ($rs = mysql_fetch_array($db)) {
		$up_id_ar[] = $rs['up_id']; 
		@unlink(UP_FILES_FS_PATH."/".$rs['up_photo_name']);
	}
	if (is_array($up_id_ar)) {
		$up_ids = implode(",", $up_id_ar);
		delete_photo_comment("", $up_ids, "");
		delete_photo_rating ("", $up_ids, "");
	}
	
	db_query ("delete from ss_user_photos where $sql ");

}

function delete_photo_comment($pc_id, $pc_up_id, $pc_user_id) {
	if ($pc_id != '') {
		$sql = " pc_id in ($pc_id)";
	}
	elseif ($pc_up_id !='') {
		$sql = " pc_up_id in ($pc_up_id) ";
	}
	elseif ($pc_user_id != '') {
		$sql = " pc_user_id in ($pc_user_id)";
	
	}	
	db_query ("delete from ss_photo_comments where $sql ");

}

function delete_photo_rating ($pr_id, $pr_up_id, $pr_user_id) {
	if ($pr_id != '') {
		$sql = " pr_id in ($pr_id)";
	}
	elseif ($pr_up_id != '') {
		$sql = " pr_up_id in ($pr_up_id) ";	
	
	}
	elseif ($pr_user_id != '') {
		$sql = " pr_user_id in ($pr_user_id) ";	
	}
	db_query (" delete from ss_photo_rating where $sql ");


}

function delete_blog ($ub_id, $ub_user_id) {
	if ($ub_id != '') {
		$sql = " ub_id in ($ub_id)";
	}
	elseif($ub_user_id != '') {
		$sql = " ub_user_id in ($ub_user_id) ";
	}
	$db = db_query("select * from ss_user_blog where $sql");
	while ($rs = mysql_fetch_array($db)){
		$ub_id_ar[]=$rs['ub_id'];
	}
	if (is_array($ub_id_ar)) {
		$ub_id = implode(",", $ub_id_ar); 
		delete_blog_comment ("", "", $ub_user_id);
		delete_blog_comment ("", $ub_id, "");
	}
	
	db_query ("delete from ss_user_blog where $sql ");
}

function delete_blog_comment ($bc_id, $bc_ub_id, $bc_user_id) {

	if ($bc_id != '') {
		$sql = " bc_id in ($bc_id)";
	}
	elseif ($bc_ub_id != '') {
		$sql = " bc_ub_id in ($bc_ub_id) ";
	}
	elseif($bc_user_id != '') {
		$sql = " bc_user_id in ($bc_user_id) ";
	}
	db_query("delete from ss_blog_comments where $sql");
}

function delete_aboutme_answer($abt_id, $abt_abtque_id, $abt_user_id) {
	if ($abt_id != '') {
		$sql  = " abt_id in ($abt_id) ";
	}
	elseif ($abt_abtque_id != '') {
		$sql = " abt_abtque_id in ($abt_abtque_id) ";
	}
	elseif ($abt_user_id != '') {
		$sql = " abt_user_id in ($abt_user_id) ";
	}
	db_query("delete from ss_aboutme_answers where $sql ");
	return;
}

function delete_favorite_answer ($user_id) {
	db_query("delete from ss_user_favorite_answer where fvtans_user_id in ($user_id)");
	return;
}

#pass the table name and where clause to delte sports for a perticular user
function delete_sport ($table, $where_clause) {
	db_query ("delete from $table where $where_clause ");
	return;
}

function delete_block_user($bu_id, $user_id) {

	if ($bu_id != '') {
		$sql = " bu_id in ($bu_id) ";
	}
	elseif ($user_id != '') {
		$sql = " bu_blockto_id in ($user_id) or bu_blockfrom_id in ($user_id)";
	}
	db_query ("delete from ss_block_user where $sql ");
	return;
}

function delete_comp_offer_letter ($col_id, $col_user_id) {
	if ($col_id != '') {
		$sql = " col_id in ($col_id)";
	}
	elseif ($col_user_id != '') {
		$sql = "col_user_id in ($col_user_id)";
	}
	db_query ("delete from ss_cmp_offers_letters where $sql");	
	return;
}


function delete_cust_theme ($ct_id, $ct_user_id) {
	if ($ct_id != '') {
		$sql = " ct_id in ($ct_id) ";
	}
	elseif ($ct_user_id != '') {
		$sql = " ct_user_id in ($ct_user_id) ";
	}
	$image_qur = db_query("select background_body_image from ss_customize_theme where $sql"); 
	while ($image = mysql_fetch_array($image_qur)) {
		@unlink(UP_FILES_FS_PATH."/".$image['background_body_image']);	
	}
	db_query ("delete from ss_customize_theme where $sql");
	return;
}

function delete_event($ue_id, $ue_user_id) {
	if ($ue_id != '') {
		$sql = " ue_id in ($ue_id) ";
		delete_event_comment($ue_id,"");
		delete_favorire_event ($ue_id, "");
	}
	elseif ($ue_user_id != '') {
		$sql = " ue_user_id in ($ue_user_id) ";
		#Getting all event id to delete comments on users event
		$db = db_query ("select * from ss_user_events where $sql ");
		while ($rs = mysql_fetch_array($db)) {
			$ue_id_ar[] = $rs['ue_id'];
		}
		if (is_array($ue_id_ar)) {
			$ue_id = implode(",", $ue_id_ar);	
			delete_result ("", "", $ue_id, "");
			delete_event_comment($ue_id,"");
			delete_event_comment("",$ue_user_id);
			delete_favorire_event ($ue_id, "");
			delete_favorire_event ("", $ue_user_id);
		}
		
	}
	db_query ("delete from ss_user_events where $sql");
	return;
}

function delete_result ($ur_id, $ur_dsp_id, $ur_ue_id, $ur_user_id) {
	if ($ur_id != '') {
		$sql = " ur_id in ($ur_id)";
	}
	elseif ($ur_dsp_id != '') {
		$sql = " ur_dsp_id in ($ur_dsp_id)";
	}
	elseif ($ur_ue_id != '') {
		$sql = "ur_ue_id in ($ur_ue_id)";
	}
	elseif ($ur_user_id != '') {
		$sql = "ur_user_id in ($ur_user_id)";
	}
	db_query ("delete from ss_user_results where $sql ");
	return;
}

function delete_event_comment($ec_ue_id,$ec_user_id) {
	if ($ec_ue_id != '') {
		$sql = " ec_ue_id in ($ec_ue_id) ";
	}
	elseif ($ec_user_id != '') {
		$sql = " ec_user_id in ($ec_user_id) ";
	}
	db_query ("delete from ss_event_comments where $sql "); 
	
}

function delete_favorire_event ($fe_ue_id, $fe_user_id) {
	if ($fe_user_id != '') {
		$sql = " fe_user_id in ($fe_user_id) ";
	}
	elseif ($fe_ue_id != '') {
		$sql = " fe_ue_id in ($fe_ue_id) ";
	}
	db_query ("delete from ss_favorite_events where $sql ");
	

}

function delete_watchlist ($uw_id, $uw_user_id) {
	if ($uw_id != '') {
		$sql = " uw_id in ($uw_id)";
	}
	elseif ($uw_user_id != '') {
		$sql = " uw_user_id in ($uw_user_id) ";
	
	}
	db_query ("delete from ss_user_watchlists where $sql ");
	
}

function delete_extr_sec_pages ($psm_user_id) {
	db_query ("delete from ss_extra_sections_onpage where psm_user_id in ($psm_user_id)");

}


function delete_mail($user_id) {
	db_query ("delete from ss_mail_recieved where mr_sender_user_id in ($user_id) or mr_reciever_user_id in ($user_id)");
	db_query ("delete from ss_mail_sent where ms_sender_user_id in ($user_id) or ms_reciever_user_id in ($user_id)");
}

function delete_place ($uplc_id, $uplc_user_id) {
	if ($uplc_id != '') {
		$sql = " uplc_id in ($uplc_id)";
		delete_place_comment("",$uplc_id, "");
		
	}
	elseif ($uplc_user_id != '') {
		$sql = " uplc_user_id in ($uplc_user_id) ";
		$db = db_query ("select * from ss_user_places where uplc_user_id in ($uplc_user_id) ");
		while ($rs = mysql_fetch_array($db)) {
			$uplc_id_ar[] = $rs['uplc_id'];
		}
		if(is_array($uplc_id_ar)) {
			$uplc_id = implode(",", $uplc_id_ar);
			delete_place_comment("",$uplc_id, "");
			delete_place_comment("","", $uplc_user_id);
		} 
	}
	db_query ("delete from ss_user_places where $sql");

}

function  delete_place_comment($pc_id, $pc_uplc_id, $pc_user_id) {
	if ($pc_id != '') {
		$sql = " pc_id in ($pc_id) ";
	}
	elseif ($pc_uplc_id != '') {
		$sql = " pc_uplc_id in ($pc_uplc_id) ";
	}
	elseif ($pc_user_id != '') {
		$sql = " pc_user_id in ($pc_user_id)";
	}
	db_query ("delete from ss_place_comments where $sql ");
}



function delete_favorite_palce($fp_uplc_id, $fp_user_id) {
	if ($fp_uplc_id != '') {
		$sql = " fp_uplc_id in ($fp_uplc_id)";
	}
	elseif ($fp_user_id != '') {
		$sql = " fp_user_id in ($fp_user_id) ";
	} 
	db_query ("delete from ss_favorite_places where $sql ");

}

function delete_profile_comment($pc_id, $user_id){
	if ($pc_id != '') {
		$sql = " pc_id in ($pc_id) ";
	}
	elseif ($user_id != '') {
		$sql = " pc_commenton_id in ($user_id) or pc_commentby_id in ($user_id) ";
	}
	db_query ("delete from ss_profile_comments where $sql ");

}

function delete_profile_rating ($pfrt_id, $user_id) {
	if ($pfrt_id != '') {
		$sql = " pfrt_id in ($pfrt_id)";
	}
	elseif ($user_id != '') {
		$sql = " pfrt_ratingon_id in ($user_id) or pfrt_ratingby_id in ($user_id)";
	}
	db_query (" delete from ss_profile_rating where $sql ");
	
}

function delete_profile_css ($pc_id, $pc_user_id) {

	if ($pc_id != '') {
		$sql = " pc_id in ($pc_id) ";
	}
	elseif ($pc_user_id != '') {
		$sql = " pc_user_id in ($pc_user_id)";
	}
	db_query ("delete from ss_profile_css where $sql ");

}

function delete_report_abuse ($re_id, $re_user_id) {
	if ($re_id != '') {
		$sql = " re_id in ($re_id)";
	}
	elseif ($re_user_id != '') {
		$sql = " re_user_id in ($re_user_id)";
	}
	db_query ("delete from ss_report_abuse where $sql ");
	

}

function delete_comp_sponsered_user ($csu_id, $csu_sr_id, $user_id) {
	if ($csu_id != '') {
		$sql = " csu_id in ($csu_id)";
	}
	elseif ($user_id != '') {
		$sql = " csu_user_id in ($user_id) or csu_sponsor_id in ($user_id)";
	}
	elseif ($csu_sr_id != '') {
		$sql = " csu_sr_id in ($csu_sr_id)";
	}
	db_query ("delete from ss_company_sponsored_users where $sql");
	
}

function delete_sponsership_listing ($sl_id, $sl_user_id) {
	if ($sl_id != '') {
		$sql = " sl_id in ($sl_id)";
	}
	elseif ($sl_user_id != '') {
		$sql = " sl_user_id in ($sl_user_id)";
	}
	db_query ("delete from ss_sponsorship_listing where $sql");

}


function delete_sponsorship_request($sr_id, $sr_sl_id, $user_id) {
	if ($sr_id != '') {
		$sql = " sr_id in ($sr_id)";
	}
	elseif ($sr_sl_id != '') {
		$sql = " sr_sl_id in ($sr_sl_id)";
	}
	elseif ($user_id != '') {
		$sql = " sr_sponsor_id in ($user_id) or sr_user_id in ($user_id)";
	}
	$db = db_query ("select * from ss_sponsorship_requests where $sql");
	while ($rs = mysql_fetch_array($db)) {
		$sr_id_ar[] = $rs['sr_id'];
	}
	if (is_array($sr_id_ar)) {
		$sr_id_str = implode(",", $sr_id_ar);
		delete_comp_sponsered_user ("", $sr_id_str, "");
		delete_further_request_question ("", $sr_id_str);
		delete_question_used_in_request ("", $sr_id_str);
		#New Function
		delete_offer_contract('',$sr_id_str);
	}
	db_query ("delete from ss_sponsorship_requests where $sql");
	return;
}
function delete_offer_contract($uoc_id, $uoc_sr_id){
	if ($uoc_id  != '') {
		$sql=" uoc_id in ($uoc_id) ";
	}
	elseif($uoc_sr_id != '') {
		$sql=" uoc_sr_id in ($uoc_sr_id) ";
	}
	$db = db_query("select uoc_contract_pdf from ss_user_offers_contracts where $sql");
	while ($rs = mysql_fetch_array($db)){
		if ($uoc_contract_pdf != '' && file_exists($uoc_contract_pdf)) {
			unlink(UP_FILES_FS_PATH.'/'.$rs['uoc_contract_pdf']);
		}
	}	
	db_query("delete from ss_user_offers_contracts where $sql");
	return;
}

function delete_further_request_question ($cfaq_id, $cfaq_sr_id) {
	if ($cfaq_id != '' ) {
		$sql = "cfaq_id in ($cfaq_id)";
	}
	elseif ($cfaq_sr_id != '') {
		$sql = " cfaq_sr_id in ($cfaq_sr_id)";
	}
	db_query ("delete from ss_cmp_further_asked_questions where $sql");
	return;
}

function delete_question_used_in_request ($qur_id, $quer_sr_id) {
	if ($qur_id != '') {
		$sql = "qur_id in ($qur_id)";
	}
	elseif ($quer_sr_id != '') {
		$sql = "quer_sr_id in ($quer_sr_id)";
		$db = db_query("select * from ss_cmp_question_usedin_request where quer_sr_id in ($quer_sr_id) ");
		if (mysql_num_rows($db)>0){
			while ($rs = mysql_fetch_array($db)) {
				$qur_id_ar[]=$rs['qur_id'];
			}
			$qur_id_str = implode(",", $qur_id_ar);
			db_query("delete from ss_answer_of_question where aoq_qur_id in ($qur_id_str)");
		}
	}
	
	db_query ("delete from ss_cmp_question_usedin_request where $sql");
	return;
}
function delete_comp_sample_question ($csq_id, $csq_user_id) {
	if ($csq_id != '') {
		$sql = " csq_id in ($csq_id)";
	}
	elseif ($csq_user_id != '') {
		$sql = "csq_user_id in ($csq_user_id)";
	}
	db_query ("delete from ss_company_sample_questions where $sql");
	return;
} 

function delete_comp_app_form ($apfrm_id, $apfrm_user_id) {
	if($apfrm_id != '') {
		$sql = "apfrm_id in ($$apfrm_id)";
	}
	elseif ($apfrm_user_id != '') {
		$sql = " apfrm_user_id in ($apfrm_user_id)";
	}
	db_query ("delete from ss_cmp_app_forms where $sql");
	return;
}

function delete_comp_contract ($cc_id, $cc_user_id) {
	if ($cc_id != '') {
		$sql = " cc_id in ($cc_id)";
	}
	elseif ($cc_user_id != '') {
		$sql = " cc_user_id in ($cc_user_id) ";
	}
	db_query (" delete from ss_cmp_contracts where $sql");
	return;
}

function delete_user_friend ($uf_id, $user_id) {
	if ($uf_id != '') {
		$sql = "uf_id in ($uf_id)";
	}
	elseif ($user_id != '') {
		$sql = "uf_friend_user_id in ($user_id) or uf_friendof_user_id in ($user_id)";
	}
	db_query ("delete from ss_user_friends where $sql");
	return;
}

function delete_user_offer_contract ($uoc_id, $uoc_sr_id) {
	if ($uoc_id != '') {
		$sql = "uoc_id in ($uoc_id)";
	}
	elseif ($uoc_sr_id != '') {
		$sql = "uoc_sr_id in ($uoc_sr_id)";
	}
	db_query ("delete from ss_user_offers_contracts where $sql");
	return;

}

function delete_sanctioner_discipline ($sd_id, $sd_user_id) {
	if ($sd_id != '') {
		$sql = " sd_id in ($sd_id)";
	}
	elseif ($sd_user_id != '') {
		$sql = " sd_user_id in ($sd_user_id) ";
	}
	
	db_query("delete from ss_sanctioner_discipline where $sql ");
	return;
}

function delete_team_sport($ts_id, $ts_user_id, $ts_sc_id, $ts_sp_id, $ts_dsp_id) {
	if ($ts_id != '') {
		$sql = " ts_id in ($ts_id) ";
	}
	elseif ($ts_user_id != '') {
		$sql = " ts_user_id in ($ts_user_id)";
	
	}
	elseif ($ts_sc_id != '') {
		$sql = " ts_sc_id in ($ts_sc_id)";
	
	}
	elseif ($ts_sp_id != '') {
		$sql = " ts_sp_id in ($ts_sp_id)";
	
	}
	elseif ($ts_dsp_id != '') {
		$sql = " ts_dsp_id in ($ts_dsp_id)";
	
	}
	db_query ("delete from ss_team_sports where $sql ");
	return;

}
#this function is used to delete both team or team member
function delete_team_member($tm_id, $user_id) {
	if ($tm_id != '') {
		$sql = " tm_id in ($tm_id) ";
	}
	elseif ($user_id != '') {
		$sql = " tm_member_user_id in ($user_id) or tm_team_user_id in ($user_id) ";
	}
	db_query ("delete from ss_team_members where $sql ");	
	return;
}
function delete_declined_request($dr_id, $dr_user_id){
	if ($dr_id != '') {
		$sql = " dr_id in ($dr_id)";
	}
	elseif($dr_user_id != ''){
		$sql = " dr_user_id in ($dr_user_id) or dr_sponsor_id in ($dr_user_id)";
	}
	db_query("delete from ss_declined_request where $sql ");
	return;	
}

function delete_video_tags($pk_tag_id, $tag_user_id, $tag_video_id){
	if ($pk_tag_id != '') {
		$sql = " pk_tag_id in ($pk_tag_id) ";
	}
	elseif ($tag_user_id != '') {
		$sql = " tag_user_id in ($tag_user_id)";
	}
	elseif($tag_video_id != ''){
		$sql = " tag_video_id in ($tag_video_id)";
	}
	db_query("delete from ss_video_tags where $sql ");
	return;
}






?>