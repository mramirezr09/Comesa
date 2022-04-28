<?php
ob_start();
try{
	//echo phpinfo() ;
	require('Script/core/Globalcfg.php"');
	require_once('APP/Controller/funcion.class.SGMX_Controller.php');
	$sgmx = new sgmx_Controller();
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Angel Ventura Sanchez">
		<meta name="description" content="Sistema de control de horarios para SEGALMEX">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>:: Sistema Integral Comesa</title>
		<!-- Estilos del aplicativo -->
		<link rel="stylesheet"  href="<?php echo SRVURL; ?>Script/css/custom.min.css">
		<link href="<?php echo SRVURL; ?>css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo SRVURL; ?>css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo SRVURL; ?>css/nprogress/nprogress.css" rel="stylesheet">
		<link href="<?php echo SRVURL; ?>css/animate.css/animate.min.css" rel="stylesheet">
		<link href="<?php echo SRVURL; ?>css/iCheck/skins/flat/green.css" rel="stylesheet">
		<link href="<?php echo SRVURL; ?>css/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
		<link href="<?php echo SRVURL; ?>css/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo SRVURL; ?>css/micss.css">
		<link href="<?php echo SRVURL; ?>css/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo SRVURL; ?>css/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo SRVURL; ?>css/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo SRVURL; ?>css/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo SRVURL; ?>css/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo SRVURL; ?>fancybox/dist/jquery.fancybox.min.css" rel="stylesheet" type="text/css" />
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="<?php echo SRVURL; ?>fancybox/dist/jquery.fancybox.min.js" type="text/javascript"></script>
		<link rel='stylesheet prefetch' href="<?php echo SRVURL; ?>Script/css/bootstrap-select.min.css">
	</head>
	<!-- Inicia el cuerpo-->
	<body>
		<?php
			$sgmx ->get_template_controller();
			require_once("Script/View_module/SGMX.viewfooter.php");
		?>
	</body>
		<?php
			} catch (Exception $e) {}
			ob_end_flush();
		?>
</html>
