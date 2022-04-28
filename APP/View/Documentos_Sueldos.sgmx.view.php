<div class="right_col" role="main"><!-- page content -->
	<div class="page-title">
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<script type="text/javascript" src="/Script/js/funcion.Jquery.curp.js"></script>
					<script type="text/javascript" src="/Script/js/funcion.Jquery.rfc.js"></script>
					<script type="text/javascript" src="/Script/js/funcion.Jquery.edad.js"></script>
					<script type="text/javascript" src="/Script/js/funcion.Jquery.fechanac.js"></script>
					<script type="text/javascript" src="/Script/js/funcion.Jquery.comboEsquema.js"></script>

					<?php
						$conn = sqlsrv_connect(SERVER,CONNINF);
						$get_DB = new PDO (SGDB); 
						$esquema= $get_DB -> query ("SELECT [PK_IdEsquema],[Nombre] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Esquema_Nomina] where estatus=1");
						$esquema= $esquema ->fetchAll();
					?>
					<h2>
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Nuevo Registro
					</h2>
					<ul class="nav navbar-right panel_toolbox"></ul>
					<div class="clearfix"></div>
				</div>
				<div class="col-md-13">
					<div class="form-horizontal">         
						<div class="form-group">
							<!--Movimiento Solicitado-->
							<h2 style="padding-left: 400px">
								<i class="fa fa-user"></i> Datos Personales
							</h2>												
						</div>

						<div class="form-group">							
							<!--apaterno-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="apaterno">Apellido Paterno</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,30}" class="form-control" type="text" placeholder="Escribe tu apellido paterno" id="apaterno" name="apaterno">
							</div>
						
						
							<!--amaterno-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="amaterno">Apellido Materno</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,30}" class="form-control" type="text" placeholder="Escribe tu apellido materno" id="amaterno" name="amaterno">
							</div>
						</div>
						
						<div class="form-group">
							<!--Nombre-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="nombre">Nombre</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="text" placeholder="Escribe tu nombre" id="nombre" name="nombre">
							</div>
						</div>

						<div class="ln_solid"></div>
						
						<div class="form-group">						
							<!--CURP-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="curp">CURP</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="text" id="curp_input" oninput="validarInput(this)"  style="text-transform:uppercase" placeholder="Escribe tu CURP" maxlength="18" name="curp">
								<pre id="resultado"></pre>
							</div>
							
							<!--RFC-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="rfc">RFC</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="text" id="rfc_input" oninput="validarInputrfc(this)" style="text-transform:uppercase" placeholder="Escribe tu RFC" maxlength="13" name="rfc">
								<pre id="resultadorfc"></pre>
							</div>
						</div>
                          
						<div class="form-group">
							<!--fecha de nacimiento-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="fechaN">Fecha de Nacimiento</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="date" placeholder="Escribe tu Fecha de Nacimiento"id="fechaN" name="fechaN">
							</div>
						 
							<!--lugar de nacimiento-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="lugarN">Lugar de Nacimiento</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<select id="lugarN" name="lugarN" class="form-control" required>
									<option selected disable hidden style="display:none" value="0">--Selecciona--</option>
									<option value="1">Veraruz</option>
									<option value="2">CDMX</option>
								</select>
							</div>
						</div>
					
						
						<div class="form-group">						
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="nacionalidad">Nacionalidad</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<select id="nacionalidad" name="nacionalidad" class="form-control" required>
									<option selected disable hidden style="display:none" value="0">--Selecciona--</option>
									<option value="1">Mexicana</option>
									<option value="2">Extrangero</option>
								</select>
							</div>					

							<!--Edad-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="edad">Edad</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="number" placeholder="Escribe tu Edad" min="18" max="70"  name="edad" id="edad">
							</div>						
						</div>

						<div class="form-group">
							<!--sexo-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="sexo">Sexo</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<select id="sexo" name="sexo" class="form-control" required>
									<option selected disable hidden style="display:none" value="0">--Selecciona--</option>
									<option value="1">Mujer</option>
									<option value="2">Hombre</option>
								</select>
							</div>							
							
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="mail">Mail</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="email" placeholder="Escribe tu Correo Electronico"id="mail" name="mail">
							</div>
						</div>
							
	
						<div class="form-group">
							<!--telefono-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="tel">Telefono</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="tel" placeholder="Escribe tu Telefono"id="tel" name="tel">
							</div>
							
							<!--NSS-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="nss">NSS</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="text" placeholder="Escribe tu NSS" maxlength="11" id="nss" name="nss">
							</div>
						</div>
							
						<div class="ln_solid"></div>
						<h2 style="padding-left: 400px">
							<i class="fa fa-map-marker"></i> Datos Domiciliarios
						</h2> 
						<div class="ln_solid"></div>						   
						   
						<div class="form-group">						   
							<!--estado-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="estado">Estado</label>
							<div class="col-md-3 col-sm-4 col-xs-12">								
								<select id="estado" name="estado" class="form-control" required>
									<option selected disable hidden style="display:none" value="0">--Selecciona--</option>
									<option value="1">Veraruz</option>
									<option value="2">CDMX</option>
								</select>
							</div>
							<!--CP-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="cp">Código Postal</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<select id="nacionalidad" name="nacionalidad" class="form-control" required>
									<option selected disable hidden style="display:none" value="0">--Selecciona--</option>
									<option value="1">01870</option>
									<option value="2">07720</option>
								</select>
							</div>
						</div>
						   
						<div class="form-group">
							<!--municipio alcalida-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="munAlc">Municipio</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="text" placeholder="Escribe tu Municipio o Alcaldía" id="numAlc" name="munAlc">
							</div>						
						
							<!--colonia-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="colonia">Colonia</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="text" placeholder="Escribe tu Colonia"id="colonia" name="colonia">
							</div>
						</div>
							
							
						<div class="form-group">
							<!--calle-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="calle">Calle</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="text" placeholder="Escribe tu Calle"id="calle" name="calle">
							</div>						

							<!--numero ext-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="numext">Número Exterior</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="text" placeholder="Escribe tu Número Exterior" id="numext" name="numext">
							</div>
							</div>
							
							<div class="form-group">
							<!--numint-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="numint">Número Interior</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="text" placeholder="Escribe tu Número Interior" id="numint" name="numint">
							</div>	
						</div>
						
						<div class="ln_solid"></div>
						
						<h2 style="padding-left: 400px">
							<i class="fa fa-bank"></i> Datos Bancarios
						</h2>
						
						<div class="ln_solid"></div>
						
						<div class="form-group">
							<!--banco-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="banco">Banco</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="tel" placeholder="Escribe tu banco afiliado"id="banco" name="banco">
							</div>
						
							<!--clabe intervancaria-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="clabeI">Clabe Interbancaria</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<input class="form-control" type="email" placeholder="Escribe tu Clabe Interbancaria"id="clabeI" name="clabeI">
							</div>
						</div>

						<div class="ln_solid"></div>
					
						<div class="form-group">
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="cp">Tipo de esquema</label>
							<div class="col-md-3 col-sm-4 col-xs-12">
								<select name="nom-re"  class="form-control" required>
									<option selected disabled hidden style='display: none' value="">--Selecciona--</option>
									<?php foreach($esquema as $esq):?>
									<option value="
										<?php echo $esq['PK_IdEsquema']; ?>">
										<?php echo $esq['Nombre']; ?>
									</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						
						<div class="ln_solid"></div>
						
						<h2 style="padding-left: 400px">
							<i class="fa fa-bank"></i> Datos Infonavit
						</h2>
						
						<div class="ln_solid"></div>

						<div class="form-group">
							<!--infonavit-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="infonavit">Infonavit</label>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input class="form-control" type="email" placeholder="Escribe si cuenta con infonavit"id="infonavit" name="infonavit">
							</div>
							<!--numero infonavit-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="numeroI">Número de Credito</label>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input class="form-control" type="tel" placeholder="Escribe tu numeroI"id="numeroI" name="numeroI">
							</div>
						</div>

						<div class="form-group">
							<!--tipo credito-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="tipoC">Tipo de Credito</label>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input class="form-control" type="email" placeholder="Escribe tu Tipo de Credito"id="tipoC" name="tipoC">
							</div>
							<!--valor de tasa-->
							<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="valorTI">Valor de Tasa</label>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input class="form-control" type="tel" placeholder="Escribe el valo de tu Tasa"id="valorTI" name="valorTI">
							</div>
						</div>

						<div class="form-group">                                       
							<label class="control-label col-md-2 col-sm-3 col-xs-12" for="last-name">Adjunta CV</label>
							<div class="col-md-4 col-sm-9 col-xs-12">
								<input type="file" name="file-mds" class="form-control">								
							</div>
						</div>            
						<div class="form-group">
							<div class="col-md-12 text-center">                            
								<button type="submit" class="btn btn-primary btn-lg">
									Guardar
								</button>       
							</div>
						</div>        
						<!--</fieldset>-->
						<div class="RespuestaAjax"></div>
					</form>
					<div class="clearfix"></div>
					<div class="x_content"></div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>