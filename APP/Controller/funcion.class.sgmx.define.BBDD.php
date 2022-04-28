<?php // Definicion de MSSQL

define('SERVER', 'DESKTOP-KVPNC2P\SRVDSBM');// Instancia Productiva
//define('SERVER', 'SRVDBSQL\PRUEBATI');
define('BBDD_MSSQL','PRO_SERVER_COMESA');

define('USER','UsVisionCorp');// Usuario Productivo
define('PASS_','V1s10n.4dm1n');

/*
define('USER','UsVisionCorp');/
define('PASS_','123qwe');
*/

define('PARAMS',array());
define('OPTION',array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));


define('CONNINF',array("Database"=>BBDD_MSSQL,"Uid"=>USER,"Pwd"=>PASS_));


define ('SGDB','odbc:Driver={SQL Server};Server='.SERVER.';Database='.BBDD_MSSQL.';Uid='.USER.';Pwd='.PASS_);

define ('METHOD','AES-256-CBC');
define ('SECRET_KEY','@SCLP$ppro123!"#');
define ('SECRET_IV','123');

?>
