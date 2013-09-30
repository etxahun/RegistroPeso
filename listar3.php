<?php
include_once('conexion.php');
require_once 'classes/Membership.php';

$membership = New Membership();
$membership->confirm_Member();



//Selecionamos ID y NOMBRE de la tabla PERSONAS
// y calculamos cuantas filas nos devuelve la consulta.
$resultado1=mysql_query("SELECT id,nombre FROM personas WHERE nombre='".(ucfirst($_SESSION['usuario']))."'");	
$rows=mysql_num_rows($resultado1);

//Definimos una variable que nos sirva de contador
$n=0;

?>
<p>Primeros 10 registros recogidos de <em><b class="esb"><?php echo 
(ucfirst($_SESSION['usuario'])); ?></b></em>:</p>
<table id="tabla_resultados">
<thead align="center">
	<tr>
		<!-- <th>ID</th> -->
		<th>#</th> 
		<th>Nombre</th>
		<!-- <th>ID Medida</th> -->
		<th>Peso</th>
		<th>Fecha</th>
		<th>Acción</th>		
	</tr>
</thead>
<tbody>

<?php
while ($rows >0) :
	
	$id=mysql_result($resultado1,$n);
	
	//$resultado2=mysql_query("select fecha,peso from medidas where personas_id=" . $id) or die('Error al procesar consulta: ' . mysql_error());
	
	// Como la fecha en la tabla de la base de datos está en formato (YYYY-MM-DD) hacemos un cambio de formato de fecha con 
	// "DATE_FORMAT(fecha, '%d-%m-%Y')
	$resultado2=mysql_query("SELECT id,peso,DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha FROM medidas WHERE personas_id=".$id." LIMIT 0, 10") 
		or die('Error al procesar consulta: ' . mysql_error());
	
	$medidas=mysql_num_rows($resultado2);
	
	//Definimos otra variable que nos sirve de contador para el segundo while
	$m=0;
	
	while ($medidas >0) :
	
	//Selecionamos las fechas de la tabla MEDIDAS
	// y seleccionamos cada una de las fechas.	
	$consultafecha=mysql_query("SELECT fecha FROM medidas WHERE personas_id=" . $id);
	$fecha=mysql_result($consultafecha,$m,0);

	$id_medida=mysql_result($resultado2,$m,0);
?>	
    	<tr>
    		<td><b><?php echo ($m+1)  ?></b></td> 
	   		<!-- <td><b><?php echo mysql_result($resultado1,$n)?>  ID de Persona -->
    		<td><b><?php echo mysql_result($resultado1,$n,1) ?></b></td> <!--"Nombre" de la tabla "personas"-->
    	<!-- <td><?php echo mysql_result($resultado2,$m,0) ?></td> "ID Medida" de la tabla "medidas" -->
    		<td><?php echo mysql_result($resultado2,$m,1) ?></td> <!--"Peso" de la tabla "medidas"-->
    		<td><?php echo mysql_result($resultado2,$m,2) ?></td> <!--"Fecha" de la tabla "medidas"-->	
			<td colspan="2">
				<a href="javascript: fn_eliminar(<?php echo "$id,'$fecha',$id_medida" ?>);"><img src="ico/delete.png" /></a>
				<a href="javascript: fn_mostrar_frm_modificar(<?php echo "$id,'$fecha',$id_medida" ?>);"><img src="ico/page_edit.png" /></a>
			</td>
			
    	</tr>    
<?php
	$m++;
	$medidas--;
	endwhile; //Cerramos el "While" interno

$n++;
$rows--;
endwhile; // Cerramos el "While" externo
?>

</tbody>
</table>
