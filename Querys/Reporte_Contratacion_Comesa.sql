SELECT				
			t1.PK_IdRegistro as id,
			t15.Nombre_Frente as 'FOLIO',
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
			--'01/11/2021' as 'FECHA DE ALTA LABORAL',	
			t1.[Contacto_Telefono] as 'TELEFONO DE CONTACTO',	
			UPPER(t1.[Contacto]) as 'NOMBRE DE CONTACTO',	
			t13.Nombre_Banco as 'BANCO',	
			t2.Clabe as 'CLABE',
			CONVERT (char(10),t1.Fecha_Actualiza,103) as 'FECHA CONTRATACION',
			CONVERT (char(10),t1.Fecha_Actualiza,103) as 'FECHA INGRESO',
			UPPER(t14.Nombre) as 'FILTRO JURIDICO'
				
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
			--where CONVERT (char(10),t1.Fecha_Actualiza,23) between '2021-11-05' and '2021-11-05'
				
			order by t1.Fecha_Actualiza desc
