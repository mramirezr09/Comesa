<?php 
 $requestAjax = true;
 require ('../../Script/core/Globalcfg.php');

 if(isset($_POST['nombre'])){
	 require_once('../../APP/Controller/Controller-RegistroPN.php');
	 $instRE = new  registroPN();
	 
	 if(isset ( $_POST ['nombre']) && isset($_POST['apa']))
	 {
		 echo $instRE -> insertPN_registro_controller();
	 }
 }
	 
	 else
	 {
		 session_start();
		 session_destroy();
		 echo '<script> window.location.href"'.SRVURL.'login/" </script>';
	 }
	 