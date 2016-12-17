<?php
    $Read_Temperature = exec("sudo ./teste", $output, $temperature);    
	echo $Read_Temperature;
?>