<?php
  if ($requestAjax) {
    require ('../../APP/Model/LoginModel.php');
  }
  else {
    require ('././APP/Model/LoginModel.php');
  }

  class login extends loginModel {
    public function controller_login_session() {
		$usuario= SGMXModel :: clean_string($_POST['usuario']);
		$clave= SGMXModel :: clean_string($_POST['clave']);
		$claven=SGMXModel :: passencrypt($clave);

		$infologin=array(
      'userlogin'=>$usuario,
      'contrasena'=>$claven,
		);
    $infosession=loginModel :: model_login_session($infologin);
    $conn= SGMXModel::connect_MSSQL();
    $query1= "
      SELECT
        *
      FROM [PRO_SERVER_COMESA].[dbo].[PSC.Usuario]
      WHERE
        [login]='$usuario'and
        [Password]='$claven' and
        [Estatus]= 1
    ";
    $stmt= sqlsrv_query($conn,$query1,PARAMS,OPTION);
    $count= sqlsrv_num_rows($stmt);
		//print_r($query1);
		//print_r($stmt);

    if ($count==1) {
      $row=$infosession -> fetch();
      $horainicio = date('H:i:s');
      $factualiza = date('Y-m-d H:i:s');
			$conn2= SGMXModel::connect_MSSQL();
      $que1= "
      SELECT
        [Pk_IdBitacoraEvento]
      FROM
        [PRO_SERVER_COMESA].[dbo].[PSC.Bitacora_Evento]
      ";
      $stmt1= sqlsrv_query($conn2,$que1,PARAMS,OPTION);
      $count1= sqlsrv_num_rows($stmt1)+1;
			$claveb= SGMXModel :: generator_PK("CB-",4,$count1);
      $infobitacora = array(
        'clave'=>$claveb,
        'factualiza'=>$factualiza,
        'hinicio' => $horainicio,
        'hfinal' => NULL,
        'nbitacora' => $row ['Nombre'],
        'cuser' => $row['Cve_Usuario'],
      );
      $insertbitacora = SGMXModel :: bitacora_evento($infobitacora);
      if($insertbitacora -> rowCount()>=1) {
        session_start(array('name'=>'SGMX'));
        $_SESSION['id_sgmx'] = $row ['PK_IdUsuario'];
        $_SESSION['usuario_sgmx'] = $row ['Nombre'];
        $_SESSION['perfil_sgmx'] = $row ['FK_IdPerfil'];
        $_SESSION['token_sgmx'] = md5(uniqid(mt_rand(),true));
        $_SESSION['cve_sgmx'] = $row ['Cve_Usuario'];
        $_SESSION['Img_sgmx'] = $row ['Img_Perfil'];
        $_SESSION['clave_evento']=$claveb;
				;

        if ($row['FK_IdPerfil']==2) {
          $url =SRVURL."Filtro_Comesa/";
        }
        elseif($row['FK_IdPerfil']==1) {
          $url =SRVURL."Registros_Comesa/";
        }
        elseif($row['FK_IdPerfil']==3) {
          $url =SRVURL."Filtro_Comesa/";
        }
				return $urlLocation='<script>window.location="'.$url.'"</script>';
      }
      else {
        $alerta=array(
          'Alerta' => "basic",
					'Titulo' => " Algo anda mal",
					'Texto' =>  " No se ha podido iniciar sesi??n, intente de nuevo",
					'Tipo' =>   "error"
        );
      }
    }
    else {
      $alerta=array(
        'Alerta' => "basic",
				'Titulo' => " No se pudo iniciar sesi??n",
				'Texto' =>  " El correo o la contrase??a no son correctos",
				'Tipo' =>   "error"
      );
      return SGMXModel :: sweet_alert($alerta);
    }
  }
  public function controller_exit_session() {
    session_start(array('name'=>'SGMX'));
    $token = SGMXModel :: passdecryption($_GET['token']);
    $hora= date ("H:i:s");
    $info =array(
      "Id"=> $_SESSION['id_sgmx'],
      "Usuario"=> $_SESSION['usuario_sgmx'],
      "Token_U"=> $_SESSION['token_sgmx'],
      "token"=> $token,
      "clave"=>$_SESSION['clave_evento'],
      "hora"=>$hora,
    );
    return loginModel:: model_exit_session($info);
    print_r($info);
  }

  public function controller_close_session(){
    session_destroy();
    return header ("Location: ".SRVURL."login/");
  }
}
