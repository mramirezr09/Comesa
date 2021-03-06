 <?php
 // Send headers
	require_once ('fpdf/fpdf.php');
	require_once('APP/Controller/funcion.class.sgmx.define.BBDD.php');
	$con = sqlsrv_connect(SERVER,CONNINF);

	//$esq=($_GET['esq']);
	//echo $esq;
	if($esq == 2){
		
		$pdf = new fpdf(); //creamos un nuevo objeto pdf
		
		$query= "
		
		SELECT 
      t2.[PK_IdRegistro] as id
	 , UPPER(t2.[Nombre_Completo]) as 'NOMBRE COMPLETO',
			UPPER(t2.[CURP]) as 'CURP',
			UPPER(t2.[Calle] + ', ' + t2.[Numero_Int] + ', ' + t2.[Numero_Ext] + ', ' + t5.[Colonia] + ', ' + t5.[Municipio] + ', ' + t5.[Estado]+', CP. '+ t5.[Num_CP]) as 'DOMICILIO',
			UPPER(t2.[RFC]) as 'RFC',
			UPPER(t4.[NOMBRE]) as 'NACIONALIDAD',
			t2.[Edad] as 'EDAD',
			UPPER(t6.[Estado_Civil]) as 'ESTADO CIVIL',
			UPPER(t2.[NSS]) as 'NSS',
			convert (char(30),t2.Fecha_Nacimiento,101) as 'FECHA DE NACIMIENTO',
			UPPER(t7.Nombre_Puesto) as 'PUESTO',
			t8.[Nombre_Fase] as 'FASE',
			UPPER(t12.Nombre) as 'CUENTA CON INFONAVIT',
			UPPER(t11.Sueldo_Diario) as 'SUELDO',
			t3.ODS_Comesa
			,t1.[Fecha_ODS],
			UPPER(CONVERT(varchar,t3.Fecha_Inicio,111)) as 'FECHA DE INICIO',
			UPPER(CONVERT(varchar,t3.Fecha_Fin,111)) as 'FECHA DE FIN',
			CONVERT(varchar,t3.Fecha_Inicio,103) as 'FECHA DE ALTA',	
          '\\192.168.1.220\Comesa\APP\Controller\' + t2.[Nombre_Completo] + '_' + t2.[CURP] as 'RUTA'
  FROM [PRO_SERVER_COMESA].[dbo].[PSC.Bitacora_ODS]t1
  LEft join [PSC.RegistroDP]t2 on t2.PK_IdRegistro=t1.FK_IdRegistro
  Left join [PSC.ODS]t3 on t3.PK_IdODS=t1.FK_IdODS
  left join [dbo].[PSC.Usuario_Nacionalidad]t4 on t2.FK_IdNacionalidad= t4.PK_IdNacionalidad
  left join [dbo].[PSC.CP]t5 on t2.FK_idCP = t5.PK_IdCP
  left join [dbo].[PSC.Estado_Civil]t6 on t2.FK_IdEstado_Civil= t6.PK_IdEstado_Civil
  left join [dbo].[PSC.Puesto]t7 on t2.FK_IdPuesto = t7.PK_IdPuesto
  left join [dbo].[PSC.Fase_Puesto]t8 on t7.FK_IdFase = t8.PK_IdFase
  left join [dbo].[PSC.ODS]t9 on t2.FK_IdODS = t9.PK_IdODS
  left join [PSC.RegistroDB]t10 on t1.FK_IdRegistro=t10.FK_IdRegistro
  left join [dbo].[PSC.Puesto]t11 on t2.FK_IdPuesto = t11.PK_IdPuesto
  left join [dbo].[PSC.Infonavit]t12 on t10.FK_IdInfonavit= t12.PK_IdInfonavit
  where t1.FK_IdRegistro= '$id'  and convert(varchar,t3.fecha_Inicio, 111) between '2022/01/02' and '2022/01/18'
		";
		//print_r($query);
		$query=sqlsrv_query($con,$query,PARAMS,OPTION);

		while ($res=sqlsrv_fetch_array($query)) {

			$id=$res['id'];
			$nombreC = $res['NOMBRE COMPLETO'];
			$curp = $res['CURP'];
			$domicilio = $res['DOMICILIO'];
			$rfc = $res['RFC'];
			$naci = $res['NACIONALIDAD'];
			$edad = $res['EDAD'];
			$estadoc = $res['ESTADO CIVIL'];
			$nss = $res['NSS'];
			$fechaN = $res['FECHA DE NACIMIENTO'];
			$puesto = $res['PUESTO'];
			$fase = $res['FASE'];
			$info = $res['CUENTA CON INFONAVIT'];
			$salariob = $res['SUELDO'];
			$nombreb = $res['NOMBRE DE CONTACTO'];
			$fechaal = $res['FECHA DE ALTA'];
			setlocale(LC_TIME, 'spanish');
			$i = strtoupper(strftime(" %d DE %B DE %Y", strtotime($res['FECHA DE INICIO']))); //debe recibir la fecha en el formato 111 de forma contraria aaaa/mm/dd
			$f = strtoupper(strftime(" %d DE %B DE %Y", strtotime($res['FECHA DE FIN'])));
			
			//print_r($i);
			//print_r($f);
			//$parenteb = $res[''];
			//$edadb = $res[''];



			
			$pdf->AliasNbPages();
			$pdf -> AddPage(); //crea la pagina del PDF

			$pdf -> SetFont('Arial','B',7);
			//muestra el formato de fuente con tres parametros,
			//1 tipo de fuente (Courier,Helvetica o Arial, Times, Symbol,ZapfDingbats)
			//2 estilo (estilo de la fuente que puede ser regular, negrita "B", italica "I" y subindice "U" se puede usar dos al mismo tiempo poniendolas juntas 'BU')
			//3 tama??o de letra

			$pdf -> SetX(5);
			//indica la posicion de la siguiente selda en el c??digo
			$pdf -> Cell(200,7,'CARATULA DE CONTRATO INDIVIDUAL DE TRABAJO',1,1,'C');
			//muestra el formato de la celda
			//1 ancho (el ancho de la celda en pixeles)
			//2 alto (el alto de la celda en pixeles)
			//3 texto (el texto a mostrar en la celda)
			//4 bordes (el borde que rodea la celda "opcional")
			//5 salto de linea (baja el renglon para la siguiente celda)
			//6 alineacion texto (alinea el texto de la celda)

			$pdf -> SetX(5);
			$pdf -> Cell(200,8,'DATOS DEL EMPLEADO',1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(30,8,'NOMBRE COMPLETO',1,0,'J');
			$pdf -> Cell(110,8,utf8_decode($nombreC),1,0,'C');
			$pdf -> Cell(10,8,'CURP',1,0,'J');
			$pdf -> Cell(50,8,$curp,1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(30,8,'DOMICILIO',1,0,'J');
      $pdf -> SetXY(35,33);
			$pdf -> MultiCell(110,4,utf8_decode($domicilio),1,'C',0);
      $pdf -> SetXY(145,33);
			$pdf -> Cell(10,8,'RFC',1,0,'J');
			$pdf -> Cell(50,8,$rfc,1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(30,8,'NACIONALIDAD',1,0,'J');
			$pdf -> Cell(35,8,$naci,1,0,'C');
			$pdf -> Cell(33,8,'EDAD',1,0,'J');
			$pdf -> Cell(33,8,$edad,1,0,'C');
			$pdf -> Cell(34,8,'ESTADO CIVIL',1,0,'J');
			$pdf -> Cell(35,8,$estadoc,1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,8,'NUMERO DE SEGURO SOCIAL',1,0,'J');
			$pdf -> Cell(50,8,$nss,1,0,'C');
			$pdf -> Cell(50,8,'FECHA DE NACIMIENTO',1,0,'J');
			$pdf -> Cell(50,8,$fechaN,1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(20,8,'PUESTO',1,0,'J');
			$pdf -> SetXY(25,57);
			$pdf -> MultiCell(70,4,$puesto,1,'C',0);
			$pdf -> SetXY(95,57);
			$pdf -> MultiCell(60,4,'TIENE CREDITO INFONAVIT, INFONACOT  U OTRA RETENCION LEGAL',1,'J',0);
			$pdf -> SetXY(155,57);
			$pdf -> Cell(50,8,$info,1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,8,'PERIODICIDAD DEL CONTRATO',1,0,'J');
			$pdf -> Cell(150,8,'CONTRATO POR TIEMPO DETERMINADO DEL '.$i.' AL '.$f.'',1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> MultiCell(20,3.2,'CAUSA QUE JUSTIFICA CONTRATO TEMPORAL',1,'J',0);
			$pdf -> SetXY(25,73);
			$pdf -> MultiCell(180,4.3,'CONTRATACION POR TIEMPO DETERMINADO, DE SERVICIOS ESPECIALIZADOS, 	CONTRATO NUMERO CTO_ADQ_069/2021, CELEBRADO POR PNPDMI, S.A. DE C.V., VISION Y ESTRATEGIA DE NEGOCIOS S.A DE C.V. CON UNA VIGENCIA DEL 21 DE SEPTIEMBRE DEL	2021 AL 20 DE SEPTIEMBRE DE 2022.',1,'J',0);

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'SALARIO DIARIO BRUTO',1,0,'J');
			$pdf -> Cell(150,7,'$'.$salariob.'.00',1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> MultiCell(20,6.6,'JORNADA LABORAL',1,'J',0);
			$pdf -> SetXY(25,93);
			$pdf -> MultiCell(180,3.3,'LA DURACION DE LA JORNADA LABORAL SERA DE 8 (OCHO) HORAS DIARIAS, LA CUAL SE DISTRIBUIRA ACORDE A LAS NECESIDADES DE LA EMPRESA Y ESTA PERMANEZCA EN OPERACIONES, PERO CONTANDO SIEMPRE CON UNA HORA DIARIA PARA DISFRUTAR SUS ALIMENTOS, FUERA DE LA FUENTE DE TRABAJO POR LO QUE NO PODRA SER CONSIDERADO EN NINGUN CASO COMO TIEMPO EFECTIVO DE TRABAJO, ASI COMO DEL DIA DE DESCANSO SEMANAL, CONFORME EL ARTICULO 71 DE LA LFT.',1,'J',0);

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'AREA DE ADSCRIPCION',1,0,'J');
			$pdf -> Cell(150,7,$fase,1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'FECHA DE ALTA LABORAL',1,0,'J');
			$pdf -> Cell(150,7,$fechaal,1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'BENEFICIARIO POR CAUSA DE MUERTE',1,0,'J');
			$pdf -> Cell(150,7,$nombreb,1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'PARENTESCO DEL BENEFICIARIO',1,0,'J');
			$pdf -> Cell(50,7,'',1,0,'C');//REVISAR
			$pdf -> Cell(50,7,'EDAD DEL BENEFICIARIO',1,0,'J');
			$pdf -> Cell(50,7,'',1,1,'C');//REVISAR

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','B',7);
			$pdf -> Cell(200,7,'DATOS DEL PATRON',1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'NOMBRE',1,0,'J');
			$pdf -> Cell(150,7,'PNPDMI S.A DE C.V.',1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'DOMICILIO',1,0,'J');
			$pdf -> Cell(150,7,'AVENIDA RIO MIXCOAC, No. 36, INT. 702, COLONIA ACTIPAN, BENITO JUAREZ, CDMX, 03230',1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> MultiCell(50,3.5,'NUMERO ESCRITURA EXISTENCIA LEGAL DEL PATRON',1,'J',0);
			$pdf -> SetXY(55,155.2);
			$pdf -> Cell(50,7,'FECHA ESCRITURA',1,0,'J');
			$pdf -> Cell(50,7,'NOTARIO',1,0,'J');
			$pdf -> Cell(50,7,'DATOS DE REGISTRO ESCRITURA',1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> MultiCell(50,7,'58,505',1,'J',0);
			$pdf -> SetXY(55,162.3);
			$pdf -> Cell(50,7,'13 DE JUNIO DE 2012',1,0,'J');
			$pdf -> Cell(50,7,'LIC. ALFREDO AYALA HERRERA',1,0,'J');
			$pdf -> SetXY(155,162.3);
			$pdf -> MultiCell(50,3.5,'INSCRITO EN EL REGISTRO PUBLICO DE LA PROPIEDAD Y COMERCIO',1,'J',0);

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7.3,'NOMBRE DEL REPRESENTANTE LEGAL',1,0,'J');
			$pdf -> Cell(150,7,'RICARDO SOTO LOPEZ Y/O BRENDA ALIN BANDA ARZATE',1,1,'J');


			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> MultiCell(50,3.6,'NUMERO ESCRITURA DEL PODER DEL REPRESENTANTE LEGAL',1,'J',0);
			$pdf -> SetXY(55,176.5);
			$pdf -> Cell(50,7,'FECHA ESCRITURA',1,0,'J');
			$pdf -> Cell(50,7,'NOTARIO',1,0,'J');
			$pdf -> Cell(50,7,'DATOS DE REGISTRO ESCRITURA',1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'1,316',1,0,'J');
			$pdf -> SetXY(55,183.5);
			$pdf -> Cell(50,7,'12 DE SEPTIEMBRE DE 2017',1,0,'J');
			$pdf -> Cell(50,7, utf8_decode('LIC. SAUL GUADALUPE SALDA??A'),1,0,'J');
			$pdf -> SetXY(155,183.5);
			$pdf -> MultiCell(50,3.5,'INSCRITO EN EL REGISTRO PUBLICO DE LA PROPIEDAD Y COMERCIO',1,'J',0);

			//$pdf -> SetX(5);
			//$pdf -> SetFont('Arial','B',7);
			//$pdf -> Cell(200,7,'DATOS DEL LUGAR EN QUE EL EMPLEADO PRESTA SERVICIOS',1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','B',7);
			$pdf -> Cell(200,7,'',0,1,'C');

			//$pdf -> SetX(5);
			//$pdf -> SetFont('Arial','',7);
			//$pdf -> MultiCell(50,3.5,'NOMBRE DE LA EMPRESA O INSTITUCION',1,'J',0);
			//$pdf -> SetXY(55,197.5);
			//$pdf -> Cell(150,7,'',1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7.2,'DOMICILIO O DATOS DE LOCALIZACION',1,0,'J');
			$pdf -> Cell(150,7,'',1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'ESTE CONTRATO TIENE ADENDUM',1,0,'J');
			$pdf -> Cell(50,7,'',1,0,'J');
			//$pdf -> Cell(50,7,'COMPENSACION POR LA VIGENCIA DEL CONTRATO',1,0,'J');
			//$pdf -> Cell(50,7,'',1,0,'J');
			$pdf -> Cell(50,7,'FECHA DE FIRMA',1,0,'J');
			$pdf -> Cell(50,7,$fechaal,1,1,'J');

			$pdf -> SetXY(35,250);
			$pdf -> SetFont('Times','',12);
			//$pdf -> Cell(66,10,'',0,0,'C');
			$pdf -> Cell(50,10,'EL PATRON','T',0,'C'); //la letra T indica borde solo en la parte superior de la celda
			$pdf -> Cell(50,10,'',0,0,'C');
			$pdf -> Cell(50,10,'EL EMPLEADO','T',0,'C');
		}
			$pdf->Output(); //muestra la pagina en el navegador
			 exit;
		
	}
	else {
     
	 	$pdf = new fpdf(); //creamos un nuevo objeto pdf
	$query= "
		SELECT 
      t2.[PK_IdRegistro] as id
	 , UPPER(t2.[Nombre_Completo]) as 'NOMBRE COMPLETO',
			UPPER(t2.[CURP]) as 'CURP',
			UPPER(t2.[Calle] + ', ' + t2.[Numero_Int] + ', ' + t2.[Numero_Ext] + ', ' + t5.[Colonia] + ', ' + t5.[Municipio] + ', ' + t5.[Estado]+', CP. '+ t5.[Num_CP]) as 'DOMICILIO',
			UPPER(t2.[RFC]) as 'RFC',
			UPPER(t4.[NOMBRE]) as 'NACIONALIDAD',
			t2.[Edad] as 'EDAD',
			UPPER(t6.[Estado_Civil]) as 'ESTADO CIVIL',
			UPPER(t2.[NSS]) as 'NSS',
			convert (char(30),t2.Fecha_Nacimiento,101) as 'FECHA DE NACIMIENTO',
			UPPER(t7.Nombre_Puesto) as 'PUESTO',
			t8.[Nombre_Fase] as 'FASE',
			UPPER(t12.Nombre) as 'CUENTA CON INFONAVIT',
			UPPER(t11.Sueldo_Diario) as 'SUELDO',
			t3.ODS_Comesa
			,t1.[Fecha_ODS],
			UPPER(CONVERT(varchar,t3.Fecha_Inicio,111)) as 'FECHA DE INICIO',
			UPPER(CONVERT(varchar,t3.Fecha_Fin,111)) as 'FECHA DE FIN',
			CONVERT(varchar,t3.Fecha_Inicio,103) as 'FECHA DE ALTA',	
          '\\192.168.1.220\Comesa\APP\Controller\' + t2.[Nombre_Completo] + '_' + t2.[CURP] as 'RUTA'
  FROM [PRO_SERVER_COMESA].[dbo].[PSC.Bitacora_ODS]t1
  LEft join [PSC.RegistroDP]t2 on t2.PK_IdRegistro=t1.FK_IdRegistro
  Left join [PSC.ODS]t3 on t3.PK_IdODS=t1.FK_IdODS
  left join [dbo].[PSC.Usuario_Nacionalidad]t4 on t2.FK_IdNacionalidad= t4.PK_IdNacionalidad
  left join [dbo].[PSC.CP]t5 on t2.FK_idCP = t5.PK_IdCP
  left join [dbo].[PSC.Estado_Civil]t6 on t2.FK_IdEstado_Civil= t6.PK_IdEstado_Civil
  left join [dbo].[PSC.Puesto]t7 on t2.FK_IdPuesto = t7.PK_IdPuesto
  left join [dbo].[PSC.Fase_Puesto]t8 on t7.FK_IdFase = t8.PK_IdFase
  left join [dbo].[PSC.ODS]t9 on t2.FK_IdODS = t9.PK_IdODS
  left join [PSC.RegistroDB]t10 on t1.FK_IdRegistro=t10.FK_IdRegistro
  left join [dbo].[PSC.Puesto]t11 on t2.FK_IdPuesto = t11.PK_IdPuesto
  left join [dbo].[PSC.Infonavit]t12 on t10.FK_IdInfonavit= t12.PK_IdInfonavit
  where t1.FK_IdRegistro= '$id'  and convert(varchar,t3.fecha_Inicio, 111) between '2021/12/31' and '2022/01/01'
		
		";
		//print_r($query);
		$query=sqlsrv_query($con,$query,PARAMS,OPTION);

		while ($res=sqlsrv_fetch_array($query)) {

			$id=$res['id'];
			$nombreC = $res['NOMBRE COMPLETO'];
			$curp = $res['CURP'];
			$domicilio = $res['DOMICILIO'];
			$rfc = $res['RFC'];
			$naci = $res['NACIONALIDAD'];
			$edad = $res['EDAD'];
			$estadoc = $res['ESTADO CIVIL'];
			$nss = $res['NSS'];
			$fechaN = $res['FECHA DE NACIMIENTO'];
			$puesto = $res['PUESTO'];
			$info = $res['CUENTA CON INFONAVIT'];
			$salariob = $res['SUELDO'];
			$areaad = $res['DEPARTAMENTO'];
			$fechaal = $res['FECHA DE ALTA LABORAL'];
			$nombreb = $res['NOMBRE DE CONTACTO'];
			//$parenteb = $res[''];
			//$edadb = $res[''];



		     $pdf->AliasNbPages();
			$pdf -> AddPage(); //crea la pagina del PDF

			$pdf -> SetFont('Arial','B',7);
			//muestra el formato de fuente con tres parametros,
			//1 tipo de fuente (Courier,Helvetica o Arial, Times, Symbol,ZapfDingbats)
			//2 estilo (estilo de la fuente que puede ser regular, negrita "B", italica "I" y subindice "U" se puede usar dos al mismo tiempo poniendolas juntas 'BU')
			//3 tama??o de letra

			$pdf -> SetX(5);
			//indica la posicion de la siguiente selda en el c??digo
			$pdf -> Cell(200,7,'CARATULA DE CONTRATO INDIVIDUAL DE TRABAJO',1,1,'C');
			//muestra el formato de la celda
			//1 ancho (el ancho de la celda en pixeles)
			//2 alto (el alto de la celda en pixeles)
			//3 texto (el texto a mostrar en la celda)
			//4 bordes (el borde que rodea la celda "opcional")
			//5 salto de linea (baja el renglon para la siguiente celda)
			//6 alineacion texto (alinea el texto de la celda)

			$pdf -> SetX(5);
			$pdf -> Cell(200,8,'DATOS DEL EMPLEADO',1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(30,8,'NOMBRE COMPLETO',1,0,'J');
			$pdf -> Cell(110,8,$nombreC,1,0,'J');
			$pdf -> Cell(10,8,'CURP',1,0,'J');
			$pdf -> Cell(50,8,$curp,1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(30,8,'DOMICILIO',1,0,'J');
			$pdf -> Cell(110,8,$domicilio,1,0,'J');
			$pdf -> Cell(10,8,'RFC',1,0,'J');
			$pdf -> Cell(50,8,$rfc,1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(30,8,'NACIONALIDAD',1,0,'J');
			$pdf -> Cell(35,8,$naci,1,0,'J');
			$pdf -> Cell(33,8,'EDAD',1,0,'J');
			$pdf -> Cell(33,8,$edad,1,0,'J');
			$pdf -> Cell(34,8,'ESTADO CIVIL',1,0,'J');
			$pdf -> Cell(35,8,$estadoc,1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,8,'NUMERO DE SEGURO SOCIAL',1,0,'J');
			$pdf -> Cell(50,8,$nss,1,0,'J');
			$pdf -> Cell(50,8,'FECHA DE NACIMIENTO',1,0,'J');
			$pdf -> Cell(50,8,$fechaN,1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(20,8,'PUESTO',1,0,'J');
			$pdf -> SetXY(25,57);
			$pdf -> MultiCell(70,8,$puesto,1,'J',0);
			$pdf -> SetXY(95,57);
			$pdf -> MultiCell(60,4,'TIENE CREDITO INFONAVIT, INFONACOT  U OTRA RETENCION LEGAL',1,'J',0);
			$pdf -> SetXY(155,57);
			$pdf -> Cell(50,8,$info,1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,8,'PERIODICIDAD DEL CONTRATO',1,0,'J');
			$pdf -> Cell(150,8,'CONTRATO POR TIEMPO DETERMINADO DEL 1 DE DICIEMBRE AL 31 DE DICIEMBRE DEL 2021',1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> MultiCell(20,3.2,'CAUSA QUE JUSTIFICA CONTRATO TEMPORAL',1,'J',0);
			$pdf -> SetXY(25,73);
			$pdf -> MultiCell(180,4.3,'CONTRATACION POR TIEMPO DETERMINADO, DE SERVICIOS ESPECIALIZADOS, 	CONTRATO NUMERO CTO_ADQ_069/2021, CELEBRADO POR PNPDMI, S.A. DE C.V., VISION Y ESTRATEGIA DE NEGOCIOS S.A DE C.V. CON UNA VIGENCIA DEL 21 DE SEPTIEMBRE DEL	2021 AL 20 DE SEPTIEMBRE DE 2022.',1,'J',0);

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'SALARIO DIARIO INTEGRADO',1,0,'J');
			$pdf -> Cell(150,7,$salariob,1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> MultiCell(20,6.6,'JORNADA LABORAL',1,'J',0);
			$pdf -> SetXY(25,93);
			$pdf -> MultiCell(180,3.3,'LA DURACION DE LA JORNADA LABORAL SERA DE 8 (OCHO) HORAS DIARIAS, LA CUAL SE DISTRIBUIRA ACORDE A LAS NECESIDADES DE LA EMPRESA Y ESTA PERMANEZCA EN OPERACIONES, PERO CONTANDO SIEMPRE CON UNA HORA DIARIA PARA DISFRUTAR SUS ALIMENTOS, FUERA DE LA FUENTE DE TRABAJO POR LO QUE NO PODRA SER CONSIDERADO EN NINGUN CASO COMO TIEMPO EFECTIVO DE TRABAJO, ASI COMO DEL DIA DE DESCANSO SEMANAL, CONFORME EL ARTICULO 71 DE LA LFT.',1,'J',0);

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'AREA DE ADSCRIPCION',1,0,'J');
			$pdf -> Cell(150,7,$areaad,1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'FECHA DE ALTA LABORAL',1,0,'J');
			$pdf -> Cell(150,7,$fechaal,1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'BENEFICIARIO POR CAUSA DE MUERTE',1,0,'J');
			$pdf -> Cell(150,7,$nombreb,1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'PARENTESCO DEL BENEFICIARIO',1,0,'J');
			$pdf -> Cell(50,7,'JUAN PEREZ',1,0,'J');
			$pdf -> Cell(50,7,'EDAD DEL BENEFICIARIO',1,0,'J');
			$pdf -> Cell(50,7,'35',1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','B',7);
			$pdf -> Cell(200,7,'DATOS DEL PATRON',1,1,'C');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'NOMBRE',1,0,'J');
			$pdf -> Cell(150,7,'PNPDMI S.A DE C.V.',1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'DOMICILIO',1,0,'J');
			$pdf -> Cell(150,7,'AVENIDA RIO MIXCOAC, No. 36, INT. 702, COLONIA ACTIPAN, BENITO JUAREZ, CDMX, 03230',1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> MultiCell(50,3.5,'NUMERO ESCRITURA EXISTENCIA LEGAL DEL PATRON',1,'J',0);
			$pdf -> SetXY(55,155.2);
			$pdf -> Cell(50,7,'FECHA ESCRITURA',1,0,'J');
			$pdf -> Cell(50,7,'NOTARIO',1,0,'J');
			$pdf -> Cell(50,7,'DATOS DE REGISTRO ESCRITURA',1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> MultiCell(50,7,'58,505',1,'J',0);
			$pdf -> SetXY(55,162.3);
			$pdf -> Cell(50,7,'13 DE JUNIO DE 2012',1,0,'J');
			$pdf -> Cell(50,7,'LIC. ALFREDO AYALA HERRERA',1,0,'J');
			$pdf -> SetXY(155,162.3);
			$pdf -> MultiCell(50,3.5,'INSCRITO EN EL REGISTRO PUBLICO DE LA PROPIEDAD Y COMERCIO',1,'J',0);

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7.3,'NOMBRE DEL REPRESENTANTE LEGAL',1,0,'J');
			$pdf -> Cell(150,7,'RICARDO SOTO LOPEZ Y/O BRENDA ALIN BANDA ARZATE',1,1,'J');


			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> MultiCell(50,3.6,'NUMERO ESCRITURA DEL PODER DEL REPRESENTANTE LEGAL',1,'J',0);
			$pdf -> SetXY(55,176.5);
			$pdf -> Cell(50,7,'FECHA ESCRITURA',1,0,'J');
			$pdf -> Cell(50,7,'NOTARIO',1,0,'J');
			$pdf -> Cell(50,7,'DATOS DE REGISTRO ESCRITURA',1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'1,316',1,0,'J');
			$pdf -> SetXY(55,183.5);
			$pdf -> Cell(50,7,'12 DE SEPTIEMBRE DE 2017',1,0,'J');
			$pdf -> Cell(50,7,'LIC. SAUL GUADALUPE SALDA??A',1,0,'J');
			$pdf -> SetXY(155,183.5);
			$pdf -> MultiCell(50,3.5,'INSCRITO EN EL REGISTRO PUBLICO DE LA PROPIEDAD Y COMERCIO',1,'J',0);

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'DOMICILIO O DATOS DE LOCALIZACION',1,0,'J');
			$pdf -> Cell(150,7,'',1,1,'J');

			$pdf -> SetX(5);
			$pdf -> SetFont('Arial','',7);
			$pdf -> Cell(50,7,'ESTE CONTRATO TIENE ADENDUM',1,0,'J');
			$pdf -> Cell(50,7,'',1,0,'J');
			$pdf -> Cell(50,7,'FECHA DE FIRMA',1,0,'J');
			$pdf -> Cell(50,7,$fechaal,1,1,'J');

			$pdf -> SetXY(35,250);
			$pdf -> SetFont('Times','',12);
			//$pdf -> Cell(66,10,'',0,0,'C');
			$pdf -> Cell(50,10,'EL PATRON','T',0,'C'); //la letra T indica borde solo en la parte superior de la celda
			$pdf -> Cell(50,10,'',0,0,'C');
			$pdf -> Cell(50,10,'EL EMPLEADO','T',0,'C');

			$pdf->Output(); //muestra la pagina en el navegador
			 exit;
		}
	}
?>
