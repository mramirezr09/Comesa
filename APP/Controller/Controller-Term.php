<?php 
 require_once('../../Script/core/Globalcfg.php');
if ($requestAjax) 
 {require_once('../../APP/Model/SGMXModel.php');
 
 }else{require_once('././APP/Model/SGMXModel.php');}
 	//print_r($_POST);
	
	

 class terminos extends SGMXModel 
{

   public  function insert_QR_controller()
    {
  
		$usuario= SGMXModel :: clean_string($_POST['usuario']);
		 $documento= SGMXModel :: clean_string($_POST['documento']);
	
		           
					
					//$cve= SGMXModel ::generator_PK('Key-',6,$numero);
					$ruta = "prueba";
					$cod = "codigo";
					$time= date('Y-m-d H:i:s');
					
					$insertQR=array(
					"usuario"=>$usuario ,
					"documento" => $documento,
					"ruta"=> $ruta ,
					"n-cod"=> $cod ,
					"fechaact" => $time,

					 );
					

					
					$saver= SGMXModel :: inserta_qr($insertQR);
						if($saver->rowCount()>=1)
			            {
				         $alerta =array( 'Alerta' => "clean",
		                 'Titulo' => "Validación Correcta",
						 'Texto' =>  " De clic en aceptar para visualizar su documento",
						 'Tipo'  =>   "success"); 
						 
						    if($documento == 3)
							{
						 echo '<script> window.open("'.SRVURL.'lista-asistencia/")</script>';
						  echo '<script> window.location="'.SRVURL.'Mireporte/" </script>';
							}
						else{
								echo '<script> window.open("'.SRVURL.'lista-actividades/")</script>';
						        echo '<script> window.location="'.SRVURL.'Mireporte/" </script>';
							}
						//<script>window.location = SRVURL."lista-asistencia"</script>
                       
                          
							
			             }
			             else
						{
				         $alerta =array( 'Alerta' => "basic",
		                 'Titulo' => " No se realizo la validación",
						 'Texto' =>  " Por favor consulta al administrador",
						 'Tipo'  =>   "error");  	
						// print_r($insertQR);		 
						}
					
	  
	return SGMXModel :: sweet_alert ($alerta); 

}
    
}