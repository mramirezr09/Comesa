$(document).ready(function(){
	load(1);
});

function load(page){
	var q= $("#q").val();
	var r= $("#r").val();
        var s= $("#s").val();
        var t= $("#t").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url:'/APP/Controller/Controller-EstadoMoviAfili.php?action=ajax&page='+page+'&q='+q+'&r='+r+'&s='+s+'&t='+t,
		beforeSend: function(objeto){
			$('#loader').html('<img src="/Script/IMG/ajax-loader.gif"> Cargando...');
		},
		success:function(data){
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');
		}
	})
}