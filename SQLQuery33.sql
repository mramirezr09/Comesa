/****** Script for SelectTopNRows command from SSMS  ******/
SELECT [PK_IdRegistro]
      ,[Nombre_Completo]
	  ,[CURP]
	  ,[RFC]
	  ,[Fecha_Nacimiento]
	   ,[Edad]
	   ,[Partida] as Salario
	   ,puesto as categoria
      
  FROM [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]t1

  LEFT JOIN [dbo].[PSC.Estado]t2 ON t1.FK_IdEstado=t2.PK_IdEstado
  LEFT JOIN [PSC.Esquema_Nomina]t3 ON t1.FK_IdEsquema=t3.PK_IdEsquema
  LEFT JOIN [PSC.RegistroDB]t4 ON t1.PK_IdRegistro=t4.FK_IdRegistro
  