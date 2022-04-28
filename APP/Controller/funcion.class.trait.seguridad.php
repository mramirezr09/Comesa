<?php

trait seguridad{
function obtener_ip()
	{
							if (isset($_SERVER["HTTP_CLIENT_IP"]))
							{
								$IP= $_SERVER["HTTP_CLIENT_IP"];
							} elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
							{
								$IP=  $_SERVER["HTTP_X_FORWARDED_FOR"];
							} elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
							{
								$IP=  $_SERVER["HTTP_X_FORWARDED"];
							} elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
							{
								$IP=  $_SERVER["HTTP_FORWARDED_FOR"];
							} elseif (isset($_SERVER["HTTP_FORWARDED"]))
							{
								$IP=  $_SERVER["HTTP_FORWARDED"];
							} 
							elseif(isset($_SERVER['HTTP_X_REAL_IP']))
							{
								$IP=  $_SERVER['HTTP_X_REAL_IP'];
							}else
							{
								$IP= $_SERVER['REMOTE_ADDR'];	
							}
							return $IP;
	}

function upload_file($arg,$tipo,$tmp_name)
{
	extract($arg, EXTR_SKIP);
	$filename=uniqd(microtime()).$filename;
	$ext = end(explode('.',$filename));
	$filename= substr(md5($filename),0,10);
	$filename = $filename.'.'.$ext;
	if($tipo=='7'){
				$filepath = $ruta. $filename;
			}elseif($tipo=='8')
			{
				$filepath = $ruta. $filename;
			}elseif($tipo=='9')
			{
				$filepath = $ruta. $filename;
			}elseif($tipo=='10')
			{
				$filepath = $ruta. $filename;
			}
			move_uploaded_file($tmp_name, $filepath);
				# Le cambiamos los permisos al archivo
			chmod( $filepath , 0644 );
}
}
?>