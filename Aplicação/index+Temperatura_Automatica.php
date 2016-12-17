<!DOCTYPE html>
<html>
<head>
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
	
	<script type="text/javascript">

        $(document).ready(function () {
            <!--  -->
            
			$.get("getTemperature.php", function(data) {
				temperature = data.split(" ");
				$("#minimo").val(temperature[0]);
				$("#maximo").val(temperature[1]);
			});
			
			setInterval(function() {
				$.get( "temperature.php", function( data ) {
				$( "#temperature" ).html( data );
				console.log(data);
				});
			}, 5000);
			
			setInterval(function() {
				$.get( "animationAuto.php", function( data ) {
				$( "#animation" ).html( data );
				console.log(data);
				});
			}, 4000);
		});
		
		function atualizarValores() {
			min = parseInt($("#minimo").val());
			max = parseInt($("#maximo").val());
			
			if(isNaN(min)){
				$("#warn_min").css("display", "block");
				$("#warn_invalid_values").css("display", "none");
			}
			else {
				$("#warn_min").css("display", "none");
			}
			
			if(isNaN(max) || max == ""){
				$("#warn_max").css("display", "block");
				$("#warn_invalid_values").css("display", "none");
			}
			else {
				$("#warn_max").css("display", "none");
			}

			// verficar se o min e max são numeros
			if(isNaN(min) || isNaN(max)){
				return;
			}
			
			if(min >= max) {
				$("#warn_invalid_values").css("display", "block");
				return;
			}
			else {
				$("#warn_invalid_values").css("display", "none");
			}
			
			$.get("setTemperature.php?min="+min+"&max="+max, function(data) {
				temperature = data.split(" ");
				$("#minimo").value = temperature[0];
				$("#maximo").value = temperature[1]; 
			});
		}
	</script>
	
</head>
<?php 
	$Read_Temperature = exec("sudo ./teste", $output, $temperature);
	
	?>
<body class="bg-info">
<div class="container" style="text-align: center">
    <div class="bg-primary" style="border: 1px solid dodgerblue">
	<br>
	<br>
	<br>
	<h1><span id="temperature"><?= $Read_Temperature ?></span> &#8451;</h1>
	<span id="animation"></span>
	<style>
					#animation {
						position: absolute;
						left:middle;
						margin-left: -100px;
						top: 10px;
						
						}
					</style>
<br>


<br>
<br>
<br>
<br>
<br>
<br>

<br>
<span id="warn_invalid_values" style="display:none">O máximo não pode ser inferior ou igual ao minimo.</span><br>
<br>
					<span id="warn_max" style="display:none">Valor inválido para máximo</span><br>
valor Máximo <input id="maximo" value="" type="number" onchange="atualizarValores()" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();" style="color:black"  />

					<br>
					<span id="warn_min" style="display:none">Valor inválido para minimo</span><br>
valor Minimo <input id="minimo" value="" type="number" onchange="atualizarValores()" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();" style="color:black" />
<br>

<br>
	
<!--  Fim Tempertura-->

<br>
<br>
    <a href="index.php">
		<button type="button" class="btn btn-primary">Desativar Modo Automático</button>
    </a>
    </div>
</div>

</body>
</html>