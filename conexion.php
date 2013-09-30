<?php 
// Conectar y selecionar la Base de datos
$link = mysql_connect('localhost', 'esb', 'etxahun') or die('Mierdaa!!!: ' . mysql_error());
mysql_select_db('esb_pesos') or die('No se ha seleccionado la base de datos');
?>
