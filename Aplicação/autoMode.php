<?php

	$temperatures = explode(" ", file_get_contents("/var/www/html/temp.txt"));
	$min = $temperatures[0];
	$max = $temperatures[1];
	
	$Read_Temperature = exec("sudo /var/www/html/teste", $output, $temperature);
	
	print_r($Read_Temperature);
	print_r($min);
	print_r($max);
	
	if($Read_Temperature <= $min) {
		print("A ligar Calor");
		// Ligar hot
		system("gpio -g mode 21 out");
		system("gpio -g write 21 1");
		// Desligar frio
		system("gpio -g mode 23 out");
		system("gpio -g write 23 0");
	}
	else if($Read_Temperature >= $max) {
		print("A ligar Frio");
		// Ligar cold
		system("gpio -g mode 23 out");
		system("gpio -g write 23 1");
		// Desligar hot
		system("gpio -g mode 21 out");
		system("gpio -g write 21 0");
	}
	else {
		print("Deligar tudo");
		// Desligar frio
		system("gpio -g mode 23 out");
		system("gpio -g write 23 0");
		// Desligar hot
		system("gpio -g mode 21 out");
		system("gpio -g write 21 0");
	}
	
?>