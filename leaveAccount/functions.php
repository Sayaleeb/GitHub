<?php

	function list_display_query($query, $onChangeFunction){
		
		$userId = 1;

		if($query_run = mysql_query($query)){

			if(mysql_num_rows($query_run)==0){
				echo "<li style='align:center;'><a>No applications found</a></li>";
			}

			while($query_row = mysql_fetch_assoc($query_run)){

				$applicantId = $query_row['userId'];

				echo "<li><div style='float:left;width:30px;'><span class='demoSpan1'><input type='checkbox' onchange='".$onChangeFunction."(".$query_row['leaveDetailId'].", this.checked);'></div></span>";
				
				if($onChangeFunction=="readyDeleteApplication"){
					echo "<a href='#' onclick='showApplication(".$query_row['leaveDetailId'].", \"leave_details_tb\");'>";						
				}else if($onChangeFunction=="readyRestoreApplication"){
					echo "<a href='#' onclick='showApplication(".$query_row['leaveDetailId'].", \"deleted_applications_tb\");'>";						
				}			
				
	                	echo "<font color='#CCC'>".$query_row['userName']."</font>: <font size='2px'>";

		                if($query_row['recommendingAuthority']==$userId){
					echo 'Recommend ';
				}else{
					echo 'Approve ';
				}
				echo $query_row['leaveDuration']." days ";
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
				echo "<div style='float:right;width:15%;'>".date("d/m/Y", strtotime($query_row['applyingDate']))."</div></font></a></li>";
				echo "<div class='line-separator'></div>";
			}

		}else{

			echo mysql_error();

		}
	}

	function transfer_leaves($from, $to, $allLeaves, $allLeavesCount){

		$query_vars = "";

		for ($i=0; $i < $allLeavesCount; $i++) { 
			
			$leaveDetailId = $allLeaves[$i];

			if(!empty($leaveDetailId)){
				
				if($query_vars!=""){
					$query_vars = $query_vars." OR";
				}

				$query_vars = $query_vars." leaveDetailId='".$leaveDetailId."'";
				
			}			

		}

		if(!empty($query_vars)){

			$query = "INSERT ".$to." SELECT * FROM ".$from." WHERE".$query_vars;

			if($query_run = mysql_query($query)){

				$query = "DELETE FROM ".$from." WHERE".$query_vars;

				if($query_run = mysql_query($query)){

					if($from=="leave_details_tb"){					
						echo "Application(s) deleted";	
					}else if($from=="deleted_applications_tb"){				
						echo "Application(s) restored";						
					}

				}else{
					if($from=="leave_details_tb"){	
						echo "Failed to delete application(s)";	
					}else if($from=="deleted_applications_tb"){	
						echo "Failed to restore application(s)";						
					}
				}
			}else{
				if($from=="leave_details_tb"){	
					echo "Failed to delete application(s)";	
				}else if($from=="deleted_applications_tb"){	
					echo "Failed to restore application(s)";						
				}
			}

		}else{
			if($from=="leave_details_tb"){	
				echo "No application(s) selected for deletion";	
			}else if($from=="deleted_applications_tb"){	
				echo "No application(s) selected for restoration";						
			}
		}
	}

?>