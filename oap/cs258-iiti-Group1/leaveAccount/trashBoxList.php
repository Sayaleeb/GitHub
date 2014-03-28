<?php

	if( !isset($_SESSION['userId']) ){

		require_once('../connect.inc.php');
		require_once('functions.php');

		connect_db('leave_account_db');

		$userId = 1;//$_SESSION['userId'];

		$query = "SELECT * FROM deleted_applications_tb WHERE recommendingAuthority='$userId' OR approvingAuthority='$userId'";

		list_display_query($query, "readyRestoreApplication");

	}

?>
