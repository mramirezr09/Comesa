<?php

$id_u=$_SESSION['id_sgmx'];
//Agregamos la libreria para generar pdf
require_once('fpdf/fpdf.php');
//Agregamos la libreria para genera códigos QR
require("phpqrcode/qrlib.php"); 
require_once('APP/Controller/funcion.class.sgmx.define.BBDD.php');
 $con = sqlsrv_connect(SERVER,CONNINF);
	
$inicio=$_SESSION['inicio'];
$fin=$_SESSION['fin'];

setlocale(LC_TIME, 'spanish');
$einicio = strftime(" %d de %B de %Y", strtotime($inicio));
$efin = strftime(" %d de %B de %Y", strtotime($fin));



class PDF extends FPDF
{
	
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('Script/assets/pnpdmi.png',130,7,62);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(1);
    // Título
    $this->Cell(10,10,'PNPDMI SA de CV');
    // Salto de línea
    $this->Ln(12);
	
	
	// subtitulo
	$this->SetFont('Arial','I',12);
	$this->Cell(1);
	
	$this->Cell(5,5,utf8_decode('Ricardo Sóto López').' - '.('Representante Legal'));
	
	$this->Ln(20);
	
	//Reporte centrado
	$this->SetFont('Arial','B',12);
	
	$this->Cell(60);
	
	$this->Cell(5,5,utf8_decode('REPORTE DE ASISTENCIA QUINCENAL'),'C');
	
	$this->Ln(15);
	
	
	

}


// Pie de página
function Footer()
{
	
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Creación de la lista de asistencia
$query= " SELECT 
			t1.PK_IdUsuario AS ID,
			CONCAT(t1.Apallido_Paterno,' ',t1.Apallido_Materno,' ', t1.Nombre) as Empleado,
			t2.Nombre AS Perfil,
			t3.Nombre AS Proyecto,
			t1.RFC,
			CONVERT(varchar,t4.Hora_Entrada,8) AS Entrada,
			CONVERT(varchar,t4.Hora_Salida,8) AS Salida,
			t6.nombre_puesto AS Puesto,
			t5.Nombre AS Supervisor
						
			FROM [PSA.UsuarioAsistencia]t1
			LEFT JOIN [PSA.Perfil_Usuario]t2 ON t1.FK_IdPerfil=t2.PK_IdPerfil
			LEFT JOIN [PSA.Proyecto]t3 ON t1.FK_IdProyecto=t3.PK_IdProyecto
			LEFT JOIN [PSA.Horario_Empleado]t4 ON t1.FK_IdHorario=t4.PK_IdHorario
			LEFT JOIN [PSA.Supervisor]t5 ON t1.FK_IdSupervisor=t5.PK_IdSupervisor
			LEFT JOIN [PSA.Puesto]t6 ON t1.FK_IdPuesto=t6.PK_IdPuesto
			WHERE t1.PK_IdUsuario='$id_u'";
      // print_r($query);
       $query=sqlsrv_query($con,$query,PARAMS,OPTION);
	   
	   while ($res=sqlsrv_fetch_array($query)) {
		                     
							 $empleado=$res['Empleado'];
							 $supervisor=$res['Supervisor'];
							 $proyecto=$res['Proyecto'];
							 $puesto=$res['Puesto'];
		                     $entrada=$res['Entrada'];
                            $salida=$res['Salida'];
							$userlog=$res['ID'];
							$rfc=$res['RFC'];
	   }

   if ( $inicio!= "" && $fin != "")
   {
// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//Quincena
	
	$pdf->SetFont('Arial','I',11);
	
	$pdf->Cell(80);
	
    $pdf->Cell(5,5,utf8_decode('Período: del '). $einicio. ' al '. $efin);
	
	$pdf->Ln(20);
	
//Nombre
	
	$pdf->SetFont('Arial','B',11);
	
	$pdf->Cell(1);
	
	$pdf->Cell(5,5,('Nombre: '.$empleado));
	
	$pdf->Ln(8);
	

// Departeamento
	
	$pdf->SetFont('Arial','B',11);
	
	$pdf->Cell(1);
	
	$pdf->Cell(5,5,utf8_decode('Departamento: '.$proyecto));
	
	$pdf->Ln(8);
	
// Puesto
	
	$pdf->SetFont('Arial','B',11);
	
	$pdf->Cell(1);
	
	$pdf->Cell(5,5,utf8_decode('Puesto: '.$puesto));
	
	$pdf->Ln(20);
	 
//Genera encabezados
                           // Color de encabezado
                        $pdf->SetFillColor(255,210,67);//Fondo verde de celda
                        $pdf->SetTextColor(3, 3, 3); //Letra color blanco
						$pdf->SetDrawColor(21,58,128);
						$pdf->SetLineWidth(.4);
						$pdf->SetFont('Arial','B',12);
						
						$fill = true;
						
						// Restauración de colores y fuentes
						//$pdf->SetTextColor(220,50,50);
						$pdf->SetTextColor(0);
						$pdf->SetFont('');
						
                         $pdf->Cell(25,8,"Registro",1,0,'C','R');
						  $pdf->Cell(40,8,"Fecha",1,0,'C','R');
						  $pdf->Cell(40,8,"Hora Entrada",1,0,'C','R');
						  $pdf->Cell(40,8,"Hora Salida",1,0,'C','R');
						  $pdf->Cell(40,8,"Estado",1,0,'C','R');
						  $pdf->Ln();
   

// armar la tabla de asistencia

$query1= "  SELECT 
				t1.FK_IdUsuario as ID,
				convert( char(10),t1.Fecha_Asistencia,120) AS Fecha, 
				(t2.Apallido_Paterno+' '+t2.Apallido_Materno+' '+ t2.Nombre) as Nombre,
				t3.Nombre_puesto as Puesto,
				(select CASE 
							WHEN CONVERT(CHAR(5), '$entrada', 108)> = CONVERT(CHAR(5), MIN( t1.Fecha_Asistencia ) , 108) and Hora_1=1 
							THEN 'A tiempo'
                            WHEN Hora_1<=2
					        THEN 'Incapacidad' 							
							ELSE 'Incidencia' END) as 'Estado entrada',
				
				MIN (CONVERT(CHAR(8), t1.Fecha_Asistencia,108 )) as 'Hora Entrada',
				
				
				
				MAX(CONVERT(CHAR(8), t1.Fecha_Asistencia,108 )) as 'Hora Salida',
				
				(select CASE 
							WHEN  CONVERT(CHAR(5), MAX( t1.Fecha_Asistencia ) , 108) > =CONVERT(CHAR(5), '$salida', 108) 
							THEN 'Completada' ELSE 'Incidencia' END) as 'Jornada Total'
				
				
				FROM [PSA.Registro_Asistencia] t1
				INNER JOIN [PSA.UsuarioAsistencia]t2 on t2.PK_IdUsuario=t1.FK_IdUsuario
				LEFT JOIN [PSA.Puesto]t3 on t2.FK_IdPuesto=t3.PK_IdPuesto
				 where t1.FK_IdUsuario='$id_u' and CAST(t1.Fecha_Asistencia as date) between '$inicio' and '$fin' group by t1.FK_IdUsuario
				,convert( char(10),t1.Fecha_Asistencia,120 ),t2.Nombre, t2.Apallido_Materno, t2.Apallido_Paterno,t1.fecha_c,t1.hora_1, t3.Nombre_Puesto, CAST( t1.Fecha_Asistencia AS DATE )
				order by t1.Fecha_c ASC";
	   // print_r($query1);
       $query1=sqlsrv_query($con,$query1,PARAMS,OPTION);
	   $cuenta=1;
	  
	while ($r=sqlsrv_fetch_array($query1)) {
							 
						$id=$r['ID'];
                            $fecha=$r['Fecha'];
                            $nombre=$r['Nombre'];
                            $puesto=$r['Puesto'];
                            $estado=$r['Estado entrada'];
							$horae=$r['Hora Entrada'];
							$horas=$r['Hora Salida'];
							$jornada=$r['Jornada Total'];
							
							$pdf->SetFont('Arial','',11);
							 
						  $pdf->Cell(25,7,$cuenta++,1,0,'C');
						  $pdf->Cell(40,7,$fecha,1,0,'C');
						  $pdf->Cell(40,7,$horae,1,0,'C');
						  $pdf->Cell(40,7,$horas,1,0,'C');
						  $pdf->Cell(40,7,$estado,1,0,'C');
						  $pdf->Ln();
	}
          $pdf->Ln(25);           

// Generación de QR

   
	
	//Creación de la carpeta temporal para guardar  imagenes 
	$server="S:/CHECADOR_SEGALMEX/";
	$folder ="Web/QR/temp/";
	$dir = $server.$folder;
	$nQR=$fecha.'_'.$rfc.'_asistenciaQR.png';
	
	if (!file_exists($dir))
        mkdir($dir);
	
        // ruta y nombre del archivo a generar
	$filename = $dir.$nQR;
 
        //Parametros de Condiguración
	
	$tamaño = 10; //Tamaño de Pixel
	$level = 'L'; //Precisión Baja
	$framSize = 3; //Tamaño en blanco
	$contenido = $nombre.' con RFC: '.$rfc.' Puesto: '.$puesto.' ha aceptado los terminos de uso  de la clausula 9 de su contrato para generar este documento de asistencia el día '.$fecha; //Texto
	
        //Enviamos los parametros a la Función para generar código QR 
	QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
	
        //Mostramos la imagen generada
   $pdf->Ln(15); 
   $pdf->Image('Web/QR/temp/'.$nQR,9,217,42);	
						  

$pdf->SetFont('Arial','',9);
$pdf->Ln(15);
$pdf->Cell(11);
$pdf->Cell(70,5,utf8_decode('Validación electrónica del prestador de servicios especializados.'),0,0,'C');
$pdf->Cell(170,5,utf8_decode($supervisor),0,0,'C');

   
 

	
$pdf->Output();
   }
   
     else
   {
	   echo 'No puedes Generar una lista de asitencia autorizada si no seleccionas un rango valido ';
	   
   }
?>