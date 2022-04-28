$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#postal").on('change', function () { //recupera el name de html controlador de eventos
		let postal = $("#postal").val();

		$.post('/APP/Controller/Controller-camposCP.php',
			{est: postal},
			//{sexod: sexo},
			function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
				$("#estadoD").html(data); //combo1 retorna el resutlado
				//$("#sexo").val(data);
			}
		);

		$.post('/APP/Controller/Controller-camposCP.php',
			{mun: postal},
			//{sexod: sexo},
			function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
				$("#muni").html(data); //combo1 retorna el resutlado
				//$("#sexo").val(data);
			}
		);

		$.post('/APP/Controller/Controller-camposCP.php',
			{col: postal},
			//{sexod: sexo},
			function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
				$("#colo").html(data); //combo1 retorna el resutlado
				//$("#sexo").val(data);
			}
		);
	});
});
