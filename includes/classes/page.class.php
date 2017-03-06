<?php
Class Page {
	
	public function _constructor(){

	}

	public function getPageById( $page_id = 0 ){
     
     $sql = "SELECT * From ss_static_pages WHERE sp_id = $page_id";
     $result = db_query($sql);
     $page = mysql_fetch_object($result);
     
     return $page;
	}

	public function getPageBySeoName( $page_seoname = '' ){
     
     $sql = "SELECT * From ss_static_pages WHERE sp_seoname = '$page_seoname'";
     $result = db_query($sql);
     $page = mysql_fetch_object($result);
     
     return $page;
	}

}

?>