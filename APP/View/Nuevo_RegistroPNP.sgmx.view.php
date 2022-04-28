<?php
	$get_DB = new PDO (SGDB);
	$esquema= $get_DB -> query ("SELECT [PK_IdEsquema],[Nombre] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Esquema_Nomina] where estatus=1");
	$esquema= $esquema ->fetchAll();

	$reest= $get_DB -> query ("SELECT  [PK_IdRegistrEstatus],[Nombre] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Registro_Estatus] where estatus=1");
	$reest= $reest ->fetchAll();

	$naci= $get_DB -> query ("SELECT  [PK_IdNacionalidad],[Nombre] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Usuario_Nacionalidad] where estatus=1");
	$naci= $naci ->fetchAll();

	$sexo= $get_DB -> query ("SELECT  [PK_IdSexo] ,[Nombre_Sexo] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Sexo] where estatus=1");
	$sexo= $sexo ->fetchAll();

	$edo= $get_DB -> query ("SELECT [PK_IdEstado],[Nombre_Estado] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Estado] where estatus=1");
	$edo= $edo ->fetchAll();

	$info= $get_DB -> query ("SELECT [PK_IdInfonavit],[Nombre] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Infonavit] where estatus=1");
	$info= $info ->fetchAll();

	$puesto= $get_DB -> query ("SELECT [PK_IdPuesto],[Nombre_Puesto] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Puesto]");
	$puesto= $puesto ->fetchAll();

	$estadoC= $get_DB -> query ("SELECT [PK_IdEstado_Civil],[Estado_Civil] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Estado_Civil]");
	$estadoC= $estadoC ->fetchAll();

	$banco= $get_DB -> query ("SELECT [PK_IdBanco], [Nombre_Banco] FROM [PRO_SERVER_COMESA].[dbo].[PSC.Banco]");
	$banco= $banco ->fetchAll();
?>

	<script type="text/javascript" src="/Script/js/funcion.Jquery.curp.js"></script>
	<script type="text/javascript" src="/Script/js/funcion.Jquery.CP.js"></script>
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
					<h2>
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Registro Comesa
					</h2>
					<ul class="nav navbar-right panel_toolbox"></ul>
					<div class="clearfix"></div>
				</div>
				<div class="col-md-13">
					<div class="form-horizontal">
						<div class="form-group">
							<!--Movimiento Solicitado-->
							<h2 style="padding-left: 400px"><i class="fa fa-user"></i> Datos Comesa</h2>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<form action ="<?php echo SRVURL;?>APP/ajax/class.sgmx.registroajax2.php" method = "POST" data-form="save" class=" FormularioAjax form-horizontal form-label-left input_mask" autocomplete="off" enctype ="multipart/form-data" id="curpD"> <!-- AJAX -->
								<div class="form-group">
									<?php
									$conn = sqlsrv_connect(SERVER,CONNINF);
									$id=$_GET["reg"];
									$query1= "SELECT [PK_IdRegistro] as ID
									,t1.[Nombre_Completo] as NombreU
									,t1.[Nombre] as Nombrer
									,t1.[FK_IdSexo] as sexoid
									,t1.[Apellido_Paterno] as apellidoP
									,t1.[Apellido_Materno] as apellidoM
									,t4.[Nombre] as registroE
									,t1.[FK_IdPuesto] as puesto
									,t1.edad
									,t1.FK_IdEstado_Civil as estadoc
									,t1.FK_IdRegistrEstatus
									,[CURP] as curp
									,[RFC] as rfc
									,convert (char(30),t1.Fecha_Nacimiento,120) as 'fechaN'
									,[Lugar_Nacimiento] as lugarN
									,[FK_IdNacionalidad] as nacion
									,t8.nombre as nacionalidad
									,[Edad] as edad
									,[Mail] as mail
									,[Numero_Telefono] as numT
									,[NSS]
									,t1.[FK_IdEstado] as nombree
									,[CP] as cp
									,[FK_IdEsquema] as esqueman
									,[Municipio] as municipio
									,[Colonia] as colonia
									,[Calle] as calle
									,[Numero_Ext] as numE
									,[Numero_Int] as numI
									,t2.FK_IdBanco as banco
									,t2.Clabe as clabe
									,t2.FK_IdInfonavit as siNoInf
									,t2.Num_Inf as numInf
									,t2.Tipo_Inf as tipoInf
									,t2.Valor_inf as valorinf
									,t1.[FK_IdFiltro] as idfiltro
									FROM [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]t1
									left join [dbo].[PSC.RegistroDB]t2 on t1.PK_IdRegistro = t2.FK_IdRegistro
									left join [dbo].[PSC.Puesto]t3 on t1.FK_IdPuesto = t3.PK_IdPuesto
									left join [dbo].[PSC.Registro_Estatus]t4 on t1.FK_IdPuesto = t4.PK_IdRegistrEstatus
									left join [dbo].[PSC.Sexo]t5 on t1.FK_IdSexo = t5.PK_IdSexo
									left join [dbo].[PSC.Estado]t6 on t1.FK_IdEstado = t6.PK_IdEstado
									left join [dbo].[PSC.Esquema_Nomina]t7 on t1.FK_IdEsquema = t7.PK_IdEsquema
									left join [dbo].[PSC.Usuario_Nacionalidad]t8 on t1.FK_IdNacionalidad= t8.PK_IdNacionalidad
									where PK_IdRegistro='$id'";

									$query1=sqlsrv_query($conn,$query1,PARAMS,OPTION);

									$echo="";

									$_SESSION['id_r']=$id;
									// $_SESSION['curpuser']=$curp;

									while ($r=sqlsrv_fetch_array($query1)) {
										$id=$r['ID'];
										$nombre=$r['NombreU'];
										$_SESSION['nomco']=$nombre;
										?>
									<input type="hidden" id="idreg" name="idreg" value="<?php echo $id ?>">
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="apaterno">Apellido Paterno</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input style="text-transform:uppercase; background-color:#e9f7e5;" class="form-control" type="text" placeholder="Escribe tu apellido paterno" id="apa" name="apa" value="<?php echo utf8_encode($r["apellidoP"]) ?>">
									</div>
									<!--amaterno-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="amaterno">Apellido Materno</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input style="text-transform:uppercase; background-color:#e9f7e5;" class="form-control" type="text"  placeholder="Escribe tu apellido materno" id="ama" name="ama" value="<?php echo utf8_encode($r["apellidoM"])?>">
									</div>
								</div>
								<div class="form-group">
									<!--Nombre-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="nombre">Nombre</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input style="text-transform:uppercase; background-color:#e9f7e5;" class="form-control" type="text" style="background-color:#e9f7e5;" placeholder="Escribe tu nombre" id="nombre" name="nombre" value="<?php echo utf8_encode($r["Nombrer"])?>">
									</div>
								</div>
								<!--
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="puesto">Puesto</label>
									<select id="puest" name="puest" class="form-control col-md-6 col-sm-6 col-xs-12"  value="<?php echo $r["puesto"]?>">
										<option selected disabled hidden style='display: none' value="">--Selecciona--</option>
										<?php foreach($puesto as $pue):?>
										<option value="<?php echo $pue['PK_IdPuesto']; ?>">
											<?php echo $pue['Nombre_Puesto']; ?>
										</option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" >Sueldo Mensual</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select id="part" name="part" class="form-control" required>
											<option selected disable hidden style="display:none" value="">
												--Selecciona--
											</option>
										</select>
									</div>
								</div>-->
								<br>
								<h2 style="padding-left: 400px">
									<i class="fa fa-address-card"></i> Datos Personales
								</h2>
								<div class="ln_solid"></div>
								<div class="form-group">
									<!--CURP-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="curp">CURP</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="text" id="curp_input" oninput="validarInput(this)"  style="text-transform:uppercase" placeholder="Escribe tu CURP" maxlength="18" name="curp" value="">
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
										<input class="form-control" type="text" style="background-color:#e9f7e5;"  placeholder="Escribe tu Fecha de Nacimiento"id="fechaN" name="fechaN">
									</div>
									<!--lugar de nacimiento-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="lugarN">Lugar de Nacimiento</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select id="luna" name="luna" style="background-color:#e9f7e5;" class="form-control" required>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="nacionalidad">Nacionalidad</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select id="naci" name="naci"  class="form-control" required>
											<?php foreach($naci as $na):?>
												<option value="<?php echo $na['PK_IdNacionalidad']; ?>">
													<?php echo $na['Nombre']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
									<!--Edad-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="edad">Edad</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="number" style="background-color:#e9f7e5;" placeholder="Escribe tu Edad" min="18" max="70"  name="edad" id="edad">
									</div>
								</div>
								<div class="form-group">
									<!--sexo-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="sexo">Sexo</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<!--<input class="form-control" type="text" placeholder="Escribe tu lugar de nacimiento" id="sexo" name="sexo">-->
										<select id="sexo" name="sexo" style="background-color:#e9f7e5;" class="form-control" required>
										</select>
									</div>

									<!--estado civil-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="estadoC">Estado Civil</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select name="estadoC" id="estadoC" class="form-control" required>
											<option selected disable hidden style="display:none" value="0">--Selecciona--</option>
											<?php foreach($estadoC as $ec):?>
												<option value="<?php echo $ec['PK_IdEstado_Civil']; ?>">
													<?php echo $ec['Estado_Civil']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="mail">Mail</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="email" placeholder="Escribe tu Correo Electronico"id="mail" name="mail">
									</div>

									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="tel">Telefono</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="tel" placeholder="Escribe tu Telefono"id="tel" name="tel">
									</div>
								</div>
								<div class="form-group">
									<!--NSS-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="nss">NSS</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="text" placeholder="Escribe tu NSS" maxlength="11" id="nss" name="nss">
									</div>
								</div>

								<div class="form-group">
									<!--NSS-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="nss">Confirma el NSS</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="text" placeholder="confirma tu NSS" maxlength="11" id="nss2" name="nss2">
									</div>
								</div>
								<div class="ln_solid"></div>
								<h2 style="padding-left: 400px"><i class="fa fa-map-marker"></i> Datos Domiciliarios</h2>
								<div class="ln_solid"></div>
								<div class="form-group">
									<!--CP-->
									<legend style="font-size: normal;">El código postal llena todos los campos</legend>
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="postal">Código Postal: No agregar 0 al inicio</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="text" placeholder="Escribe tu codigo postal" id="postal" name="postal">
									</div>
									<!--estado-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="estado">Estado</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select id="estadoD" name="estadoD" style="background-color:#e9f7e5;" class="form-control" required>
										</select>
									</div>
								</div>
								<div class="form-group">
									<!--municipio alcalida-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="munAlc">Municipio</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select id="muni" name="muni" style="background-color:#e9f7e5;" class="form-control" required>
										</select>
									</div>
									<!--colonia-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="colonia">Colonia</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select id="colo" name="colo" style="background-color:#e9f7e5;" class="form-control" required>
										</select>
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
								<h2 style="padding-left: 400px"><i class="fa fa-bank"></i> Datos Bancarios</h2>
								<div class="ln_solid"></div>

								<div class="form-group">
									<!--banco-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="banco">Banco</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<!--<input class="form-control" type="text" placeholder="Escribe tu banco afiliado"id="mod_banco" name="mod_banco">-->
										<select id="banco" name="banco" class="form-control" required>
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
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="text" maxlength="18" placeholder="Escribe tu Clabe Interbancaria"id="clabeI" name="clabeI">
									</div>
								</div>

								<div class="form-group">
									<!--banco-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="cuenta">Cuenta</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="text" maxlength="20" placeholder="Captura Cuenta"id="cuenta" name="cuenta">
									</div>
								</div>

								<div class="ln_solid"></div>
								<h2 style="padding-left: 400px"><i class="fa fa-home"></i> Datos Infonavit</h2>
								<div class="ln_solid"></div>

								<div class="form-group">
									<!--infonavit-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="infonavit">Infonavit</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select id="info" name="info" class="form-control" required>
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
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="tel" placeholder="Escribe tu numeroI" id="numeroI" name="numeroI">
									</div>
								</div>

								<div class="form-group">
									<!--tipo credito-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="tipoC">Tipo de Credito</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="text" placeholder="Escribe tu Tipo de Credito"id="tipoC" name="tipoC">
									</div>
									<!--valor de tasa-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="valorTI">Valor de Tasa</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="text" placeholder="Escribe el valor de tu Tasa"id="valorTI" name="valorTI">
									</div>
								</div>

						<!--<div class="ln_solid"></div>
								<h2 style="padding-left: 400px"><i class="fa fa-camera"></i> Fotografia</h2>
								<div class="ln_solid"></div>
								Foto-->
						<!--<div class="form-group">
									<div id="result_foto"></div>
							<!--<input type="text" id="mod_id" name="mod_id">-->
							<!--<style>
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
								</div>
								Documentacion-->
								<div class="ln_solid"></div>
								<h2 style="padding-left: 400px">
									<i class="fa fa-camera"></i> Datos de credencial
								</h2>
								<div class="ln_solid"></div>
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="esquema"> Capturar datos para credencial</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select name="credencial"  id="credencial" class="form-control" required>
											<option selected disabled hidden style='display: none' value="">--Selecciona--</option>
											<option value="1">Si</option>
											<option value="2">Omitir</option>
										</select>
									</div>
								</div>
								<div id="mostrar"></div>
								<div class="form-group">
									<!--banco-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="cuenta">Nombre de Contacto</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="text" maxlength="50" placeholder="Nombre Contacto (Parentesco)" id="contacto" name="contacto">
									</div>
									<!--banco-->
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="cuenta">Telefono de contacto</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<input class="form-control" type="text" maxlength="10" placeholder="Capture su numero de telefono" id="telcon" name="telcon">
									</div>
								</div>
								<div class="ln_solid"></div>
								<h2 style="padding-left: 400px"><i class="fa fa-paperclip"></i> Documentación</h2>
								<div class="ln_solid"></div>
								<div class="form-group">
									<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="esquema">Tipo de esquema</label>
									<div class="col-md-3 col-sm-4 col-xs-12">
										<select name="esquema"  id="esquema" class="form-control" required>
											<option selected disabled hidden style='display: none' value="">--Selecciona--</option>
											<?php foreach($esquema as $esq):?>
												<option value="<?php echo $esq['PK_IdEsquema']; ?>">
													<?php echo $esq['Nombre']; ?>
												</option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div id="combo1"></div>
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
										<button type="submit" class="btn btn-success btn-raised btn-sm"><i class="fa fa-hdd-o"></i> Registrar</button>
										<input type="button" class="btn btn-danger btn-raised btn-sm" value="Página anterior" onClick="history.go(-1);">
										</br>
										</br>
									</div>
								</div>
								<div class="ln_solid"></div>
								<div class="RespuestaAjax"></div> <!-- Resultado de la peticion de Formulario AJAX-->
							</form>
							<div class="x_content">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
									}
									echo $echo;
									return $echo;
?>
	</div>
