<?php 

if ($requestAjax) 
 {require_once('../../APP/Model/SGMXModel.php');
 
 }else{require_once('././APP/Model/SGMXModel.php');}
 	//print_r($_POST);
	
	

 class ayuda extends SGMXModel 
{

   public  function insert_ayuda_controller()
    {
  
		 $fkid = SGMXModel::clean_string($_POST['fkid']);
		 $nombre = SGMXModel::clean_string($_POST['nombre-ay']);
	     $email = SGMXModel::clean_string($_POST['email-ay']);
		 $tel = SGMXModel::clean_string($_POST['tel-ay']);
		 $ayuda = SGMXModel::clean_string($_POST['ayuda']);
	
		             $conn1= SGMXModel::connect_MSSQL();
					$query2 =("SELECT [Pk_IdRegistroAyuda] FROM [dbo].[PSA.Registro_Ayuda]");
					$stmt1= sqlsrv_query($conn1,$query2,PARAMS,OPTION);
					$caunt1= sqlsrv_num_rows($stmt1);
					
					$numero = ($caunt1)+1;
					
					$cve= SGMXModel ::generator_PK('Key-',6,$numero);
					
					$time= date('Y-m-d H:i:s');
					
					$insertAY=array(
					"fkid"=>$fkid ,
					"nombre" => $nombre,
					"email"=> $email ,
					"tel"=> $tel ,
					"ayuda"=> $ayuda,
					"fechaact" => $time,
					"rowid" => $cve,

					 );
					

					
					$saver= SGMXModel :: inserta_ayuda($insertAY);
						if($saver->rowCount()>=1)
			            {
				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => " Registro Correcto",
						 'Texto' =>  " Gracia por tus comentarios, en breve estaremos en contacto contigo",
						 'Tipo'  =>   "success");  
						// print_r($caunt1);					
			             }
			             else
						{
				         $alerta =array( 'Alerta' => "basic",
		                 'Titulo' => " Algo no anda bien",
						 'Texto' =>  " No se pudo registrar tu comentario, por favor consulta al administrador",
						 'Tipo'  =>   "error");  	
						 //print_r($insertAY);		 
						}
					
	  
	return SGMXModel :: sweet_alert ($alerta); 
}
    
}