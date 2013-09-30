<?php
    include_once('conexion.php');

	//$sql = sprintf("DELETE FROM medidas WHERE personas_id='%s'",$_POST['id']);
	//$sql="DELETE FROM medidas WHERE personas_id=".$_POST['id']."AND fecha=".$_POST['fecha'];
	
	//mysql_query("DELETE FROM personas WHERE id=".$_POST['id']);
		
	//mysql_query("DELETE FROM medidas WHERE personas_id=".$_POST['id']." AND fecha='".$_POST['fecha']."'");
	
	mysql_query("DELETE FROM medidas WHERE personas_id=".$_POST['id']." AND id=".$_POST['id_medida']);
	
?>