$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#mod_curpa").on('change', function () { //recupera el name de html controlador de eventos
		var parteCurp = $("#mod_curpa").val();
		var anho = parseInt(parteCurp.substring(4,6));
		var mes = parteCurp.substring(6,8);
		var dia = parteCurp.substring(8,10);
		if(anho >=0 && anho <= 21){
			var fecha = dia +'/'+ mes +'/' + '200' + anho; //fecha de nacimiento
		}
		else{
			var fecha = dia +'/'+ mes +'/' + '19' + anho; //fecha de nacimiento
		}

		let hoy = new Date();
		let hoyanho = hoy.getFullYear();
		let hoymes = hoy.getMonth() + 1;
		let hoydia = hoy.getDate();

		let edad = hoyanho - parseInt(fecha.substring(6,10));
		if(hoymes < parseInt(mes)){
			edad --;
		}
		else if (hoymes == parseInt(mes)) {
			if(hoydia < dia){
				edad --;
			}
		}
		
		var sexo = parteCurp.substring(10,11); // sexo
		var luna = parteCurp.substring(11,13); // lugar de nacimiento
		console.log(sexo);
		$.post('/APP/Controller/Controller-camposCurp.php',
			{sexod: sexo},
			//{sexod: sexo},
			function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
				$("#mod_sexoid").html(data); //combo1 retorna el resutlado
				//$("#sexo").val(data);
			}
		);
		$.post('/APP/Controller/Controller-camposCurp.php',
			{lugarN: luna},
			//{sexod: sexo},
			function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
				$("#mod_luna").html(data); //combo1 retorna el resutlado
				//$("#sexo").val(data);
			}
		);
		$('#mod_edad').val(edad);
		$('#mod_fechaN').val(fecha);
	});
});
