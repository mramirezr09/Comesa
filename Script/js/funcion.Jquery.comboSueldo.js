//proyecto
$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#puest").on('change', function () { //recupera el name de html controlador de eventos
		$("#puest option:selected").each(function () {//recorrer opciones del combo
			part=$(this).val(); //definir valor de comboP
			$.post("/APP/Controller/Controller-comboSueldo.php",
				{part: part},
				function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
					$("#part").html(data); //combo1 retorna el resutlado
				}
			); 
		});
	});
	

});