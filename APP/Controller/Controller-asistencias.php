<?php 

if ($requestAjax) 
 {require_once('../../APP/Model/SGMXModel.php');

 }else{require_once('././APP/Model/SGMXModel.php');}
 	//print_r($_POST);
	
	

 class asistencia extends SGMXModel 
{

   public  function insert_check_controller()
    {
         //funcion limpiar cadenas
		 $evento = SGMXModel::clean_string($_POST['evento-as']);
	     $id = SGMXModel::clean_string($_POST['id-as']);
		 $nombre = SGMXModel::clean_string($_POST['nombre-as']);
		 $pro = SGMXModel::clean_string($_POST['pro-as']);
		 $pues = SGMXModel::clean_string($_POST['pues-as']);
		 $entrada = SGMXModel::clean_string($_POST['entrada-as']);
		 $salida = SGMXModel::clean_string($_POST['salida-as']);
		 
		
					$conn1= SGMXModel::connect_MSSQL();
					$query2 =("SELECT [Pk_IdUsuario] FROM [dbo].[PSA.UsuarioAsistencia]");
					$stmt1= sqlsrv_query($conn1,$query2,PARAMS,OPTION);
					$caunt1= sqlsrv_num_rows($stmt1);
					
					$numero = ($caunt1)+1;
					
					$cve= SGMXModel ::generator_PK('Key-',6,$numero);			
					$time= date('Y-m-d H:i:s');
					$date=date('Y-m-d');
					$hour=date('H:i:s');
		 
		  if($evento==1)
		 {
			 $conn= SGMXModel::connect_MSSQL();
					$query1= "  
					SELECT [FK_IdUsuario]
                    FROM [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Registro_Asistencia] 
                    WHERE Fk_IdUsuario= '$id' and FK_IdTipoAsistencia=1 and Fecha_c=CAST(GETDATE() AS DATE)";
					$stmt= sqlsrv_query($conn,$query1,PARAMS,OPTION);
					$caunt= sqlsrv_num_rows($stmt);
					
					if($caunt>=1)
					{
					$alerta=array(
					'Alerta' => "basic",
					'Titulo' => " Error",
					'Texto' =>  " Ya has registrado tu entrada el día de hoy",
					'Tipo' =>   "error"
					); 
					}
					else
					{
					$insertAS=array(
					"id"=>$id ,
					"evento" => $evento,
					"fecha"=> $time ,
					"fecha_c"=> $date ,
					"hora"=> 1,
					"fechaact" => $time,
					"rowid" => $cve,

					 );
					
					$saver= SGMXModel :: inserta_asistencia($insertAS);
						if($saver->rowCount()>=1)
			            {
				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => " Acceso Correcto",
						 'Texto' =>  " Tu entrada se registro a las: ".$hour,
						 'Tipo'  =>   "success");  
						// print_r($caunt1);					
			             }
			             else
						{
				         $alerta =array( 'Alerta' => "basic",
		                 'Titulo' => " Algo no anda bien",
						 'Texto' =>  " No se pudo registrar tu acceso, por favor consulta al administrador",
						 'Tipo'  =>   "error");  	
						 //print_r($insertAS);		 
						}
					}
					
              			
						
					}
		    elseif	($evento==2)
		   {
		     
					$conn= SGMXModel::connect_MSSQL();
					$query1= "
					SELECT [FK_IdUsuario]
                    FROM [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Registro_Asistencia] 
                    WHERE Fk_IdUsuario= '$id' and FK_IdTipoAsistencia=1 and Fecha_c=CAST(GETDATE() AS DATE)";
					$stmt= sqlsrv_query($conn,$query1,PARAMS,OPTION);
					$caunt= sqlsrv_num_rows($stmt);
					
					
					
					if($caunt<1)
					{
					$alerta =array( 'Alerta' => "basic",
					'Titulo' => " Error",
					'Texto' =>  " No has registrado tu entrada",
					'Tipo'  =>   "error");   
					}
					
					
		            else
		            {
			       
					$query2= "
					SELECT [FK_IdUsuario]
                    FROM [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Registro_Asistencia] 
                    WHERE Fk_IdUsuario= '$id' and FK_IdTipoAsistencia=2 and Fecha_c=CAST(GETDATE() AS DATE)";
					$stmt1= sqlsrv_query($conn,$query2,PARAMS,OPTION);
					$caunt1= sqlsrv_num_rows($stmt1);
					if($caunt1>=1){
						$alerta =array( 'Alerta' => "basic",
					'Titulo' => " Error",
					'Texto' =>  " Ya has registrado tu salida el día de hoy!",
					'Tipo'  =>   "error");
					}
					else{
					
					$insertAS=array(
					"id"=>$id ,
					"evento" => $evento,
					"fecha"=> $time ,
					"fecha_c"=> $date ,
					"hora"=> 1,
					"fechaact" => $time,
					"rowid" => $cve,

					 );
					
					$saver= SGMXModel :: inserta_asistencia($insertAS);
						if($saver->rowCount()>=1)
			            {
				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => " Acceso Correcto",
						 'Texto' =>  " Tu salida se registro a las: ".$hour,
						 'Tipo'  =>   "success");  
						 //print_r($caunt1);					
			             }
			             else
						{
				         $alerta =array( 'Alerta' => "basic",
		                 'Titulo' => " Algo no anda bien",
						 'Texto' =>  " No se pudo registrar tu acceso, por favor consulta al administrador",
						 'Tipo'  =>   "error");  	
						 //print_r($insertAS);		 
						}
					}
		   }
			
		   }
	
	 return SGMXModel :: sweet_alert ($alerta); 
}
   
}