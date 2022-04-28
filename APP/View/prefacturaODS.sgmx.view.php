<?php
	$get_DB = new PDO (SGDB);
	$frente= $get_DB -> query ("SELECT [PK_IdFrente] as pk,[Nombre_Frente] as nombref  FROM [PRO_SERVER_COMESA].[dbo].[PSC.Frente]");
	$frente= $frente ->fetchAll();
?>

<script type="text/javascript" src="/Script/js/funcion.Jquery.comboFolio.js"></script>
<div class="right_col" role="main"><!-- page content -->
  <div class="page-title">
    <div class="clearfix"></div>
    <div class="x_panel">
      <div class="col-md-13">
        <div class="form-horizontal">
          <div class="form-group">
	          <!--Frente-->
	          <h2 style="padding-left: 150px"><i class="fa fa-user"></i> Prefactura</h2>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <!--<form action ="<?php echo SRVURL;?>APP/View/GeneraPrefactura.sgmx.view.php" method = "POST" class="form-horizontal form-label-left input_mask" data-form="save" autocomplete="off" enctype ="multipart/form-data"> <!-- AJAX -->
							<div class="form-group">
								<label class="control-label col-md-1 col-sm-6 col-xs-12 text-left" for="frente">Frente</label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select class="form-control"  name="frente3" id="frente3">
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
								<div id="folio3"></div>
							</div>
							<div class="ln_solid"></div>
							<p class="text-center">
								<a href="javascript:window.open('<?php echo SRVURL.'GeneraPrefactura?folio='.$fo ?>')" class="btn btn-info btn-raised btn-sm" title='Generar Prefactura'>
									<i class="fa fa-file"></i> Descargar
								</a>
							</p>
							<!--<div class="RespuestaAjax"></div> <!-- Resultado de la peticion de Formulario AJAX-->
            <!--</form>-->
            <div class="x_content"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
