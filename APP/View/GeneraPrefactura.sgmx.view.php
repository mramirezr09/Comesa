<?php
	//Obterner la variable
	ob_clean();
	$id=($_GET['id']);
	//echo $id;
	require ('APP/Controller/Controller-CrearPrefactura.php');
	$pdfprint= new PDF();
?>
