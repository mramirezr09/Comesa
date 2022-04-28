	    function obten_contrato(id)// construye la bitacora de seguimiento
{
	var q= $("#q").val();
	
		$.ajax({
			type: "POST",
			url: "/APP/Controller/Controller-Creartraslado.php",
			data: "id="+id,"q":q,
			beforeSend: function(objeto){
				$("#ObtenBitacora").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#ObtenBitacora").html(datos);
				
			}
		});
	
}	