<?php
require_once('APP/Controller/funcion.class.sgmx.define.BBDD.php');
require_once('Script/core/Globalcfg.php');
//$con = sqlsrv_connect(SERVER,CONNINF);
$get_DB = new PDO (SGDB);
$uad= $get_DB-> query("SELECT [PK_IdUnidadAdm],[Nombre_UnidadAdm] FROM [PRO_SERVER_ASISTENCIA].[dbo].[PSA.UnidadAdm]");
$uad= $uad-> fetchAll();
//$uad = sqlsrv_query($con,$query,PARAMS,OPTION);

?>
<div class="right_col" role="main"><!-- page content -->
<!--<script src="<?php echo SRVURL; ?>Script/js/funcion.Jquery.close.js"></script>-->
<div class="">
<div class="page-title">
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<br>

<button type="button" class="btn btn-success" onclick="location.href='../CatEmpSedExcel'"><i class="fa fa-download"></i> Exportar Excel</button>
<br>

<br>
<div class="x_panel">
<div class="x_title">
<h2> <?php echo utf8_encode( 'Plantilla de Empleados'); ?> </h2>
<ul class="nav navbar-right panel_toolbox">
<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
</li>
<li><a class="close-link"><i class="fa fa-close"></i></a>
</li>
</ul>
<div class="clearfix"></div>
</div>
                        
                        <!-- form seach -->
<form class="form-horizontal" role="form" id="reporte">
<div class="form-group row">

<label for="q" class="col-md-2 control-label">Consultar Sede</label>
<div class="col-md-5">
<select class="form-control" name="evento-as" required="" id="q" >
  <option value="" selected>-- Selecciona --</option>
<?php 
foreach($uad as $u):?>
<option value="
<?php echo $u['PK_IdUnidadAdm']; ?>">
<?php echo utf8_encode ($u['Nombre_UnidadAdm']); ?></option>
<?php endforeach;
?>
</select>
</div>
<div class="col-md-3">
<button type="button" class="btn btn-default" onclick='load(1);'>
<span class="glyphicon glyphicon-search" ></span> Buscar</button>
<span id="loader"></span>
</div>
</div>
</form>     
<!-- end form seach -->
<div class="x_content">
<div class="table-responsive">
<!-- ajax -->
<div id="resultados" class=""></div><!-- Carga los datos ajax -->
<div class='outer_div'></div><!-- Carga los datos ajax -->
<!-- /ajax -->
</div>
</div>
</div>
</div>
</div>
</div>
</div><!-- /page content -->

<script type="text/javascript" src="/Script/js/funcion.Jquery.CatEmpSed.js"></script>
