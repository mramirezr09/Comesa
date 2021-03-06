<?php
	$requestAjax = true;
	 //require('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
	if ($requestAjax) {
		require_once('../../APP/Model/SGMXModel.php');
	}
	else {
		require_once('./APP/Model/SGMXModel.php');
	}

class Upd_DP extends SGMXModel {
	public function upd_DP_controller() {

		$con = sqlsrv_connect(SERVER,CONNINF);

		$id = SGMXModel::clean_string($_POST['mod_idu']);
		$apa = SGMXModel::clean_string(utf8_decode($_POST['mod_apellidoP']));
		$ama = SGMXModel::clean_string(utf8_decode($_POST['mod_apellidoM']));
		$nombre = SGMXModel::clean_string(utf8_decode($_POST['mod_nombre']));
		//$estre = SGMXModel::clean_string($_POST['mod_registroE']);
		$puest = SGMXModel::clean_string($_POST['mod_puesto']);
		$curp = SGMXModel::clean_string($_POST['mod_curpa']);
		$rfc = SGMXModel::clean_string($_POST['mod_rfc']);
		$fechaN = SGMXModel::clean_string($_POST['mod_fechaN']);
		$luna = SGMXModel::clean_string($_POST['mod_lugarN']);
		$naci = SGMXModel::clean_string($_POST['mod_nacion']);
		$edad = SGMXModel::clean_string($_POST['mod_edad']);
		$sexo = SGMXModel::clean_string($_POST['mod_sexoid']);
		$estadoC = SGMXModel::clean_string($_POST['mod_estadocid']);
		$mail = SGMXModel::clean_string($_POST['mod_mail']);
		$tel = SGMXModel::clean_string($_POST['mod_numT']);
		$nss = SGMXModel::clean_string($_POST['mod_nss']);
		//$estado = SGMXModel::clean_string($_POST['mod_nombree']);
		$postal = SGMXModel::clean_string($_POST['mod_cp']);
		//$muni = SGMXModel::clean_string(utf8_decode($_POST['mod_municipio']));
		$colo = SGMXModel::clean_string(utf8_decode($_POST['mod_colonia']));
		$calle = SGMXModel::clean_string(utf8_decode($_POST['mod_calle']));
		$numext = SGMXModel::clean_string($_POST['mod_numE']);
		$numint = SGMXModel::clean_string($_POST['mod_numI']);
		$banco = SGMXModel::clean_string($_POST['mod_banco']);
		$clabeI= SGMXModel::clean_string($_POST['mod_clabe']);
		$info = SGMXModel::clean_string($_POST['mod_siNoInf']);
		$numeroI = SGMXModel::clean_string($_POST['mod_numInf']);
		$tipoC = SGMXModel::clean_string($_POST['mod_tipoInf']);
		$valorTI = SGMXModel::clean_string($_POST['mod_valorinf']);
		$esquema = SGMXModel::clean_string($_POST['mod_esqueman']);

		$contacto = SGMXModel::clean_string(utf8_decode($_POST['mod_contacto']));
		$telcon = SGMXModel::clean_string($_POST['mod_telcon']);

		$fechaA = date("Y-m-d H:i:s");

		$insertRE=array(//insertar en  apuntadores del modelo informaci??n recuperada de la vista

			"id"=>$id,
			"estado"=> $luna,//
			"esquema"=> $esquema,//
			"sexo"=> $sexo,//
			"naci"=> $naci,//
			//"estre" => $estre,//
			"apa"=>$apa,//
			"ama" => utf8_encode($ama),//
			"nombre"=> utf8_encode($nombre),//
			"nomco"=> $apa.' '.$ama.' '.$nombre,
			"edad"=> $edad,//
			"estadoC"=> $estadoC,//
			"mail"=> $mail,//
			"fechaN"=> $fechaN,//
			//"luna"=> $luna,//
			"calle"=> $calle,//
			"numext"=> $numext,//
			"numint"=> $numint,//
			//"muni"=> $muni,//
			"colo"=> $colo,//
			"postal"=>$postal,//
			"rfc"=> $rfc,//
			"curp"=> $curp,//
			"nss"=> $nss,//
			//"cmed"=>$cmed,
			"tel"=> $tel,//
			"puest"=> $puest,//
			"fechaA"=>$fechaA,
			"contacto"=>$contacto,
			"telcon"=>$telcon

		);

		// print_r($insertRE);
		$savereg= SGMXModel :: upd_DP($insertRE);//save row

		$insertDB = array(
			"id"=>$id,
			"info"=> $info,
			"banco"=> $banco,
			"clabeI"=> $clabeI,
			"numeroI"=> $numeroI,
			"tipoC"=> $tipoC,
			"valorTI"=> $valorTI,
			"fechaA"=>$fechaA
		);
		print_r($insertDB);
		$savereg2= SGMXModel :: upd_DB($insertDB);//save row

		if ($savereg ->rowCount()>=1){
			$messages[] = "Los datos han sido actualizados.";
		}
		else {
			
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
				<strong>??Actualizaci??n Correcta!</strong>
<?php
				foreach ($messages as $message) {
					echo $message;
				}
?>
				</div>
<?php
		}
	}
}
	$updDP = new  Upd_DP();
	echo $updDP -> upd_DP_controller();
?>
