<?php
include_once('conexion.php');

//----------------------- INCLUIMOS LOS DATOS DEL FORMULARIO EN LA BBDD-------------------

$nombre=mysql_escape_string($_POST['nombre']);
$peso=mysql_escape_string($_POST['peso']);
$fecha=mysql_escape_string($_POST['fecha']);

/*verificamos si se han rellenado todos los campos del nuevo usuario */

if(empty($nombre) || empty($peso) || empty($fecha))
	{
	 //echo "No se han rellenado todos los campos.";
	?>
	
		<script type="text/javascript">
			alert('No has rellenados todos los campos.');
		</script>
	
	<?php
	exit;
	}

$q=sprintf("SELECT id FROM personas WHERE nombre='%s'",$nombre);
$resultado=mysql_query($q);
$filas=mysql_num_rows($resultado);

if($filas == 0) {	
	$q2=sprintf("INSERT INTO personas (nombre) VALUES('%s')", $nombre);
	mysql_query($q2) or die('Error al procesar consulta: ' . mysql_error());	
	$resultado=mysql_query($q);
}

$id=mysql_result($resultado, 0);

$q3=sprintf("INSERT INTO medidas (peso, fecha, personas_id) VALUES ('%s','%s', '%s')", $peso, $fecha, $id);

mysql_query($q3) or die('Error al procesar consulta: ' . mysql_error());


//----------------------- LISTAR EL CONTENIDO DE LA BBDD ---------------------------------

include_once('listar2.php');

?>