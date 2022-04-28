<?php
 $id_u=$_SESSION['id_sgmx'];
?>

<!-- Iniciar instrucciones de modal pa ventana -->
<div class="modal fade bs-example-modal-lg-foto" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
			<!-- boton de cierre de modal -->
				<button type="button" class="close" onClick="window.location.reload()" data-dismiss="modal">
					<span aria-hidden="true">
						<i class="fa fa-window-close" aria-hidden="true"></i>
					</span>
				</button>		
				<h4 class="modal-title"  center id="myModalLabel"> 
					<i class="fa fa-camera"></i> 
					<center> Genera la credencial del empleado</center>
				</h4>
			</div>	  
			<div class="modal-body">
				<form class="form-horizontal form-label-left input_mask" method="post" id="upd_user" name="upd_user"> <!-- Llamada a Jquery -->
					<div id="result_foto"></div>		
					<input type="hidden" id="mod_id" name="mod_id">		  
					<style>
							@media only screen and (max-width: 100px) {
								video {
									max-width: 100%;
								}
							}
					</style>		  
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-6 col-xs-12 text-center" for="q">Dispositivo </label>
						<div class="col-md-4 col-sm-3 col-xs-12 form-group has-feedback ">
							<select name="listaDeDispositivos" id="listaDeDispositivos"></select> 
						</div>
					</div>
					<div class="center">					
						<p style="text-align:center;"> <video  class="center" muted="muted" id="video" width="300"></video> </p>
					</div>					
					<canvas id="canvas" style="display: none;"></canvas>					
					<div class="form-group">
						<!--apaterno-->
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left" for="nombrecom">Nombre Completo:</label>
						<div class="col-md-5 col-sm-4 col-xs-12">
							<input class="form-control" type="text" placeholder="Escribe tu apellido paterno" id="mod_nombrec" name="mod_nombrec">
						</div>
                    </div>
					
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left" for="pueston">Puesto: </label>
            			<div class="col-md-5 col-sm-4 col-xs-12">
							<input class="form-control" type="text" name="mod_pueston" id="mod_pueston">
						</div>
					</div>				  
					
					<div class="form-group">				   
						<!--RFC-->
        				<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left" for="rfc">Nss:</label>
        				<div class="col-md-5 col-sm-4 col-xs-12">
        					<input class="form-control" type="text" id="mod_numse" name="mod_numse">        							
        				</div>
					</div>
								
					<div class="form-group">
						<!--CURP-->
        				<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left" for="curp">CURP:</label>
        				<div class="col-md-5 col-sm-4 col-xs-12">
        					<input class="form-control" type="text" id="mod_curp"  style="text-transform:uppercase" placeholder="Escribe tu CURP" maxlength="18" name="mod_curp">        					
        				</div>
        			</div>
							
					<div class="form-group">
						<!--CURP-->
        				<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left" for="curp">Departamento:</label>
        				<div class="col-md-5 col-sm-4 col-xs-12">
        					<input class="form-control" type="text" id="mod_dep"  style="text-transform:uppercase" placeholder="Escribe tu Departamento" name="mod_dep">        					
        				</div>
        			</div>
							
					<div class="form-group">
						<!--apaterno-->
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left" for="apaterno">Vigencia:</label>
						<div class="col-md-5 col-sm-4 col-xs-12">
							<input  class="form-control" type="text" placeholder="Vigencia de la credencial" id="mod_vig" name="mod_vig">
						</div>
                    </div>
					
					<div class="form-group">
						<!--apaterno-->
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left" for="apaterno">Nombre Contacto:</label>
						<div class="col-md-5 col-sm-4 col-xs-12">
							<input class="form-control" type="text" placeholder="Escribe nombre de contacto" id="mod_contact" name="mod_contact">
						</div>
					</div>
					
					<div class="form-group">
						<!--apaterno-->
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left" for="apaterno">Telefono Contacto:</label>
						<div class="col-md-5 col-sm-4 col-xs-12">
	                        <input  class="form-control" type="tel"  id="mod_telc" name="mod_telc">
						</div>
                    </div>
					
					<div class="form-group">				
						<p class="text-center" >
							<button id="upd_data" type="submit" class="btn btn-success">Verificar</button>
							<button type="submit" class="btn btn-primary"   id="boton" value="COM2182"><i class="fa fa-camera"></i> Tomar foto</button>
						</p>
						<p id="estado"></p>
						<div class="RespuestaAjax"></div> <!-- Resultado de la peticion de Formulario AJAX-->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
					<div class="RespuestaAjax"></div> <!-- Resultado de la peticion de Formulario AJAX-->
				</form>
			</div>
		</div>
	</div>
</div> <!-- /Modal -->
