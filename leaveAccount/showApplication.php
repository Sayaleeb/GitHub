
<?php

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {

		if(!isset($_SESSION['$userId'])){

		 	$userId='1';

		 	require_once('../connect.inc.php');

			connect_db('leave_account_db');

			$leaveDetailId = $_GET['leaveDetailId'];
			$location = $_GET['location'];

			if(!empty($leaveDetailId)){

				$query="SELECT * FROM ".$location." WHERE leaveDetailId=".$leaveDetailId;
				
				//$query="SELECT * FROM deleted_applications_tb WHERE leaveDetailId=".$leaveDetailId;				
				
				if( $mysql_run=mysql_query($query)){

					if( mysql_num_rows($mysql_run)==1){

						$query_row= mysql_fetch_assoc($mysql_run);
						$applicantsId=$query_row['userId'];
						$fromDate=date('m/d/Y',strtotime($query_row['fromDate']));
						$approvingAuthority=$query_row['approvingAuthority'];
						$leaveType=$query_row['leaveType'];
						$availConcession=$query_row['availConcession'];
						$leaveAddress=$query_row['leaveAddress'];
						$applyingDate=$query_row['applyingDate'];
						$leaveDuration=$query_row['leaveDuration'];
						$reason= $query_row['reason'];
						$leaveStatus = $query_row['leaveStatus'];
						connect_db('user_details_db');
						$query_find_user_details="SELECT * FROM user_login_tb WHERE userId='$applicantsId'";
						if( $mysql_run_login=mysql_query($query_find_user_details)){

							if( mysql_num_rows($mysql_run_login)==1){

								if($query_row_login= mysql_fetch_assoc($mysql_run_login)){

									$applicantName=$query_row_login['userName'];
									$designation=$query_row_login['designation'];

									echo "<div class='header'><h1>".$query_row_login['userName']."</h1>
										<h2>".$query_row_login['designation']."<div style='float:right;'>".date("d/m/Y", strtotime($applyingDate))." (".date("Gi.s", strtotime($applyingDate)).")</div></h2>";
									
							                echo "	</div>";

							                if($leaveStatus!=1){
							                	echo "<div class='content'><h2 class='content-subhead'>";

								                if($leaveStatus==2){
								                	echo "(Recommended)";
								                }else if($leaveStatus==3){
								                	echo "(Approved)";
								                }else if($leaveStatus==4){
								                	echo "(Rejected)";
								                }

							                	echo "</h2></div>";
							        	}

									echo "<div class='content'>
		                						<h2 class='content-subhead'></h2>
								            <table style='width:90%;'>
										<tr class='table-li-even'><td>Applicant Name</td><td>".$applicantName."</td></tr>
										<tr class='table-li-odd'><td>Designation</td><td>".$designation."</td></tr>
										<tr class='table-li-even'><td>Leave Type</td><td>";
									if($query_row['leaveType']=='casualLeave'){
										echo "Casual Leave";
									}else if($query_row['leaveType']=='specialClBalance'){
										echo "Sepcial CL";
									}else if($query_row['leaveType']=='specialLeaveBalance'){
										echo "Special Leave";
									}else if($query_row['leaveType']=='halfPayLeaveBalance'){
										echo "Half-Pay Leave";
									}else if($query_row['leaveType']=='commutedLeaveBalance'){
										echo "Commuted Leave";
									}else if($query_row['leaveType']=='earnedLeaveBalance'){
										echo "Earned Leave";
									}else if($query_row['leaveType']=='extraOrdinaryLeaveBalance'){
										echo "Extra Ordinary Leave";
									}else if($query_row['leaveType']=='maternityLeaveBalance'){
										echo "Maternity Leave";
									}else if($query_row['leaveType']=='hospitalLeaveBalance'){
										echo "Hospital Leave";
									}else if($query_row['leaveType']=='quarantineLeaveBalance'){
										echo "Quarantine Leave";
									}else if($query_row['leaveType']=='leaveNotLeaveBalance'){
										echo "Leave Not Leave";
									}else if($query_row['leaveType']=='sabbaticalLeaveBalance'){
										echo "Sabbatical Leave";
									}else if($query_row['leaveType']=='vacationBalance'){
										echo "Vacation Leave";
									}

									echo "</td></tr>
										<tr class='table-li-odd'><td>Leave duration</td><td>".$leaveDuration." days leave starting from ".$fromDate."</td></tr>
										<tr class='table-li-even'><td>Leave Reason</td><td>".$reason."</td></tr>
										<tr class='table-li-odd'><td>Address during leave</td><td>".$leaveAddress."</td></tr>";
								        echo "</table>";

									if($leaveType!='clBalance'){
										if($availConcession==1) echo "<h5><td><input type='checkbox' checked disabled>  I would like to take leave concession</h5>";
									}

								        echo "<p>";

									if($userId==$query_row['approvingAuthority']){
							                    echo "<a href='#' class='pure-button pure-button-primary' onclick='approveApplication(".$_GET['leaveDetailId'].")'";

							                    if($leaveStatus==3 || $leaveStatus==4 || $location=="deleted_applications_tb"){
							                    	echo " disabled";
							                    }

							                    echo ">Approve</a>";
							                }else if($userId==$query_row['recommendingAuthority']){
							                    echo "<a href='#' class='pure-button pure-button-primary' onclick='recommendApplication(".$_GET['leaveDetailId'].")'";

							                    if($leaveStatus==2 || $leaveStatus==4 || $location=="deleted_applications_tb"){
							                    	echo " disabled";
							                    }

							                    echo ">Recommend</a>";
							                }
							                echo "  <a href='#' class='pure-button pure-button-primary' onclick='rejectApplication(".$_GET['leaveDetailId'].")'";

									if($leaveStatus==2 || $leaveStatus==3 || $leaveStatus==4 || $location=="deleted_applications_tb"){
										echo " disabled";
									}

							                echo ">Reject</a>";
							                
							                echo "</p>";
								}
							}else{
								echo "Problem in user database";
							}
						}
					}
					else{
						echo "<div class='header'><h1>No applications</h1></div>";
					}
				}else{
					echo mysql_error();//'some problem occured';
				}
			}
			
		}
	}
?>