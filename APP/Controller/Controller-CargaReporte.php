<?php 

if ($requestAjax) 
 {require_once('../../APP/Model/SGMXModel.php');
 
 }else{require_once('././APP/Model/SGMXModel.php');}
 
 
 class cargaReporte extends SGMXModel
 {
	 
	 public function inserta_reporte_controller()
	 {
		 $fkid = SGMXModel::clean_string($_POST['fk-id']);
		 $pro = SGMXModel::clean_string($_POST['pro-re']);
		 $user = SGMXModel::clean_string($_POST['user-re']);
		 $tipor = SGMXModel::clean_string($_POST['tipo-re']);
	     $esqr = SGMXModel::clean_string($_POST['esq-re']);
	     $nomina = SGMXModel::clean_string($_POST['nom-re']);
	     $mes = SGMXModel::clean_string($_POST['mes-re']);
		 $nombre = SGMXModel::clean_string($_POST['nombre-re']);
		  $decri = SGMXModel::clean_string($_POST['desc-re']);
		  $peri = SGMXModel::clean_string($_POST['peri-re']);
		  
		  
           $file = $_FILES['file-re'];
		            $name = $file["name"];
					$type = $file["type"];
					$tmp_n = $file["tmp_name"];
					$size = $file["size"];
					$fecha= date("Y-m-d H:i:s");
				    $ruta="Web/Documentos/Reportes/";
					$server="S:/CHECADOR_SEGALMEX/";
		  
		  	if($tipor==1)
					{//inicio de condición principal
						
						if ($type != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
				        {
				           $alerta =array( 'Alerta' => "basic",
						   'Titulo' => " Error de archivo ",
						   'Texto' =>  " No se pudo guardar el registro,verifique que el archivo este en formato *.xlsx",
						   'Tipo'  =>   "error");  	
				         } 
						 else
						 {
						 
					
					         $nombrec=$nombre.".xlsx";
							 $docruta=$ruta."Nomina/";
							 $src=$server.$docruta.$nombrec;
							 
							 @move_uploaded_file($tmp_n,$src);
							 
					$insertRE=array(
					
					"tipor"=> $tipor,
					"pro"=>$pro,
					"esqr"=> $esqr,
					"nomina" => $nomina,
					"mes" => $mes,
					"peri" => $peri,
					"fkid"=>$fkid ,
					"nombre" => $nombre,
					"docruta" => $docruta,
					"nombrec"=> $nombrec,
					"estatus"=> 1,
					"decri"=> $decri,
					"fecha"=> $fecha,

					 );
					  $saver= SGMXModel :: inserta_reporte_model($insertRE);
						if($saver->rowCount()>=1)
			            {
				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => " Carga Correcta",
						 'Texto' =>  " Se ha cargado el reporte correctamente",
						 'Tipo'  =>   "success");  
										
			             }
			             else
						{
				         $alerta =array( 'Alerta' => "basic",
		                 'Titulo' => " Algo no anda bien",
						 'Texto' =>  " No se pudo cargar tu reporte, por favor consulta al administrador",
						 'Tipo'  =>   "error");  	
						 print_r($insertRE);			 
						}
					
					
					}//else fin
					}//inicio de condición principal
					
					if($tipor==2)
					{//inicio de condición principal
						
						if ($type != 'application/pdf')
				{
				$alerta =array( 'Alerta' => "basic",
						   'Titulo' => " Error de archivo ",
						   'Texto' =>  " No se pudo guardar el registro,verifique que el archivo este en formato *.pdf",
						   'Tipo'  =>   "error");  	
				} 
						 else
						 {
						 
					         
					         $nombrec=$nombre.".pdf";
							 $docruta=$ruta."Afiliatorios/";
							 
							  $src=$server.$docruta.$nombrec;
							 @move_uploaded_file($tmp_n,$src);
							 
					$insertRE=array(
					
					"tipor"=> $tipor,
					"pro"=>$pro,
					"esqr"=> $esqr,
					"nomina" => $nomina,
					"mes" => $mes,
					"peri" => $peri,
					"fkid"=>$fkid ,
					"nombre" => $nombre,
					"docruta" => $docruta,
					"nombrec"=> $nombrec,
					"estatus"=> 1,
					"decri"=> $decri,
					"fecha"=> $fecha,

					 );
					
					 $saver= SGMXModel :: inserta_reporte_model($insertRE);
						if($saver->rowCount()>=1)
			            {
				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => " Carga Correcta",
						 'Texto' =>  " Se ha cargado el reporte correctamente",
						 'Tipo'  =>   "success");  
										
			             }
			             else
						{
				         $alerta =array( 'Alerta' => "basic",
		                 'Titulo' => " Algo no anda bien",
						 'Texto' =>  " No se pudo cargar tu reporte, por favor consulta al administrador",
						 'Tipo'  =>   "error");  	
						 print_r($insertRE);			 
						}
					
					}//else fin
					}//inicio de condición principal
					
						  	
							
							if($tipor==3)
					{//inicio de condición principal
						
						if ($type != 'application/pdf')
				        {
				           $alerta =array( 'Alerta' => "basic",
						   'Titulo' => " Error de archivo ",
						   'Texto' =>  " No se pudo guardar el registro,verifique que el archivo este en formato *.pdf",
						   'Tipo'  =>   "error");  	
				         } 
						 else
						 {
						 
					
					         $nombrec=$nombre.".pdf";
							 $docruta=$ruta."Incapacidades/";
							 
							 $src=$server.$docruta.$nombrec;
							 @move_uploaded_file($tmp_n,$src);
					$insertRE=array(
					
					"tipor"=> $tipor,
					"pro"=>$pro,
					"esqr"=> $esqr,
					"nomina" => $nomina,
					"mes" => $mes,
					"peri" => $peri,
					"fkid"=>$fkid ,
					"nombre" => $nombre,
					"docruta" => $docruta,
					"nombrec"=> $nombrec,
					"estatus"=> 1,
					"decri"=> $decri,
					"fecha"=> $fecha,

					 );
					  $saver= SGMXModel :: inserta_reporte_model($insertRE);
						if($saver->rowCount()>=1)
			            {
				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => " Carga Correcta",
						 'Texto' =>  " Se ha cargado el reporte correctamente",
						 'Tipo'  =>   "success");  
										
			             }
			             else
						{
				         $alerta =array( 'Alerta' => "basic",
		                 'Titulo' => " Algo no anda bien",
						 'Texto' =>  " No se pudo cargar tu reporte, por favor consulta al administrador",
						 'Tipo'  =>   "error");  	
						 print_r($insertRE);			 
						}
					
					
					}//else fin
					}//inicio de condición principal
					
					
							if($tipor==5)
					{//inicio de condición principal
						
						if ($type != 'application/pdf')
				        {
				           $alerta =array( 'Alerta' => "basic",
						   'Titulo' => " Error de archivo ",
						   'Texto' =>  " No se pudo guardar el registro,verifique que el archivo este en formato *.pdf",
						   'Tipo'  =>   "error");  	
				         } 
						 else
						 {
						 
					
					         $nombrec=$nombre.".pdf";
							 $docruta=$ruta."Cedulas/";
							 $src=$server.$docruta.$nombrec;
							 @move_uploaded_file($tmp_n,$src);
					$insertRE=array(
					
					"tipor"=> $tipor,
					"pro"=>$pro,
					"esqr"=> $esqr,
					"nomina" => $nomina,
					"mes" => $mes,
					"peri" => $peri,
					"fkid"=>$fkid ,
					"nombre" => $nombre,
					"docruta" => $docruta,
					"nombrec"=> $nombrec,
					"estatus"=> 1,
					"decri"=> $decri,
					"fecha"=> $fecha,

					 );
					  $saver= SGMXModel :: inserta_reporte_model($insertRE);
						if($saver->rowCount()>=1)
			            {
				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => " Carga Correcta",
						 'Texto' =>  " Se ha cargado el reporte correctamente",
						 'Tipo'  =>   "success");  
										
			             }
			             else
						{
				         $alerta =array( 'Alerta' => "basic",
		                 'Titulo' => " Algo no anda bien",
						 'Texto' =>  " No se pudo cargar tu reporte, por favor consulta al administrador",
						 'Tipo'  =>   "error");  	
						 print_r($insertRE);			 
						}
					
					
					}//else fin
					}//inicio de condición principal
					
					 
					
					
						
	return SGMXModel :: sweet_alert ($alerta); 
		 
		
	 } 
	 
 }