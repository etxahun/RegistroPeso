<?php
	include_once('conexion.php');
	
	/*verificamos si las variables se envian 
	
	if(empty($_POST['id']) || empty($_POST['nombre']) || empty($_POST['peso']) || empty($_POST['fecha'])){
		echo "No se han rellenado todos los campos.";
		exit;
	}
	*/
	
	/*Modificamos el registro de Persona y Medidas de esa persona
	  ===========================================================*/
	
	//Con esta primera QUERY actualizamos el nombre de la persona
	//$sql=sprintf("UPDATE personas SET nombre='%s' where id='%s'", $_POST['nombre'], $_POST['id']);
	
	//mysql_query("UPDATE personas SET nombre='".$_POST['nombre']."' WHERE id=".$_POST['id']) 
	//	or die('Error al modificar el nombre del usuario: ' . mysql_error());
	

	//Con esta segunda QUERY actualizamos los datos de la persona
	//$sql2=sprintf("UPDATE medidas SET peso='%s', fecha='%s' where personas_id='%s'", $_POST['peso'], $_POST['fecha'], $_POST['id']);
	
	mysql_query("UPDATE medidas SET peso=".$_POST['peso'].", fecha='".$_POST['fecha']."' WHERE id=".$_POST['id_medida']) 
		or die('Error al modificar el peso y fecha del usuario: ' . mysql_error());	

?>