$(document).ready(function(){
	load(1);
});

function load(page){
	var q= $("#q").val();
	var r= $("#r").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'/APP/Controller/Controller-ReporteBase.php?action=ajax&page='+page+'&q='+q+'&r='+r,
		beforeSend: function(objeto){
			$('#loader').html('<img src="/Script/IMG/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})
	console.log(q);
	console.log(r);
}



function eliminar (id)
{
	var q= $("#q").val();
	if (confirm("Realmente deseas eliminar el registro?")){	
		$.ajax({
			type: "GET",
			url: "./ajax/asistencia.php",
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