$(document).ready(function() {
	
	<!-- Cargamos el contenido de la bbdd con listar3.php -->
	
	$('#result').load("listar3.php");
	
	$('#estadisticas').load("estadisticas2.php");
	
 	$('#grafica').load("grafika.php");
		
	<!-- Esta primera parte, crea un loader no es necesaria -->
	$().ajaxStart(function() {
	<!-- Enviamos el formulario usando AJAX -->
		$('#loading').show();
		$('#result').hide();
	}).ajaxStop(function() {
		$('#loading').hide();
		$('#result').fadeIn('slow');
	});
	
	<!-- Seleccionar fecha con "datepicker" -->
	$(function() {
	    $( '#fecha' ).datepicker({dateFormat: 'yy-mm-dd'});
	});
	
	<!-- Interceptamos el evento submit -->
	$('#form, #fo3').submit(function() {
		$.ajax({
    		type: 'POST',
    		url: $(this).attr('action'),
    		data: $(this).serialize(),
    		<!-- Mostramos un mensaje con la respuesta de PHP -->
    		success: function(data) {
        	 	$('#result').html(data);
				//alert("kakaaa");
				$('#nombre').val("");
				$('#peso').val("");
				$('#fecha').val("");
				//Tambíen valdria:
				//$('#fo3')[0].reset();	
				$('#estadisticas').load("estadisticas2.php");	
				$('#grafica').load("grafika.php");					
    			}
	 	  	})
	 return false;
	 });
	
}) <!-- Fin de $(document)...	-->


function fn_eliminar(id,fecha,id_medida){
	var respuesta = confirm("Deseas eliminar este peso?");
	
	if (respuesta){
		$.ajax({
			type: 'POST',
			url: 'eliminar.php',
			data: {
				id: id,
				fecha: fecha,
				id_medida: id_medida
			},
			success: function(data){
				if(data!="")
					alert(data);
				$('#result').load("listar3.php");
				$('#estadisticas').load("estadisticas2.php");
				$('#grafica').load("grafika.php");
			}
		});
	}
}

function fn_mostrar_frm_modificar(id,fecha,id_medida){
	$("#div_oculto").load("form_modificar.php", {id: id, fecha: fecha, id_medida: id_medida}, function(){
		$.blockUI({
			message: $('#div_oculto'),
			css:{
				top: '10%'
			}
		}); 
	});
};

function fn_cerrar(){
	$.unblockUI({ 
		onUnblock: function(){
			$("#div_oculto").html("");
		}
	}); 
};

