<?php 
 $requestAjax = true;
 require ('../../Script/core/Globalcfg.php');

 if(isset($_POST['nom-re'])){
	 require_once('../../APP/Controller/Controller-CargaReporte.php');
	 $insertRE = new  cargaReporte();
	 
	 if(isset ( $_POST ['nom-re']) && isset($_POST['mes-re']))
	 {
		 echo $insertRE -> inserta_reporte_controller();
	 }
 }
	 
	 else
	 {
		 session_start();
		 session_destroy();
		 echo '<script> window.location.href"'.SRVURL.'login/" </script>';
	 }
	 