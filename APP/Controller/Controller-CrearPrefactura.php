 <?php
  // date_default_timezone_set("America/Mexico_City");
	require_once ('fpdf/fpdf.php');
	require_once('APP/Controller/funcion.class.sgmx.define.BBDD.php');
	$con = sqlsrv_connect(SERVER,CONNINF);

  $folio=($_GET['id']);
  //print_r($folio);

  $query= "
  SELECT
  [Nombre_Completo] as 'NOMBRE COMPLETO'
  ,t2.Nombre_Puesto as 'PUESTO'
  ,t2.Sueldo_Diario as 'SUELDOD'
  ,UPPER(CONVERT(varchar,t3.Fecha_Inicio,111)) as 'FECHA DE INICIO'
  ,UPPER(CONVERT(varchar,t3.Fecha_Fin,111)) as 'FECHA DE FIN'
  ,t4.Nombre_Frente as 'FRENTE'
  ,t3.ODS_Comesa as 'FOLIO'
  FROM [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]t1
  left join [PSC.Puesto]t2 on t1.FK_IdPuesto = t2.PK_IdPuesto
  left join [PSC.ODS]t3 on t1.FK_IdODS = t3.PK_IdODS
  left join [PSC.Frente]t4 on t3.FK_Idfrente = t4.PK_IdFrente
  where PK_IdODS = '$folio'
  order by [Nombre_Completo] ASC
  ";
  //print_r($query);
  $query = sqlsrv_query($con,$query,PARAMS,OPTION);
  $fact=sqlsrv_num_rows($query);
  if ($fact >= 1) {
    while ($res=sqlsrv_fetch_array($query)){
      setlocale(LC_TIME, 'spanish');
      $i = strftime("%d", strtotime($res['FECHA DE INICIO']));
      $f = strtoupper(strftime(" %d DE %B DE %Y", strtotime($res['FECHA DE FIN'])));
      $frente = $res['FRENTE'];
      $ods = $res['FOLIO'];
    }
    $pdf = new fpdf(); //creamos un nuevo objeto pdf
    $pdf -> AddPage(); //crea la pagina del PDF

    $pdf -> SetFont('Arial','B',12);
    //muestra el formato de fuente con tres parametros,
    //1 tipo de fuente (Courier,Helvetica o Arial, Times, Symbol,ZapfDingbats)
    //2 estilo (estilo de la fuente que puede ser regular, negrita "B", italica "I" y subindice "U" se puede usar dos al mismo tiempo poniendolas juntas 'BU')
    //3 tamaño de letra

    $pdf -> SetX(5);
    //indica la po4icion de la siguiente selda en el código
    $pdf -> Cell(200,10,'INTEGRACION DEL COSTO',0,1,'C');
    //muestra el for6ato de la celda
    //1 ancho (el ancho de la celda en pixeles)
    //2 alto (el al41 de la celda en pixeles)
    //3 texto (el texto a mostrar en la celda)
    //4 bordes (el b7rde que rodea la celda "opcional")
    //5 salto de linea (baja el renglon para la siguiente celda)
    //6 alineacion texto (alinea el texto de la celda)

    $logo = $pdf -> Image('S:\COMESA\Script\assets\Logotipo_PNPDMI.png',15,10,40);

    $pdf -> SetFont('Arial','B',12);
    $pdf -> Cell(200,10,'PNPDMI S.A. DE C.V.',0,1,'C');

    // $pdf -> SetX(5);
    // $pdf -> SetFont('Arial','',7);
    // $pdf -> SetXY(25,57);
    // $pdf -> MultiCell(70,4,$nombreC,1,'C',0);

    // Datos de la Hoja
    $pdf -> SetFont('Arial','B',10);
    $pdf -> SetXY(5,35);
    $pdf -> Cell(50,5,'CONTRATO',0,0,'L');
    $pdf -> Cell(50,5,'CTO_ADQ_069/2021 REVISAR',0,1,'L'); //REVISAR VALOR

    $pdf -> SetX(5);
    $pdf -> Cell(50,5,'SUBPARTIDA',0,0,'L');
    $pdf -> Cell(50,5,'2.1',0,1,'L');

    $pdf -> SetX(5);
    $pdf -> Cell(50,5,'DEPTO Y/O PROYECT',0,0,'L');
    $pdf -> Cell(50,5,$frente,0,1,'L');

    $pdf -> SetX(5);
    $pdf -> Cell(50,5,'PERSONAL DEL PERIODO',0,0,'L');
    $pdf -> Cell(50,5,$i.' AL '.$f,0,1,'L');

    $pdf -> SetX(5);
    $pdf -> Cell(50,5,'OSS',0,0,'L');
    $pdf -> Cell(50,5,$ods,0,1,'L');
    $pdf -> Cell(50,5,'',0,1,'L');

    // Encabezados
    $pdf -> SetFont('Arial','B',7);
    $pdf -> SetX(5);
    $pdf -> Cell(5,8,'#',1,0,'C');
    $pdf -> Cell(46,8,'NOMBRE',1,0,'C');
    $pdf -> Cell(80,8,'CATEGORIA',1,0,'C');
    $pdf -> MultiCell(15,4,'SUELDO DIARIO',1,'C',0);
    $pdf -> SetXY(151,65);
    $pdf -> MultiCell(15,4,'DIAS DE SERVICIO',1,'C',0);
    $pdf -> SetXY(166,65);
    $pdf -> MultiCell(16,4,'PRIMA DOMINICAL',1,'C',0);
    $pdf -> SetXY(182,65);
    $pdf -> MultiCell(15,4,'TOTAL NOMINA',1,'C',0);

    $empleados=sqlsrv_num_rows($query);

    if($empleados > 1){
      //reporte 1
      //$folio=$res['id'];
      $query1= "
      SELECT
      [Nombre_Completo] as 'NOMBRE COMPLETO'
      ,t2.Nombre_Puesto as 'PUESTO'
      ,t2.Sueldo_Diario as 'SUELDOD'
      ,t2.Costo_Diario as 'COSTO DIARIO'
      ,UPPER(CONVERT(varchar,t3.Fecha_Inicio,111)) as 'FECHA DE INICIO'
      ,UPPER(CONVERT(varchar,t3.Fecha_Fin,111)) as 'FECHA DE FIN'
      ,t4.Nombre_Frente as 'FRENTE'
      ,t3.ODS_Comesa as 'FOLIO'
      FROM [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]t1
      left join [PSC.Puesto]t2 on t1.FK_IdPuesto = t2.PK_IdPuesto
      left join [PSC.ODS]t3 on t1.FK_IdODS = t3.PK_IdODS
      left join [PSC.Frente]t4 on t3.FK_Idfrente = t4.PK_IdFrente
      where PK_IdODS = '$folio'
      order by [Nombre_Completo] ASC
      ";
      $query1 = sqlsrv_query($con,$query1,PARAMS,OPTION);

      while ($res=sqlsrv_fetch_array($query1)) {
        $num1++;
        $nombreC = $res['NOMBRE COMPLETO'];
        $puesto = $res['PUESTO'];
        $salariod = $res['SUELDOD'];
        $costod = $res['COSTO DIARIO'];
        $fechai = New DateTime($res['FECHA DE INICIO']);
        $fechaf = New DateTime($res['FECHA DE FIN']);
        $dif =  $fechaf -> diff($fechai);
        $dias = 1 + $dif -> days;
        $primad = 0;
        $totaln = round(($salariod * $dias) + $primad,2);

        $pdf -> SetFont('Arial','',6);
        $pdf -> SetX(5);
        $pdf -> Cell(5,5,$num1,1,0,'L');
        $pdf -> Cell(46,5,$nombreC,1,0,'L');
        $pdf -> Cell(80,5,$puesto,1,0,'L');
        $pdf -> Cell(15,5,'$ '.$salariod,1,0,'C');
        $pdf -> Cell(15,5,$dias,1,0,'C');
        $pdf -> Cell(16,5,'$ '.$primad,1,0,'C');
        $pdf -> Cell(15,5,'$ '.$totaln,1,1,'C');
        //suma
        $total = round($total + $salariod,2);
        $totald = round($totald + $dias,2);
        $totalp = round($totalp + $primad,2);
        $totalt = round($totalt + $totaln,2);
      }
      $pdf -> SetX(52);
      $pdf -> Cell(84,5,'TOTAL',0,0,'C');
      $pdf -> Cell(15,5,'$ '.$total,1,0,'C');
      $pdf -> Cell(15,5,$totald,1,0,'C');
      $pdf -> Cell(16,5,'$ '.$totalp,1,0,'C');
      $pdf -> Cell(15,5,'$ '.$totalt,1,1,'C');
      $pdf -> Cell(15,10,'',0,1,'C');

      //reporte 2

      // Encabezados
      $pdf -> SetFont('Arial','B',7);
      $pdf -> SetX(5);
      $pdf -> Cell(5,8,'#',1,0,'C');
      $pdf -> Cell(46,8,'NOMBRE',1,0,'C');
      $pdf -> Cell(19,8,'COSTO DIARIO',1,0,'C');
      $pdf -> Cell(24,8,'DIAS DE SERVICIO',1,0,'C');
      $pdf -> Cell(28,8,'COSTO DEL PERIODO',1,0,'C');
      $pdf -> Cell(35,8,'COSTO DEL SERVICIO 3.35%',1,0,'C');
      $pdf -> Cell(15,8,'SUBTOTAL',1,0,'C');
      $pdf -> Cell(15,8,'IVA',1,0,'C');
      $pdf -> Cell(14,8,'TOTAL',1,1,'C');

      $query2= "
      SELECT
      [Nombre_Completo] as 'NOMBRE COMPLETO'
      ,t2.Nombre_Puesto as 'PUESTO'
      ,t2.Sueldo_Diario as 'SUELDOD'
      ,t2.Costo_Diario as 'COSTO DIARIO'
      ,UPPER(CONVERT(varchar,t3.Fecha_Inicio,111)) as 'FECHA DE INICIO'
      ,UPPER(CONVERT(varchar,t3.Fecha_Fin,111)) as 'FECHA DE FIN'
      ,t4.Nombre_Frente as 'FRENTE'
      ,t3.ODS_Comesa as 'FOLIO'
      FROM [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]t1
      left join [PSC.Puesto]t2 on t1.FK_IdPuesto = t2.PK_IdPuesto
      left join [PSC.ODS]t3 on t1.FK_IdODS = t3.PK_IdODS
      left join [PSC.Frente]t4 on t3.FK_Idfrente = t4.PK_IdFrente
      where PK_IdODS = '$folio'
      order by [Nombre_Completo] ASC
      ";
      $query2 = sqlsrv_query($con,$query2,PARAMS,OPTION);

      while ($res=sqlsrv_fetch_array($query2)) {
        $num2++;
        $nombreC = $res['NOMBRE COMPLETO'];
        $puesto = $res['PUESTO'];
        $costod = $res['COSTO DIARIO'];
        $fechai = New DateTime($res['FECHA DE INICIO']);
        $fechaf = New DateTime($res['FECHA DE FIN']);
        $dif =  $fechaf -> diff($fechai);
        $dias = 1 + $dif -> days;
        $costop = $costod * $dias;
        $costopp = round($costop * 0.0335,2);
        $subtotal = round($costopp + $costop,2);
        $iva = round($subtotal * 0.016,2);
        $totaln = round($iva + $subtotal,2);

        //campos
        $pdf -> SetFont('Arial','',6);
        $pdf -> SetX(5);
        $pdf -> Cell(5,5,$num2,1,0,'L');
        $pdf -> Cell(46,5,$nombreC,1,0,'L');
        $pdf -> Cell(19,5,'$ '.$costod,1,0,'C');
        $pdf -> Cell(24,5,$dias,1,0,'C');
        $pdf -> Cell(28,5,'$ '.$costop,1,0,'C');
        $pdf -> Cell(35,5,'$ '.$costopp,1,0,'C');
        $pdf -> Cell(15,5,'$ '.$subtotal,1,0,'C');
        $pdf -> Cell(15,5,'$ '.$iva,1,0,'C');
        $pdf -> Cell(14,5,'$ '.$totaln,1,1,'C');
        //suma
        $total1 = $total1 + $costop;
        $totald1 = $totald1 + $costopp;
        $totalp1 = $totalp1 + $subtotal;
        $subtotalt1 = round($subtotalt1 + $iva,2);
        $totalt1 = round($totalt1 + $totaln,2);
      }

      $pdf -> SetX(52);
      $pdf -> Cell(47,5,'TOTAL',0,0,'C');
      $pdf -> Cell(28,5,'$ '.$total1,1,0,'C');
      $pdf -> Cell(35,5,'$ '.$totald1,1,0,'C');
      $pdf -> Cell(15,5,'$ '.$totalp1,1,0,'C');
      $pdf -> Cell(15,5,'$ '.$subtotalt1,1,0,'C');
      $pdf -> Cell(14,5,'$ '.$totalt1,1,1,'C');
      $pdf -> Cell(15,50,'',0,1,'C');

      $pdf -> SetX(35);
      $pdf -> SetFont('Times','B',10);
      $pdf -> Cell(50,10,'ENLACE ADMINISTRATIVO','T',0,'C');
      $pdf -> Cell(50,10,'',0,0,'C');
      $pdf -> Cell(50,10,'COMESA','T',1,'C');


    }
    $pdf->Output(); //muestra la pagina en el navegador
  }
  else {
    echo "No hay datos para mostrar en esta factura!";
  }
?>
