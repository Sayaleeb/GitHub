<?php
	include 'connect.inc.php';
	
	if( isset($_POST['fromDate']) && isset($_POST['toDate']) && isset($_POST['availConcession']) && isset($_POST['leaveReason']) && 
		isset($_POST['leaveAddress']) && isset($_POST['recommendingAuthority']) && isset($_POST['approvingAuthority'])){
		if(isset($_POST['agreeToTerms'])){
				$leaveType=$_POST['leaveType'];
				$fromDate=$_POST['fromDate'];
				$toDate=$_POST['toDate'];
				$availConcession=$_POST['availConcession'];
				$reason=$_POST['leaveReason'];
				$leaveReason=$_POST['leaveReason'];
				$leaveAddress=$_POST['leaveAddress'];
				//$recommendingAuthority=$_POST['recommendingAuthority'];
				//$approvingAuthority=$_POST['approvingAuthority'];
				$recommendingAuthority='1';
				$approvingAuthority='2';
				$agreeToTerms=$_POST['agreeToTerms'];
				if(  !empty($fromDate) && !empty($toDate) && !empty($availConcession) && !empty($leaveReason) && !empty($leaveAddress)&& 
					!empty($recommendingAuthority) && !empty($approvingAuthority)  ){
						
						$fromDate=$_POST['fromDate'];
						$toDate=$_POST['toDate'];
					if( strlen($leaveReason) < 500){

						 $now = time();  
					     $fromDate = strtotime($fromDate);
					     $toDate=strtotime($toDate);
					     $datediff = $toDate-$fromDate;
					     $numberOfDays =ceil($datediff/(60*60*24)) + 1;
					     connect_leave_account_db();
					     $query_find_leaves="SELECT $leaveType FROM  leave_balance_tb WHERE userId='1'";
					     if($query_run=mysql_query($query_find_leaves)){
					     	if(mysql_num_rows($query_run)==1){
					     		$query_row=mysql_fetch_assoc($query_run);
					     		echo $numberOfDaysLeft=$query_row[$leaveType];
					     	}else{
					     		echo 'Error Occured';
					     	}

					     }
					     if($numberOfDays>0){
						
							if($numberOfDays<$numberOfDaysLeft ){
								 
								$leaveReason = mysql_real_escape_string($leaveReason);
						
								$query= "INSERT INTO leave_details_tb VALUES (NULL, '1', '1' ,NOW() ,FROM_UNIXTIME($fromDate),'$numberOfDays', '$leaveReason','$recommendingAuthority', '$approvingAuthority', '$leaveType', '$availConcession', '$leaveAddress')";
								

								if($query_run = mysql_query($query)){
									$query_update_balance="UPDATE leave_balance_tb SET $leaveType=$numberOfDaysLeft-$numberOfDays WHERE  userId='1'";
									if($query_run=mysql_query($query_update_balance))
									echo "Your application is sent for furthur process";
									else
										echo 'Problem';
									
								}else{
									echo "Sorry, an error occured. Please try sometime later.";
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
			}else
			echo 'Please agree to terms';

		}

?>
<html>
	<head><link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/pure-min.css"></head>
	<div style="margin-left:45px;">
		<h3 style="background-color:black; color:white; margin-left:45px; padding:4px;">New Application</h3>
		<textarea  style="width:100%; margin-left:45px;  height:25px; vertical-align:middle; font-weight:bold;  margin-top:-18px;">To:</textarea>
		<p style="width:100%; margin-left:45px; vertical-align:middle; margin-top:1px;margin-bottom:-5px;"><b>Application:</b> Non Casual Leave</p>
		<hr style="width:100%; margin-left:45px;"/>
		<form class="pure-form pure-form-aligned"  action="nonClLeaveApplication.php" method="POST" >
			<fieldset>
				<div class="pure-control-group">
				<label style="font-weight:bold;">Nature of Leave:</label>
					<select name="leaveType" class="pure-input-1-1">
						<option value="specialClBalanace" selected>Special CL Balanace  </option>
						<option value="specialLeaveBalance"> Special Leave Balance </option>
						<option value="halfPayLeaveBalance"> Half Pay LeaveBalance </option>
						<option value="commutedLeaveBalance"> Commuted Leave Balance </option>
						<option value="earnedLeaveBalance"> Earned Leave Balance </option>
						<option value="extraordinaryLeaveBalance"> Extraordinary Leave Balance </option>
						<option value="maternityLeaveBalance"> Maternity Leave Balance </option>
						<option value="hospitalLeaveBalance"> Hospital Leave Balance </option>
						<option value="quarantineLeaveBalance ">Quarantine Leave Balance </option>
						<option value="leaveNotLeaveBalance"> Leave Not Leave Balance</option>
						<option value="sabbaticalLeaveBalance">Sabbatical Leave Balance </option>
						<option value="vacationBalance"> Vacation Balance</option>
						
					</select>
				</div>

				<div class="pure-control-group">
					 <label style="font-weight:bold;">Duration of leave required: </label>
		            <input name="fromDate" type="date" value="<?php if(isset($_POST['fromDate'])) {echo $_POST['fromDate']; } ?>">
		            <input type="date" name="toDate"  value="<?php if(isset($_POST['toDate'])) {echo $_POST['toDate']; } ?>"/>
		        </div>
				<!-- Holidays,if any proposed to be <br> -->

				<div class="pure-control-group">
		            <label style="font-weight:bold;">Grounds for leave:   </label>
		            <textarea name="leaveReason" maxlength="500" rows="6" cols="40" placeholder="Do not use more than 100 words"><?php if(isset($_POST['leaveReason'])) {echo $_POST['leaveReason']; } ?></textarea>
		        </div>

		        <div class="pure-control-group">
					 <label class="pure-radio" style="font-weight:bold;">
					Do you want travel leave concession during the ensuring leave: &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
					</label>
					<input type="radio" name="availConcession" value="1" checked> &nbsp;yes</input>&nbsp;&nbsp;
					<input type="radio" name="availConcession" value="0" >&nbsp;no</input>
				</div>

				<div class="pure-control-group">
		            <label style="font-weight:bold;">Address while on leave:   </label>
		            <textarea name="leaveAddress" maxlength="500" rows="6" cols="40" placeholder="Do not use more than 100 words"><?php if(isset($_POST['leaveAddress'])) {echo htmlentities($_POST['leaveAddress']); }?></textarea>
		        </div>

				<div class="pure-control-group">
		           <label style="font-weight:bold;"> Recommending Authority: </label>
		           <input name="recommendingAuthority" id="recommendingAuthority" type="text" placeholder="Recommending Authority" value="<?php if(isset($_POST['recommendingAuthority'])) {echo $_POST['recommendingAuthority']; } ?>">
		        </div>

				<div class="pure-control-group">
		          <label style="font-weight:bold;">Sanctioning Authority:</label>
		          <input name="approvingAuthority" type="text" placeholder=" Sanctioning Authority" value="<?php if(isset($_POST['approvingAuthority'])) {echo $_POST['approvingAuthority']; } ?>">
		        </div>

		        <div class="pure-control-group">
					  A. In the event of my resignation or voluntary retirement from the service. I undertake to refund:<br>
				        &nbsp;&nbsp;&nbsp;&nbsp;   1. The difference between the leave salary drawn during commuted leave and that admissible during half pay leave.<br>
				      <br>B.  Undertake to refund the leave salary drawn for the period of earned leave which would not have been admissible, had leave not been credited in advance in the event of my resignation, Voluntary retirement, dismissal or removal from service or removal from service or in the event of termination of my services.
				 </div>
				<div class="pure-control-group">
					<label style="font-weight:bold;" class="pure-checkbox">I agree</label>			
			   		<input name="agreeToTerms" type="checkbox">
		    	</div>
		    	<hr style="width:100%; margin-left:45px;"/>
		    	<div class="pure-control-group">
		      		  <label></label><button type="submit" class="pure-button pure-button-primary">Apply</button>
		        </div>


			</fieldset>
		</form>
	</div>
</html>