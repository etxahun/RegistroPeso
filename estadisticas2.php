<?php
include_once('conexion.php');

//==========NUMERO DE FILAS===================================================================
$consultafilas=mysql_query("SELECT peso FROM medidas");	
$filas=mysql_num_rows($consultafilas);

$n=0;

//=================================ESTADISTICAS===============================================

//Numero de personas registradas
$consultaregistros=mysql_query("SELECT id FROM personas");	
$numpersreg=mysql_num_rows($consultaregistros);

//============================================================================================

//Personas más GORDA
$consultamaxpeso=mysql_query("SELECT MAX(peso) as peso FROM medidas");
$a=mysql_fetch_row($consultamaxpeso);
$pesomaxvalor=$a[0];

$q1=mysql_query("SELECT personas_id FROM medidas WHERE peso='$pesomaxvalor'");

//============================================================================================

//Persona más FLACA
$consultaminpeso=mysql_query("SELECT MIN(peso) as peso FROM medidas");
$d=mysql_fetch_row($consultaminpeso);
$pesominvalor=$d[0];

$q3=mysql_query("SELECT personas_id FROM medidas WHERE peso='$pesominvalor'");

//============================================================================================

//Peso medio de Etxahun
$q5=mysql_query("SELECT id FROM personas WHERE nombre='Etxahun'");
$id=mysql_fetch_assoc($q5);
$idetxahun=$id["id"];

$q6="SELECT SUM(peso) as pesomedio FROM medidas WHERE personas_id='$idetxahun'";
$kaka=mysql_query($q6);
$sumapesos=mysql_fetch_array($kaka);
$pesototaletxahun=$sumapesos[0];

$q7="SELECT * FROM medidas WHERE personas_id='$idetxahun'";
$res=mysql_query($q7);
$num=mysql_num_rows($res);

$pesomedio=$pesototaletxahun/$num;


//============================================================================================


?>

<fieldset id="estad">
	<legend><b>Estadísticas</b></legend>
	<ul>	
		<li><label><b>Nº Personas Registradas: </b></label><?php echo $numpersreg ?></li>
		<br />
		<li><label><b>Peso medio de Etxahun: </b></label><em><?php 
			 echo round($pesomedio,2);
		 ?></em><b> Kg.</b></li>
		<br />		
		<li><label><b>Personas más gordas con <em></b><?php echo $pesomaxvalor?></em><b> Kg:</b></label>
		</br>
		<?php		
		while ($fila = mysql_fetch_array($q1, MYSQL_ASSOC)) {
			$b=$fila["personas_id"];
		    $q2=mysql_query("SELECT nombre FROM personas WHERE id='$b'");
			$c=mysql_fetch_row($q2);
			?>
			<ul>
				<li><label><?php printf("%s", $c[0]);?></label></li>
			</ul>
			<?php			
		}		
		?></li>
		<br />
		<li><label><b>Personas más flacas con <em></b><?php echo $pesominvalor?></em><b> Kg:</b></label>
		</br>
		<?php		
		while ($fila = mysql_fetch_array($q3, MYSQL_ASSOC)) {
			$e=$fila["personas_id"];
		    $q4=mysql_query("SELECT nombre FROM personas WHERE id='$e'");
			$f=mysql_fetch_row($q4);
			?>
			<ul>
				<li><label><?php printf("%s", $f[0]);?></label></li>
			</ul>
			<?php			
		}		
		?></li>

	</ul>
</fieldset>
