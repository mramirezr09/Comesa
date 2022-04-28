<?php
	$requestAjax = true;
	 //require('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
	if ($requestAjax) {
		require_once('../../APP/Model/SGMXModel.php');
	}
	else {
		require_once('./APP/Model/SGMXModel.php');
	}

 session_start(array('name'=>'SGMX'));

class Upd_Filtro extends SGMXModel {
	public function upd_Filtro_controller() {

		$con = sqlsrv_connect(SERVER,CONNINF);

		$id = SGMXModel::clean_string($_POST['mod_id']);
		$filtroid = SGMXModel::clean_string($_POST['mod_filtroid']);
		$apa = SGMXModel::clean_string(utf8_decode($_POST['mod_apellidoP']));
		$ama = SGMXModel::clean_string(utf8_decode($_POST['mod_apellidoM']));
		$nombre = SGMXModel::clean_string(utf8_decode($_POST['mod_nombre']));
		//$estre = SGMXModel::clean_string($_POST['mod_registroE']);
		$puesto = SGMXModel::clean_string($_POST['mod_puesto']);
		$curp = SGMXModel::clean_string($_POST['mod_curpa']);
		//$tel = SGMXModel::clean_string($_POST['mod_numT']);
		//$nss = SGMXModel::clean_string($_POST['mod_nss']);
       // $odsori=  SGMXModel::clean_string($_POST['mod_ods']);
		$fechaA = date("Y-m-d H:i:s");

		 $perfo=$_SESSION['perfil_sgmx'];
		 $id_u=$_SESSION['id_sgmx'];

		 if($perfo	== 3) {

			 $insertRE=array(//insertar en  apuntadores del modelo información recuperada de la vista
				 "id"=>$id,
				 "filtroid"=> $filtroid,//
	       "puesto"=> $puesto,//			/
				 "apa"=>$apa,//
				 "ama" => $ama,//
				 "nombre"=> $nombre,//
				 "nomco"=> $apa.' '.$ama.' '.$nombre,
				 "curp"=> $curp,//
				 //"nss"=> $nss,//
				 //"cmed"=>$cmed,
         //"tel"=> $tel,//
				 "filtro"=> 0,//
				 "fechaA"=>$fechaA,
				 "capnp"=>1
			 );
			 //print_r($insertRE);
			 $savereg= SGMXModel :: upd_Filtro_ODS($insertRE);//save row
			 if ($savereg ->rowCount()>=1){
				 $messages[] = "Los datos han sido actualizados.";
				 if(isset ( $_POST ['mod_ods1'])) {
					 if($_POST["mod_ods1"]!=""){
						 $ods=  SGMXModel::clean_string($_POST['mod_ods1']);
						 $query="update [PSC.RegistroDP] set FK_IdODS='$ods' where Pk_IdRegistro='$id'";
						 //print_r($query);
						 $insertBO=array(//insertar en  apuntadores del modelo información recuperada de la vista
							 "pkid"=>$id,
							 "idODS"=> $ods,
							 "id_u"=>$id_u,
							 "fechaods"=>$fechaA,
							 "fechacon"=>$fechaA
						 );
						 $savebo= SGMXModel :: inserta_filtroPNP_ODS($insertBO);//save row


					$update_passwd=sqlsrv_query($con,$query,PARAMS,OPTION);
					if ($update_passwd) {
						$messages[] = " Se actualizo la ODS.";
					}
				}
	 }

		}
		else {
			//print_r($query);
			$errors []= "Lo siento algo ha salido mal intenta nuevamente.".sqlsrv_errors($con);
		}

		if (isset($errors)){
?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error!</strong>
<?php
				foreach ($errors as $error) {
					echo $error;
				}
?>
			</div>
<?php
		}
		if (isset($messages)){
?>
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡Actualización Correcta!</strong>
<?php
				foreach ($messages as $message) {
					echo $message;
				}
?>
				</div>
<?php
			}

	}//fin ciclo

	                  if($perfo	== 2)
				  {


		$insertRE=array(//insertar en  apuntadores del modelo información recuperada de la vista

			"id"=>$id,
			"filtroid"=> $filtroid,//
	        "puesto"=> $puesto,//			/
			"apa"=>$apa,//
			"ama" => $ama,//
			"nombre"=> $nombre,//
			"nomco"=> $apa.' '.$ama.' '.$nombre,
			"curp"=> $curp,//
			//"nss"=> $nss,//
			//"cmed"=>$cmed,
           //"tel"=> $tel,//
			"filtro"=> 0,//
			"fechaA"=>$fechaA

		);

		//print_r($insertRE);
		$savereg= SGMXModel :: upd_Filtro($insertRE);//save row


		if ($savereg ->rowCount()>=1){
			$messages[] = "Los datos han sido actualizados.";

				if(isset ( $_POST ['mod_ods1']))
	 {
				if($_POST["mod_ods1"]!=""){
					$ods=  SGMXModel::clean_string($_POST['mod_ods1']);
					$query="update [PSC.RegistroDP] set FK_IdODS='$ods' where Pk_IdRegistro='$id'";
					//print_r($query);
					$update_passwd=sqlsrv_query($con,$query,PARAMS,OPTION);
					if ($update_passwd) {
						$messages[] = " Se actualizo la ODS.";
					}
				}
	 }

		}
		else {
			//print_r($query);
			$errors []= "Lo siento algo ha salido mal intenta nuevamente.".sqlsrv_errors($con);
		}

		if (isset($errors)){
?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Error!</strong>
<?php
				foreach ($errors as $error) {
					echo $error;
				}
?>
			</div>
<?php
		}
		if (isset($messages)){
?>
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>¡Actualización Correcta!</strong>
<?php
				foreach ($messages as $message) {
					echo $message;
				}
?>
				</div>
<?php
			}

	}//fin ciclo




		}
}
	$updFiltro = new  Upd_Filtro();
	echo $updFiltro -> upd_Filtro_controller();
?>
