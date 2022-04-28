 <?php
	require'././fpdf/fpdf.php';
	require_once('././APP/Controller/funcion.class.sgmx.define.BBDD.php');

	//$id=$_POST["cred"];
	//echo $id;


	$con = sqlsrv_connect(SERVER,CONNINF);

	$query= "
		SELECT
			t1.PK_IdRegistro as id,
			UPPER(t1.[Nombre_Completo]) as 'NOMBRE COMPLETO',
			UPPER(t1.[Apellido_Paterno]) as 'Apaterno',
			UPPER(t1.[Apellido_Materno]) as 'Amaterno',
			UPPER(t1.[Nombre]) as 'Nombre',
			UPPER(t1.[CURP]) as 'CURP',
			UPPER(t1.[Calle] + ', ' + [Numero_Int] + ', ' + [Numero_Ext] + ', ' + [Colonia] + ', ' + [Municipio] + ', ' + [Nombre_Estado]) as 'DOMICILIO',
			UPPER(t1.[RFC]) as 'RFC',
			UPPER(t8.[NOMBRE]) as 'NACIONALIDAD',
			t1.[Edad] as 'EDAD',
			UPPER(t9.[Estado_Civil]) as 'ESTADO CIVIL',
			UPPER(t1.[NSS]) as 'NSS',
			convert (char(30),t1.Fecha_Nacimiento,101) as 'FECHA DE NACIMIENTO',
			UPPER(t3.Nombre_Puesto) as 'PUESTO',
			UPPER(t10.Nombre) as 'CUENTA CON INFONAVIT',
			UPPER(t3.Sueldo_Mensual) as 'SUELDO',
			'01/10/2021' as 'FECHA DE ALTA LABORAL',
			t1.[Contacto_Telefono] as 'TELEFONO DE CONTACTO',
			UPPER(t1.[Contacto]) as 'NOMBRE DE CONTACTO',
			UPPER(t11.[Departamento]) as 'DEPARTAMENTO',
			'S:\Comesa\APP\Controller\Fotos\' +t1.PK_IdRegistro+'.png' as 'RUTA'

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

			where T1.PK_IdRegistro = '$id'
	";
	//print_r($query);
	$query=sqlsrv_query($con,$query,PARAMS,OPTION);

	while ($res=sqlsrv_fetch_array($query)) {

		$id=$res['id'];
		$nombreC = $res['NOMBRE COMPLETO'];
		$apaterno = $res['Apaterno'];
		$amaterno = $res['Amaterno'];
		$nombre = $res['Nombre'];
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
		$telefonob = $res['TELEFONO DE CONTACTO'];
		//$parenteb = $res[''];
		//$edadb = $res[''];
		$ruta = $res['RUTA'];



		$pdf = new fpdf; //creamos un nuevo objeto pdf
		$pdf -> AddPage(); //crea la pagina del PDF

		//$pdf -> SetFont('Arial','B',5);
		//muestra el formato de fuente con tres parametros,
		//1 tipo de fuente (Courier,Helvetica o Arial, Times, Symbol,ZapfDingbats)
		//2 estilo (estilo de la fuente que puede ser regular, negrita "B", italica "I" y subindice "U" se puede usar dos al mismo tiempo poniendolas juntas 'BU')
		//3 tama�o de letra

		//$pdf -> SetX(5); //indica el numero de pixeles que recorre el margen de la siguiente celda
		//indica la posicion de la siguiente selda en el c�digo
		//$pdf -> Cell(200,7,'CARATULA DE CONTRATO INDIVIDUAL DE TRABAJO',1,1,'C');
		//muestra el formato de la celda
		//1 ancho (el ancho de la celda en pixeles)
		//2 alto (el alto de la celda en pixeles)
		//3 texto (el texto a mostrar en la celda)
		//4 bordes (el borde que rodea la celda "opcional")
		//5 salto de linea (baja el renglon para la siguiente celda)
		//6 alineacion texto (alinea el texto de la celda)

		$foto = $pdf -> Image($ruta,18,15,40);

		$logo = $pdf -> Image('S:\COMESA\Script\assets\Logotipo_PNPDMI.png',15,80,40);




		$pdf -> SetX(10);
		$pdf -> SetFont('Arial','B',9);
		$pdf -> SetDrawColor(255,128,0);
		$pdf -> SetLineWidth(0.5);
		$pdf -> MultiCell(60,9,'



		NOMBRE: '.$apaterno.' '.$amaterno.'
		'.$nombre.'
		NSS: '.$nss.'
		CURP: '.$curp.'

		',1,'L',0);


		// parte trasera

		$texto = $pdf -> Image('S:\COMESA\Script\assets\texto.png',80,18,40);

		$pdf -> SetXY(85,60);
		$pdf -> SetFont('Arial','',9);
		$pdf -> SetDrawColor(0,0,0);
		$pdf -> Cell(30,5,'FIRMA','T',0,'C');

		$pdf -> SetXY(70,70);
		$pdf -> SetFont('Arial','B',9);
		$pdf -> MultiCell(60,7,'CONTACTO DE EMERGENCIA',0,'C',0);

		$pdf -> SetXY(70,80);
		$pdf -> SetFont('Arial','B',9);
		$pdf -> MultiCell(60,7,''.$nombreb.'
		'.$telefonob.'',0,'C',0);

		$pdf -> SetXY(70,10);
		$pdf -> SetFont('Arial','B',9);
		$pdf -> SetDrawColor(255,128,0);
		$pdf -> Cell(60,9,'AL SERVICIO DE COMESA',0,0,'C');
		$pdf -> SetXY(70,10);
		$pdf -> SetFont('Arial','B',9);
		$pdf -> SetLineWidth(0.5); //grozor de linea de celda
		$pdf -> MultiCell(60,7,'











		',1,'C',0);

		$pdf->Output(); //muestra la pagina en el navegador
	}
?>
