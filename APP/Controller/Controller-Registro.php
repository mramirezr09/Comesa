<?php //Modelo usuarios

if ($requestAjax) //Validador de solicitudes enviadas por Ajax
 {require_once('../../APP/Model/SGMXModel.php');
 // Request por AJAX
 }else{require_once('././APP/Model/SGMXModel.php');}
 	//print_r($_POST);

session_start(array('name'=>'SGMX'));

 class registro extends SGMXModel
{
//nombre nss, nss2, curp, puesto
   public  function insert_registro_controller()// Función para  insertar usuarios
{
         //funcion limpiar cadenas
		 $id_u=$_SESSION['id_sgmx'];
	     $apa = SGMXModel::clean_string($_POST['apa']);
		 $ama = SGMXModel::clean_string($_POST['ama']);
		 $nombre = SGMXModel::clean_string($_POST['nombre']);
		 // $puesto = SGMXModel::clean_string($_POST['puesto']);
		 //$estre = SGMXModel::clean_string($_POST['estre']);
		 $curp = SGMXModel::clean_string($_POST['curp']);
		 $rfc = SGMXModel::clean_string($_POST['rfc']);
		 $fechaN = SGMXModel::clean_string($_POST['fechaN']);
		 $luna = SGMXModel::clean_string($_POST['luna']);
		 $postal = SGMXModel::clean_string($_POST['postal']);
		 $naci = SGMXModel::clean_string($_POST['naci']);
		 $edad = SGMXModel::clean_string($_POST['edad']);
		 $sexo = SGMXModel::clean_string($_POST['sexo']);
     $estadoC = SGMXModel::clean_string($_POST['estadoC']);
		 $mail = SGMXModel::clean_string($_POST['mail']);
		 $tel = SGMXModel::clean_string($_POST['tel']);
		 $nss = SGMXModel::clean_string($_POST['nss']);

		  $puest = SGMXModel::clean_string($_POST['puest']);
		   $esp = SGMXModel::clean_string($_POST['esp']);
		   $ced = SGMXModel::clean_string($_POST['ced']);
		   //$cmed = SGMXModel::clean_string($_POST['cmed']);
		    $part = SGMXModel::clean_string($_POST['part']);



		 $estado = SGMXModel::clean_string($_POST['estado']);
		 $muni = SGMXModel::clean_string($_POST['muni']);
		 $colo = SGMXModel::clean_string($_POST['colo']);
		  $calle = SGMXModel::clean_string($_POST['calle']);
		 $numext = SGMXModel::clean_string($_POST['numext']);
		 $numint = SGMXModel::clean_string($_POST['numint']);



		 $banco = SGMXModel::clean_string($_POST['banco']);
		  $clabeI = SGMXModel::clean_string($_POST['clabeI']);
      $cuenta = SGMXModel::clean_string($_POST['cuenta']);


		$info = SGMXModel::clean_string($_POST['info']);
		 $numeroI = SGMXModel::clean_string($_POST['numeroI']);


		$tipoC = SGMXModel::clean_string($_POST['tipoC']);
		 $valorTI = SGMXModel::clean_string($_POST['valorTI']);


		 $esquema = SGMXModel::clean_string($_POST['esquema']);
		 $nss2= SGMXModel::clean_string($_POST['nss2']);





		            /*

					$query1= "SELECT [Login]  FROM [dbo].[PSC.Usuario]  WHERE [Login]= '$login'";
					$stmt= sqlsrv_query($conn,$query1,PARAMS,OPTION);
					$caunt= sqlsrv_num_rows($stmt);
					*/
					$conn1= SGMXModel::connect_MSSQL();
					$query1= "SELECT [curp]  FROM [dbo].[PSC.RegistroDP]  WHERE [curp]= '$curp'";
					$stmt= sqlsrv_query($conn1,$query1,PARAMS,OPTION);
					$caunt= sqlsrv_num_rows($stmt);

				    if($caunt>=1)
					{
					$alerta =array( 'Alerta' => "basic",
					'Titulo' => " Error en informacion",
					'Texto' =>  " Ya existe un usuario con este curp en los registros",
					'Tipo'  =>   "error");
					}
		            else
		            {

                    if($nss != $nss2)
					{
						$alerta =array( 'Alerta' => "basic",
					'Titulo' => " Error en informacion",
					'Texto' =>  " no coincide el nss",
					'Tipo'  =>   "error");

					}


					else
					{

					$query2 =("SELECT [PK_IdRegistro] FROM [dbo].[PSC.RegistroDP]");
					$stmt1= sqlsrv_query($conn1,$query2,PARAMS,OPTION);
					$caunt1= sqlsrv_num_rows($stmt1);

					$numero = ($caunt1)+1000;// get numero de registro pk +1
					$id='COM'.$numero;

					//$cve= SCLPMain ::generator_PK('CVE-',2,$numero);// crea cve
					// $encodelogin= SCLPMain ::  passencrypt($pass1);// encripta login
					//$encodepass= SCLPMain ::  passencrypt($pass1);// encripta pass
					$time= date('Y-m-d H:i:s');
					$nomco=$apa.' '.$ama.' '.$nombre;

					$insertRE=array(//insertar en  apuntadores del modelo información recuperada de la vista
					"pkid"=>$id,
					"id_u"=>$id_u,
					"filtro"=> 1,
					"estado"=> $estado,
					"perfil"=>2,
					"esquema"=> $esquema,
					"sexo"=> $sexo,
                    "estadoC"=> $estadoC,
					"naci"=> $naci,
					//"estre" => $estre,
				//	"puesto"=> $puesto ,
					"apa"=>$apa ,
					"ama" => $ama,
					"nombre"=> $nombre ,
					"nomco"=> $apa.' '.$ama.' '.$nombre,
					"edad"=> $edad,
					"mail"=> $mail,
					"fechaN"=> $fechaN,
					"luna"=> $luna,
					"calle"=> $calle,
					"numext"=> $numext,
					"numint"=> $numint,
					"muni"=> $muni,
					"colo"=> $colo,
					"postal"=>$postal,
					"rfc"=> $rfc,
					"curp"=> $curp,
					"nss"=> $nss,
					"tel"=> $tel,
					"puest"=> $puest,
					"estatus"=>1,
					"fechacon"=>$time

					 );


					$savereg= SGMXModel :: inserta_registroDP($insertRE);//save row

					 $insertDB = array(

					"pkid"=>$id,
					"info"=> $info,
					"banco"=> $banco,
					"cuenta"=> $cuenta,
					"clabeI"=> $clabeI,
					"numeroI"=> $numeroI,
					"tipoC"=> $tipoC,
					"valorTI"=> $valorTI,

					);


					



					if($savereg->rowCount()>=1)
			            {
							
							$savereg2= SGMXModel :: inserta_registroDB($insertDB);//save row
				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => " Registro completo",
						 'Texto' =>  " Se ha registrado con exito a ".$nomco,
						 'Tipo'  =>   "success");
						 
						 

			             }
			             else
						{
				         $alerta =array( 'Alerta' => "basic",
		                 'Titulo' => " Algo no anda bien",
						 'Texto' =>  " No se pudo guardar el registro",
						 'Tipo'  =>   "error");
						print_r($insertRE);
			            }
					}

		            }
	 //fin funcion
	 return SGMXModel :: sweet_alert ($alerta);

}
}
