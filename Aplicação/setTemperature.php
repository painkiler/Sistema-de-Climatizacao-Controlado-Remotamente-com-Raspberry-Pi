<?php

	if(isset($_GET['min']) && isset($_GET['max']))
	{
		$result = file_put_contents("temp.txt", $_GET['min'] . " " . $_GET['max']);
		print_r($result);
	}
	else {
		print("bug");
	}
	

?>