<?php //Modelo usuarios

if ($requestAjax) //Validador de solicitudes enviadas por Ajax
 {require_once('../../APP/Model/SGMXModel.php');
 // Request por AJAX
 }
 else
 {
	 require_once('././APP/Model/SGMXModel.php');
	 
	 }
 	//print_r($_POST);



 class capturarODS extends SGMXModel
{

   public  function insert_ODS_controller()// Función para  insertar usuarios
{
         //funcion limpiar cadenas
		 //$id_u=$_SESSION['id_sgmx'];
	    // $pkid = SGMXModel::clean_string($_POST['fr']);
		 $frente = SGMXModel::clean_string($_POST['fr']);
		 $direq = SGMXModel::clean_string($_POST['dods']);
		 $ODS = SGMXModel::clean_string($_POST['ods']);
		 $q=  SGMXModel::clean_string($_POST['q']);
		 $r= SGMXModel::clean_string($_POST['r']);
		

					$conn1= SGMXModel::connect_MSSQL();
					$query1= "SELECT [ODS_Comesa]  FROM [dbo].[PSC.ODS]  WHERE [ODS_Comesa]= '$ODS'";
					$stmt= sqlsrv_query($conn1,$query1,PARAMS,OPTION);
					$caunt= sqlsrv_num_rows($stmt);

				    if($caunt>=1)
					{
					$alerta =array( 'Alerta' => "basic",
					'Titulo' => " Error en informacion",
					'Texto' =>  " Ponte trucha ya existe esta ODS",
					'Tipo'  =>   "error");
					}
		            else
					{

					$query2 =("SELECT [PK_IdODS] FROM [dbo].[PSC.ODS] where FK_IdFrente=$frente");
					$stmt1= sqlsrv_query($conn1,$query2,PARAMS,OPTION);
					$caunt1= sqlsrv_num_rows($stmt1);
                     // print_r($query2);
					  
					  
					  if($frente==2)
					  {
						  
					$numero = ($caunt1)+1;// get numero de registro pk +1
					$id='DN0'.$numero;
					$numeroc='0'.$numero;

					//$cve= SCLPMain ::generator_PK('CVE-',2,$numero);// crea cve
					// $encodelogin= SCLPMain ::  passencrypt($pass1);// encripta login
					//$encodepass= SCLPMain ::  passencrypt($pass1);// encripta pass
					$time= date('Y-m-d H:i:s');

					$insertRE=array(//insertar en  apuntadores del modelo información recuperada de la vista
					"pkid"=>$id,
					"fre"=>$frente,
					"direq"=> $direq,
					"numco"=> $numeroc,
					"ods"=> $ODS,
					"estatus"=>1,
					"q"=>$q,
					"r"=>$r,
					"fechacon"=>$time

					 );


					$savereg= SGMXModel :: insert_ODS($insertRE);//save row


					
					if($savereg->rowCount()>=1)
			            {
							

				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => " Registro completo",
						 'Texto' =>  " Se ha registrado con exito la ods ".$ODS,
						 'Tipo'  =>   "success");
						 
						 

			             }
			             else
						{
				         $alerta =array( 'Alerta' => "basic",
		                 'Titulo' => " Algo no anda bien",
						 'Texto' =>  " No se pudo guardar el registro",
						 'Tipo'  =>   "error");
						print_r($insertRE);
						print_r($savereg);
			            }
					}
                
				
				  if($frente==1)
					  {
						  
					$numero = ($caunt1)+1;// get numero de registro pk +1
					$id='DS00'.$numero;
					$numeroc='0'.$numero;

					//$cve= SCLPMain ::generator_PK('CVE-',2,$numero);// crea cve
					// $encodelogin= SCLPMain ::  passencrypt($pass1);// encripta login
					//$encodepass= SCLPMain ::  passencrypt($pass1);// encripta pass
					$time= date('Y-m-d H:i:s');

					$insertRE=array(//insertar en  apuntadores del modelo información recuperada de la vista
					"pkid"=>$id,
					"fre"=>$frente,
					"direq"=> $direq,
					"numco"=> $numeroc,
					"ods"=> $ODS,
					"estatus"=>1,
					"q"=>$q,
					"r"=>$r,
					"fechacon"=>$time

					 );


					$savereg= SGMXModel :: insert_ODS($insertRE);//save row


					
					if($savereg->rowCount()>=1)
			            {
							

				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => " Registro completo",
						 'Texto' =>  " Se ha registrado con exito la ods ".$ODS,
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
					}//fin
					
					
					  if($frente==3)
					  {
						  
					$numero = ($caunt1)+1;// get numero de registro pk +1
					$id='FI0'.$numero;
					$numeroc='0'.$numero;

					//$cve= SCLPMain ::generator_PK('CVE-',2,$numero);// crea cve
					// $encodelogin= SCLPMain ::  passencrypt($pass1);// encripta login
					//$encodepass= SCLPMain ::  passencrypt($pass1);// encripta pass
					$time= date('Y-m-d H:i:s');

					$insertRE=array(//insertar en  apuntadores del modelo información recuperada de la vista
					"pkid"=>$id,
					"fre"=>$frente,
					"direq"=> $direq,
					"numco"=> $numeroc,
					"ods"=> $ODS,
					"estatus"=>1,
					"q"=>$q,
					"r"=>$r,
					"fechacon"=>$time

					 );


					$savereg= SGMXModel :: insert_ODS($insertRE);//save row


					
					if($savereg->rowCount()>=1)
			            {
							

				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => " Registro completo",
						 'Texto' =>  " Se ha registrado con exito la ods ".$ODS,
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

?>