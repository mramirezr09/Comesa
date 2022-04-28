<?php

session_start(array('name'=>'SGMX'));
$requestAjax = true;
	
	if ($requestAjax) 
		
 {require_once('../../APP/Model/SGMXModel.php'); 
  
 }else{require_once('./APP/Model/SGMXModel.php');}
 
class UpdPass extends SGMXModel{
	 
	 public function upd_Pass_controller()
	 {

        $con = sqlsrv_connect(SERVER,CONNINF);
		
		                    $id=SGMXModel::clean_string($_POST['mod_id']);
							$pass1=SGMXModel::clean_string($_POST['mod_pass1']);
							$pass2=SGMXModel::clean_string($_POST['mod_pass2']);
							$pass3=SGMXModel::clean_string($_POST['mod_pass3']);

	                 /*      			
									
					$camposupd = array(
					"idu"=>$id,
					"correo"=>$mail,
								
					);
					$actU = SGMXModel:: upd_pass($camposupd);
					print_r($camposupd);
					*/
					$passant= SGMXModel::  passencrypt($pass1);
				$encodepass= SGMXModel::  passencrypt($pass2);


			
				if($_POST["mod_pass2"]!=""){
					
					
  
        
					
					if($pass2==$pass3){
						      $con = sqlsrv_connect(SERVER,CONNINF);
					
					            $query= "SELECT * FROM [PRO_SERVER_ASISTENCIA].[dbo].[PSA.UsuarioAsistencia]
			                 WHERE PK_IdUsuario='$id'";
                             $query=sqlsrv_query($con,$query,PARAMS,OPTION);
  
					 while ($row=sqlsrv_fetch_array($query)) {
                  $pass = $row['Password'];
  
                         }
						 
						 if ($pass==$passant){
					
					$query="update [PSA.UsuarioAsistencia] set Password='$encodepass' where PK_IdUsuario='$id'";
					$update_passwd=sqlsrv_query($con,$query,PARAMS,OPTION);
					if ($update_passwd) {
						$messages[] = " Se actualizo la contraseña.";
					}
					
						 }else{
					$errors [] = " La contraseña no coincide con la anterior.";
            	
				            }
					}else{
				$errors [] = "Las nuevas contraseñas no coinciden.";
            	
			}
					
					
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
 
  $updpass = new  UpdPass();
	 
	
		 echo $updpass -> upd_Pass_controller();
	 
 
?>
