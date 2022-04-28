<?php
/*$leyenda = "Where can I get some?
There are many variations of passages of Lorem Ipsum available,
but the majority have suffered alteration in some form, 
by injected humour, or randomised words which don't look even slightly believable.
If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything
embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend
to repeat predefined chunks as necessary, making this the first true generator on the Internet. 
It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, 
to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, 
injected humour, or non-characteristic words etc."

boton de aceptar genera codigo qr */

 $id_u=$_SESSION['id_sgmx'];
?>

<!-- Boton para generar el aviso de terminos y condiciones -->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-download"></i> Generar Lista de Asistencia</button>

<!-- Iniciar instrucciones de modal pa ventana -->
<div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header">

<!-- boton de cierre de modal -->
<button type="button" class="close" onClick="window.location.reload()" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-window-close" aria-hidden="true"></i></span>
</button>

<!-- Titulo del modal -->
<h4 class="modal-title"  center id="myModalLabel"><i class="fa fa-pencil-square-o"></i><center> Términos y condiciones de la aplicación WEB</center></h4>
</div>

<!--  Inicia cuerpo del modal -->
<div class="modal-body" id="asistencia">

<!-- entradas Validación-->

<form action ="<?php echo SRVURL;?>APP/ajax/class.sgmx.qrajax.php" method = "POST" data-form="vali" class="form-horizontal form-label-left input_mask FormularioAjax" autocomplete="off" enctype ="multipart/form-data">
<div id="result"></div>      
	  
<input type="hidden" value="<?php echo $id_u;?>" name="usuario">
<input type="hidden" value="3" name="documento">

<!--<p class="text-muted"> <center>Para poder generar tu Lista de asistencia,debes aceptar los <strong>Términos de uso</strong> y el procesamiento, tratamiento y transferencia de tus datos personales conforme a lo dispuesto en las <strong>Politicas de Privacidad. </center> </strong>.</p>
 -->   
<p class="text-muted"> <center> 
 <strong>1. Condiciones generales de uso y su aceptación </strong>
<br>
<br>
El presente aviso legal regula el acceso y el uso de los contenidos de la APLICACIÓN Web “Control de Asistencia Web”, del que PNPDMI, S. A. DE C. V., es titular y administrador. Su uso está sujeto a los términos y condiciones que se especifican a continuación.
Al utilizar el Control de Asistencia Web, usted acepta tales términos y condiciones y se somete a los mismos. Si no está de acuerdo con estos términos o con nuestra Política de confidencialidad, le informamos que no deberá utilizar el Control de Asistencia Web o los servicios ofrecidos en la misma, en caso contrario, consideraremos que existe aceptación por su parte.
La utilización de esta Aplicación Informática implica la plena aceptación de las condiciones y términos especificados en las Condiciones Generales de Uso publicada por PNPDMI, S. A. DE C. V., en el momento en que el Usuario acceda al Control de Asistencia Web. Por todo ello, el Usuario debe leer atentamente las presentes Condiciones cada vez que acceda a el Control de Asistencia Web, ya que podrían haber sido objeto de modificaciones.
<br>
<br>

 <strong>7. Aceptación de las Condiciones de acceso y uso </strong>
  <br>
 <br>
El acceso y uso del Control de Asistencia Web, así como de sus servicios y de la información incluida en el mismo implica la aceptación de su Política de Confidencialidad y de los términos especificados en las presentes Condiciones Generales de Uso. En caso de no estar de acuerdo con las mismas, no acceda o utilice esta Aplicación Informática.

</center>.</p>

                 
         
         
                           <div class="ln_solid"></div>
<div class="form-group">

<div class="col-md-9 col-sm-12 col-xs-12 col-md-offset-5">
<button type="submit" class="btn btn-success">  Aceptar</button>
<button type="button" class="btn btn-danger" onClick="window.location.reload()" data-dismiss="modal">Cancelar</button>
</div>
</div>    
<div class="RespuestaAjax"></div> <!-- Resultado de la peticion de Formulario AJAX-->
</form>
</div>                               



</div>
</div>
</div> <!-- /Modal -->
