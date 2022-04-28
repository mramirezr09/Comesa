
	   
	   function obtener_contrato(id)// construye la bitacora de seguimiento
{
	var q= $("#q").val();
	$("#cot_id").val(id);
		$.ajax({
			type: "POST",
			url: "/APP/View/Creacontrato.sgmx.view.php",
		  
			data: "id="+id,"q":q,
			beforeSend: function(objeto){
				$("#ObtenContrato").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#ObtenContrato").html(datos);
				
			}
		});
	
}	
	


/*
$( "#gen_cont" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
   
     $.ajax({
            type: "GET",
            url: "/APP/View/Creacontrato.sgmx.view.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_cont").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_cont").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
         }
    });
  event.preventDefault();
})











function obtener_contrato(id) {// construye la bitacora de seguimiento

var laid= "hola";
	
	$.ajax({

		url:'Controller-CrearContrato.php?action=ajax&id='+id+'&laid='+laid,
		
	beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Contrato...");
			},
			success: function(datos){
				$("#resultados").html(datos);
				load(1);
			}
		});
}


*/