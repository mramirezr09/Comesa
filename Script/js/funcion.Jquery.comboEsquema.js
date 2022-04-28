//proyecto
$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#esquema").on('change', function () { //recupera el name de html controlador de eventos
		$("#esquema option:selected").each(function () {//recorrer opciones del combo
			combo1=$(this).val(); //definir valor de comboP
			$.post("/APP/Controller/Controller-comboArchivos.php",
				{combo1: combo1},
				function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
					$("#combo1").html(data); //combo1 retorna el resutlado
				}
			); 
		});
	});
	
	});