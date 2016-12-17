<?php
			
			$Read_Temperature = exec("sudo ./teste", $output, $temperature);
			echo "<center><img src='CoresTemperatura/" .$Read_Temperature. ".gif' height='200' width='200' /></center>"; 
			?>