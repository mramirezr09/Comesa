<div class="right_col" role="main"><!-- page content -->
	<div class="">
	<meta charset="utf-8">
	<div class="page-title">
		<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<br>
				<?php
					include("Capturafoto.sgmx.modal.php");
					include("ActualizaRegistro.sgmx.modal.php");
					include("costotraslados.sgmx.modal.php");
				?>
				<div>

				</div>
				<br>
				<div class="x_panel">
					<div class="x_title">
						<h2>Registros PNPDMI </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<a class="collapse-link">
									<i class="fa fa-chevron-up"></i>
								</a>
							</li>
							<li>
								<a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<!-- form seach -->
					<form class="form-horizontal" role="form" id="ticket">
						<div class="form-group row">
							<label for="q" class="col-md-1 control-label">Consultar</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Capture CURP del colaborador" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn btn-default" onclick='load(1);'>
									<span class="glyphicon glyphicon-search" ></span> Buscar
								</button>
								<span id="loader"></span>
							</div>
						</div>
					</form>
					<!-- end form seach -->
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
	</div><!-- /page content -->
</div>

<script type="text/javascript" src="/Script/js/funcion.Jquery.registros.js"></script>
<script type="text/javascript" src="/Script/js/funcion.Jquery.camara.js"></script>
<!--<script type="text/javascript" src="/Script/js/funcion.Jquery.creacontrato.js"></script> -->
<!--<script type="text/javascript" src="/Script/js/funcion.Jquery.creacredencial.js"></script> -->
<script type="text/javascript" src="/Script/js/funcion.Jquery.actualiza_registros.js"></script>
<script type="text/javascript" src="/Script/js/funcion.Jquery.fotocred.js"></script>
<script type="text/javascript" src="/Script/js/funcion.Jquery.costotraslados.js"></script>
