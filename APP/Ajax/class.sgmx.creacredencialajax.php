<?php
 $requestAjax = true;
 require ('../../Script/core/Globalcfg.php');

 if(isset($_POST['id'])){
	 require_once('../../APP/Controller/Controller-Creacredencial.php');
	 $instCT = new creacred();

	 if(isset ( $_POST ['id']))
	 {
	 print_r($_POST['id']);
		 echo $instCT -> creacredencial_controller();
	 }


	 else
	 {
		 session_start();
		 session_destroy();
		 echo '<script> window.location.href"'.SRVURL.'login/" </script>';
	 }

 }
