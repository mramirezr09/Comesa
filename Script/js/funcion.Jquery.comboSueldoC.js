//proyecto
$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#puesto-re").on('change', function () { //recupera el name de html controlador de eventos
		$("#puesto-re option:selected").each(function () {//recorrer opciones del combo
			part=$(this).val(); //definir valor de comboP
			$.post("/APP/Controller/Controller-comboSueldoC.php",
				{part: part},
				function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
					$("#part").html(data); //combo1 retorna el resutlado
				}
			); 
	
		});
	});
	
	//Categoria
	$("#puesto-re").on('change',function() { //recupera el name de html controlador de eventos
		$("#puesto-re option:selected").each(function() { //recorrer opciones del combo
			fase = $(this).val(); //definir valor de comboP
			$.post("/APP/Controller/Controller-comboSueldoC2.php",
				{fase: fase}, //comboP: indice y comboP se envia al controlador
				function(data){//retorna valores a html
					$("#fase").html(data); //combo1 retorna el resutlado
				}
			);		
		});
	});
	

});