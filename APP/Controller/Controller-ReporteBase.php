<?php
	//require_once('/APP/Controller/funcion.class.sgmx.define.BBDD.php');
	//require('PHPExcel/Classes/PHPExcel.php');
	//$conect = sqlsrv_connect(SERVER,CONNINF);
	
	require('../../Script/core/Globalcfg.php"');
	
	$q=$_GET['q'];
	$r=$_GET['r'];
	

	
		?>
									<div class="col-md-6 col-sm-9 col-xs-12 col-md-offset-5">
	<a href="<?php echo SRVURL.'ReporteBase?q='.$q.'&r='.$r ?>" class='btn btn-success' title='Generar Reporte'>
								<i class="fa fa-file"></i>
							 Genera Excel</a> 
							 </div>
	