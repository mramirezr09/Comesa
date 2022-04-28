<?php 
 $requestAjax = true;
 require ('../../Script/core/Globalcfg.php');

 if(isset($_GET['token'])){
	 
	 require_once ('../../APP/Controller/Controller-login.php');;
	 $logout = new login();
	 echo $logout-> controller_exit_session();
	 
     } 
	 else
	 {
		 session_start();
		 session_destroy();
		 echo '<script> window.location.href"'.SRVURL.'login/" </script>';
	 }
	 