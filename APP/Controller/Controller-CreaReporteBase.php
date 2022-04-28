<?php
	require_once('./APP/Controller/funcion.class.sgmx.define.BBDD.php');
   require('./PHPExcel/Classes/PHPExcel.php');
	$conect = sqlsrv_connect(SERVER,CONNINF);

	
        if ($q != "" && $r != "") {
            $sWhere = " where CONVERT (char(10),t1.Fecha_Contratacion,23) between '$q' and '$r'";
		}
        else {
			$sWhere = "";
		}
	
	$query= "SELECT				
			t1.PK_IdRegistro as id,			
			UPPER(t1.[Nombre_Completo]) as 'NOMBRE COMPLETO',	
			UPPER(t1.[Apellido_Paterno]) as 'Apaterno',	
			UPPER(t1.[Apellido_Materno]) as 'Amaterno',	
			UPPER(t1.[Nombre]) as 'Nombre',	
			t1.[Edad] as 'EDAD',	
			UPPER(t9.[Estado_Civil]) as 'ESTADO CIVIL',	
			UPPER(t1.[CURP]) as 'CURP',	
			UPPER(t1.[RFC]) as 'RFC',	
			UPPER(t1.[NSS]) as 'NSS',	
			UPPER(t1.[Calle]) as 'CALLE',	
			UPPER(t1.[Numero_Int]) as 'NUMERO INTERIOR',	
			UPPER(t1.[Numero_Ext]) as 'NUMERO EXTERIOR',	
			UPPER(t1.[Colonia]) as 'COLONIA',	
			UPPER(t1.[Municipio]) as 'MUNICIPIO',	
			UPPER(t6.[Nombre_Estado]) as 'ESTADO',	
			UPPER(t8.[NOMBRE]) as 'NACIONALIDAD',	
			convert (char(30),t1.Fecha_Nacimiento,101) as 'FECHA DE NACIMIENTO',	
			UPPER(t3.Nombre_Puesto) as 'PUESTO',	
			t12.[Nombre_Fase] as 'FASE',	
			UPPER(t10.Nombre) as 'CUENTA CON INFONAVIT',	
			UPPER(t3.Sueldo_Mensual) as 'SUELDO',				
			t1.[Contacto_Telefono] as 'TELEFONO DE CONTACTO',	
			UPPER(t1.[Contacto]) as 'NOMBRE DE CONTACTO',	
			t13.Nombre_Banco as 'BANCO',	
			t2.Clabe as 'CLABE',
			CONVERT (char(10),t1.Fecha_Actualiza,103) as 'FECHA CONTRATACION',
			CONVERT (char(10),t1.Fecha_Actualiza,103) as 'FECHA INGRESO',
			UPPER(t14.Nombre) as 'FILTRO JURIDICO',
			t15.Nombre_Frente as 'FOLIO'
				
			FROM [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]t1	
			left join [dbo].[PSC.RegistroDB]t2 on t1.PK_IdRegistro = t2.FK_IdRegistro	
			left join [dbo].[PSC.Puesto]t3 on t1.FK_IdPuesto = t3.PK_IdPuesto	
			left join [dbo].[PSC.Registro_Estatus]t4 on t1.FK_IdPuesto = t4.PK_IdRegistrEstatus	
			left join [dbo].[PSC.Sexo]t5 on t1.FK_IdSexo = t5.PK_IdSexo	
			left join [dbo].[PSC.Estado]t6 on t1.FK_IdEstado = t6.PK_IdEstado	
			left join [dbo].[PSC.Esquema_Nomina]t7 on t1.FK_IdEsquema = t7.PK_IdEsquema	
			left join [dbo].[PSC.Usuario_Nacionalidad]t8 on t1.FK_IdNacionalidad= t8.PK_IdNacionalidad	
			left join [dbo].[PSC.Estado_Civil]t9 on t1.FK_IdEstado_Civil= t9.PK_IdEstado_Civil	
			left join [dbo].[PSC.Infonavit]t10 on t2.FK_IdInfonavit= t10.PK_IdInfonavit	
			left join [dbo].[PSC.Credencial]t11 on t1.PK_IdRegistro= t11.FK_IdRegistro	
			left join [dbo].[PSC.Fase_Puesto]t12 on t3.FK_IdFase = t12.PK_IdFase	
			left join [dbo].[PSC.Banco]t13 on t2.FK_IdBanco = t13.PK_IdBanco
			left join [dbo].[PSC.Filtro_Juridico]t14 on t1.FK_IdFiltro = t14.PK_IdFiltro
			left join [dbo].[PSC.Frente]t15 on t1.FK_IdFiltro = t15.PK_IdFrente
			
			$sWhere
			order by t1.Fecha_Actualiza desc
			";
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
            ->setCellValue('A1', 'id')
            ->setCellValue('B1', 'NOMBRE COMPLETO')
            ->setCellValue('C1', 'Apaterno')
			->setCellValue('D1', 'Amaterno')
			->setCellValue('E1', 'Nombre')
			->setCellValue('F1', 'EDAD')
			->setCellValue('G1', 'ESTADO CIVIL')
			->setCellValue('H1', 'CURP')
			->setCellValue('I1', 'RFC')
			->setCellValue('J1', 'NSS')
			->setCellValue('K1', 'CALLE')
			->setCellValue('L1', 'NUMERO INTERIOR')
			->setCellValue('M1', 'NUMERO EXTERIOR')
			->setCellValue('N1', 'COLONIA')
			->setCellValue('O1', 'MUNICIPIO')
			->setCellValue('P1', 'ESTADO')
			->setCellValue('Q1', 'NACIONALIDAD')
			->setCellValue('R1', 'FECHA DE NACIMIENTO')
			->setCellValue('S1', 'PUESTO')
			->setCellValue('T1', 'FASE')
			->setCellValue('U1', 'CUENTA CON INFONAVIT')
			->setCellValue('V1', 'SUELDO')
			->setCellValue('W1', 'TELEFONO DE CONTACTO')
			->setCellValue('X1', 'NOMBRE DE CONTACTO')
			->setCellValue('Y1', 'BANCO')
			->setCellValue('Z1', 'CLABE')
			->setCellValue('AA1', 'FECHA CONTRATACION')
			->setCellValue('AB1', 'FECHA INGRESO')
			->setCellValue('AC1', 'FILTRO JURIDICO')
			->setCellValue('AD1', 'FOLIO');


			$i = 2;

			while ($registros = sqlsrv_fetch_array($query)) {
				$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A'.$i, $registros['id'])
				->setCellValue('B'.$i, utf8_encode ($registros['NOMBRE COMPLETO']))
				->setCellValue('C'.$i, utf8_encode ($registros['Apaterno']))
				->setCellValue('D'.$i, utf8_encode ($registros['Amaterno']))
				->setCellValue('E'.$i, utf8_encode ($registros['Nombre']))
				->setCellValue('F'.$i, $registros['EDAD'])
				->setCellValue('G'.$i, $registros['ESTADO CIVIL'])
				->setCellValue('H'.$i, $registros['CURP'])
				->setCellValue('I'.$i, $registros['RFC'])
				->setCellValue('J'.$i, $registros['NSS'])
				->setCellValue('K'.$i, $registros['CALLE'])
				->setCellValue('L'.$i, $registros['NUMERO INTERIOR'])
				->setCellValue('M'.$i, $registros['NUMERO EXTERIOR'])
				->setCellValue('N'.$i, $registros['COLONIA'])
				->setCellValue('O'.$i, $registros['MUNICIPIO'])
				->setCellValue('P'.$i, $registros['ESTADO'])
				->setCellValue('Q'.$i, $registros['NACIONALIDAD'])
				->setCellValue('R'.$i, $registros['FECHA DE NACIMIENTO'])
				->setCellValue('S'.$i, $registros['PUESTO'])
				->setCellValue('T'.$i, $registros['FASE'])
				->setCellValue('U'.$i, $registros['CUENTA CON INFONAVIT'])
				->setCellValue('V'.$i, $registros['SUELDO'])
				->setCellValue('W'.$i, $registros['TELEFONO DE CONTACTO'])
				->setCellValue('X'.$i, utf8_encode ($registros['NOMBRE DE CONTACTO']))
				->setCellValue('Y'.$i, $registros['BANCO'])
				->setCellValue('Z'.$i, $registros['CLABE'])
				->setCellValue('AA'.$i, $registros['FECHA CONTRATACION'])
				->setCellValue('AB'.$i, $registros['FECHA INGRESO'])
				->setCellValue('AC'.$i, $registros['FILTRO JURIDICO'])
				->setCellValue('AD'.$i, $registros['FOLIO']);
				
				$i++;
			}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('BASE CONTRATACION COMESA');


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