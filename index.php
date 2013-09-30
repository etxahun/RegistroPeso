<?php
include_once('conexion.php');
require_once 'classes/Membership.php';

// Comprobamos que tenga una sesión iniciada, en caso contrario no cargara index.php
$membership = New Membership();
$membership->confirm_Member();

$resultado=mysql_query("SELECT peso FROM medidas");

$interests=array();

while($row = mysql_fetch_assoc($resultado))
{
    $interests[] = $row['peso'];
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registro de Pesos</title>
	<!-- Todos los estilos a aplicar -->
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/cupertino/jquery-ui-1.9.1.custom.css">
	
	<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
	<script src="js/jquery.validate.js" type="text/javascript"></script>
	<script src="js/jquery.blockUI.js" type="text/javascript"></script>
	<script src="js/jquery-ui-1.9.1.custom.js" type="text/javascript"></script>
	
	<!-- Recopilo todas las funciones y código javascript en main.js -->
	<script src="js/main.js" type="text/javascript"></script> 
	
	<!-- HighCharts: Para las gráficas-->
	<script src="js/highcharts/highcharts.js" type="text/javascript"></script>
	<script src="js/highcharts/modules/exporting.js" type="text/javascript"></script>
	<script src="js/highcharts/themes/grid.js" type="text/javascript"></script>
		
</head>
<body>
	<fieldset id="estad">
		<legend><b>Registro de Pesos</b></legend>	
			
				<p> Bienvenido <em><b class="esb"><?php echo $_SESSION['usuario']; ?></b></em>, en esta página puedes registrar tu peso.</p>
				<input type="button" class="button" onclick="location.href='login.php?status=loggedout'" value="Logout">

				<!-- Inicialmente tenia lo siguiente:
				<a href="login.php?status=loggedout">Log Out</a>
				-->
	</fieldset>
	
	<div id="registro">
	<FORM method="post" action="envio.php" id="fo3" name="fo3">
		<fieldset>
			<legend><b>Registro de Pesos</b></legend>
				<p><b>Introduce tu peso</b></p>
				<p style="border-bottom:solid 1px black;"></p>

			<table align="left" border="0">
					<td align="left" width="70"><b>Nombre: </b></td>
					<td align="center" width="150">
						<input type="text" id="nombre" class="required" name="nombre" maxlength="25" value="">
					</td>
				<tr>
					<td align="left" width="70"><b>Peso: </b></td>
					<td align="center" width="150">
						<input type="text" id="peso" class="required" name="peso" maxlength="25" value="">
					</td>
				<tr>
					<td align="left" width="70"><b>Fecha: </b></td>
					<td align="center" width="150">
						<input type="text" id="fecha" class="required" name="fecha" maxlength="25" value="">
					</td>
				<tr>
					<td align="center" width="110" class="nirea">
					</br>
						<input type="submit" name="mysubmit" value="Enviar">
						<input type="reset" name="myreset" value="Reset">
					</td>
			</table>
			
		</fieldset>
	</form>
	<!--	
	<form method="post" action="envio.php" id="fo3" name="fo3" >
      	<fieldset>
      		<legend><b>Registro de Pesos</b></legend>
				<p><b>Introduce tu peso:</b></p>
      			<ul>	
        			<li>
						<label><b>Nombre: </b></label>
						<input type="text" size="11" id="nombre" class="required" name="nombre" />
					</li>
					<br />
   		        	<li>
						<label><b>Peso: </b></label>
						<input type="text" size="13" id="peso" class="required" name="peso" />
					</li>
   		        	<br />
					<li>
						<label><b>Fecha: </b></label>
						<input type="text" size="12" id="fecha"  class="required" name="fecha" />
					</li>
        		</ul>
        	<input type="submit" name="mysubmit" value="Enviar">
			<input type="reset" name="myreset" value="Reset">
      	</fieldset>
	</form>
	-->
	</div>
	
	<div id="div_oculto" style="display: none;"></div>
	
	<div id="result"></div> 
	
	<div id="estadisticas"></div>

    <!-- Gráfica generada con HighCharts -->
    <div id="grafica" style="width: 800px; height: 500px; margin: 0 auto; margin-top:25px"></div>
		
</body>
</html>
