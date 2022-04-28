$( "#upd_user" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
   
     $.ajax({
            type: "POST",
            url: "/APP/Controller/Controller-credencialgestion.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_foto").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_foto").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
         }
    });
  event.preventDefault();
})

    function obtener_foto(id){
		var nombre = $("#nombre"+id).val();
            var nombrer = $("#nombrer"+id).val();
			var apellidoP = $("#apellidoP"+id).val();
			var apellidoM = $("#apellidoM"+id).val();
			var registroid = $("#registroid"+id).val();
			var puestoid = $("#puestoid"+id).val();
			var edad = $("#edad"+id).val();
			var puesto = $("#puesto"+id).val();
            var curp = $("#curp"+id).val();
			var rfc = $("#rfc"+id).val();
            var fechaN = $("#fechaN"+id).val();
			var lugarN = $("#lugarN"+id).val();
			var nacion = $("#nacion"+id).val();
			var mail = $("#mail"+id).val();
			var numT = $("#numT"+id).val();
			var nombreE = $("#nombreE"+id).val();
			var cp = $("#cp"+id).val();
			var EsquemaN = $("#EsquemaN"+id).val();
			var municipio = $("#municipio"+id).val();
			var colonia = $("#colonia"+id).val();
			var calle = $("#calle"+id).val();
			var nss = $("#nss"+id).val();
			var numE = $("#numE"+id).val();
			var sexo = $("#sexo"+id).val();
			var numI = $("#numI"+id).val();		
			var banco = $("#banco"+id).val();
			var clabe = $("#clabe"+id).val();
			var siNoInf = $("#siNoInf"+id).val();
			var numInf = $("#numInf"+id).val();
			var tipoInf = $("#tipoInf"+id).val();
			var valorInf = $("#valorInf"+id).val();
				var nacionalidad = $("#nacionalidad"+id).val();
					var sexoid = $("#sexoid"+id).val();
			
			
			$("#mod_id").val(id);
			$("#mod_nombrec").val(nombre);
			$("#mod_nombre").val(nombrer);
			$("#mod_apellidoP").val(apellidoP);
			$("#mod_apellidoM").val(apellidoM);
			$("#mod_registroE").val(registroid);
			$("#mod_pueston").val(puesto);
			$("#mod_puesto").val(puestoid);
			$("#mod_edad").val(edad);
			$("#mod_curp").val(curp);
			$("#mod_rfc").val(rfc);
			$("#mod_fechaN").val(fechaN);
			$("#mod_lugarN").val(lugarN);
            $("#mod_nacion").val(nacion);
            $("#mod_mail").val(mail);
			$("#mod_numT").val(numT);
			$("#mod_numse").val(nss);
			$("#mod_nombreE").val(nombreE);
			$("#mod_cp").val(cp);
			$("#mod_esquemaN").val(EsquemaN);
			$("#mod_municipio").val(municipio);
			$("#mod_colonia").val(colonia);
			$("#mod_calle").val(calle);
			$("#mod_numE").val(numE);
			$("#mod_numI").val(numI);
			$("#mod_banco").val(banco);
			$("#mod_sexo").val(sexo);
			$("#mod_clabe").val(clabe);
			$("#mod_siNoInf").val(siNoInf);
			$("#mod_numInf").val(numInf);
			$("#mod_tipoInf").val(tipoInf);
				$("#mod_nacionalidad").val(nacionalidad);
				$("#mod_sexoid").val(sexoid);
			
        }// JavaScript Document