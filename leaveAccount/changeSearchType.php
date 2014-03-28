<?php

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {

		$type = $_GET['type'];

		if(!empty($type)){
			echo "<fieldset>
			<input type='text' class='pure-form input-rounded' placeholder='Search...' style='width:100%;margin:0;' onkeyUp='search(this.value, \"".$type."\");'>
			</fieldset>";
		}
		
        }
?>