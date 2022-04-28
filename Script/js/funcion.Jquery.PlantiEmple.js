$(document).ready(function(){
	load(1);
});

function load(page){
	var q= $("#q").val();
	var r= $("#r").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'/APP/Controller/Controller-PlantiEmple.php?action=ajax&page='+page+'&q='+q+'&r='+r,
		beforeSend: function(objeto){
			$('#loader').html('<img src="/Script/IMG/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})
}