<?php
 $id_u=$_SESSION['id_sgmx'];
?>
<!-- Boton para generar el aviso de terminos y condiciones -->

<!-- Iniciar instrucciones de modal pa ventana -->
<div class="modal fade bs-example-modal-lg-tras" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<!-- boton de cierre de modal -->
				<button type="button" class="close" onClick="window.location.reload()" data-dismiss="modal">
					<span aria-hidden="true">
						<i class="fa fa-window-close" aria-hidden="true"></i>
					</span>
				</button>
				<!-- Titulo del modal -->
				<h4 class="modal-title"  center id="myModalLabel">
					<i class="fa fa-pencil-square-o"></i>
					<center> Costo de Traslados</center>
				</h4>
			</div>
			<!--  Inicia cuerpo del modal -->
			<div class="modal-body" id="asistencia">
				<!-- entradas Validación-->
				<form action ="<?php echo SRVURL;?>APP/ajax/class.sgmx.controlcostosajax.php" method = "POST" data-form="save" class="form-horizontal form-label-left input_mask FormularioAjax" autocomplete="off" enctype ="multipart/form-data">
					<p class="text-muted"> <strong>Nota: </strong> Completa los montos gastados durante tu viaje.</p>
					<br>
					
					 <div id="result_costos"></div>
		
                    <input hidden id="mod_ide" name="mod_ide">


					<div class="form-group">
						<label class="control-label col-md-1 col-sm-1 col-xs-12" for="origen1">Origen</label>
						<div class="col-md-2 col-sm-2 col-xs-12">
							<input style="text-transform: uppercase;" class="form-control" name="origen1" id="origen1" type="text"  placeholder="Lugar de partida">
						</div>

						<label class="control-label col-md-1 col-sm-1 col-xs-12" for="destino1">Destino</label>
						<div class="col-md-2 col-sm-2 col-xs-12">
							<input style="text-transform: uppercase;" class="form-control" name="destino1" id="destino1" type="text"  placeholder="Lugar de llegada">
						</div>

						<label class="control-label col-md-1 col-sm-1 col-xs-12" for="valor1">Valor</label>
						<div class="col-md-2 col-sm-2 col-xs-12">
							<input class="form-control" name="valor1" id="valor1" type="numeric"  placeholder="Dinero">
						</div>

						<label class="control-label col-md-1 col-sm-1 col-xs-12" for="fecha1">Fecha</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<input class="form-control" name="fecha1" id="fecha1" type="date">
						</div>
					</div>				
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
							<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="fa fa-hdd-o"></i> Guardar</button>
						</div>
					</div>
					<div class="RespuestaAjax"></div> <!-- Resultado de la peticion de Formulario AJAX-->
				</form>
			</div>
		</div>
	</div>
</div> <!-- /Modal -->
