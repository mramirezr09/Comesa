$(document).ready(function(){
	load(1);
});

function load(page){
	var q= $("#q").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'/APP/Controller/Controller-ArmaPrefactura.php?action=ajax&page='+page+'&q='+q,
		beforeSend: function(objeto){
			$('#loader').html('<img src="/Script/IMG/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".query_ods").html(data).fadeIn('slow');
			$('#loader').html('');
			console.log('funciona');
		}
	})
}


function eliminar (id)
{
	var q= $("#q").val();
	if (confirm("Realmente deseas eliminar el registro?")){
		$.ajax({
			type: "GET",
			url: "./ajax/tickets.php",
			data: "id="+id,"q":q,
			beforeSend: function(objeto){
				$("#resultados").html("Mensaje: Cargando...");
			},
			success: function(datos){
				$("#resultados").html(datos);
				load(1);
			}
		});
	}
}
