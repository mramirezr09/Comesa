<div class="right_col" role="main"><!-- page content -->
<!-- <script src="<?php echo SRVURL; ?>Script/js/funcion.Jquery.close.js"></script> -->
<div class="">
<div class="page-title">
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">

<?php
//include_once('TermAsi.sgmx.modal.php');
//include_once('TermAct.sgmx.modal.php');
?>


<div class="">
<br>
<p> <strong> Nota: </strong>Para poder generar estos documentos, es necesario filtrar (Buscar) el rango de fechas del corte correspondiente. <p>
<br>
<p><strong>IMPORTANTE: La lista de asistencias se genera delimitando un rango de fechas, NO exporte el archivo a excel sin realizar el rangueo o realicelo por partes.</strong><p>
<!--<button type="button" class="btn btn-primary" onclick="location.href='../lista-asistencia'"><i class="fa fa-plus-circle"></i> Generar Lista de Asistencia</button> -->
<!--<button type="button" class="btn btn-primary" onclick="location.href='../lista-actividades'"><i class="fa fa-plus-circle"></i> Generar Lista de Actividades</button> -->
</div>
<br>
<div class="x_panel">
<div class="x_title">
<h2>Mi reporte de asistencia</h2>
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

<label for="q" class="col-md-2 control-label">Rango de fechas</label>

<div class="col-lg-3">
                                <div class="input-group">
<span class="input-group-addon">INICIO</span>
<input type="date" name="start_at" id="q" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control" placeholder="Palabra clave">
                                </div>
</div>

<div class="col-lg-3">
                                <div class="input-group">
                                  <span class="input-group-addon">FIN</span>
                                  <input type="date" name="finish_at" id="r" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control" placeholder="Palabra clave">
                                </div>
                            </div>
							
<div class="col-md-3">
<button type="button" class="btn btn-default" onclick='load(1);'>
<span class="glyphicon glyphicon-search" ></span> Buscar</button>
<span id="loader"></span>
</div>
</div>
<!-- boton importar excel -->
<button type="button" class="btn btn-success" onclick="location.href='../ReporteAsisExcel'"><i class="fa fa-download"></i> Exportar Excel</button>
<br>
</form>     
<!-- end form seach -->
<div class="x_content">
<div class="table-responsive">
<!-- ajax -->
<div id="resultados"></div><!-- Carga los datos ajax -->
<div class='outer_div'></div><!-- Carga los datos ajax -->
<!--ajax -->
</div>
</div>
</div>
</div>
</div>
</div>
</div><!-- /page content -->

<script type="text/javascript" src="/Script/js/funcion.Jquery.ReporteAsis.js"></script>