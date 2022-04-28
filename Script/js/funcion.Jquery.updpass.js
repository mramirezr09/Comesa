$( "#upd_pass" ).submit(function( event ) {
  $('#upd_data').attr("disabled", true);
  
 var parametros = $(this).serialize();
   
     $.ajax({
            type: "POST",
            url: "/APP/Controller/Controller-updpass.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#result_user2").html("Mensaje: Cargando...");
              },
            success: function(datos){
            $("#result_user2").html(datos);
            $('#upd_data').attr("disabled", false);
            load(1);
          }
    });
  event.preventDefault();
})

/*

    function obtener_datos(id){
var status = $("#status"+id).val();
			var nombre = $("#nombre"+id).val();
			var pro = $("#pro"+id).val();
			var supervisor = $("#supervisor"+id).val();
			var perfil = $("#perfil"+id).val();
            var sexo = $("#sexo"+id).val();
            var peri = $("#peri"+id).val();
			var desca = $("#desca"+id).val();
			var eciv = $("#eciv"+id).val();
			var domi = $("#domi"+id).val();
			var mail = $("#mail"+id).val();
			var banco = $("#banco"+id).val();
			var cuenta = $("#cuenta"+id).val();
			var clabe = $("#clabe"+id).val();
			var rfc = $("#rfc"+id).val();
			var curp = $("#curp"+id).val();
			var nss = $("#nss"+id).val();
			var fenac = $("#fenac"+id).val();
			var lunac = $("#lunac"+id).val();
			var fein = $("#fein"+id).val();
			var info = $("#info"+id).val();
			var ninfo = $("#ninfo"+id).val();
			var finfo = $("#finfo"+id).val();
			var edad = $("#edad"+id).val();
			var tel = $("#tel"+id).val();
			var area = $("#area"+id).val();
			var clavepu = $("#clavepu"+id).val();
			var npuesto = $("#npuesto"+id).val();
			var sueldo = $("#sueldo"+id).val();
			var sbc = $("#sbc"+id).val();
			
			var mensual = $("#mensual"+id).val();
			var quince = $("#quince"+id).val();
			var brutomes = $("#brutomes"+id).val();
			
		
			
			
			$("#mod_id").val(id);
			$("#mod_user").val(id);
			$("#mod_status").val(status);
			$("#mod_nombre").val(nombre);
			 $("#mod_pro").val(pro);
			 $("#mod_supervisor").val(supervisor);
			 $("#mod_perfil").val(perfil);
			$("#mod_sexo").val(sexo);
            $("#mod_peri").val(peri);
            $("#mod_desca").val(desca);
			$("#mod_eciv").val(eciv);
			$("#mod_domi").val(domi);
			$("#mod_mail").val(mail);
			$("#mod_banco").val(banco);
			$("#mod_cuenta").val(cuenta);
			$("#mod_clabe").val(clabe);
			$("#mod_rfc").val(rfc);
			$("#mod_curp").val(curp);
			$("#mod_nss").val(nss);
			$("#mod_fenac").val(fenac);
			$("#mod_lunac").val(lunac);
			$("#mod_fein").val(fein);
			$("#mod_info").val(info);
			$("#mod_ninfo").val(ninfo);
			$("#mod_finfo").val(finfo);
			$("#mod_edad").val(edad);
			$("#mod_tel").val(tel);
			$("#mod_area").val(area);
			$("#mod_clavepu").val(clavepu);
			$("#mod_npuesto").val(npuesto);
			$("#mod_sueldo").val(sueldo);
			$("#mod_sbc").val(sbc);
			$("#mod_mensual").val(mensual);
			$("#mod_quince").val(quince);
			$("#mod_brutomes").val(brutomes);
        }// JavaScript Document

*/