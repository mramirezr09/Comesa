<div class="right_col" role="main"><!-- page content -->
<div class="">
<div class="page-title">
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">

<div class="x_panel">
<div class="x_title">
<h2>Prueba de camara comesa </h2>
<ul class="nav navbar-right panel_toolbox">
<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
</li>
<li><a class="close-link"><i class="fa fa-close"></i></a>
</li>
</ul>
<div class="clearfix"></div>
</div>
	<style>
		@media only screen and (max-width: 400px) {
			video {
				max-width: 100%;
			}
		}
	</style>
	<label for="q" class="col-md-2 control-label">Dispositivos disponibles</label>
	<div class="col-md-4">
		<select name="listaDeDispositivos" id="listaDeDispositivos"></select>
		<button type="button" class="btn btn-primary" id="boton"><i class="fa fa-camera"></i> Tomar foto</button>
		<p id="estado"></p>
	</div>
	<br>
	<video muted="muted" id="video"></video>
	<canvas id="canvas" style="display: none;"></canvas>

<div class="x_content">
<div class="table-responsive">
<!-- ajax -->
<div id="resultados"></div><!-- Carga los datos ajax -->
<div class='outer_div'></div><!-- Carga los datos ajax -->
<!-- /ajax -->
</div>
</div>
</div>
</div>
</div>
</div>
</div><!-- /page content -->

<script type="text/javascript" src="/Script/js/funcion.Jquery.camara.js"></script>
