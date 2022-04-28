$( "#upd_filtro" ).submit(function( event ) {
	$('#upd_data').attr("disabled", true);
	var parametros = $(this).serialize();
    $.ajax({
		type: "POST",
		url: "/APP/Controller/Controller-FiltroUPD.php",
		data: parametros,
			beforeSend: function(objeto){
			$("#result_re").html("Mensaje: Cargando...");
			},
		success: function(datos){
		$("#result_re").html(datos);
		$('#upd_data').attr("disabled", false);
		load(1);
		}
	});

	event.preventDefault();
})

function obtener_datos(id){
	var nombrer = $("#nombrer"+id).val();
	var apellidoP = $("#apellidoP"+id).val();
	var apellidoM = $("#apellidoM"+id).val();
	var registroid = $("#registroid"+id).val();
	var estadocid = $("#estadocid"+id).val();
	var puesto = $("#puesto"+id).val();
	var curp = $("#curp"+id).val();
	var curpa = $("#curpa"+id).val();
	var fase = $("#fase"+id).val();
	var rfc = $("#rfc"+id).val();
	var numT = $("#numT"+id).val();
	var nombree = $("#nombree"+id).val();
    var filtroid = $("#filtroid"+id).val();
	var esqueman = $("#esqueman"+id).val();
	var nss = $("#nss"+id).val();
	var ods = $("#ods"+id).val();
	var frente = $("#frente"+id).val();
			
	$("#mod_id").val(id);
	$("#mod_idcom").val(id);
	$("#mod_nombre").val(nombrer);
	$("#mod_apellidoP").val(apellidoP);
	$("#mod_apellidoM").val(apellidoM);
	$("#mod_registroE").val(registroid);
	$("#mod_puesto").val(puesto);	
	$("#mod_estadocid").val(estadocid);
	$("#mod_curpa").val(curpa);
	$("#mod_rfc").val(rfc);
	$("#mod_numT").val(numT);
   $("#mod_filtroid").val(filtroid);
	$("#mod_nss").val(nss);
	$("#mod_nombree").val(nombree);
	$("#mod_nsueldo").val(puesto);
	$("#mod_fase").val(fase);

	$("#mod_ods").val(ods);
	$("#modfrente").val(frente);
	$("#mod_esqueman").val(esqueman);
	   

}// JavaScript Document
