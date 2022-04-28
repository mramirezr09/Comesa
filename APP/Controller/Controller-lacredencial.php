
<script type="text/javascript" src="/Script/js/funcion.Jquery.camara.js"></script>
					
				
						  
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
						<p class="text-center" >
							<!-- <button id="upd_data" type="submit" class="btn btn-success">Verificar</button> -->
							<button type="button" class="btn btn-primary"   id="boton"><i class="fa fa-camera"></i> Tomar foto</button>
						</p>
						<p id="estado"></p>
						<div class="RespuestaAjax"></div> <!-- Resultado de la peticion de Formulario AJAX-->
					</div>

			
