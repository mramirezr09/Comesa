<?php
  include "Script/View_module/SGMX.script.jquery.php";//LLamada Jquery
  include "Script/View_module/SGMX.script.alertas.php";
  $requestAjax = false;
  require_once('APP/Controller/funcion.class.SGMX_Controller.php');

  $cv= new sgmx_controller();
  $cvr=$cv ->get_view_controller();
  if ($cvr=='login' || $cvr=='error404'):
    if($cvr=='login') {
      require_once ('APP/View/login.sgmx.view.php');
    }
    else {
      require_once ('APP/View/error404.sgmx.view.php');
    }
  else:
    if(!isset($_SESSION)) {
      session_start(array('name'=>'SGMX'));
    }
    require_once('APP/Controller/Controller-login.php');
    $logcon = new login();
    if (!isset($_SESSION['token_sgmx']) || !isset($_SESSION['usuario_sgmx'])) {
      $logcon -> controller_close_session();
    }
    require("Script/View_module/SGMX.viewsidebar.php");
    require_once("Script/View_module/SGMX.viewnavcenter.php");
    require_once($cvr);
    include "Script/View_module/SGMX.Jquery.logout.php";
  endif;
  include "Script/View_module/SGMX.script.jquery.min.php";
?>
<script>
  $.material.init();
</script>
