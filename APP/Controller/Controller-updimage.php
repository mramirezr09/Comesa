<?php
session_start(array('name'=>'SGMX'));
$id_u=$_SESSION['id_sgmx'];
 require('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
    $con = sqlsrv_connect(SERVER,CONNINF);

if (isset($_FILES["file"]))
{
    $file = $_FILES["file"];
    $name = $file["name"];
    $type = $file["type"];
    $tmp_n = $file["tmp_name"];
    $size = $file["size"];
	$server="S:/CHECADOR_SEGALMEX/";
    $folder = "Script/assets/profile/";
    
    if ($type != 'image/jpg' && $type != 'image/jpeg' && $type != 'image/png' && $type != 'image/gif')
    {
      echo "Error, el archivo no es una imagen"; 
    }
    else if ($size > 1024*1024)
    {
      echo "Error, el tamaño máximo permitido es un 1MB";
    }
    else
    {
        $src = $server.$folder.$name;
       @move_uploaded_file($tmp_n,$src);

	$query=sqlsrv_query($con, "UPDATE [PRO_SERVER_ASISTENCIA].[dbo].[PSA.UsuarioAsistencia] set [Img_Perfil]='$name' WHERE PK_IdUsuario='$id_u'");
       if($query){
        echo "<div class='alert alert-success' role='alert'>
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            <strong>¡Bien hecho!</strong> Perfil Actualizado Correctamente
        </div>";
       }
    }
}