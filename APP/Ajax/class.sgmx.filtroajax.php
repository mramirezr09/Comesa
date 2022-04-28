<?php 
 $requestAjax = true;
 require ('../../Script/core/Globalcfg.php');

 if(isset($_POST['apa-re'])){
	 require_once('../../APP/Controller/Controller-Filtro.php');
	 $instFiltro = new  Filtro();
	 
	 if(isset ( $_POST ['apa-re']) && isset($_POST['ama-re']))
	 {
		 echo $instFiltro -> insert_filtro_controller();
	 }
 }
	 
	 else
	 {
		 session_start();
		 session_destroy();
		 echo '<script> window.location.href"'.SRVURL.'login/" </script>';
	 }
	 