<?php
	error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING & ~E_NOTICE);
	if(!isset($_SESSION)) {
		session_start(array('name'=>'SGMX'));
	}

	class sgmx_view {
		protected function get_view_model($view) {
			$perfil= isset($_SESSION['perfil_sgmx']) ? $_SESSION['perfil_sgmx'] : null ;
			$perfil=$_SESSION['perfil_sgmx'];
			if($perfil == 1) {
				$urlist=array('Bienvenido','Inicio_Comesa','Registros_Comesa','Nuevo_Registro','Documentos_Sueldos',
				'Registros_Comesa','Mireporte','prueba_foto','pdfmasivo','Creacontrato','Creacredencial',
				'Nuevo_RegistroPNP','Generacontrato','Generacred','Filtro_Comesa','Actualizafoto','capturarODS','consultarODS','prefacturaODS','GeneraPrefactura');
			}
			else {
				$urlist=array('Bienvenido','Mireporte','Formatos','Ayuda','Acerca','NEJRSkE3WWFx','close','ContratacionFase','EstadoMoviAfili','Incapa',
		    'PlantiEmple','CedAutCou','CatEmpSed','lista-asistencia','lista-actividades','Administrador','PlantiEmpleExcel','CatEmpSedExcel',
				'ReporteAsis','Administrador','CargaReporte','DocIncidencia','ReporteAsisExcel','Recibos','pdfmasivo','MasivoActi','MiCuenta',
				'Comunicados','alertas','Registros_Comesa','prueba_foto','Creacredencial','Generacontrato',
				'Generacred','Inicio_Comesa','Filtro_Comesa','RegistroPNP','Actualizafoto','ReporteBase','Adminpnp','ReporteContratacion','ReporteConteo','capturarODS','consultarODS','prefacturaODS','GeneraPrefactura','prefacturaODS2');//generacion de array para las url permitidas del sitio
			}

			if(in_array($view, $urlist)) {
			   if(is_file("APP/View/".$view.".sgmx.view.php")) {
				   $content="APP/View/".$view.".sgmx.view.php";
			   }
			   else {
				  $content="login";
			   }
			}
			elseif($view=="login") {
				$content="login";
			}
			elseif($view=="Index") {
			    $content="login";
			}
			else {
				$content="error404";
			}
	      return $content;
		}
	}
