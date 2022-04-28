<?php 
 $requestAjax = true;
 require ('../../Script/core/Globalcfg.php');

 if(isset($_POST['nombre-ay'])){
	 require_once('../../APP/Controller/Controller-ayuda.php');
	 $instAY = new  ayuda();
	 
	 if(isset ( $_POST ['nombre-ay']) && isset($_POST['email-ay']))
	 {
		 echo $instAY -> insert_ayuda_controller();
	 }
 }
	 
	 else
	 {
		 session_start();
		 session_destroy();
		 echo '<script> window.location.href"'.SRVURL.'login/" </script>';
	 }
	 