<?php
session_start(array('name'=>'SGMX'));
if($_SESSION['id_sgmx']){
	session_unset();
	session_destroy();
	header ("Location: ".SRVURL."login/");
}
else{
	header ("Location: ".SRVURL."login/");
}
?>