<?php 
 $requestAjax = true;
 require ('../../Script/core/Globalcfg.php');
 
 if(isset($_POST['usuario'])){
	 require_once('../../APP/Controller/Controller-Term.php');
	 $instQR = new  terminos();
	 
	 if(isset ($_POST['usuario']) && isset($_POST['documento']))
	 {
		 echo $instQR -> insert_QR_controller();
	
	 }
	  }
	 
	 else
	 {
		 session_start();
		 session_destroy();
		 echo '<script> window.location.href"'.SRVURL.'login/" </script>';
	 }
