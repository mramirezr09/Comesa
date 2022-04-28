<div class="right_col" role="main"><!-- page content -->
<!--<script src="<?php echo SRVURL; ?>Script/js/funcion.Jquery.close.js"></script>-->
<div class="">
<div class="page-title">
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<br>
<?php

$get_DB = new PDO (SGDB); 


$peri= $get_DB -> query ("Select PK_IdPeriodoRecibo as Peri, Nombre from [dbo].[PSA.Periodo_Recibo]");
$peri= $peri ->fetchAll();


?>
<br>
<div class="x_panel">
<div class="x_title">
<h2> <?php echo 'Mis Recibos de Nómina';?></h2><!--mostrar acentos php-->
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

<div class="col-lg-5">
<div class="input-group">
<span class="input-group-addon">Periodo</span>
<select class="form-control" id="q">
<option value="" selected>-- Selecciona --</option>
<?php 
foreach($peri as $e):?>
<option value="
<?php echo $e['Peri']; ?>"><?php echo $e['Nombre']; ?></option>
<?php endforeach;
?>
</select>
</div>
</div>


<div class="col text-left">
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

<script type="text/javascript" src="/Script/js/funcion.Jquery.Periodorecibo.js"></script>
