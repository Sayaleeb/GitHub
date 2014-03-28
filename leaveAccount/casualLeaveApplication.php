<?php
	
	include 'connect.inc.php';
	
	if( isset($_POST['fromDate']) && isset($_POST['toDate']) && isset($_POST['leaveReason']) && 
		isset($_POST['recommendingAuthority']) && isset($_POST['approvingAuthority']) ){
			
			$fromDate = $_POST['fromDate'];
			$toDate = $_POST['toDate'];
			$leaveReason = $_POST['leaveReason'];
			$recommendingAuthority = $_POST['recommendingAuthority'];
			$approvingAuthority = $_POST['approvingAuthority'];
			$leaveType='clBalance';
			
			if( !empty($fromDate) && !empty($toDate) && !empty($leaveReason) && 
				!empty($recommendingAuthority) && !empty($approvingAuthority) ){
					
					$fromDate=$_POST['fromDate'];
					$toDate=$_POST['toDate'];
				if( strlen($leaveReason) < 500){

					 $now = time();  
				     $fromDate = strtotime($fromDate);
				     $toDate=strtotime($toDate);
				     $datediff = $toDate-$fromDate;
				     echo $numberOfDays =ceil($datediff/(60*60*24)) + 1 ;
				     connect_leave_account_db();
				       $query_find_leaves="SELECT $leaveType FROM  leave_balance_tb WHERE userId='1'";
					     if($query_run=mysql_query($query_find_leaves)){
					     	if(mysql_num_rows($query_run)==1){
					     		$query_row=mysql_fetch_assoc($query_run);
					     		echo $numberOfDaysLeft=$query_row[$leaveType];
					     	}else{
					     		echo 'Error Occured';
					     	}

				     if($numberOfDays>0){
					
						if($numberOfDays<$numberOfDaysLeft ){
							 
							$leaveReason = mysql_real_escape_string($leaveReason);
							$recommendingAuthority = 1;
							$approvingAuthority = 2;
							
				
							$query= "INSERT INTO leave_details_tb VALUES (NULL, '0', '1' ,NOW(),FROM_UNIXTIME($fromDate),'$numberOfDays', '$leaveReason','$recommendingAuthority', '$approvingAuthority', '$leaveType',' ','')";
							
						
							if($query_run = mysql_query($query)){
								
								$query_update_balance="UPDATE leave_balance_tb SET $leaveType=$numberOfDaysLeft-$numberOfDays WHERE  userId='1'";
									if($query_run=mysql_query($query_update_balance))
									echo "Your application is sent for furthur process";
									else
										echo 'some problem occured';
								
							}else{
								"Sorry, an error occured. Please try sometime later.";
							}
							
						}else{
							echo "You don't have enough leave balance";					
						}
				    }
				    else
				    	echo "Enter dates again";
					
				}else{
					echo "Please adher to maxlength of the field \'Reason for leave\'";
				}
				
			}else{
				echo "All fields are required";
			}			
			
		}
	}
	
?>
<html>
	<head ><link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/pure-min.css"></head>
		<div style="margin-left:45px;">

			 <h3 style="background-color:black; color:white; margin-left:45px;padding:4px;">New Application</h3>
			<textarea  style="width:100%; height:25px; margin-left:45px; margin-top:-18px;vertical-align:middle; font-weight:bold;">To:</textarea>
			<p style="width:100%; margin-left:45px; vertical-align:middle;margin-top:1px;margin-bottom:-5px;"><b>Application</b>: Casual Leave</p>
			<hr style="width:100%; margin-left:45px;"/>
			<form class="pure-form pure-form-aligned" action="casualLeaveApplication.php" method="POST">
				<fieldset>
					<div class="pure-control-group">
						 <label style="font-weight:bold;">Duration of leave required: </label>
			            <input name="fromDate" type="date" value="<?php if(isset($_POST['fromDate'])) {echo $_POST['fromDate']; } ?>">
			            <input type="date" name="toDate"  value="<?php if(isset($_POST['toDate'])) {echo $_POST['toDate']; } ?>"/>
			        </div>
					
					 <div class="pure-control-group">
			            <label style="font-weight:bold;" >Reason for Casual Leaves and Grounds:   </label>
			            <textarea name="leaveReason" maxlength="500" rows="6" cols="40" placeholder="Do not use more than 100 words"><?php if(isset($_POST['leaveReason'])) {echo $_POST['leaveReason']; } ?></textarea>
			        </div>
					
					<div class="pure-control-group">
			          <label style="font-weight:bold;" > Recommending Authority: </label>
			           <input name="recommendingAuthority" id="recommendingAuthority" type="text" placeholder="Recommending Authority" value="<?php if(isset($_POST['recommendingAuthority'])) {echo $_POST['recommendingAuthority']; } ?>">
			        </div>

					<div class="pure-control-group">
			          <label style="font-weight:bold;" >Sanctioning Authority:</label>
			          <input name="approvingAuthority" type="text" placeholder=" Sanctioning Authority" value="<?php if(isset($_POST['approvingAuthority'])) {echo $_POST['approvingAuthority']; } ?>">
			        </div>
			        <hr style="width:100%; margin-left:45px;"/>
			        <div class="pure-control-group">
					     <label></label><button type="submit" class="pure-button pure-button-primary">Apply</button>
					</div>
				</fieldset>
			</form>
		</div>
</html>