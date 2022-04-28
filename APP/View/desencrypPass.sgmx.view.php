<div class="right_col" role="main"><!-- page content -->
<!--<script src="<?php echo SRVURL; ?>Script/js/funcion.Jquery.close.js"></script>-->
	<div class="">
		<div class="page-title">
			<div class="clearfix"></div>
				<div class="col-md-12 col-sm-12 col-xs-12">
				<br>
				<br>
					<div class="x_panel">
						<div class="x_title">
						<h2> <?php echo utf8_encode( 'Contraseñas Desencriptadas'); ?> </h2>
						<ul class="nav navbar-right panel_toolbox">
							<li>
								<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li>
								<a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul>
						<div class="clearfix"></div>
						<?php							
							require ('APP/Controller/Controller-desencrypPass.php');							
						?>						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


