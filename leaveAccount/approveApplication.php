<?php

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$leaveDetailId = $_GET['leaveDetailId'];

		require_once '../connect.inc.php';

		connect_db('leave_account_db');

		$query = "UPDATE leave_details_tb SET leaveStatus='3'";

		if($query_run = mysql_query($query)){
			echo "Application Approved";
		}else{
			echo "Failed to approve application";
		}
	}

?>