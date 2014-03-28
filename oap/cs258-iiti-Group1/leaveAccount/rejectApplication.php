<?php

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {

		$leaveDetailId = $_GET['leaveDetailId'];

		$userId = 1;//$_SESSION['userId'];

		if(!empty($leaveDetailId)){
			
			require_once '../connect.inc.php';

			connect_db('leave_account_db');

			$query = "UPDATE leave_details_tb SET leaveStatus='4', rejectedBy='".$userId."' WHERE leaveDetailId='".$leaveDetailId."'";

			if($query_run = mysql_query($query)){
				echo "Application Rejected";
			}else{
				echo "Failed to reject application";
			}
		}
	}

?>