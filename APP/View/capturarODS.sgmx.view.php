<?php
	$get_DB = new PDO (SGDB);
	$frente= $get_DB -> query ("SELECT [PK_IdFrente],[Nombre_Frente]  FROM [PRO_SERVER_COMESA].[dbo].[PSC.Frente]");
	$frente= $frente ->fetchAll();

  $get_DB = new PDO (SGDB);
	$dods= $get_DB -> query ("SELECT [PK_IdDireccionR],[Nombre_Direccion]  FROM [PRO_SERVER_COMESA].[dbo].[PSC.DireccionODS]");
	$dods= $dods ->fetchAll();
?>


<!-- <script type="text/javascript" src="/Script/js/funcion.Jquery.comboSueldo.js"></script> -->

<div class="right_col" role="main"><!-- page content -->
  <div class="page-title">
    <div class="clearfix"></div>
    <div class="x_panel">
      <div class="col-md-13">
        <div class="form-horizontal">
          <div class="form-group">
            <!--Frente-->
            <h2 style="padding-left: 400px"><i class="fa fa-user"></i> Capturar Ornden de Suministro</h2>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <form action ="<?php echo SRVURL;?>APP/ajax/class.sgmx.capturaODSajax.php" method = "POST" data-form="save" class=" FormularioAjax form-horizontal form-label-left input_mask" autocomplete="off" enctype ="multipart/form-data"> <!-- AJAX -->
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="fr">Frente</label>
                <div class="col-md-3 col-sm-4 col-xs-12">
    							<select name="fr"  id="fr" class="form-control" required>
    								<option selected disabled hidden style='display: none' value="">--Selecciona--</option>
    								<?php foreach($frente as $fre):?>
    								<option value="<?php echo $fre['PK_IdFrente'];?>">
    									<?php echo $fre['Nombre_Frente']; ?>
    								</option>
    								<?php endforeach; ?>
  								</select>
  							</div>
              </div>
              <div class="form-group">
                <!--Dirección de Requirente-->
                <label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="amaterno">Dirección de Requirente</label>
                <div class="col-md-3 col-sm-4 col-xs-12">
    							<select name="dods"  id="dods" class="form-control" required>
    								<option selected disabled hidden style='display: none' value="">--Selecciona--</option>
    								<?php foreach($dods as $od):?>
    								<option value="<?php echo $od['PK_IdDireccionR'];?>">
    									<?php echo $od['Nombre_Direccion']; ?>
    								</option>
    								<?php endforeach; ?>
  								</select>
  							</div>
              </div>
              <div class="form-group">
                <!--ODS-->
                <label class="control-label col-md-2 col-sm-6 col-xs-12 text-left" for="nombre">ODS</label>
                <div class="col-md-3 col-sm-4 col-xs-12">
                  <input class="form-control" type="text" placeholder="Escribe la ODS" id="ods" name="ods">
                </div>
              </div>
			  
			  <div class="form-group row">
			  <label for="q" class="col-md-2 control-label">Fecha inicio</label>

<div class="col-lg-3">
                                <div class="input-group">
<span class="input-group-addon">INICIO</span>
<input type="date" name="q" id="q" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control" placeholder="Palabra clave">
                                </div>
</div>
</div>


			  <div class="form-group row">
			  <label for="q" class="col-md-2 control-label">Fecha Fin</label>
<div class="col-lg-3">
                                <div class="input-group">
                                  <span class="input-group-addon">FIN</span>
                                  <input type="date" name="r" id="r" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control" placeholder="Palabra clave">
                                </div>
                            </div>
							</div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-5">
                  <button type="submit" class="btn btn-success btn-raised btn-sm"><i class="fa fa-hdd-o"></i> Registrar</button>
                  <input type="button" class="btn btn-danger btn-raised btn-sm" value="Página anterior" onClick="history.go(-1);">
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="RespuestaAjax"></div> <!-- Resultado de la peticion de Formulario AJAX-->
            </form>
            <div class="x_content"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
