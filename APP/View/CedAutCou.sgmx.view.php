<div class="right_col" role="main"><!-- page content -->
<!--<script src="<?php echo SRVURL; ?>Script/js/funcion.Jquery.close.js"></script>-->
	<div class="">
		<div class="page-title">
			<div class="clearfix"></div>
				<div class="col-md-12 col-sm-12 col-xs-12">
				<br>
				<?php
					$getdb = new PDO(SGDB);
					$mes = $getdb -> query("Select PK_IdMes as Mes, Nombre from [dbo].[PSA.Mes_nomina]");
					$mes = $mes -> fetchall();
					
					$nom= $getdb -> query ("Select PK_IdNomina as Nom, Nombre from [dbo].[PSA.Tipo_Nomina]");
                    $nom= $nom ->fetchAll();

                    $esq= $getdb -> query ("Select PK_IdEsquema as Esq, Nombre from [dbo].[PSA.Esquema_Nomina]");
                    $esq= $esq ->fetchAll();

                    $peri= $getdb -> query ("Select PK_IdPeriodo as Peri, Nombre from [dbo].[PSA.Periodo_Nomina]");
                    $peri= $peri ->fetchAll();

				?>
				<br>
					<div class="x_panel">
						<div class="x_title">
							<h2> <?php echo utf8_encode( 'Cedula de Autodeterminación de Cuotas'); ?> </h2>
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

									<div class="col-lg-3">
									<div class="input-group">
									<span class="input-group-addon">Esquema</span>
									<select class="form-control" id="q">
												<option value="" selected>--Selecciona--</option>
												<?php foreach($esq as $e):?>
												<option value="<?php echo $e['Esq'];?>"><?php echo $e['Nombre']; ?></option>
												<?php endforeach; ?>
											</select>
									</div>
									</div>

									<div class="col-lg-3">
									<div class="input-group">
									<span class="input-group-addon"><?php echo utf8_encode("Nómina");?></span>
									<select class="form-control" id="r">
												<option value="" selected>--Selecciona--</option>
												<?php foreach($nom as $n):?>
												<option value="<?php echo $n['Nom'];?>"><?php echo $n['Nombre']; ?></option>
												<?php endforeach; ?>
											</select>
									</div>
									</div>


									<div class="col-lg-3">
									<div class="input-group">
									<span class="input-group-addon">Mes</span>
									<select class="form-control" id="s">
									<option value="" selected>-- Selecciona --</option>
									<?php 
									foreach($mes as $m):?>
									<option value="
									<?php echo $m['Mes']; ?>"><?php echo $m['Nombre']; ?></option>
									<?php endforeach;
									?>
									</select>
									</div>
									</div>

									<div class="col-lg-3">
									<div class="input-group">
									<span class="input-group-addon">Periodo</span>
									<select class="form-control" id="t">
												<option value="" selected>--Selecciona--</option>
												<?php foreach($peri as $p):?>
												<option value="<?php echo $p['Peri'];?>"><?php echo $p['Nombre']; ?></option>
												<?php endforeach; ?>
											</select>
									</div>
									</div>
									<br>
									<div class="col text-center">
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

<script type="text/javascript" src="/Script/js/funcion.Jquery.CedAutCou.js"></script>
