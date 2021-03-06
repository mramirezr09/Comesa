<?php //Modelo usuarios
  if ($requestAjax) {//Validador de solicitudes enviadas por Ajax
    require_once('../../APP/Model/SGMXModel.php');
  }  // Request por AJAX
  else {
    require_once('././APP/Model/SGMXModel.php');
  }
 	//print_r($_POST);
  session_start(array('name'=>'SGMX'));

  class Filtro extends SGMXModel {
    //nombre nss, nss2, curp, puesto
    public  function insert_filtro_controller() {// Función para  insertar usuarios
      //funcion limpiar cadenas
  		$id_u=$_SESSION['id_sgmx'];
  	  $apa = SGMXModel::clean_string(utf8_decode($_POST['apa-re']));
  		$ama = SGMXModel::clean_string(utf8_decode($_POST['ama-re']));
  		$nombre = SGMXModel::clean_string(utf8_decode($_POST['nombre-re']));
  		$puesto = SGMXModel::clean_string($_POST['puesto-re']);
  		$curp = SGMXModel::clean_string($_POST['curp-re']);
      // $campa = SGMXModel::clean_string($_POST['campa-re']);
  		//$tel = SGMXModel::clean_string($_POST['tel-re']);
      //$nss = SGMXModel::clean_string($_POST['nss-re']);
      // $frente = SGMXModel::clean_string($_POST['frente']);
  		$folio = SGMXModel::clean_string($_POST['frente']);
      $conn1= SGMXModel::connect_MSSQL();
      $query1= "SELECT [curp]  FROM [dbo].[PSC.RegistroDP]  WHERE [curp]= '$curp'";
      $stmt= sqlsrv_query($conn1,$query1,PARAMS,OPTION);
      $caunt= sqlsrv_num_rows($stmt);

  		// if($caunt>=1) {
      //   $alerta =array(
      //     'Alerta' => "basic",
      //     'Titulo' => " Error en informacion",
      //     'Texto' =>  " Ya existe un usuario con este curp en los registros",
      //     'Tipo'  =>   "error"
      //   );
      // }
      // else {
        $query2 =("SELECT [PK_IdRegistro] FROM [dbo].[PSC.RegistroDP]");
        $stmt1= sqlsrv_query($conn1,$query2,PARAMS,OPTION);
        $caunt1= sqlsrv_num_rows($stmt1);
				$numero = ($caunt1)+572;// get numero de registro pk +1
				$id='COM'.$numero;
				//$cve= SCLPMain ::generator_PK('CVE-',2,$numero);// crea cve
				// $encodelogin= SCLPMain ::  passencrypt($pass1);// encripta login
				//$encodepass= SCLPMain ::  passencrypt($pass1);// encripta pass
				$time= date('Y-m-d H:i:s');
				$nomco=$apa.' '.$ama.' '.$nombre;
		    $perfo=$_SESSION['perfil_sgmx'];

        if($perfo	== 2) {
          $insertRE=array(//insertar en  apuntadores del modelo información recuperada de la vista
            "pkid"=>$id,
  					"id_u"=>$id_u,
  					"filtroid"=>1,
  					"perfil"=>2,
  					"estre" => 1,
  					"puesto"=> $puesto,
  					"rei"=>0,
  					"idODS"=> $folio,
  					"apa"=>$apa ,
  					"ama" => $ama,
  					"nombre"=> $nombre,
  					"nomco"=> $apa.' '.$ama.' '.$nombre,
  					"curp"=> $curp,
  					//"nss"=> $nss,
  					//"tel"=> $tel,
  					"filtro"=> 1,
  					//"frente"=> $frente,
  					"estatus"=>1,
  					"fechacon"=>$time,
          );
          print_r($insertRE);
          $savereg= SGMXModel :: inserta_filtroJ($insertRE);//save row

          if($savereg->rowCount()>=1) {
            $alerta =array( 'Alerta' => "clean",
              'Titulo' => " Registro completo",
						  'Texto' =>  " Se ha registrado con exito a ".utf8_encode($nomco),
						  'Tipo'  =>   "success"
            );
          }
	         else {
             $alerta =array( 'Alerta' => "basic",
             'Titulo' => " Algo no anda bien",
			       'Texto' =>  " No Capturaste el Puesto",
		         'Tipo'  =>   "error");
           // print_r($insertRE);
         }
       }
       if($perfo	== 3) {
         $insertRE=array(//insertar en  apuntadores del modelo información recuperada de la vista
           "pkid"=>$id,
           "id_u"=>$id_u,
           "filtroid"=>1,
           "perfil"=>2,
           "estre" => 1,
           "puesto"=> $puesto,
           "rei"=>0,
					 "idODS"=> $folio,
					 "apa"=>$apa ,
					 "ama" => $ama,
					 "nombre"=> $nombre,
					 "nomco"=> $apa.' '.$ama.' '.$nombre,
					 "curp"=> $curp,
					 //"nss"=> $nss,
					 //"tel"=> $tel,
					 "filtro"=> 1,
					 //"frente"=> $frente,
					 "estatus"=>1,
           "fechacon"=>$time,
           "pnpcon"=>1,
         );
         //print_r($insertRE);
         $savereg= SGMXModel :: inserta_filtroPNP($insertRE);//save row
         $insertBO=array(//insertar en  apuntadores del modelo información recuperada de la vista
           "pkid"=>$id,
           "idODS"=> $folio,
           "id_u"=>$id_u,
           "fechaods"=>$time,
           "fechacon"=>$time,
         );

         $savebo= SGMXModel :: inserta_filtroPNP_ODS($insertBO);//save row
         if($savereg->rowCount()>=1) {
           $alerta =array( 'Alerta' => "clean",
           'Titulo' => " Registro completo",
				   'Texto' =>  " Se ha registrado con exito a ".utf8_encode($nomco),
				   'Tipo'  =>   "success"
         );
       }
       else{
         $alerta =array( 'Alerta' => "basic",
         'Titulo' => " Algo no anda bien",
				 'Texto' =>  " No Capturaste el Puesto",
				 'Tipo'  =>   "error"
       );
       // print_r($insertRE);
     }
   }
 // }
 //fin funcion
 return SGMXModel :: sweet_alert ($alerta);
  }
}
