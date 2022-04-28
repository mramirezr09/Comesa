<?php
	ob_clean();
	require('APP/Controller/Controller-PlantiEmpleExcel.php');

	$exportar = new reporte_excel();
	$exportar -> exportar_excel();

?>