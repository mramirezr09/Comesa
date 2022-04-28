<?php
	$id_u=$_SESSION['id_sgmx'];
	$conn = sqlsrv_connect(SERVER,CONNINF);

	$get_DB = new PDO (SGDB);
	$esquema= $get_DB -> query ("SELECT [PK_IdEsquema],[Nombre] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Esquema_Nomina] where estatus=1");
	$esquema= $esquema ->fetchAll();

	$reest= $get_DB -> query ("SELECT  [PK_IdRegistrEstatus],[Nombre] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Registro_Estatus] where estatus=1");
	$reest= $reest ->fetchAll();

	$naci= $get_DB -> query ("SELECT  [PK_IdNacionalidad],[Nombre] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Usuario_Nacionalidad] where estatus=1");
	$naci= $naci ->fetchAll();

	$sexo= $get_DB -> query ("SELECT  [PK_IdSexo] ,[Nombre_Sexo] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Sexo]");
	$sexo= $sexo ->fetchAll();

	$edo= $get_DB -> query ("SELECT [PK_IdEstado],[Nombre_Estado] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Estado] where estatus=1");
	$edo= $edo ->fetchAll();

	$info= $get_DB -> query ("SELECT [PK_IdInfonavit],[Nombre] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Infonavit] where estatus=1");
	$info= $info ->fetchAll();

	$puesto= $get_DB -> query ("SELECT [PK_IdPuesto],[Nombre_Puesto] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Puesto]");
	$puesto= $puesto ->fetchAll();

	$estadoC= $get_DB -> query ("SELECT [PK_IdEstado_Civil] as estadoC, [Estado_Civil] as tipoEC FROM [PRO_SERVER_COMESA].[dbo].[PSC.Estado_Civil]");
	$estadoC= $estadoC ->fetchAll();

	$banco= $get_DB -> query ("SELECT [PK_IdBanco], [Nombre_Banco] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Banco]");
	$banco= $banco ->fetchAll();
?>
<script type="text/javascript" src="/Script/js/funcion.Jquery.curp.js"></script>
<script type="text/javascript" src="/Script/js/funcion.Jquery.rfc.js"></script>
<script type="text/javascript" src="/Script/js/funcion.Jquery.edad.js"></script>
<script type="text/javascript" src="/Script/js/funcion.Jquery.comboEsquemaUPD.js"></script>
<script type="text/javascript" src="/Script/js/funcion.Jquery.parteCurp.js"></script>
<script type="text/javascript" src="/Script/js/funcion.Jquery.CPUPD.js"></script>
<!-- Boton para generar el aviso de terminos y condiciones -->
<!-- Iniciar instrucciones de modal pa ventana -->
<div class="modal fade bs-example-modal-lg-upd" tabindex="-1" role="dialog" aria-hidden="true">
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
					<i class="fa fa-pencil-square-o"></i> Actualizar Registro
				</h4>
			</div>
			<!--  Inicia cuerpo del modal -->
			<div class="modal-body">
				<form class="form-horizontal form-label-left input_mask" method="post" id="upd_DP" name="upd_DP"> <!-- Llamada a Jquery -->
					<div id="result_re"></div>
					<input type="hidden" id="mod_idu" name="mod_idu">
					<!-- page content -->
					<div class="col-md-13">
						<div class="form-horizontal">
							<div class="form-group">
								<!--Movimiento Solicitado-->
								<h2 style="padding-left: 400px"><i class="fa fa-user"></i> Datos Personales</h2>
							</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="form-group">
								<!--apaterno-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="apaterno">Apellido Paterno</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input  class="form-control" type="text" placeholder="Escribe tu apellido paterno" id="mod_apellidoP" name="mod_apellidoP">
								</div>
								<!--amaterno-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="amaterno">Apellido Materno</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text"  placeholder="Escribe tu apellido materno" id="mod_apellidoM" name="mod_apellidoM">
								</div>
							</div>
							<div class="form-group">
								<!--Nombre-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="nombre">Nombre</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Escribe tu nombre" id="mod_nombre" name="mod_nombre">
								</div>

								<!--puesto-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="puesto">Puesto</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<!--<input class="form-control" type="text" placeholder="Captura puesto" id="mod_puesto" name="mod_puesto">-->
									<select id="mod_puesto" name="mod_puesto" class="form-control" data-live-search="true">
										<option selected="" value="">--Selecciona--</option>
										<?php foreach($puesto as $pue):?>
										<option value="<?php echo $pue['PK_IdPuesto'];?>">
											<?php echo $pue['Nombre_Puesto']; ?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="ln_solid"></div>

							<div class="form-group">
								<!--CURP-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="curpa">CURP</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" id="mod_curpa" oninput="validarInput(this)"  style="text-transform:uppercase" placeholder="Escribe tu CURP" maxlength="18" name="mod_curpa">
									<pre id="resultado"></pre>
								</div>
								<!--RFC-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="rfc">RFC</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" id="mod_rfc" oninput="validarInputrfc(this)" style="text-transform:uppercase" placeholder="Escribe tu RFC" maxlength="13" name="mod_rfc">
									<pre id="resultadorfc"></pre>
								</div>
							</div>
							<div class="form-group">
								<!--fecha de nacimiento-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="fechaN">Fecha de Nacimiento</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Escribe tu Fecha de Nacimiento" id="mod_fechaN" name="mod_fechaN" readonly>
								</div>

								<!--lugar de nacimiento-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="lugarN">Lugar de Nacimiento</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<!--<input class="form-control" type="text" placeholder="Escribe tu lugar de nacimiento" id="mod_lugarN" name="mod_lugarN">-->
									<select style="pointer-events: none;" id="mod_lugarN" name="mod_lugarN" class="form-control">
										<option selected="" value="">--Selecciona--</option>
										<?php foreach($edo as $ed):?>
										<option value="<?php echo $ed['PK_IdEstado']; ?>">
											<?php echo utf8_encode($ed['Nombre_Estado']); ?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="nacionalidad">Nacionalidad</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select name="mod_nacion"  id="mod_nacion" class="form-control">
										<option selected="" value="">--Selecciona--</option>
										<?php foreach($naci as $na):?>
										<option value="<?php echo $na['PK_IdNacionalidad'];?>">
											<?php echo $na['Nombre']; ?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>

								<!--Edad-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="edad">Edad</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="number" placeholder="Escribe tu Edad" min="18" max="70"  name="mod_edad" id="mod_edad" readonly>
								</div>
							</div>

							<div class="form-group">
								<!--sexo-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="sexo">Sexo</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select style="pointer-events: none;" name="mod_sexoid" id="mod_sexoid" class="form-control">
										<option selected="" value="">--Selecciona--</option>
										<?php foreach($sexo as $se):?>
										<option value="<?php echo $se['PK_IdSexo']; ?>">
											<?php echo $se['Nombre_Sexo']; ?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>

								<!--estado civil-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="estadoc">Estado Civil</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select name="mod_estadocid" id="mod_estadocid" class="form-control">
										<option selected="" value="">--Selecciona--</option>
										<?php foreach($estadoC as $estC):?>
										<option value="<?php echo $estC['estadoC']; ?>">
											<?php echo $estC['tipoEC']; ?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<!--mail-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="mail">Mail</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="email" placeholder="Escribe tu Correo Electronico"id="mod_mail" name="mod_mail">
								</div>
							</div>

							<div class="form-group">
								<!--telefono-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="tel">Telefono</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="tel" placeholder="Escribe tu Telefono"id="mod_numT" name="mod_numT">
								</div>

								<!--NSS-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="nss">NSS</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Escribe tu NSS" maxlength="11" id="mod_nss" name="mod_nss">
								</div>
							</div>

							<div class="ln_solid"></div>
							<h2 style="padding-left: 400px"><i class="fa fa-map-marker"></i> Datos Domiciliarios</h2>
							<div class="ln_solid"></div>

							<div class="form-group">
								<!--CP-->
								<legend style="font-size: 1.3rem; font-weight: bold;">El código postal llena todos los campos</legend>
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="cp">Código Postal: No agregar 0 al inicio</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Escribe tu codigo postal" id="mod_cp" name="mod_cp">
								</div>
								<!--estado-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="estado">Estado</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select id="mod_nombree" name="mod_nombree" style="background-color:#e9f7e5;" class="form-control">
									</select>
								</div>
              </div>

							<div class="form-group">
								<!--municipio alcalida-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="munAlc">Municipio</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select id="mod_municipio" name="mod_municipio" style="background-color:#e9f7e5;" class="form-control">
									</select>
								</div>

								<!--colonia-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="colonia">Colonia</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select id="mod_colonia" name="mod_colonia" style="background-color:#e9f7e5;" class="form-control">
									</select>
								</div>
							</div>

							<div class="form-group">
								<!--calle-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="calle">Calle</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Escribe tu Calle"id="mod_calle" name="mod_calle">
								</div>

								<!--numero ext-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="numext">Número Exterior</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Escribe tu Número Exterior" id="mod_numE" name="mod_numE">
								</div>
							</div>

							<div class="form-group">
								<!--numint-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="numint">Número Interior</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Escribe tu Número Interior" id="mod_numI" name="mod_numI">
								</div>
							</div>
							<div class="ln_solid"></div>
							<h2 style="padding-left: 400px"><i class="fa fa-bank"></i> Datos Bancarios</h2>
							<div class="ln_solid"></div>

							<div class="form-group">
								<!--banco-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="banco">Banco</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<!--<input class="form-control" type="text" placeholder="Escribe tu banco afiliado"id="mod_banco" name="mod_banco">-->
									<select id="mod_banco" name="mod_banco" class="form-control">
										<option selected="" value="">--Selecciona--</option>
										<?php foreach($banco as $ban):?>
										<option value="<?php echo $ban['PK_IdBanco']; ?>">
											<?php echo utf8_encode($ban['Nombre_Banco']); ?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>

								<!--clabe intervancaria-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="clabeI">Clabe Interbancaria</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Escribe tu Clabe Interbancaria"id="mod_clabe" name="mod_clabe">
								</div>
							</div>

							<div class="ln_solid"></div>
							<h2 style="padding-left: 400px"><i class="fa fa-home"></i> Datos Infonavit</h2>
							<div class="ln_solid"></div>

							<div class="form-group">
								<!--infonavit-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="infonavit">Infonavit</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select id="mod_siNoInf" name="mod_siNoInf" class="form-control">
										<option selected disable hidden style="display:none" value="0">--Selecciona--</option>
										<?php foreach($info as $in):?>
										<option value="<?php echo $in['PK_IdInfonavit']; ?>">
											<?php echo utf8_encode($in['Nombre']); ?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
								<!--numero infonavit-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="numeroI">Número de Credito</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Escribe tu numeroI" id="mod_numInf" name="mod_numInf">
								</div>
							</div>

							<div class="form-group">
								<!--tipo credito-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="tipoC">Tipo de Credito</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Escribe tu Tipo de Credito"id="mod_tipoInf" name="mod_tipoInf">
								</div>
								<!--valor de tasa-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="valorinf">Valor de Tasa</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Escribe el valo de tu Tasa"id="mod_valorinf" name="mod_valorinf">
								</div>
							</div>


                              <div class="ln_solid"></div>
							<h2 style="padding-left: 400px"><i class="fa fa-user"></i> Datos de la Credencial</h2>
							<div class="ln_solid"></div>

							<div class="form-group">
								<!--infonavit-->

								<!--numero infonavit-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="numeroI">Número de Contacto</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="tel" maxlength="10" placeholder="Numero de contacto" id="mod_telcon" name="mod_telcon">
								</div>

								<!--tipo credito-->
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="tipoC">Nombre de Contacto</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<input class="form-control" type="text" placeholder="Nombre de contacto (Parentesco)" id="mod_contacto" name="mod_contacto">
								</div>

							</div>


							<div class="ln_solid"></div>
							<h2 style="padding-left: 400px"><i class="fa fa-paperclip"></i> Documentación</h2>
							<div class="ln_solid"></div>

							<div class="form-group">
								<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="esqueman">Tipo de esquema</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select name="mod_esqueman"  id="mod_esqueman" class="form-control">
										<option selected="" value="">--Selecciona--</option>
										<?php foreach($esquema as $esq):?>
										<option value="<?php echo $esq['PK_IdEsquema']; ?>">
											<?php echo $esq['Nombre']; ?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="ln_solid"></div>
							<div id="comboUPD"></div>
							<div class="form-group">
								<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
									<button id="upd_data" type="submit" class="btn btn-info btn-raised btn-sm"><i class="fa fa-hdd-o"></i> Actualizar</button>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" onClick="window.location.reload()" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
						<!--<div class="RespuestaAjax"></div> <!-- Resultado de la peticion de Formulario AJAX-->
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
