<div class="right_col" role="main"><!-- page content -->
<!--<script src="<?php echo SRVURL; ?>Script/js/funcion.Jquery.close.js"></script>-->
<div class="">
<div class="page-title">
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">
<br>

<button type="button" class="btn btn-success" onclick="location.href='../PlantiEmpleExcel'"><i class="fa fa-download"></i> Exportar Excel</button>
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

<label for="q" class="col-md-2 control-label">Consultar Usuario</label>
<div class="col-md-6">
<input type="text" class="form-control" id="q" placeholder="Nombre (Apellido paterno Apellido Materno Nombre) o Login" onkeyup='load(1);'>
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

<script type="text/javascript" src="/Script/js/funcion.Jquery.PlantiEmple.js"></script>
