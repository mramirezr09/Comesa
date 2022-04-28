<?php
	require_once('./APP/Controller/funcion.class.sgmx.define.BBDD.php');
   require('./PHPExcel/Classes/PHPExcel.php');
	$conect = sqlsrv_connect(SERVER,CONNINF);

	
        if ($q != "" ) {
            $sWhere = " where t1.FK_IdReingreso=1 and CAST(t1.Fecha_Contratacion as date)='$q'";
		}
        else {
			$sWhere = "where t1.FK_IdReingreso=1";
		}
	
	$query= "  
					select t2.Nombre_Puesto,
					t3.Nombre_Fase,
					count(t1.FK_IdPuesto)as Total 

					from [PSC.RegistroDP]t1
					LEFT JOIN  [PSC.Puesto]t2 ON t1.FK_IdPuesto=t2.PK_IdPuesto 
					LEFT JOIN [PSC.Fase_Puesto]t3 on t2.FK_IdFase=t3.PK_IdFase		  
		  
				 $sWhere 
				group by t1.FK_IdPuesto , t2.Nombre_Puesto,t3.Nombre_Fase
				order by Total DESC
				";
//print_r($query);
	$query = sqlsrv_query($conect, $query, PARAMS, OPTION);
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Angel Ventura")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$objPHPExcel->getActiveSheet()->getStyle('A1:AD1')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '122E43')
        )
    )
);

$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getStyle("A1:AD1")->getFont()->setBold(true)->getColor()->setRGB('fffefc');

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nombre Puesto')
            ->setCellValue('B1', 'NombreFase')
            ->setCellValue('C1', 'Total');
			$i = 2;

			while ($registros = sqlsrv_fetch_array($query)) {
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, utf8_encode ($registros['Nombre_Puesto']))
				->setCellValue('B'.$i, utf8_encode ($registros['Nombre_Fase']))
				->setCellValue('C'.$i, utf8_encode ($registros['Total']));
				
				$i++;
			}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Contratacion_conteo_fase');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

$fecha = date('Y-m-d');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="ConteoFase_'.$fecha.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>