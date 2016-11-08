<?php
class midas_pager_sql extends midas_pager {
	function midas_pager_sql($sql, $records_per_page, $start='0', $theme = '') {
		$sql_orig = $sql;
		$sql = preg_replace('/{\s}+/', ' ', $sql);
		$pos_group_by = strpos(' group by ', $sql);

		$sql = $this->trim_from_end($sql, ' having ');
		$sql = $this->trim_from_end($sql, ' order by ');
		$sql = $this->trim_from_end($sql, ' limit ');

		if($pos_group_by===false) {
			//echo("<br>sql:$sql");

			$sql = $this->trim_from_end($sql, ' group by ');
			$pos_from = strpos($sql, ' from ');
			//echo("<br>pos_from:$pos_from");
			if($pos_from !== false) {
				$sql = substr($sql, $pos_from );
			}
			//echo("<br>sql:$sql");
			$sql = "select count(*) ".$sql;
			$this->sql = $sql;
			$total_records = db_scalar($sql);
		} else {
			//echo("<br>sql:$sql");
			$this->sql = $sql;
			$result = db_query($sql);
			$total_records = mysql_num_rows($result);
		}
		parent::midas_pager($total_records, $records_per_page, $start, $theme);
	}
	
	function trim_from_end($sql, $token) {
		$pos = strpos($sql, $token);
		if($pos !== false) {
			$sql = substr($sql, 0, $pos);
		}
		return $sql;
	}
}
?>