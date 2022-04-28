/*
$( "#upd_user" ).submit(function( event ) {
	$('#upd_data').attr("disabled", true);  
	var parametros = $(this).serialize();   
    $.ajax({
            type: "POST",
            url: "/APP/Controller/Controller-controlcostos.php",
            data: parametros,
            beforeSend: function(objeto){
				$("#result_costos").html("Mensaje: Cargando...");
            },
            success: function(datos){
				$("#result_costos").html(datos);
				$('#upd_data').attr("disabled", false);
				load(1);
			}
    });
  event.preventDefault();
})
*/
function obtener_costos(id) {
	$("#mod_ide").val(id);
}// JavaScript Document