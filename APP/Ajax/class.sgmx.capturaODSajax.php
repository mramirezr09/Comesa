<?php
  $requestAjax = true;
  require ('../../Script/core/Globalcfg.php');
  if(isset($_POST['fr'])) {
    require_once('../../APP/Controller/Controller-RegistroODS.php');
    $instRE = new  capturarODS();
    if(isset ($_POST ['fr']) && isset($_POST['dods']) && isset($_POST['ods'])) {
      echo $instRE -> insert_ODS_controller();
    }
  }
  else {
    session_start();
  	session_destroy();
  	echo '<script> window.location.href"'.SRVURL.'login/" </script>';
  }
