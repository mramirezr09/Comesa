//proyecto
$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#frente").on('change', function () { //recupera el name de html controlador de eventos
		$("#frente option:selected").each(function () {//recorrer opciones del combo
			folio=$(this).val(); //definir valor de comboP
			$.post("/APP/Controller/Controller-comboFolio.php",
				{folio: folio},
				function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
					$("#folio").html(data); //combo1 retorna el resutlado
				}
			);
		});
	});
});

//proyecto
$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#modfrente").on('change', function () { //recupera el name de html controlador de eventos
		$("#modfrente option:selected").each(function () {//recorrer opciones del combo
			modfrente=$(this).val(); //definir valor de comboP
			$.post("/APP/Controller/Controller-comboFolio2.php",
				{modfrente: modfrente},
				function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
					$("#folio2").html(data); //combo1 retorna el resutlado
				}
			);
		});
	});
});
//proyecto
$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#frente3").on('change', function () { //recupera el name de html controlador de eventos
		$("#frente3 option:selected").each(function () {//recorrer opciones del combo
			folio=$(this).val(); //definir valor de comboP
			$.post("/APP/Controller/Controller-comboFolio3.php",
				{folio: folio},
				function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
					$("#folio3").html(data); //combo1 retorna el resutlado
				}
			);
		});
	});
});
