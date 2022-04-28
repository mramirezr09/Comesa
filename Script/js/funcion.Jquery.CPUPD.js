$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#mod_cp").on('change', function () { //recupera el name de html controlador de eventos
		let postal = $("#mod_cp").val();

		$.post('/APP/Controller/Controller-camposCP.php',
			{est: postal},
			//{sexod: sexo},
			function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
				$("#mod_nombree").html(data); //combo1 retorna el resutlado
				//$("#sexo").val(data);
			}
		);

		$.post('/APP/Controller/Controller-camposCP.php',
			{mun: postal},
			//{sexod: sexo},
			function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
				$("#mod_municipio").html(data); //combo1 retorna el resutlado
				//$("#sexo").val(data);
			}
		);

		$.post('/APP/Controller/Controller-camposCP.php',
			{col: postal},
			//{sexod: sexo},
			function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
				$("#mod_colonia").html(data); //combo1 retorna el resutlado
				//$("#sexo").val(data);
			}
		);
	});
});
