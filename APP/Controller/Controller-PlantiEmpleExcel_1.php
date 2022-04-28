<?php
	require_once('APP/Controller/funcion.class.sgmx.define.BBDD.php');
	require('PHPExcel/Classes/PHPExcel.php');
	$conect = sqlsrv_connect(SERVER,CONNINF);
	
	$sede=$_SESSION['sede'];
	
	
	 if ( $sede != "" ) {
            $sWhere = " where   t1.FK_IdUnidadAdm='$sede' group by t1.PK_IdUsuario";
		}
        else{
		$sWhere.="group by t1.PK_IdUsuario";
		//group by t1.FK_IdUsuario
		//convert( char(10),t1.Fecha_Asistencia,120 )
		}

	$query= "select 
			PK_IdUsuario as 'N',
			t1.login as Login,
			t2.Nombre as 'ENTIDAD',
			t3.Nombre_Estado as 'ESTADO',
			t4.Nombre_UnidadAdm as 'UNIDAD',
			t1.Apallido_Paterno + ' ' + t1.Apallido_Materno  + ' ' +  t1.Nombre as 'NOMBRE_COMPLETO',
			t6.[Nombre_TipoPago] as 'ESQUEMAP',
			t1.Apallido_Paterno as 'APELLIDO PATERNO',
			t1.Apallido_Materno as 'APELLIDO MATERNO',
			t1.Nombre as 'NOMBRE (S)',
			t7.[Nombre_Puesto] as 'PUESTO EN CONTRATO O PERFIL',
			t7.[Sueldo] as 'SUELDO MENSUAL NETO',
			t1.Banco as BANCO,
			t1.Cuenta as CUENTA,
			t1.Clabe as CLABE,
			t1.RFC,
			t1.CURP,
			t1.NSS as 'N.S.S',
			t8.Nombre_Sexo as SEXO,
			t1.Fecha_Nacimiento AS 'FECHA DE NACIMIENTO',
			t1.Lugar_Nacimiento as 'LUGAR DE NACIMIENTO'


			from [PRO_SERVER_ASISTENCIA].[dbo].[PSA.UsuarioAsistencia] t1

			left join [dbo].[PSA.Proyecto]t2 on t1.FK_IdProyecto = t2.[PK_IdProyecto]
			left join [dbo].[PSA.Estado]t3 on t1.FK_IdEstado = t3.[PK_IdEstado]
			left join [dbo].[PSA.UnidadAdm]t4 on t1.FK_IdUnidadAdm = t4.[PK_IdUnidadAdm]
			left join [dbo].[PSA.TipoPago]t6 on t1.FK_IdTipoPago = t6.[PK_IdTipoPago]
			left join [dbo].[PSA.Puesto]t7 on t1.FK_IdPuesto = t7.[PK_IdPuesto]
			left join [dbo].[PSA.Sexo]t8 on t1.FK_IdSexo = t8.[PK_IdSexo]
			 $sWhere 
			,
			t2.Nombre,
			t1.Login,
			t3.Nombre_Estado,
			t4.Nombre_UnidadAdm,
			t1.Apallido_Paterno,
			t1.Apallido_Materno,
			t6.[Nombre_TipoPago],
			t1.Apallido_Paterno,
			t1.Apallido_Materno,
			t1.Nombre,
			t7.[Nombre_Puesto],
			t7.[Sueldo],
			t1.Banco,
			t1.Cuenta,
			t1.Clabe,
			t1.RFC,
			t1.CURP,
			t1.NSS,
			t8.Nombre_Sexo,
			t1.Fecha_Nacimiento,
			t1.Lugar_Nacimiento
			order by t1.PK_IdUsuario ASC";
//print_r($query);
	$query = sqlsrv_query($conect, $query, PARAMS, OPTION);
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

$objPHPExcel->getActiveSheet()->getStyle('A1:U1')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '122E43')
        )
    )
);

$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
$objPHPExcel->getActiveSheet()->getStyle("A1:U1")->getFont()->setBold(true)->getColor()->setRGB('fffefc');

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'N')
            ->setCellValue('B1', 'Login')
            ->setCellValue('C1', 'ENTIDAD')
			->setCellValue('D1', 'ESTADO')
			->setCellValue('E1', 'UNIDAD')
			->setCellValue('F1', 'NOMBRE_COMPLETO')
			->setCellValue('G1', 'ESQUEMAP')
			->setCellValue('H1', 'APELLIDO PATERNO')
			->setCellValue('I1', 'APELLIDO MATERNO')
			->setCellValue('J1', 'NOMBRE (S)')
			->setCellValue('K1', 'PUESTO EN CONTRATO O PERFIL')
			->setCellValue('L1', 'SUELDO MENSUAL NETO')
			->setCellValue('M1', 'BANCO')
			->setCellValue('N1', 'CUENTA')
			->setCellValue('O1', 'CLABE')
			->setCellValue('P1', 'RFC')
			->setCellValue('Q1', 'CURP')
			->setCellValue('R1', 'N.S.S')
			->setCellValue('S1', 'SEXO')
			->setCellValue('T1', 'FECHA DE NACIMIENTO')
			->setCellValue('U1', 'LUGAR DE NACIMIENTO');
			$i = 2;

			while ($registros = sqlsrv_fetch_array($query)) {
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $registros['N'])
				->setCellValue('B'.$i, $registros['Login'])
				->setCellValue('C'.$i, $registros['ENTIDAD'])
				->setCellValue('D'.$i, $registros['ESTADO'])
				->setCellValue('E'.$i, $registros['UNIDAD'])
				->setCellValue('F'.$i, utf8_encode ($registros['NOMBRE_COMPLETO']))
				->setCellValue('G'.$i, $registros['ESQUEMAP'])
				->setCellValue('H'.$i, utf8_encode ($registros['APELLIDO PATERNO']))
				->setCellValue('I'.$i, utf8_encode ($registros['APELLIDO MATERNO']))
				->setCellValue('J'.$i, utf8_encode ($registros['NOMBRE (S)']))
				->setCellValue('K'.$i, utf8_encode ($registros['PUESTO EN CONTRATO O PERFIL']))
				->setCellValue('L'.$i, $registros['SUELDO MENSUAL NETO'])
				->setCellValue('M'.$i, $registros['BANCO'])
				->setCellValue('N'.$i, $registros['CUENTA'])
				->setCellValue('O'.$i, $registros['CLABE'])
				->setCellValue('P'.$i, $registros['RFC'])
				->setCellValue('Q'.$i, $registros['CURP'])
				->setCellValue('R'.$i, $registros['N.S.S'])
				->setCellValue('S'.$i, $registros['SEXO'])
				->setCellValue('T'.$i, $registros['FECHA DE NACIMIENTO'])
				->setCellValue('U'.$i, $registros['LUGAR DE NACIMIENTO']);
				
				$i++;
			}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte Empleados');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte_Empleados_Sede.xls"');
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