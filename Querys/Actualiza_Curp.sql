--ACTUALIZA CURP

update [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP] 
set nss='67008008855'
where PK_IdRegistro='COM135'

SELECT
	  [PK_IdRegistro]
      ,[Nombre_Completo]
      ,[NSS]

  FROM [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]
  where Nombre_Completo like '%PRIETO RAMIREZ VICTOR%'