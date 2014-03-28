<?php

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$leaveDetailId = $_GET['leaveDetailId'];

		if(!empty($leaveDetailId)){
			
			require_once '../connect.inc.php';

			connect_db('leave_account_db');

			$query = "UPDATE leave_details_tb SET leaveStatus='2' WHERE leaveDetailId='".$leaveDetailId."'";

			if($query_run = mysql_query($query)){
				echo "Application Recommended";
			}else{
				echo "Failed to recommend application";
			}
		}
	}

?>