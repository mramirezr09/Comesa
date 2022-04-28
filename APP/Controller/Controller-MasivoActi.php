<?php
$id_u=$_SESSION['id_sgmx'];
require('fpdf/fpdf.php');

//Agregamos la libreria para genera códigos QR
require("phpqrcode/qrlib.php"); 
require_once('APP/Controller/funcion.class.sgmx.define.BBDD.php');
 $con = sqlsrv_connect(SERVER,CONNINF);
	
$inicio='2021-08-1';
$fin='2021-08-31';

setlocale(LC_TIME, 'spanish');
$einicio = strftime(" %d de %B de %Y", strtotime($inicio)); //dar formato a fecha
$efin = strftime(" %d de %B de %Y", strtotime($fin)); //dar formato a fecha

//$pruebavar=($_GET['pruebavar']);

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
	
	$this->Cell(5,5,utf8_decode(utf8_encode('Ricardo Sóto López').' - '.('Representante Legal')));
	
	$this->Ln(20);
	
	//Reporte centrado
	$this->SetFont('Arial','B',12);
	
	$this->Cell(60);
	
	$this->Cell(5,5,utf8_decode('INFORME MENSUAL DE ACTIVIDADES'),'C');
	
	$this->Ln(10);
	
	
	

}


// Pie de página
function Footer()
{
	
    // Posición: a 1,5 cm del final
    $this->SetY(-25);
    // Arial italic 8
    $this->SetFont('Arial','I',10);
    // Número de página
	$this->Cell(105,5,'Validación electrónica del prestador de servicios especializados.',0,0,'C');	
	$this->Ln(5);
	 $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}
// Creación del objeto de la clase heredada
$pdf = new PDF();

//Creación de la lista de asistencia
$query= "SELECT 
			t1.PK_IdUsuario AS ID,
			CONCAT(t1.Apallido_Paterno,' ',t1.Apallido_Materno,' ', t1.Nombre) as Empleado,
			t2.Nombre AS Perfil,
			t3.Nombre AS Proyecto,
			t1.RFC,
			
			t6.nombre_puesto AS Puesto,
			t1.FK_IdPuesto as fkpuesto,
			t7.Nombre_UnidadAdm AS Departamento,
			
			t5.Nombre AS Supervisor
						
			FROM [PSA.UsuarioAsistencia]t1
			LEFT JOIN [PSA.Perfil_Usuario]t2 ON t1.FK_IdPerfil=t2.PK_IdPerfil
			LEFT JOIN [PSA.Proyecto]t3 ON t1.FK_IdProyecto=t3.PK_IdProyecto
			LEFT JOIN [PSA.Horario_Empleado]t4 ON t1.FK_IdHorario=t4.PK_IdHorario
			LEFT JOIN [PSA.Supervisor]t5 ON t1.FK_IdSupervisor=t5.PK_IdSupervisor
			LEFT JOIN [PSA.Puesto]t6 ON t1.FK_IdPuesto=t6.PK_IdPuesto
			LEFT JOIN [PSA.UnidadAdm] t7 ON t1.FK_IdUnidadAdm = t7.PK_IdUnidadAdm			
			LEFT JOIN [PSA.TipoPago]t9 ON t1.FK_IdTipoPago = t9.Pk_IdTipopago

			where t1.FK_IdProyecto = 3 and t1.FK_IdTipoPago = 3 and t1.FK_IdPerfil=2
			and t6.pk_idpuesto != 15";
      //print_r($query);
       $query=sqlsrv_query($con,$query,PARAMS,OPTION);
	   
	   
	   while ($res=sqlsrv_fetch_array($query)) {
		                     
							 $id=$res['ID'];
							 $empleado=$res['Empleado'];
							 $supervisor=$res['Supervisor'];
							 $proyecto=$res['Proyecto'];
							 $puesto=$res['Puesto'];
							 $pkPuesto=$res['fkpuesto'];
		                     //$entrada=$res['Entrada'];
                            //$salida=$res['Salida'];
							$userlog=$res['ID'];
							$depto=$res['Departamento'];
							$rfc=$res['RFC'];
							//$fecha=$res['Fecha'];
	   


// Creación del objeto de la clase heredada

$pdf->AliasNbPages();
$pdf->AddPage();
//Quincena
	
	$pdf->SetFont('Arial','I',11);
	
	$pdf->Cell(90);
	
	//$pdf->Cell(5,5,utf8_decode('Período: del '). $einicio. ' al '. $efin);
	
	$pdf->Ln(5);
	
	//Genera primera tabla de actividades
	//Genera encabezados
                           // Color de encabezado
                        $pdf->SetFillColor(255,210,67);//Fondo verde de celda
                        $pdf->SetTextColor(3, 3, 3); //Letra color blanco
						$pdf->SetDrawColor(21,58,128);
						$pdf->SetLineWidth(.4);
						$pdf->SetFont('Arial','B',8);
						
						$fill = true;
						
						// Restauración de colores y fuentes
						//$pdf->SetTextColor(220,50,50);
						$pdf->SetTextColor(0);
						$pdf->SetFont('');
						
						//Nombre
                         $pdf->Cell(84,8,"NOMBRE DEL PRESTADOR DEL SERVICIO",1,0,'L','R');
						  $pdf->Cell(91,8,$empleado,1,0,'C');
						  	$pdf->Ln();
						  //UNIDAD
						  $pdf->Cell(84,8,"UNIDAD ADMINISTRATIVA",1,0,'L','R');
						  $pdf->Cell(91,8,utf8_encode($depto),1,0,'C');
						  $pdf->Ln();
						  
						  //PErfil
						    $pdf->Cell(84,8,"PERFIL",1,0,'L','R');
							$pdf->SetFont('Arial','B',9);
						  $pdf->Cell(91,8,"$puesto",1,0,'C');
						  $pdf->Ln();
						  
						  //Perio
						  $pdf->SetFont('Arial','',10);
						    $pdf->Cell(84,8,"PERIODO",1,0,'L','R');
							$pdf->SetFont('Arial','B',8);
						   $pdf->Cell(91,8,'Período: del '. $einicio. ' al '. $efin,1,0,'C');
						  $pdf->Ln(15);
						  
						  //ACTIVIDADES
						   $pdf->SetFont('Arial','B',11);

						  $pdf->Cell(181,8,"ACTIVIDADES",1,0,'C','R');
						  
						   $pdf->Ln(15);
						  
						  
						 
	
   

// armar el cagadero de actividades

$query1= "  select
--t1.[Login],
--PK_IdUsuario as 'N',
--t7.[Nombre_Puesto] as 'PUESTO EN CONTRATO O PERFIL',
t9.[Actividades]

from [PRO_SERVER_ASISTENCIA].[dbo].[PSA.UsuarioAsistencia] t1 
left join [dbo].[PSA.Proyecto]t2 on t1.FK_IdProyecto = t2.[PK_IdProyecto] 
left join [dbo].[PSA.Estado]t3 on t1.FK_IdEstado = t3.[PK_IdEstado] 
left join [dbo].[PSA.UnidadAdm]t4 on t1.FK_IdUnidadAdm = t4.[PK_IdUnidadAdm]
inner join [dbo].[PSA.Puesto_Actividades]t9 on t1.FK_IdPuesto = t9.[FK_IdPerfilAct]
left join [dbo].[PSA.TipoPago]t6 on t1.FK_IdTipoPago = t6.[PK_IdTipoPago] 
left join [dbo].[PSA.Puesto]t7 on t1.FK_IdPuesto = t7.[PK_IdPuesto] 
left join [dbo].[PSA.Sexo]t8 on t1.FK_IdSexo = t8.[PK_IdSexo] 
WHERE t1.PK_IdUsuario = '$id'
order by t1.PK_IdUsuario ASC";
	    
       $query1=sqlsrv_query($con,$query1,PARAMS,OPTION);
	   //print_r($query1);
	   $vacio=sqlsrv_num_rows($query1);
	   //print_r($vacio);
	   $cuenta=1;
	if ($vacio > 0) {
		while ($r=sqlsrv_fetch_array($query1)) {
							 
						$act=$r['Actividades'];
                           
							/*//Contar letras de descripcion para ajustar alto

                                  $Caracteres = strlen($act);
								  //Dividimos los caracteres entre los que caben en una columna
                                    $Tot = $Caracteres/65;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                

                                     //Redondeamos el resultado y lo multiplicamos por el alto de las filas
                                    $Filas = ceil($Tot);
                                   $Alto = ($Filas == 0)? 4 : $Filas * 4;*/
								   
							$pdf->SetFont('Arial','',10);
							$pdf->Cell(15,5,$cuenta++,1,0,'C','R'); 
						  $pdf->MultiCell(166,5,$act,1, 'L', 0);						  
		}
		   $pdf->Ln(25);       
	}
	
	
	else {
		$pdf->Cell(50);
		$pdf->Cell(15,7,"No se han encontrado actividades para mostrar",0,0,'C');
		 $pdf->Ln(25);     
	}
	
                   
			/*			  
$pdf->Cell(25,5,"______________________________",0,0,'L');
$pdf->Cell(156,5,"______________________________",0,0,'R');
$pdf->Ln();

$pdf->SetFont('Arial','B',10);
$pdf->Ln(3);
$pdf->Cell(70,5,$empleado,0,0,'C');

$pdf->Cell(170,5,utf8_decode($supervisor),0,0,'C');

$pdf->Ln();
$pdf->SetFont('Arial','I',11);
$pdf->Cell(70,5,"Prestador de servicios especializados",0,0,'C');
$pdf->Cell(152,5,utf8_decode("Supervisor facultado de la unidad administrativa "),0,0,'C');
$pdf->Ln();
$pdf->Cell(300,5,utf8_decode("que recibe los servicios especializados"),0,0,'C');

*/


// Generación de QR

   
	
	//Creación de la carpeta temporal para guardar  imagenes 
	$server="S:/CHECADOR_SEGALMEX/";
	$folder ="Web/QR/temp/";
	$dir = $server.$folder;
	$nQR=$fin.'_'.$rfc.'_actividadesQR.png';
	
	if (!file_exists($dir))
        mkdir($dir);
	
        // ruta y nombre del archivo a generar
	$filename = $dir.$nQR;
 
        //Parametros de Condiguración
	
	$tamaño = 10; //Tamaño de Pixel
	$level = 'L'; //Precisión Baja
	$framSize = 3; //Tamaño en blanco
	$contenido = $empleado.' con RFC: '.$rfc.' Puesto: '.$puesto.' ha aceptado los terminos de uso  de la clausula 9 de su contrato para generar este documento de actividades el día '.$fin; //Texto
	
        //Enviamos los parametros a la Función para generar código QR 
	QRcode::png($contenido, $filename, $level, $tamaño, $framSize); 
	
        //Mostramos la imagen generada
   $pdf->Ln(35); 
   $pdf->Image('Web/QR/temp/'.$nQR,9,217,42);	

				  


}

$pdf->Output();
?>