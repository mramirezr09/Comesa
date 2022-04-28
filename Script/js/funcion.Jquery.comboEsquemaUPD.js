//proyecto
$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#mod_esqueman").on('change', function () { //recupera el name de html controlador de eventos
		$("#mod_esqueman option:selected").each(function () {//recorrer opciones del combo
			comboUPD=$(this).val(); //definir valor de comboP
			$.post("/APP/Controller/Controller-comboArchivosUPD.php",
				{comboUPD: comboUPD},
				function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
					$("#comboUPD").html(data); //combo1 retorna el resutlado
				}
			); 
		});
	});
	
	});