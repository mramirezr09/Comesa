<?php
	require_once('APP/Controller/funcion.class.sgmx.define.BBDD.php');
	require('PHPExcel/Classes/PHPExcel.php');
	$conect = sqlsrv_connect(SERVER,CONNINF);
	
	$inicio=$_SESSION['inicio'];
	$fin=$_SESSION['fin'];
	
	//print_r($inicio);

	
        if ( $inicio != "" && $fin != "") {
            $sWhere = " where CAST(t1.Fecha_Asistencia as date) between '$inicio' and '$fin' group by t1.FK_IdUsuario";
		}
        else{
		$sWhere.="group by t1.FK_IdUsuario";
		//group by t1.FK_IdUsuario
		//convert( char(10),t1.Fecha_Asistencia,120 )
		}
	$query= " SELECT 
			t1.PK_IdUsuario AS ID,
			t1.Nombre AS Empleado,
			t2.Nombre AS Perfil,
			t3.Nombre AS Proyecto,
			CONVERT(varchar,t4.Hora_Entrada,8) AS Entrada,
			CONVERT(varchar,t4.Hora_Salida,8) AS Salida,
			t1.Fk_IdPuesto AS Puesto
						
			FROM [PSA.UsuarioAsistencia]t1
			LEFT JOIN [PSA.Perfil_Usuario]t2 ON t1.FK_IdPerfil=t2.PK_IdPerfil
			LEFT JOIN [PSA.Proyecto]t3 ON t1.FK_IdProyecto=t3.PK_IdProyecto
			LEFT JOIN [PSA.Horario_Empleado]t4 ON t1.FK_IdHorario=t4.PK_IdHorario";

      //print_r($query);
       $query=sqlsrv_query($conect,$query,PARAMS,OPTION);
	   
	   while ($res=sqlsrv_fetch_array($query)) 
	   {
		   
		                     $entrada=$res['Entrada'];
                            $salida=$res['Salida'];
							$userlog=$res['ID'];
	   }	

	$query1= "SELECT 
				t1.FK_IdUsuario as ID,
				convert( char(10),t1.Fecha_Asistencia,120) AS Fecha, 
				(t2.Apallido_Paterno+' '+t2.Apallido_Materno+' '+ t2.Nombre) as Nombre,
				t3.Nombre_Puesto as Puesto,
				(select CASE 
					WHEN CONVERT(CHAR(5), '$entrada', 108)> = CONVERT(CHAR(5), MIN( t1.Fecha_Asistencia ) , 108) 
					THEN 'A tiempo' ELSE 'Retardo' END) as 'Estado Entrada',
				MIN (CONVERT(CHAR(8), t1.Fecha_Asistencia,108 )) as 'Hora Entrada',
				MAX(CONVERT(CHAR(8), t1.Fecha_Asistencia,108 )) as 'Hora Salida',
				(select CASE 
							WHEN  CONVERT(CHAR(5), MAX( t1.Fecha_Asistencia ) , 108) > =CONVERT(CHAR(5), '$salida', 108) 
							THEN 'Completada' ELSE 'Incidencia' END) as 'Jornada Total'
				FROM [PSA.Registro_Asistencia] t1

				INNER JOIN [PSA.UsuarioAsistencia]t2 on t2.PK_IdUsuario=t1.FK_IdUsuario
				LEFT JOIN [PSA.Puesto]t3 on t2.FK_IdPuesto=t3.PK_IdPuesto
				$sWhere,
				convert( char(10),t1.Fecha_Asistencia,120 ),
				t1.fk_IdUsuario,t3.Nombre_Puesto , t2.nombre,  t2.Apallido_Materno, t2.Apallido_Paterno, CAST( t1.Fecha_Asistencia AS DATE )
				
				order by t1.FK_IdUsuario ASC";
//print_r($query1);
	$query1 = sqlsrv_query($conect, $query1, PARAMS, OPTION);
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Mauricio Ramírez")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '122E43')
        )
    )
);

$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->setBold(true)->getColor()->setRGB('fffefc');

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Fecha')
            ->setCellValue('C1', 'Nombre')
			->setCellValue('D1', 'Puesto')
			->setCellValue('E1', 'Estado Entrada')
			->setCellValue('F1', 'Hora Entrada')
			->setCellValue('G1', 'Hora Salida')
			->setCellValue('H1', 'Jornada Total');
			$i = 2;

			while ($registros = sqlsrv_fetch_array($query1)) {
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $registros['ID'])
				->setCellValue('B'.$i, $registros['Fecha'])
				->setCellValue('C'.$i, utf8_encode ($registros['Nombre']))
				->setCellValue('D'.$i, $registros['Puesto'])
				->setCellValue('E'.$i, $registros['Estado Entrada'])
				->setCellValue('F'.$i, $registros['Hora Entrada'])
				->setCellValue('G'.$i, $registros['Hora Salida'])
				->setCellValue('H'.$i, $registros['Jornada Total']);
				
				$i++;
			}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte de Asistencias');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

$fecha = date('Y-m-d');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte_Asistencia_'.$fecha.'.xls"');
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