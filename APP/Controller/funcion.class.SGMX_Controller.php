<?php
	require('APP/Model/View.SGMX_View.php');
	require_once('APP/Controller/funcion.class.trait.seguridad.php');
	require('APP/Controller/funcion.class.trait.constructor.php');

	class sgmx_controller extends sgmx_view {
		use seguridad;
		use constructor;
		public function get_template_controller() {
			return	require ('APP/View/Inicio.php');
		}
		public function get_view_controller() {
			if (isset($_GET['url'])) {
		  	$route = explode ('/', $_GET['url']);
		  	$reply  =  sgmx_view :: get_view_model($route[0]);
			}
	  	else {
				$reply = 'login';
	   	}
	   	return $reply;
		}
	}
