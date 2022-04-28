<?php


if ($requestAjax) 
 {require ('../../APP/Model/SGMXModel.php');
 }else{require ('./APP/Model/SGMXModel.php');}
 
 class loginModel extends SGMXModel
 {
	 protected function model_login_session ($info)
	 {

		 $sql = SGMXModel :: connect_ODBC() -> prepare 
		                                  ("SELECT * FROM [PRO_SERVER_COMESA].[dbo].[PSC.Usuario]
		                                               WHERE [login]=:userlogin and [Password]=:contrasena 
													   and [Estatus]= 1");
                                          $sql -> bindParam(':userlogin',$info['userlogin']);
										  $sql -> bindParam(':contrasena',$info['contrasena']);
										  $sql -> execute();
										  return $sql; 
										  print_r($sql);
								
	 }
	 
	 protected function model_exit_session($info)
	 {
		 if($info['Usuario']!="" && $info['Token_U']==$info['token']) 
		 {
			 $ubit = SGMXModel :: bitacora_update($info['clave'],$info['hora']);
			
			 
			 if($ubit ->rowCount()>=1)
			 {
				 session_unset();
				 session_destroy(); 
				 $request="true";
			 }else
			  {
			   $request="false";

			  }
		     }else
		 {
			 $request="false";
		
	     }
		 
		 return $request;
		 
		 
		 
	 }
 }
 
