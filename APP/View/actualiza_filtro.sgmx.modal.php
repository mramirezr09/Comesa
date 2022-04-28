<?php
	$get_DB = new PDO (SGDB);
	$filtro= $get_DB-> query("Select PK_IdFiltro  ,Nombre from [dbo].[PSC.Filtro_Juridico] where Estatus=1 and PK_IdFiltro =1");
	$filtro= $filtro ->fetchAll();

	$puesto= $get_DB-> query("Select PK_IdPuesto ,Nombre_Puesto from [dbo].[PSC.Puesto] where Estatus=1");
	$puesto= $puesto ->fetchAll();

	$sueldo= $get_DB-> query("Select PK_IdPuesto ,Sueldo_Mensual from [dbo].[PSC.Puesto] where Estatus=1");
	$sueldo= $sueldo ->fetchAll();

	$fase= $get_DB-> query("Select PK_IdFase ,Nombre_Fase from [dbo].[PSC.Fase_Puesto] where Estatus=1");
	$fase= $fase ->fetchAll();
	
			$folio= $get_DB-> query("SELECT [PK_IdODS],[ODS_Comesa] FROM [PRO_SERVER_COMESA].[dbo].[PSC.ODS]");
		$folio= $folio ->fetchAll(); //genera un arreglo de los resultados de la consulta
	/*
	$torre= $get_DB-> query("Select Pk_idTorre as FK_IdTorre ,Nombre_Torre as Nombre from [dbo].[PSC.Torre] where Estatus=1 and PK_IdTorre NOT IN (7,8) ");
	$torre= $torre ->fetchAll();
	*/
?>
<script type="text/javascript" src="/Script/js/funcion.Jquery.curp.js"></script>
<div class="modal fade bs-example-modal-lg-upd" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Actualiza el registro</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-label-left input_mask" method="post" id="upd_filtro" name="upd_filtro"> <!-- Llamada a Jquery -->
					<div id="result_re"></div>
					<input type="hidden" id="mod_id" name="mod_id">
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left" for="first-name">ID Registro</label>
						<div class="col-md-3 col-sm-3 col-xs-12 form-group has-feedback ">
							<input name="mod_idcom" id="mod_idcom" class="form-control has-feedback-left" readonly>
							<span class="fa fa-sort-numeric-asc form-control-feedback left" aria-hidden="true"></span>
						</div>

						<label class="control-label col-md-1 col-sm-6 col-xs-12 text-left" for="first-name">Filtro</label>
						<div class="col-md-4 col-sm-6 col-xs-12 form-group has-feedback">
							<select name="mod_filtroid" class="form-control has-feedback-left"  id="mod_filtroid">
								<option  value="2">--Selecciona--</option>
								<?php 
									foreach($filtro as $f):?>
								<option value="<?php echo $f['PK_IdFiltro']; ?>"><?php 
									echo $f['Nombre']; ?>
								</option>
								<?php endforeach; ?>
							</select>
							<span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left " for="first-name">Apellido Paterno </label>
						<div class="col-md-8 col-sm-6 col-xs-12 form-group has-feedback">
							<input name="mod_apellidoP" id="mod_apellidoP" type="text" class="form-control has-feedback-left" >
							<span class="fa fa-user-circle form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left " for="first-name">Apellido Materno </label>
						<div class="col-md-8 col-sm-6 col-xs-12 form-group has-feedback">
							<input name="mod_apellidoM" id="mod_apellidoM" type="text" class="form-control has-feedback-left" >
							<span class="fa fa-user-circle form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left " for="first-name">Nombre</label>
						<div class="col-md-8 col-sm-6 col-xs-12 form-group has-feedback">
							<input name="mod_nombre" id="mod_nombre" type="text" class="form-control has-feedback-left" >
							<span class="fa fa-user-circle form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>

			

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left " >Curp </label>
						<div class="col-md-8 col-sm-9 col-xs-10 form-group has-feedback-left">
							<input  class="form-control has-feedback-left" type="text" id="mod_curpa" oninput="validarInput(this)"  style="text-transform:uppercase" placeholder="Captura la CURP" maxlength="18" name="mod_curpa">
							<pre id="resultado"></pre>
							<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>



					<div class="form-group">
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left " for="first-name">Puesto</label>
						<div class="col-md-8 col-sm-6 col-xs-12 form-group has-feedback">
							<select name="mod_puesto" class="form-control has-feedback-left" required id="mod_puesto">
								<option selected disabled hidden style='display: none' value="">--Selecciona--</option>
								<?php 
								foreach($puesto as $p):?>
								<option value="<?php echo $p['PK_IdPuesto']; ?>"><?php 
									echo $p['Nombre_Puesto']; ?>
								</option>
								<?php endforeach; ?>
							</select>
							<span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left " for="first-name">Sueldo</label>
						<div class="col-md-8 col-sm-6 col-xs-12 form-group has-feedback">
							<select name="mod_nsueldo" class="form-control has-feedback-left" required id="mod_nsueldo">
								<option selected disabled hidden style='display: none' value="">--Selecciona--</option>
								<?php 
								foreach($sueldo as $s):?>
								<option value="<?php echo $s['PK_IdPuesto']; ?>"><?php 
									echo $s['Sueldo_Mensual']; ?></option>
								<?php endforeach; ?>
							</select>
							<span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left " for="first-name">Fase</label>
						<div class="col-md-8 col-sm-6 col-xs-12 form-group has-feedback">
							<select name="mod_fase" class="form-control has-feedback-left" required id="mod_fase">
								<option selected disabled hidden style='display: none' value="">--Selecciona--</option>
								<?php 
								foreach($fase as $f):?>
								<option value="<?php echo $f['PK_IdFase']; ?>"><?php 
									echo $f['Nombre_Fase']; ?>
								</option>
								<?php endforeach; ?>
							</select>
							<span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>
					
					<!--
					<div class="form-group">
						<label class="control-label col-md-3 col-sm-6 col-xs-12 text-left " for="first-name">Campamento</label>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
							<select name="mod_perfil" class="form-control has-feedback-left" required id="mod_perfil">
								<option selected disabled hidden style='display: none' value="">--Selecciona--</option>
								<?php 
								foreach($camp as $p):?>
								<option value="<?php echo $p['FK_IdPerfil']; ?>"><?php 
									echo $p['Nombre']; ?></option>
								<?php endforeach; ?>
							</select>
							<span class="fa fa-users form-control-feedback left" aria-hidden="true"></span>
						</div>
					</div>
					!-->	
                    	<p> <strong> Si desea actualizar la Orden de Servicio, favor de seleccionar el frente nuevamente y elegir la ODS deseada </strong></p>
						<br>
					<div class="form-group">
						<label class="control-label col-md-1 col-sm-6 col-xs-12 text-left" for="frente">Frente</label>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<select class="form-control"  name="modfrente" id="modfrente" >
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
						
						<label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="frente">Folio Actual</label>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<select class="form-control" style="pointer-events:none"  name="mod_ods" id="mod_ods" required readonly>
								<option selected disable hidden style="display:none" value="">-- Selecciona Frente --</option>
								<?php 
							foreach ($folio as $fo):
		?>		
		
		<option value="<?php echo $fo['PK_IdODS'];?>">
			<?php echo utf8_encode($fo['ODS_Comesa']);?>
		</option>
		<?php
		endforeach;
			?>
								</select>
						</div>

						
						
					</div>
				
					<div id="folio2"></div>
					
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
							<button id="upd_data" type="submit" class="btn btn-success">Actualizar</button>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning"  onClick="window.location.reload()" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div> <!-- /Modal -->
