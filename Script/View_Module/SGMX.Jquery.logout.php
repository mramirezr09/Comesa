<script>
$(document).ready(function(){
$('.btn-exit-system').on('click', function(e){// Jquery cierre de sesión
e.preventDefault();
var Token=$(this).attr('href');

swal({
title: '¿Esta seguro?',
text: "Su sesión actual se cerrara",
type: 'warning',
showCancelButton: true,
confirmButtonColor: '#03A9F4',
cancelButtonColor: '#F44336',
confirmButtonText: '<i class="zmdi zmdi-run"></i> Salir',
cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> Cancelar'
}).then(function () {
                      $.ajax({
						       url: '<?php echo SRVURL; ?>APP/Ajax/class.sgmx.loginajax.php?token='+Token,
							   success: function (data)
							   {
								   if(data="true")
								   {
									   swal
											(
											  "Hasta pronto",
											  "Gracias por registrar su asistencia",
											  "success"
											  		  
											);

									   window.location.href="<?php echo SRVURL?>login/";
								   }
								   else
								   {
									 
											swal
											(
											  "ocurrio un error",
											  "No se pudo cerrar la sesión",
											  "error"
											  
											);
								   }
							   }
							   
							   });
	
});
});
});
</script>