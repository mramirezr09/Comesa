<?php 
 $requestAjax = true;
 require ('../../Script/core/Globalcfg.php');

 if(isset($_POST['nombre'])){
	 require_once('../../APP/Controller/Controller-Registro.php');
	 $instRE = new  Registro();
	 
	 if(isset ( $_POST ['nombre']) && isset($_POST['apa']))
	 {
		 echo $instRE -> insert_registro_controller();
	 }

	 
	 else
	 {
		 session_start();
		 session_destroy();
		 echo '<script> window.location.href"'.SRVURL.'login/" </script>';
	 }
	 
 }