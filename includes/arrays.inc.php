<?php
$ARR_VALID_IMG_EXTS = array('jpg', 'jpeg', 'jpe', 'gif', 'png', 'bmp');

$ARR_WEEK_DAYS = array(
'mon' => 'Monday',
'tue' => 'Tuesday',
'wed' => 'Wednesday',
'thu' => 'Thursday',
'fri' => 'Friday',
'sat' => 'Saturday',
'sun' => 'Sunday'
);

$ARR_MONTHS = Array('01'=>'Jan' , '02'=>'Feb' , '03'=>'Mar' , '04'=>'Apr' , '05'=>'May' , '06'=>'Jun' , '07'=>'Jul' , '08'=>'Aug' , '09'=>'Sep' , '10'=>'Oct' , '11'=>'Nov' , '12'=>'Dec');

if ($handle = opendir(dirname(__FILE__).'/db_arrays')) { 
	while (false !== ($file = readdir($handle))) { 
		if ($file != "." && $file != "..") { 
			include(dirname(__FILE__).'/db_arrays/'.$file);
		} 
	} 
   closedir($handle); 
} 
$arr_message=array(
'featu'=>'Records are featured successfully',
'unfeatu'=>'Records are unfeatured successfully',
'fe_in'=>'This event has been added in event list',
'fp_in'=>'This place has been added in place list',
'nfe_in'=>'This event has already been added to your favorite event list ',
'nfp_in'=>'This place has already been added to your favorite place list ',
'vn_rate'=>'you can not rate your videos',
'vrate_in'=>'you have rated this video successfully',
'vrate_up'=>'you have  changed your rate on  this video successfully',
'pn_rate'=>'you can not rate your photos',
'prate_in'=>'you have rated this photo successfully',
'prate_up'=>'you have  changed your rate on  this photo successfully',
'n_user_mail'=>'Registration Notification mail has been sended',
'n_e'=>'This event name is already exist',
'e_in'=>'New event has been added sucessfully',
'n_p'=>'Place name is already exist',
'n_rate'=>'you can not rate your profile',
'rate_in'=>'you have rated this profile successfully',
'rate_up'=>'you have  changed your rate on  this profile successfully',
'ath_in'=>'New  has been inserted',
'ath_up'=>'Record has been updated ',
'rec_in'=>'Record inserted successfully',
'no_record'=>'No records found',
'del_record'=>'Records are deleted successfully',
'invalid_user'=>'Invalid user email or password, or<br>your account is inactive currently',
'sp_cat_exist'=>'Sorry, Sport category exist already',
'email_exist'=>'Sorry, Email address exist already',
'verf_code_error'=>'Sorry, Verification code does not match',
'public_name_exist'=>'Sorry, Public name already exist',
'dsp_exist' => 'Sorry, discipline exist already',
'sp_sc_dsp_exist'=>'Sorry, you already added this combination of sport & category',
'invalid_email'=>'Invalid user email',
'forgot_password'=>'An email has been sent to your email<br>address with your user name and password',
'sp_equip_added'=>'Equipment is added successfully',
'sport_dis_del_succ'=>'Sports-discipline deleted successfully',
'info_sav_succ'=>'Information saved successfully',
'no_res'=>'No result found by your search criteria, Select different search criteria',
'fan_self'=>'You can\'t add yourself as a friend.', 
'team_self'=>'Hey; you are already in your team', 
'block_mess'=>'Sorry, you are blocked by this user',
'block_succ'=>'You have blocked user successfully',
'unblock_succ'=>'You have unblocked user successfully',
'team_mem_request'=>'Team member request is sent successfully',
'friendship_request'=>'Friendship request is sent successfully',
'team_accept'=>'Team membership is accepted successfully',
'friendship_accept'=>'Friendship request is accepted successfully',
'team_decline'=>'Team member request is declined successfully',
'friendship_decline'=>'Friendship request is declined successfully',
'message_sent'=>'Your message has been sent successfully',
'not_friend'=>'Only friends can send messages to each other, you are not friend of this user',
'message_delete'=>'Messages deleted successfully',
'comment'=>'Your comment has been sent',
'result_up'=>'Result is updated successfully',
'result_del'=>'Result is deleted successfully',
'cmt_act'=>'Comments have been activated successfully',
'cmt_inact'=>'Comments have been inactivated successfully',
'rec_acti'=>'Records are activated successfully',
'rec_deact'=>'Records are deactivated successfully',
'cmt_del'=>'Comments are deleted successfully',
'change_theme'=>'Profile theme is set successfully',
'del_theme'=>'Previous theme is removed successfully',
'ad_place'=>'Place is added successfully',
'cust_theme'=>'you have customized your theme successfully',
'report_abuse'=>'Your report has been sent to administration',
'result_succ'=>'Your result is added successfully',
'del_form'=>'Forms are deleted successfully',
'bydef_form'=>'Default Application Form is set successfully',
'sp_req_sed'=>'Your sponsorship application has been sent successfully.<br>Please wait for further processing.',
'cont_add'=>'Contract is added successfully',
'cont_upt'=>'Contract is updated successfully',
'off_sent'=>'Your offer has been sent successfully',
'listing_succ_in'=>'Listing is added successfully',
'listing_succ_up'=>'Listing is updated successfully',
'sp_equip_updated'=>'Equipment is updated successfully',
'mail_pro'=>'Unable to send mail',
'spon_decline'=>'Declined Successfully'
);

$arr_countries=array(
"" => "Select any one",
"United States" => "United States",
"Afghanistan" => "Afghanistan",
"Albania" => "Albania",
"Algeria" => "Algeria",
"American Samoa" => "American Samoa",
"Andorra" => "Andorra",
"Angola" => "Angola",
"Anguilla" => "Anguilla",
"Antarctica" => "Antarctica",
"Antigua and Barbuda" => "Antigua and Barbuda",
"Argentina" => "Argentina",
"Armenia" => "Armenia",
"Aruba" => "Aruba",
"Australia" => "Australia",
"Austria" => "Austria",
"Azerbaijan" => "Azerbaijan",
"Bahamas" => "Bahamas",
"Bahrain" => "Bahrain",
"Bangladesh" => "Bangladesh",
"Barbados" => "Barbados",
"Belarus" => "Belarus",
"Belgium" => "Belgium",
"Belize" => "Belize",
"Benin" => "Benin",
"Bermuda" => "Bermuda",
"Bhutan" => "Bhutan",
"Bolivia" => "Bolivia",
"Bosnia and Herzegovina" => "Bosnia and Herzegovina",
"Botswana" => "Botswana",
"Bouvet Island" => "Bouvet Island",
"Brazil" => "Brazil",
"British Indian Ocean Territory" => "British Indian Ocean Territory",
"Brunei Darussalam" => "Brunei Darussalam",
"Bulgaria" => "Bulgaria",
"Burkina Faso" => "Burkina Faso",
"Burundi" => "Burundi",
"Cambodia" => "Cambodia",
"Cameroon" => "Cameroon",
"Canada" => "Canada",
"Cape Verde" => "Cape Verde",
"Cayman Islands" => "Cayman Islands",
"Central African Republic" => "Central African Republic",
"Chad" => "Chad",
"Chile" => "Chile",
"China" => "China",
"Christmas Island" => "Christmas Island",
"Cocos (Keeling Islands)" => "Cocos (Keeling Islands)",
"Colombia" => "Colombia",
"Comoros" => "Comoros",
"Congo" => "Congo",
"Cook Islands" => "Cook Islands",
"Costa Rica" => "Costa Rica",
"Cote D'Ivoire (Ivory Coast)" => "Cote D'Ivoire (Ivory Coast)",
"Croatia (Hrvatska" => "Croatia (Hrvatska",
"Cuba" => "Cuba",
"Cyprus" => "Cyprus",
"Czech Republic" => "Czech Republic",
"Denmark" => "Denmark",
"Djibouti" => "Djibouti",
"Dominica" => "Dominica",
"Dominican Republic" => "Dominican Republic",
"East Timor" => "East Timor",
"Ecuador" => "Ecuador",
"Egypt" => "Egypt",
"El Salvador" => "El Salvador",
"Equatorial Guinea" => "Equatorial Guinea",
"Eritrea" => "Eritrea",
"Estonia" => "Estonia",
"Ethiopia" => "Ethiopia",
"Falkland Islands (Malvinas)" => "Falkland Islands (Malvinas)",
"Faroe Islands" => "Faroe Islands",
"Fiji" => "Fiji",
"Finland" => "Finland",
"France" => "France",
"France, Metropolitan" => "France, Metropolitan",
"French Guiana" => "French Guiana",
"French Polynesia" => "French Polynesia",
"French Southern Territories" => "French Southern Territories",
"Gabon" => "Gabon",
"Gambia" => "Gambia",
"Georgia" => "Georgia",
"Germany" => "Germany",
"Ghana" => "Ghana",
"Gibraltar" => "Gibraltar",
"Greece" => "Greece",
"Greenland" => "Greenland",
"Grenada" => "Grenada",
"Guadeloupe" => "Guadeloupe",
"Guam" => "Guam",
"Guatemala" => "Guatemala",
"Guinea" => "Guinea",
"Guinea-Bissau" => "Guinea-Bissau",
"Guyana" => "Guyana",
"Haiti" => "Haiti",
"Heard and McDonald Islands" => "Heard and McDonald Islands",
"Honduras" => "Honduras",
"Hong Kong" => "Hong Kong",
"Hungary" => "Hungary",
"Iceland" => "Iceland",
"India" => "India",
"Indonesia" => "Indonesia",
"Iran" => "Iran",
"Iraq" => "Iraq",
"Ireland" => "Ireland",
"Israel" => "Israel",
"Italy" => "Italy",
"Jamaica" => "Jamaica",
"Japan" => "Japan",
"Jordan" => "Jordan",
"Kazakhstan" => "Kazakhstan",
"Kenya" => "Kenya",
"Kiribati" => "Kiribati",
"Korea (North)" => "Korea (North)",
"Korea (South)" => "Korea (South)",
"Kuwait" => "Kuwait",
"Kyrgyzstan" => "Kyrgyzstan",
"Laos" => "Laos",
"Latvia" => "Latvia",
"Lebanon" => "Lebanon",
"Lesotho" => "Lesotho",
"Liberia" => "Liberia",
"Libya" => "Libya",
"Liechtenstein" => "Liechtenstein",
"Lithuania" => "Lithuania",
"Luxembourg" => "Luxembourg",
"Macau" => "Macau",
"Macedonia" => "Macedonia",
"Madagascar" => "Madagascar",
"Malawi" => "Malawi",
"Malaysia" => "Malaysia",
"Maldives" => "Maldives",
"Mali" => "Mali",
"Malta" => "Malta",
"Marshall Islands" => "Marshall Islands",
"Martinique" => "Martinique",
"Mauritania" => "Mauritania",
"Mauritius" => "Mauritius",
"Mayotte" => "Mayotte",
"Mexico" => "Mexico",
"Micronesia" => "Micronesia",
"Moldova" => "Moldova",
"Monaco" => "Monaco",
"Mongolia" => "Mongolia",
"Montserrat" => "Montserrat",
"Morocco" => "Morocco",
"Mozambique" => "Mozambique",
"Myanmar" => "Myanmar",
"Namibia" => "Namibia",
"Nauru" => "Nauru",
"Nepal" => "Nepal",
"Netherlands" => "Netherlands",
"Netherlands Antilles" => "Netherlands Antilles",
"New Caledonia" => "New Caledonia",
"New Zealand" => "New Zealand",
"Nicaragua" => "Nicaragua",
"Niger" => "Niger",
"Nigeria" => "Nigeria",
"Niue" => "Niue",
"Norfolk Island" => "Norfolk Island",
"Northern Mariana Islands" => "Northern Mariana Islands",
"Norway" => "Norway",
"Oman" => "Oman",
"Pakistan" => "Pakistan",
"Palau" => "Palau",
"Panama" => "Panama",
"Papua New Guinea" => "Papua New Guinea",
"Paraguay" => "Paraguay",
"Peru" => "Peru",
"Philippines" => "Philippines",
"Pitcairn" => "Pitcairn",
"Poland" => "Poland",
"Portugal" => "Portugal",
"Puerto Rico" => "Puerto Rico",
"Qatar" => "Qatar",
"Reunion" => "Reunion",
"Romania" => "Romania",
"Russian Federation" => "Russian Federation",
"Rwanda" => "Rwanda",
"Saint Kitts and Nevis" => "Saint Kitts and Nevis",
"Saint Lucia" => "Saint Lucia",
"Saint Vincent and The Grenadines" => "Saint Vincent and The Grenadines",
"Samoa" => "Samoa",
"San Marino" => "San Marino",
"Sao Tome and Principe" => "Sao Tome and Principe",
"Saudi Arabia" => "Saudi Arabia",
"Senegal" => "Senegal",
"Seychelles" => "Seychelles",
"Sierra Leone" => "Sierra Leone",
"Singapore" => "Singapore",
"Slovak Republic" => "Slovak Republic",
"Slovenia" => "Slovenia",
"Solomon Islands" => "Solomon Islands",
"Somalia" => "Somalia",
"South Africa" => "South Africa",
"S. Georgia and S. Sandwich Isls." => "S. Georgia and S. Sandwich Isls.",
"Spain" => "Spain",
"Sri Lanka" => "Sri Lanka",
"St. Helena" => "St. Helena",
"St. Pierre and Miquelon" => "St. Pierre and Miquelon",
"Sudan" => "Sudan",
"Suriname" => "Suriname",
"Svalbard and Jan Mayen Islands" => "Svalbard and Jan Mayen Islands",
"Swaziland" => "Swaziland",
"Sweden" => "Sweden",
"Switzerland" => "Switzerland",
"Syria" => "Syria",
"Taiwan" => "Taiwan",
"Tajikistan" => "Tajikistan",
"Tanzania" => "Tanzania",
"Thailand" => "Thailand",
"Togo" => "Togo",
"Tokelau" => "Tokelau",
"Tonga" => "Tonga",
"Trinidad and Tobago" => "Trinidad and Tobago",
"Tunisia" => "Tunisia",
"Turkey" => "Turkey",
"Turkmenistan" => "Turkmenistan",
"Turks and Caicos Islands" => "Turks and Caicos Islands",
"Tuvalu" => "Tuvalu",
"Uganda" => "Uganda",
"Ukraine" => "Ukraine",
"United Arab Emirates" => "United Arab Emirates",
"United Kingdom" => "United Kingdom",

"US Minor Outlying Islands" => "US Minor Outlying Islands",
"Uruguay" => "Uruguay",
"Uzbekistan" => "Uzbekistan",
"Vanuatu" => "Vanuatu",
"Vatican City State (Holy See)" => "Vatican City State (Holy See)",
"Venezuela" => "Venezuela",
"Viet Nam" => "Viet Nam",
"Virgin Islands (British)" => "Virgin Islands (British)",
"Virgin Islands (US)" => "Virgin Islands (US)",
"Wallis and Futuna Islands" => "Wallis and Futuna Islands",
"Western Sahara" => "Western Sahara",
"Yemen" => "Yemen",
"Yugoslavia" => "Yugoslavia",
"Zaire" => "Zaire",
"Zambia" => "Zambia",
"Zimbabwe" => "Zimbabwe"
);

$arr_us_states= array(
'' => 'Select',
'Alabama' => 'Alabama',
'Alaska' => 'Alaska',
'Arizona' => 'Arizona',
'Arkansas' => 'Arkansas',
'California' => 'California',
'Colorado' => 'Colorado',
'Connecticut' => 'Connecticut',
'Delaware' => 'Delaware',
'DC' => 'DC',
'Florida' => 'Florida',
'Georgia' => 'Georgia',
'Hawaii' => 'Hawaii',
'Idaho' => 'Idaho',
'Illinois' => 'Illinois',
'Indiana' => 'Indiana',
'Iowa' => 'Iowa',
'Kansas' => 'Kansas',
'Kentucky' => 'Kentucky',
'Louisiana' => 'Louisiana',
'Maine' => 'Maine',
'Maryland' => 'Maryland',
'Massachusetts' => 'Massachusetts',
'Michigan' => 'Michigan',
'Minnesota' => 'Minnesota',
'Mississippi' => 'Mississippi',
'Missouri' => 'Missouri',
'Montana' => 'Montana',
'Nebraska' => 'Nebraska',
'Nevada' => 'Nevada',
'New Hampshire' => 'New Hampshire',
'New Jersey' => 'New Jersey',
'New Mexico' => 'New Mexico',
'New York' => 'New York',
'North Carolina' => 'North Carolina',
'North Dakota' => 'North Dakota',
'Ohio' => 'Ohio',
'Oklahoma' => 'Oklahoma',
'Oregon' => 'Oregon',
'Pennsylvania' => 'Pennsylvania',
'Rhode Island' => 'Rhode Island',
'South Carolina' => 'South Carolina',
'South Dakota' => 'South Dakota',
'Tennessee' => 'Tennessee',
'Texas' => 'Texas',
'Utah' => 'Utah',
'Vermont' => 'Vermont',
'Virgin Islands' => 'Virgin Islands',
'Virginia' => 'Virginia',
'Washington' => 'Washington',
'West Virginia' => 'West Virginia',
'Wisconsin' => 'Wisconsin',
'Wyoming' => 'Wyoming'
);


$arr_errors = array(
'invalid_user'=>'Invalid user name or password, or<br>your account is inactive currently',
'upload_succ'=>'Photo uploaded successfully',
'photo_update'=>'Photo Information updated successfully',
'delete_photo'=>'Photo Deleted Successfully',
'video_update'=>'Video Updated Successfully',
'video_upload_succ'=>'Video Uploaded Successfully',
'video_delete'=>'Video Deleted Successfully',
'blog_add_succ'=>'Blog Added Successfully',
'file_nsp'=>'File type is not accepted',
'blog_up_succ'=>'Blog updated successfully',
'blog_dl_succ'=>'Blog deleted successfully',
'cmp_succ'=>'Competition information updated successfully',
'friendship_req'=>'Friendship request has been sent already',
'team_req'=>'Request for membership has been sent already',
'eqp_del_succ'=>'Equipment is deleted successfully',
'friend_already'=>'Already added in your friend list',
'team_mem_already'=>'Already added in your friend list',
'self_comment'=>'You can not give comment to yourself',
'no_video_refer_photo'=>'Please upload a photo for refering your video also',
'blog_dl_fail'=>'Blog deletion failed'
);


$arr_report_abuse_pages=array(				// same values ......temparily used.........This array is used for another purpose also
'event'=>'event_profile.php?ue_id=',
'place'=>'place_profile.php?uplc_id=',
'company'=>'cmp_profile.php?memid=',
'team'=>'team_profile.php?memid=',
'Fan'=>'fan_profile.php?memid=',
'promoter'=>'promoter_profile.php?memid=',
'media'=>'media_profile.php?memid=',
'Athlete'=>'ath_profile.php?memid='
);
$arr_profile_pages=array(				// 
'Athlete'=>'ath_profile.php',
'Team'=>'team_profile.php',
'Fan'=>'fan_profile.php',
'Company'=>'cmp_profile.php',
'Media Company'=>'media_profile.php',
'Promoter'=>'promoter_profile.php'
);
$arr_profile_menu_f=array(
''=>'profile_menu_f.php',
'Athlete'=>'profile_menu_f.php',
'Team'=>'team_menu_f.php',
'Fan'=>'fan_profile_menu_f.php',
'Company'=>'profile_menu_cmp_f.php',
'Media Company'=>'profile_menu_media_f.php',
'Promoter'=>'profile_menu_promoter_f.php'
);

$arr_account_pages=array(				// 
'Athlete'=>'ath_account.php',
'Team'=>'team_account.php',
'Fan'=>'fan_account.php',
'Company'=>'cmp_account.php',
'Media Company'=>'media_account.php',
'Promoter'=>'promoter_account.php'
);

/*  This array contains the list of sections that are default to particular page , means every page have some default sections in it...extra sections may be added later*/
$arr_bydef_sections=array(
'Athlete'=>array('ath_profile.php'=>array('Comments','My Events','My Friends','My Sports','My Sponsors','My Blog','My Favorites','Photo Gallery', 'My Sports Equipments'),
					'photos.php'=>array('Photo Gallery'),'videos.php'=>array(),'blogs.php'=>array('My Blog'),'my_friend_section.php'=>array('My Friends'),'comments_onprofile.php'=>array('Comments'),'my_result_section.php'=>array('My Results'),'my_event_section.php'=>array('My Events'),'my_place_section.php'=>array('My Places'),'my_sponsors_section.php'=>array('My Sponsors'),'my_watchlist_section.php'=>array('My Watchlist'),'aboutme.php'=>array('About Me')),
					
					
					

'Team'=>array('team_profile.php'=>array('Comments','My Events','My Friends','My Sports','My Sponsors','My Blog','My Team','My Favorites','Photo Gallery'),
					'photos.php'=>array('Photo Gallery'),'videos.php'=>array(),'blogs.php'=>array('My Blog'),'my_friend_section.php'=>array('My Friends'),'comments_onprofile.php'=>array('Comments'),'my_result_section.php'=>array('My Results'),'my_event_section.php'=>array('My Events'),'my_place_section.php'=>array('My Places'),'my_watchlist_section.php'=>array('My Watchlist'),'aboutme.php'=>array('About Me'),'my_team_section.php'=>array('My Team')),
					
					
					

'Fan'=>array('fan_profile.php'=>array('Comments','My Events','My Friends','My Sports','My Blog','My Favorites','Photo Gallery'),
					'photos.php'=>array('Photo Gallery'),'videos.php'=>array(),'blogs.php'=>array('My Blog'),'my_friend_section.php'=>array('My Friends'),'comments_onprofile.php'=>array('Comments'), 'my_event_section.php'=>array('My Events'),'my_place_section.php'=>array('My Places'),'my_watchlist_section.php'=>array('My Watchlist'),'aboutme.php'=>array('About Me')),
					
			
					
										
'Company'=>array('cmp_profile.php'=>array('Comments','My Events','My Friends','My Sports','My Sponsored Athletes','My Sponsored Teams','My Blog','My Favorites','Photo Gallery'),
					'photos.php'=>array('Photo Gallery'),'videos.php'=>array(),'blogs.php'=>array('My Blog'),'my_friend_section.php'=>array('My Friends'),'comments_onprofile.php'=>array('Comments'),'my_result_section.php'=>array('My Results'),'my_event_section.php'=>array('My Events'),'my_place_section.php'=>array('My Places'),'my_sponsored_athletes.php'=>array('My Sponsored Athletes'),'my_watchlist_section.php'=>array('My Watchlist'),'aboutme.php'=>array('About Me')),
					
					
'Media Company'=>array('media_profile.php'=>array('Comments','My Events','My Friends','My Blog','My Favorites','Photo Gallery'),
					'photos.php'=>array('Photo Gallery'),'videos.php'=>array(),'blogs.php'=>array('My Blog'),'my_friend_section.php'=>array('My Friends'),'comments_onprofile.php'=>array('Comments'), 'my_event_section.php'=>array('My Events'),'my_place_section.php'=>array('My Places'),'my_watchlist_section.php'=>array('My Watchlist'),'aboutme.php'=>array('About Me')),
					
					

'Promoter'=>array('promoter_profile.php'=>array('Comments','My Events','My Friends','My Blog','My Favorites','Photo Gallery'),
					'photos.php'=>array('Photo Gallery'),'videos.php'=>array(),'blogs.php'=>array('My Blog'),'my_friend_section.php'=>array('My Friends'),'comments_onprofile.php'=>array('Comments'),'my_event_section.php'=>array('My Events'),'my_place_section.php'=>array('My Places'),'my_watchlist_section.php'=>array('My Watchlist'),'aboutme.php'=>array('About Me'))	
					
											
);

/*  This array contains the all possible section for a user-type*/
###############################
/*
THERE ARE TWO MAJOR DIFREENCE BETWEEN MY TEAM(my_team_section.php) AND MY TEAMS(my_teams.php).
IN MY TEAMS WE ARE DISPLAYING ALL THE TEAMS THAT A ATHLELETE HAS JOINED.
AND IN MY TEAM WE ARE DISPLAYING THE TEAM MEMBERS OF A TEAM.
SO IN CASE OF ATHLELTE WE ARE USING MY TEAMS SECTION AND IN CASE OF TEAMS USERS WE ARE USING MY TEAM SECTION.
 
*/
################################

$arr_user_sections=array(
'Athlete'=>array('Comments','My Events','My Friends','My Places','My Sponsors','My Sports','My Blog','My Favorites','Photo Gallery','My Results','About Me','My Teams','My Sports Equipments','My Watchlist','My Html Module'),

'Team'=>array('Comments','My Events','My Friends','My Places','My Sponsors','My Sports','My Team','My Watchlist','My Blog','My Favorites','Photo Gallery','My Results','About Me','My Html Module'),

'Fan'=>array('Comments','My Events','My Friends','My Places','My Sports','My Watchlist','My Blog','My Favorites','Photo Gallery','About Me','My Html Module'),


'Company'=>array('Comments','My Events','My Friends','My Places','My Sponsored Athletes','My Sponsored Teams','My Sports','My Watchlist','My Blog','My Favorites','Photo Gallery','My Results','About Me','My Html Module'),

'Media Company'=>array('Comments','My Events','My Friends','My Places','My Watchlist','My Blog','My Favorites','Photo Gallery','About Me','Company Description','Working Envision','My Html Module'),

'Promoter'=>array('Comments','My Events','My Friends','My Places','My Watchlist','My Blog','My Favorites','Photo Gallery','About Me','Company Description','Working Envision','My Html Module')
);


$arr_section_corresponding_databasefields=array(
'My Events'=>'psm_my_events',                           
'Photo Gallery'=>'psm_photo_gallery',
'Latest Event Results'=>'psm_latest_event_result',                   
'My Friends'=>'psm_my_friends',
'My Places'=>'psm_my_places',
'About Me'=>'psm_about_me',
'My Sponsors'=>'psm_my_sponsors',
'My Sponsored Athletes'=>'psm_sponsored_athletes',
'My Sponsored Teams'=>'psm_sponsored_teams',
'My Sports'=>'psm_my_sports',
'My Team'=>'psm_my_team',
'My Watchlist'=>'psm_my_watchlist',
'My Blog'=>'psm_my_blogs',
'My Favorites'=>'psm_my_favorites',
'My Results'=>'psm_my_results',
'Comments'=>'psm_comments',
'My Sports Equipments'=>'psm_my_equipments',
'My Teams'=>'psm_my_total_teams',
'Company Description'=>'psm_company_description',
'Working Envision'=>'psm_working_envision',
'My Html Module'=>'psm_my_html_module'
);


$arr_section_corres_phpfile=array(
'Comments'=>'comments_onprofile.php',
'My Events'=>'my_event_section.php',
'My Places'=>'my_place_section.php',
'Photo Gallery'=>'photo_gallery_onprofile.php',
'About Me'=>'aboutme.php',
'My Watchlist'=>'my_watchlist_section.php',
'My Friends'=>'my_friend_section.php',
'My Sports'=>'my_sports_box.php',
'My Sponsors'=>'my_sponsors_section.php',
'My Sponsored Athletes'=>'my_sponsored_athletes.php',
'My Sponsored Teams'=>'my_sponsored_teams.php',
'My Blog'=>'my_blogs_section.php',
'My Results'=>'my_result_section.php',
'My Team'=>'my_team_section.php',
'My Favorites'=>'my_favorilte_section.php',
'My Sports Equipments'=>'my_equipment_box.php',
'My Teams'=>'my_teams.php',
'Company Description'=>'company_description.php',
'Working Envision'=>'working_envision.php',
'My Html Module'=>'user_html_module.php'
);


$arr_ads_page_name=array('ath_search.php'=>'athlete search ----(230px)','cmp_search.php'=>'company Search----(230px)','place_search.php'=>'Place Search----(230px)','event_search.php'=>'Event Search----(230px)','team_search.php'=>'Team Search----(230px)','ath_account.php'=>'Athlete account----(728px)','ath_profile.php'=>'Athlete Profile----(230px)','cmp_profile.php'=>'Company Profile----(230px)','team_profile.php'=>'Team Profile----(230px)','team_account.php'=>'Team Account----(728px)','cmp_account.php'=>'Company Account----(728px)','photos_listing.php'=>'Photo Listing----(230px)','videos_listing.php'=>'Video Listing----(230px)','browse_sports.php'=>'Browse Sports---(230px)','index.php'=>'Home ---(300px)');


$arr_user_display_name = array('Athlete'=>'user_fname^user_lname', 'Team'=> 'user_team_name','Fan'=>'user_fname^user_lname','Shop'=>'user_shop_name','Company'=>'user_company_name','Media Company'=>'user_company_name','Promoter'=>'user_company_name');


/*$arr_ads_width_allow=array(
'ath_search.php'=>'230','cmp_search.php'=>'230','place_search.php'=>'230','event_search.php'=>'230','team_search.php'=>'230','ath_account.php'=>'728','ath_profile.php'=>'230','cmp_profile.php'=>'230','team_profile.php'=>'230','team_account.php'=>'728','cmp_account.php'=>'728','photos_listing.php'=>'230','videos_listing.php'=>'230'

);*/


?>