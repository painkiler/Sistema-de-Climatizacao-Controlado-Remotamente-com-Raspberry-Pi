<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
  
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="css/bootstrap.min.css">-->
	<link rel="stylesheet" href="css/bootstrap-switch.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
	<!--<script src="js/bootstrap.min.js"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/bootstrap-switch.min.js"></script>
    
    <title> Sistema de Climatização Controlado Remotamente</title>
	
</head>
<?php
    $Read_Temperature = exec("sudo ./teste", $output, $temperature);
?>
	
<body class="bg-info">

<div class="container" style="text-align: center" >
<div class="bg-primary" style="border: 1px solid dodgerblue"
    <!--  -->
    
    <!-- -->
	
	<br>
	<br>
	<br>
	<span id="animation"></span>
	<style>
					#animation {
						position: absolute;
						left:middle;
						margin-left: -100px;
						top: 10px;
						
						}
					</style>
	<h1><span id="temperature"><?= $Read_Temperature ?></span> &#8451;</h1>
	<br>
	<br>
	<br>
	<br>
	
    <h2 class="font-italic">Arrefecimento</h2>
	<input type="checkbox" name="buttonCold" data-on-color="success" data-off-color="danger" <?php 
		 $state = system('gpio -g read 23');
		 if($state == 1) {
			 echo "checked";
			 
		 }
	?>>
	
	<br>
    <br>

    <br>
    <br>
    <h2 class="font-italic">Aquecimento</h2>
    <input type="checkbox" name="buttonHot" data-on-color="success" data-off-color="danger" <?php 
		 $state = system('gpio -g read 21');
		 if($state == 1) {
			 echo "checked";
		 }
	?>>
    <br>
    <br>
    <br>
    <a href="index+Temperatura_Automatica.php">
        <button type="button" class="btn btn-primary">Modo Automático</button>
    </a>
    </div>
</div>

   <script type="text/javascript">

        $(document).ready(function () {
            <!--  -->
            
			
			setInterval(function() {
				$.get( "temperature.php", function( data ) {
				$( "#temperature" ).html( data );
				console.log(data);
				});
			}, 5000);
			
			setInterval(function() {
				$.get( "animation.php", function( data ) {
				$( "#animation" ).html( data );
				console.log(data);
				});
			}, 5000);
			
			
			
			$("[name='buttonCold']").bootstrapSwitch();
			$("input[name='buttonCold']").on("switchChange.bootstrapSwitch", function(event, state) {
			  if(state) {
				  // ON
				  $.get("pinonCOLD.php");
				  $.get("pinoffHOT.php");
			  }
			  else {
				  // OFF
				  $.get("pinoffCOLD.php");
			  }
			});
			
			$("[name='buttonHot']").bootstrapSwitch();
			$("input[name='buttonHot']").on("switchChange.bootstrapSwitch", function(event, state) {
			  if(state) {
				  // ON
				  $.get("pinonHOT.php");
				  $.get("pinoffCOLD.php");
				  
			  }
			  else {
				  // OFF
				  $.get("pinoffHOT.php");
			  }
			});

        });
    </script>

</body>
</html>