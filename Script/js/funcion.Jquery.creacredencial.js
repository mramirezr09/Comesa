$( "#creac" ).submit(function( event ) { //inicia la funcion de JavaScript
	$('#creac').attr("disabled", true);  
	var parametros = $(this).serialize(); //toma todos los datos del formulario   
    $.ajax({
		beforeSend: function(objeto){ //inicia la funcion de animacion
			$("#result_cre").html("Mensaje: Cargando..."); //mensaje de carga
		},
		type: "POST", //indica como enviara los datos en seguridad
		url: "/APP/View/Creacredencial.sgmx.view.php", //indica la ruta a donde enviara los datos
		data: parametros, //indica como enviara los datos
		success: function(datos){			
			$("#result_cre").html(datos);
			$('#creac').attr("disabled", false);
			load(1);
		}
	});
	
	event.preventDefault(); //evita que se ejecute la accion por default	
})

function obtener_credencial(id) {  //inicia la funcion de recuperar el id
	$("#cred").val(id); //recuera la variable de id
}// JavaScript Document