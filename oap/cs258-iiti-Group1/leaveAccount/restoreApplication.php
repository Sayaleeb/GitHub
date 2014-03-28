<?php

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {

		$userId = 1;//$_SESSION['userId'];

		$allLeavesCount = $_GET['allLeavesCount'];
		$allLeaves = json_decode($_GET['allLeaves']);

		require_once '../connect.inc.php';
		require_once('functions.php');
 
		connect_db('leave_account_db');

		transfer_leaves("deleted_applications_tb", "leave_details_tb", $allLeaves, $allLeavesCount);
		
	}

?>