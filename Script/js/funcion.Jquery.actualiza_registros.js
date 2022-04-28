$( "#upd_DP" ).submit(function( event ) {
	$('#upd_data').attr("disabled", true);
	var parametros = $(this).serialize();
    $.ajax({
		type: "POST",
		url: "/APP/Controller/Controller-RegistroUPD.php",
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
	console.log(id);
	var nombrer = $("#nombrer"+id).val();
	var apellidoP = $("#apellidoP"+id).val();
	var apellidoM = $("#apellidoM"+id).val();
	var edad = $("#edad"+id).val();
	var sexoid = $("#sexoid"+id).val();
	var estadocid = $("#estadocid"+id).val();
	var puesto = $("#puesto"+id).val();
	var curp = $("#curp"+id).val();
	var curpa = $("#curpa"+id).val();
	var rfc = $("#rfc"+id).val();
	var fechaN = $("#fechaN"+id).val();
	var lugarN = $("#lugarN"+id).val();
	var nacion = $("#nacion"+id).val();
	var mail = $("#mail"+id).val();
	var numT = $("#numT"+id).val();
	var nombree = $("#nombree"+id).val();
	var cp = $("#cp"+id).val();
	var municipio = $("#municipio"+id).val();
	var colonia = $("#colonia"+id).val();
	var calle = $("#calle"+id).val();
	var nss = $("#nss"+id).val();
	var numE = $("#numE"+id).val();
	var numI = $("#numI"+id).val();
	var banco = $("#banco"+id).val();
	var clabe = $("#clabe"+id).val();
	var siNoInf = $("#siNoInf"+id).val();
	var numInf = $("#numInf"+id).val();
	var tipoInf = $("#tipoInf"+id).val();
	var valorinf = $("#valorinf"+id).val();
	var nacionalidad = $("#nacionalidad"+id).val();

	var esqueman = $("#esqueman"+id).val();

	var contacto = $("#contacto"+id).val();
	var telcon = $("#telcon"+id).val();
	var ods = $("#ods"+id).val();
	var frente = $("#frente"+id).val();

	$("#mod_idu").val(id);
	$("#mod_nombre").val(nombrer);
	$("#mod_apellidoP").val(apellidoP);
	$("#mod_apellidoM").val(apellidoM);
	$("#mod_puesto").val(puesto);
	$("#mod_edad").val(edad);
	$("#mod_sexoid").val(sexoid);
	$("#mod_estadocid").val(estadocid);
	$("#mod_curpa").val(curpa);
	$("#mod_rfc").val(rfc);
	$("#mod_fechaN").val(fechaN);
	$("#mod_lugarN").val(lugarN);
	$("#mod_nacion").val(nacion);
	$("#mod_mail").val(mail);
	$("#mod_numT").val(numT);

	$("#mod_nss").val(nss);
	$("#mod_nombree").val(nombree);
	$("#mod_cp").val(cp);

	$("#mod_municipio").val(municipio);
	$("#mod_colonia").val(colonia);
	$("#mod_calle").val(calle);
	$("#mod_numE").val(numE);
	$("#mod_numI").val(numI);
	$("#mod_banco").val(banco);

	$("#mod_clabe").val(clabe);
	$("#mod_siNoInf").val(siNoInf);
	$("#mod_numInf").val(numInf);
	$("#mod_tipoInf").val(tipoInf);
	$("#mod_valorinf").val(valorinf);
	$("#mod_esqueman").val(esqueman);
	$("#mod_contacto").val(contacto);
	$("#mod_telcon").val(telcon);
	$("#mod_ods").val(ods);
	$("#mod_frente").val(frente);

}// JavaScript Document
