<?php
	//Obterner la variable
	ob_clean();
	$id=($_GET['contrato']);
	$esq=($_GET['esq']);
	//echo $id.' '.$esq;
	require ('APP/Controller/Controller-CrearContrato2022.php');
	$pdfprint= new PDF();
?>