<?php	

	$requestAjax = true;
	 //require('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
	if ($requestAjax) 
		
 {require_once('../../APP/Model/SGMXModel.php'); 
  
 }else{require_once('./APP/Model/SGMXModel.php');}
 
class UpdUser extends SGMXModel{
	 
	 public function upd_user_controller()
	 {

        $con = sqlsrv_connect(SERVER,CONNINF);
		
		                    $id=SGMXModel::clean_string($_POST['mod_id']);
                            $status=SGMXModel::clean_string($_POST['mod_status']);
                            $nombre=SGMXModel::clean_string($_POST['mod_nombre']);
							$pro=SGMXModel::clean_string($_POST['mod_pro']);
                            $supervisor=SGMXModel::clean_string($_POST['mod_supervisor']);
							$perfil=SGMXModel::clean_string($_POST['mod_perfil']);
							$sexo=SGMXModel::clean_string($_POST['mod_sexo']);
							$peri=SGMXModel::clean_string($_POST['mod_peri']);
							$eciv=SGMXModel::clean_string($_POST['mod_eciv']);
							$domi=SGMXModel::clean_string($_POST['mod_domi']);
							$mail=SGMXModel::clean_string($_POST['mod_mail']);
							$pass=SGMXModel::clean_string($_POST['mod_pass']);
							$banco=SGMXModel::clean_string($_POST['mod_banco']);
							$cuenta=SGMXModel::clean_string($_POST['mod_cuenta']);
							$clabe=SGMXModel::clean_string($_POST['mod_clabe']);
							$rfc=SGMXModel::clean_string($_POST['mod_rfc']);
							$curp=SGMXModel::clean_string($_POST['mod_curp']);
							$nss=SGMXModel::clean_string($_POST['mod_nss']);
							$fenac=SGMXModel::clean_string($_POST['mod_fenac']);
							$lunac=SGMXModel::clean_string($_POST['mod_lunac']);
							$fein=SGMXModel::clean_string($_POST['mod_fein']);
							$info=SGMXModel::clean_string($_POST['mod_info']);
							$ninfo=SGMXModel::clean_string($_POST['mod_ninfo']);
							$finfo=SGMXModel::clean_string($_POST['mod_finfo']);
							$edad=SGMXModel::clean_string($_POST['mod_edad']);
							$tel=SGMXModel::clean_string($_POST['mod_tel']);
							$area=SGMXModel::clean_string($_POST['mod_area']);
							$clavepu=SGMXModel::clean_string($_POST['mod_clavepu']);
							$npuesto=SGMXModel::clean_string($_POST['mod_npuesto']);
							$sueldo=SGMXModel::clean_string($_POST['mod_sueldo']);
							$sbc=SGMXModel::clean_string($_POST['mod_sbc']);
							$mensual=SGMXModel::clean_string($_POST['mod_mensual']);
							$quince=SGMXModel::clean_string($_POST['mod_quince']);
							$brutomes=SGMXModel::clean_string($_POST['mod_brutomes']);

		                  
		
	                       			$encodepass= SGMXModel::  passencrypt($pass);
					$camposU = array(
					"idu"=>$id,
					"proy"=> $pro,
					"perfil"=> $perfil,
					"supervisor"=> $supervisor,
					"sexo"=> $sexo,
					"perio"=> $peri,
					"estadoC"=> $eciv,
					"nombre"=>$nombre,
					"domicilio"=>$domi,
					"correo"=>$mail,
					"nombreB"=>$banco,
					"cuentaB"=>$cuenta,
					"clabeB"=>$clabe,
					"rfc"=>$rfc,
					"curp"=>$curp,
					"nss"=>$nss,
					"fechaN"=>$fenac,
					"lugarN"=>$lunac,
					"fechaI"=> $fein,
					"cuentaC"=>$info,
					"numeroI"=>$ninfo,
					"factorDI"=>$finfo,
					"edad"=>$edad,
					"telefono"=>$tel,
					"estatus"=> $status,					
					);
					$guardaU = SGMXModel:: upd_user($camposU);
					
					$camposP = array(
					"idu"=>$id,
					"areaT"=>$area,
					"claveP"=>$clavepu,
					"puesto"=>$npuesto,
					"sueldoD"=>$sueldo,
					"sbc"=>$sbc,
					"netoM"=>$mensual,
					"quincenal"=>$quince,
					"brutoM"=>$brutomes,										
					);
				
					
					$guardaP = SGMXModel:: upd_puesto($camposP);
				


			if ($guardaU ->rowCount()>=1){
				$messages[] = "Los datos han sido actualizados.";
                
				if($_POST["mod_pass"]!=""){
					$query="update [PSA.UsuarioAsistencia] set Password='$encodepass' where PK_IdUsuario='$id'";
					$update_passwd=sqlsrv_query($con,$query,PARAMS,OPTION);
					if ($update_passwd) {
						$messages[] = " Se actualizo la contraseña.";
					}
				}
			
			} else{
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
	 }
 }
 
  $upduser = new  UpdUser();
	 
	
		 echo $upduser -> upd_user_controller();
	 
 
?>