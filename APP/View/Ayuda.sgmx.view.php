<?php 
    $id_u=$_SESSION['id_sgmx'];
	$conn = sqlsrv_connect(SERVER,CONNINF);

$query="
							SELECT 
							t1.PK_IdUsuario AS ID,
							t1.Nombre AS Nombre,
							t1.Mail AS Mail
							
							
							FROM [PSA.UsuarioAsistencia]t1
							LEFT JOIN [PSA.Perfil_Usuario]t2 ON t1.FK_IdPerfil=t2.PK_IdPerfil
							LEFT JOIN [PSA.Proyecto]t3 ON t1.FK_IdProyecto=t3.PK_IdProyecto
							LEFT JOIN [PSA.Horario_Empleado]t4 ON t1.FK_IdHorario=t4.PK_IdHorario
							WHERE t1.PK_IdUsuario=$id_u"
						;
						$dat= sqlsrv_query($conn,$query,PARAMS,OPTION);
						while ($res = sqlsrv_fetch_array($dat)) {
							$ID=$res['ID'];
							$nombre=$res['Nombre'];
							$mail=$res['Mail'];
							
                        }
	
?>




<div class="container">
<script src="<?php echo SRVURL; ?>Script/js/funcion.Jquery.close.js"></script>
        <div class="col-md-12">
            <div class="well well-sm">
          <div class="form-horizontal">
         <form action ="<?php echo SRVURL;?>APP/ajax/funcion.class.sgmx.ayudajax.php" 
         method = "POST" data-form="save" class="form-label-left input_mask FormularioAjax" 
         autocomplete="off" enctype ="multipart/form-data" class="form-horizontal">
                    <fieldset>
                    <div id="result"></div>
  <div>
                        <legend class="text-center ayuda-us"> ¿Tienes problemas con el sitio? <br> Contactanos</legend>
                        
                        <input type="hidden" id="fkid" name="fkid" value="<?php echo $ID;?>">
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="nombre-ay" name="nombre-ay" type="text" placeholder="Nombre" class="form-control"
                                 value="<?php echo $nombre;?>" readonly>
                            </div>
                        </div>
                     

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="email-ay" name="email-ay" type="text" placeholder="Correo" class="form-control"
                                value="<?php echo $mail;?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="tel-ay" name="tel-ay" type="number"  
                                placeholder="Phone" class="form-control" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                        
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            
                            <div class="col-md-8">
                            
                                <textarea class="form-control" id="ayuda" name="ayuda" required="required"
                                placeholder="Escribe tu duda o incidencia. en breve estaremos en contacto."
                                 rows="7"></textarea>
                            </div>
                        </div>
                         
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                            
                                <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                            </div>
                        </div>
                    </fieldset>
                    <div class="RespuestaAjax"></div>
                </form>
                <div class="clearfix"></div>
<div class="x_content">
      </div>
            </div>
        </div>
    </div>
</div>
