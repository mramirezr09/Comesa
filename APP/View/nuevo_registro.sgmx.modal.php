<?php
	$get_DB = new PDO (SGDB);

	$puesto= $get_DB-> query("Select PK_IdPuesto ,Nombre_Puesto from [dbo].[PSC.Puesto] where Estatus=1");
	$puesto= $puesto ->fetchAll();

	$frente= $get_DB-> query("SELECT [PK_IdFrente] as pk, [Nombre_Frente] as nombref FROM [PRO_SERVER_COMESA].[dbo].[PSC.Frente]");
	$frente= $frente ->fetchAll();
	/*
	$torre= $get_DB-> query("Select Pk_idTorre as Fk_IdTorre,Nombre_Torre from [dbo].[PSC.Torre] where Estatus=1 and PK_IdTorre not in (7,8) order by nombre_torre");
	$torre= $torre ->fetchAll();

	$sup= $get_DB-> query("select Pk_IdSupervisor as Fk_IdSupervisor,Nombre from [dbo].[PSC.Supervisor] where estatus=1 order by Nombre");
	$sup= $sup ->fetchAll();
	*/
?>
<div>
	<script type="text/javascript" src="/Script/js/funcion.Jquery.curp.js"></script>
	<script type="text/javascript" src="/Script/js/funcion.Jquery.comboSueldoC.js"></script>
	<!-- Modal -->
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg-add"><i class="fa fa-plus-circle"></i> Nuevo Registro</button>
</div>

<div class="modal fade bs-example-modal-lg-add" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"> <i class="fa fa-address-book-o"></i> Registrar colaborador para filtro</h4>
			</div>
			<div class="modal-body">
				<form action ="<?php echo SRVURL;?>APP/ajax/class.sgmx.filtroajax.php" method = "POST" data-form="save" class="form-horizontal form-label-left input_mask FormularioAjax" autocomplete="off" enctype ="multipart/form-data">
					<fieldset>
						<div id="result"></div>
						<!--<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<select class="form-control" name="">
								<option value="" selected>-- ID Usuario --</option>
								<?php
								foreach($pk_id as $pi):?>
								<option value="<?php echo $pi['id']; ?>">
									<?php echo $pi['pk']+1; ?>
								</option>
								<?php endforeach; ?>
							</select>
						</div>-->

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="apa-re" required="" placeholder="Apellido Paterno">
							<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
						</div>

						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="ama-re" required="" placeholder="Apellido Materno" required>
							<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<input  class="form-control" type="text" name="nombre-re" required placeholder="Nombre" required>
							<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
						</div>

<!--
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<input  class="form-control" name="nss-re" type="text" maxlength="30" placeholder="NSS (Numero de seguridad social)">
							<span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<input class="form-control" name="tel-re" type="text" maxlength="10" placeholder="Numero de telefono">
							<span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
						</div>
!-->
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<input class="form-control" type="text" id="curp-re" oninput="validarInput(this)"  style="text-transform:uppercase" placeholder="Captura el CURP" maxlength="18" name="curp-re">
							<pre id="resultado"></pre>
							<span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
						</div>

						<div class="form-group">
							<label class="control-label col-md-1 col-sm-6 col-xs-12 text-left" for="fechaN">Puesto</label>
							<select class="selectpicker show-tick col-md-10 col-sm-6 col-xs-12"  name="puesto-re" data-live-search="true"  id="puesto-re" required>
								<option data-tokens="" selected>-- Selecciona Puesto --</option>
								<?php
								foreach($puesto as $p):?>
								<option value="<?php echo $p['PK_IdPuesto']; ?>">
									<?php echo $p['Nombre_Puesto']; ?>
								</option>
								<?php endforeach;
								?>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label col-md-1 col-sm-6 col-xs-12 text-left" >Sueldo</label>
							<div class="col-md-5 col-sm-4 col-xs-12">
								<select id="part" name="part" class="form-control"  readonly>
									<option selected disable hidden style="display:none" value="">
										--Selecciona--
									</option>
								</select>
							</div>

							<label class="control-label col-md-1 col-sm-6 col-xs-12 text-left" for="frente">Frente</label>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<select class="form-control"  name="frente" id="frente">
									<option selected disable hidden style="display:none" value="">-- Selecciona Frente --</option>
									<?php
									foreach($frente as $f):?>
									<option value="<?php echo $f['pk']; ?>">
										<?php echo $f['nombref']; ?>
									</option>
									<?php endforeach;
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-1 col-sm-6 col-xs-12 text-left" >Fase</label>
							<div class="col-md-5 col-sm-4 col-xs-12">
								<select id="fase" name="fase" class="form-control"  readonly>
									<option selected disable hidden style="display:none" value="">
										--Selecciona--
									</option>
								</select>
							</div>

							<div id="folio">

						</div>
					</fieldset>
					<div class="ln_solid"></div>
					<p class="text-center">
						<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="fa fa-save"></i> Guardar</button>
					</p>
					<div class="RespuestaAjax"></div> <!-- Resultado de la peticion de Formulario AJAX-->
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" onClick="window.location.reload()" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>  <!--/Modal -->
