<?php
	//Obterner la variable
	ob_clean();
	$id=($_GET['cred']);
	require ('APP/Controller/Controller-CrearCredencial.php');
	$pdfprint= new PDF();
?>