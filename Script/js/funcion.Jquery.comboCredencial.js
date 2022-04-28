//proyecto
$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#credencial").on('change', function () { //recupera el name de html controlador de eventos
		$("#credencial option:selected").each(function () {//recorrer opciones del combo
			combo1=$(this).val(); //definir valor de comboP
			$.post("/APP/Controller/Controller-lacredencial.php",
				{combo1: combo1},
				function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
					$("#mostrar").html(data); //combo1 retorna el resutlado
				}
			); 
		});
	});
	
	
	/*
		$(document).ready(function(){ //document readi condiciona el documento y obliga a seleccionar los campos recagra unicamente el campo
	$("#boton").on('click', function () { //recupera el name de html controlador de eventos
		 $.get( "APP/Controller/Fotos/Controller-cargafoto.php", { // Aquí pones tu php que procesa el valor
                boton: $('#boton').val()  // recoges el valor
               });
          },
				function(data){//retorna valores a html //comboP: indice y comboP se envia al controlador
					 alert("Valor recibido"); // Esto es el callback, se ejecuta tras que se ha devuelto respuesta del servidor
				}
			); 
		});
	
	*/
	
	});
	
//envia Id de la credencial


