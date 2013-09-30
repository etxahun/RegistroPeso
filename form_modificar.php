<?php
	include_once('conexion.php');

	// PRIMERA QUERY ----------------------------------------------------------------------------------
	$per = mysql_query("SELECT * FROM personas WHERE id=" . $_POST['id']);
	
	//Calculamos el número de filas devueltas
	$num_rs_per = mysql_num_rows($per);	
	if ($num_rs_per==0){
		echo "No existen personas con ese ID.";
		exit;
	}
	//Accedemos a los diferentes valores de la fila
	$rs_per = mysql_fetch_assoc($per);
	
	// SEGUNDA QUERY ----------------------------------------------------------------------------------
	$datos = mysql_query("SELECT peso FROM medidas WHERE personas_id=".$_POST['id']." AND fecha='".$_POST['fecha']."'");
	$peso_kk = mysql_fetch_assoc($datos);
	
?>

<html>
<head>
	<script language="javascript" type="text/javascript">

		$(document).ready(function(){
			$("#frm_per").validate({
				submitHandler: function(form) {
					//var respuesta = confirm('\xBFDeseas modificar el peso de esta persona?')
					//if (respuesta)
						form.submit();
				}
			});

		});


		function fn_modificar(){
			var str = $("#frm_per").serialize();
			$.ajax({
				url: 'modificar.php',
				data: str,
				type: 'post',
				success: function(data){
					if(data != "")
						alert(data);
					fn_cerrar();
					$('#result').load("listar2.php");
					$('#estadisticas').load("estadisticas2.php");
					$('#grafica').load("grafika.php");
				}
			});
		};
	</script>	
</head>
<body>
<h2>Modificar datos de usuario</h2>
<p>Por favor rellena el siguiente formulario:</p>
<form action="javascript: fn_modificar();" method="post" id="frm_per">
	<input type="hidden" id="id" name="id" value="<?php echo $rs_per['id']?>" />
	<input type="hidden" id="id_medida" name="id_medida" value="<?php echo $_POST['id_medida']?>" />
    <table class="formulario">
        <tbody>
            <tr>
                <td>Nombre</td>
                <td><input name="nombre" type="text" id="nombre" size="10" value="<?php echo $rs_per['nombre']?>" /></td>
            </tr>
            <tr>
                <td>Peso</td>          
                <td><input name="peso" type="text" id="peso" size="10" value="<?php echo $peso_kk['peso']?>" /></td>

            </tr>
            <tr>
                <td>Fecha</td>
				<td><input name="fecha" type="text" id="fecha" size="10" value="<?php echo $_POST['fecha'] ?>" /></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <input name="cancelar" type="button" id="cancelar" value="Cancelar" onclick="fn_cerrar();" />
                    <input name="modificar" type="submit" id="modificar" value="Modificar" />
                </td>
            </tr>
        </tfoot>
    </table>
</form>
</body>
</html>