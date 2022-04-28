<?php
	require_once('APP/Controller/funcion.class.sgmx.define.BBDD.php');
	

	class reporte_excel {
	
	public function exportar_excel()	{
	$conect = sqlsrv_connect(SERVER,CONNINF);
	$fecha = date('Y-m-d H:i:s');
	$nombreArchivo = 'plantilla_empleados';

	$query= "select 
			PK_IdUsuario as 'N',
			t1.Login,
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
		group by t1.PK_IdUsuario
			,t1.Login,
			t2.Nombre,
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
	$archivo = '_';
	header("Content-type: application/vnd.ms-excel"); 
	header('Content-Type: text/html; charset=UTF-8');
	header("Content-Disposition: attachment; filename=".str_replace('','_',$nombreArchivo)."$archivo$fecha.xls");
	header("Pragma: no-cache");
	header("Expires: 0");

	echo "<table border='2' bordercolor='#000'><tr>";
	$filas = sqlsrv_num_rows($query); //conteo de filas
	if ($filas > 0) {
		$columnas = sqlsrv_num_fields($query);
		foreach(sqlsrv_field_metadata($query) as $titulos){
			echo "<th bgcolor='#00365c'><span><font color = '#FFFFFF'>".$titulos['Name'];
			echo "</font></span>\t</th>";
		}
		echo "</tr>".chr(13).chr(10);
		while($registro = sqlsrv_fetch_array($query)){
			echo "<tr >";
			for ($i = 0; $i<$columnas; $i++){
				if($i == 0)
					echo "<td><span  class='TexFax2'>".$registro[$i]."</span>\t</td>";
				
				else 
					echo "<td align = 'center'><span class='TexFax2'>".$registro[$i]."</span>\t</td>";
				
			}
			echo "</tr>".chr(13).chr(10);
		}
		echo "</table></div>";
	}
	}
	}
?>