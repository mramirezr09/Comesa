SELECT
t1.[Nombre_Completo] as 'NOMBRE COMPLETO',
t1.[CURP] as 'CURP',
t1.[Calle] + ', ' + [Numero_Int] + ', ' + [Numero_Ext] + ', ' + [Colonia] + ', ' + [Municipio] + ', ' + [Nombre_Estado] as 'DOMICILIO',
t1.[RFC] as 'RFC',
t8.[NOMBRE] as 'NACIONALIDAD',
t1.[Edad] as 'EDAD',
t9.[Estado_Civil] as 'ESTADO CIVIL',
t1.[NSS] as 'NSS',
convert (char(30),t1.Fecha_Nacimiento,101) as 'FECHA DE NACIMIENTO',
t3.Nombre_Puesto as 'PUESTO',
t12.[Nombre_Fase] as 'FASE',
t10.Nombre as 'CUENTA CON INFONAVIT',
--t1.Partida as 'SUELDO',
'01/10/2021' as 'FECHA DE ALTA LABORAL',
t11.[Contacto_Telefono] as 'TELEFONO DE CONTACTO',
t11.[Contacto] as 'NOMBRE DE CONTACTO',
t11.[Departamento] as 'DEAPARTAMENTO',
'\\192.168.1.220\Comesa\APP\Controller\' + t1.[Nombre_Completo] + '_' + t1.[CURP] as 'RUTA'

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

--where t1.Nombre_Completo like '%luna cruz rodolfo%'