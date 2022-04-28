

    <script type="text/javascript" src="/Script/js/funcion.Jquery.curp.js"></script>
	 
	<script type="text/javascript" src="/Script/js/funcion.Jquery.rfc.js"></script>
	<script type="text/javascript" src="/Script/js/funcion.Jquery.edad.js"></script>
	<script type="text/javascript" src="/Script/js/funcion.Jquery.comboEsquema.js"></script>
    <script type="text/javascript" src="/Script/js/funcion.Jquery.comboCredencial.js"></script>
	<script type="text/javascript" src="/Script/js/funcion.Jquery.parteCurp.js"></script>
   <script type="text/javascript" src="/Script/js/funcion.Jquery.comboSueldo.js"></script>

<div class="right_col" role="main"><!-- page content -->
		<div class="page-title">
	    <div class="clearfix"></div>
	    <div class="x_panel">
		<div class="x_title">

		<h2><i class="fa fa-camera aria-hidden="true"></i> Actualiza la foto de la credencial</h2>

		<ul class="nav navbar-right panel_toolbox"></ul>
					<div class="clearfix"></div>
				</div>
		<div class="col-md-13">

					<div class="form-horizontal">
					
					

					
					<?php
		
					$id=$_GET["foto"];
					
					   $_SESSION['id_r']=$id;
					   ?>
					
				
					
					<p style="padding-left: 300px"> Nota: Si capturaste la foto durante el registro y no es necesario actualizarla, de favor regrese con el boton "página aterior" </p>
                    <br>
                          	<div class="form-group">
						<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="esquema"> Actualizar foto</label>
						<div class="col-md-3 col-sm-4 col-xs-12">
							<select name="credencial"  id="credencial" class="form-control" required>
								<option selected disabled hidden style='display: none' value="">--Selecciona--</option>
								<option value="1">Si</option>
                                <option value="2">Omitir</option>
								</select>
							</div>
						</div> 
						
						<div id="mostrar"></div>	
						
					
						 
			

						<div id="combo1"></div>
						
			            	<div class="ln_solid"></div>
						<div class="form-group">

							<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
					
								<input type="button" class="btn btn-danger btn-raised btn-sm" value="Página anterior" onClick="history.go(-1);">
								</br>
								</br>
							</div>
						</div>
						<div class="ln_solid"></div>
						<div class="RespuestaAjax"></div> <!-- Resultado de la peticion de Formulario AJAX-->
					
					<div class="x_content">
			</div>
		</div>
	</div>
</div>

</div>
</div>
						
						
					
					

						
					?>
					
					
						
						

						

						
						


						
                       
				

                    
</div>
					 
