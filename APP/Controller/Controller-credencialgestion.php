<?php 
session_start(array('name'=>'SGMX'));
$requestAjax = true;
require_once('../../APP/Model/SGMXModel.php'); 

        //$id=$_POST['id'];
		$nombre=utf8_decode($_POST["mod_nombrec"]);
		$puesto=utf8_decode($_POST["mod_pueston"]);
		$numse=$_POST["mod_numse"];// recupera, variable no utilizada
		$curp=$_POST["mod_curp"];
		$vigencia=utf8_decode($_POST["mod_vig"]);
		$contact=utf8_decode($_POST["mod_contact"]);
		$telc=$_POST["mod_telc"];
		$depto=$_POST["mod_dep"];
		
		$_SESSION['nuser']=$nombre;
	   $_SESSION['curpuser']=$curp;
	   
	   $rt="APP/Controller/";
	   $ruta=$rt.$nombre."_".$curp.".png";
	    $con = sqlsrv_connect(SERVER,CONNINF);
					$query1= "SELECT [curp]  FROM [dbo].[PSC.RegistroDP]  WHERE [curp]= '$curp'";
					$stmt= sqlsrv_query($con,$query1,PARAMS,OPTION);
					$caunt= sqlsrv_num_rows($stmt);

				    if($caunt>=1)
					{
						$sql=" INSERT INTO  [PRO_SERVER_COMESA].[dbo].[PSC.Credencial]
(
      [FK_IdRegistro]
      ,[Puesto]
      ,[Nombre_Completo]
      ,[NSS]
      ,[CURP]
      ,[Vigencia]
      ,[Contacto]
      ,[Contacto_Telefono]
	  ,[Departamento]
	  ,[Ruta]
      ,[Estatus]
)
VALUES
(
'$id',
'$nombre',
'$puesto',
'$numse',
'$curp',
'$vigencia',
'$contact',
'$telc',
'$depto',
'$ruta',
 1
)

";

$query_update = sqlsrv_query($con,$sql,PARAMS,OPTION);
			if ($query_update){
				$messages[] = "Los datos han sido registrados.";
                
		
			
			} else{
				print_r($sql);
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".sqlsrv_errors($con);
				
			}
					
					}
		            else
		            {
						
						$alerta =array( 'Alerta' => "basic",
					'Titulo' => " Error en informacion",
					'Texto' =>  " El curp no existe en el regsitro",
					'Tipo'  =>   "error");
						
					}
	   
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