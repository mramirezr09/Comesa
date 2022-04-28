<?php //Modelo usuarios

if ($requestAjax) { //Validador de solicitudes enviadas por Ajax
  require_once('../../APP/Model/SGMXModel.php');
 // Request por AJAX
 }
 else {
   require_once('././APP/Model/SGMXModel.php');
}
 //print_r($_POST);

session_start(array('name'=>'SGMX'));

class controlcostos extends SGMXModel {
//nombre nss, nss2, curp, puesto
  public  function insert_controlCostos_controller() {// Función para  insertar usuarios
    //funcion limpiar cadenas
  	$id= $_POST['mod_ide'];
	//$print_r($id);
    $origen1 = SGMXModel::clean_string($_POST['origen1']);
    $destino1 = SGMXModel::clean_string($_POST['destino1']);
    $valor = SGMXModel::clean_string($_POST['valor1']);
    $fechaV = SGMXModel::clean_string($_POST['fecha1']);
	
	$fechaA = date("Y-m-d H:i:s");	
    $conn1 = SGMXModel:: connect_MSSQL();
    $query2 =("SELECT [PK_IdRegistro] FROM [dbo].[PSC.RegistroDP]");
    $stmt1= sqlsrv_query($conn1,$query2,PARAMS,OPTION);
    $caunt1= sqlsrv_num_rows($stmt1);
    $insertCT=array( //insertar en  apuntadores del modelo información recuperada de la vista
      "fkidR"=>$id,
	  "origen"=>$origen1,
	  "destino"=>$destino1,
	  "costo"=>$valor,
      "fechaV"=>$fechaV,
	  "fechaA"=>$fechaA
		);
    $savereg2= SGMXModel :: inserta_registroCT($insertCT);//save row

    // alerta de cuardado
    if($savereg2->rowCount()>=1) {
    $alerta =array( 'Alerta' => "clean",
       'Titulo' => " Registro completo",
       'Texto' =>  " Se ha registrado con exito el viatico ",
       'Tipo'  =>   "success");
	   //print_r($savereg2);
    }
    else {
      $alerta =array( 'Alerta' => "basic",
      'Titulo' => " Algo no anda bien",
			'Texto' =>  " No se pudo guardar el registro",
			'Tipo'  =>   "error");
			//print_r($insertCT);
    }
  
   //fin funcion
   return SGMXModel :: sweet_alert ($alerta);
  }
}
