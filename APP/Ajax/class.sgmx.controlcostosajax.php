<?php
 $requestAjax = true;
 require ('../../Script/core/Globalcfg.php');

 if(isset($_POST['origen1'])){
	 require_once('../../APP/Controller/Controller-controlcostos.php');
	 $instCT = new controlcostos();

	 if(isset ( $_POST ['origen1']))
	 {
		 echo $instCT -> insert_controlCostos_controller();
	 }


	 else
	 {
		 session_start();
		 session_destroy();
		 echo '<script> window.location.href"'.SRVURL.'login/" </script>';
	 }

 }
