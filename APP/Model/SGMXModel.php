<?php

if ($requestAjax)
 {require ('../Controller/funcion.class.sgmx.define.BBDD.php');
 }else{require ('././APP/Controller/funcion.class.sgmx.define.BBDD.php');}

  class SGMXModel
{
	  protected function connect_ODBC()
	  {
		  $get_DB = new PDO (SGDB);

          if( $get_DB ) {
				//echo "Conexión establecida.<br />";
			}else{
				 echo "Conexión no se pudo establecer.<br />";
				 die( print_r( sqlsrv_errors(), true));
			}

		  return $get_DB;
	  }

	  protected function connect_MSSQL()
	  {
		  $get_MSSQL = sqlsrv_connect(SERVER,CONNINF);
		   return $get_MSSQL;
	  }


	  protected function consultasql($consulta){
		  $result= self::connect_ODBC() -> prepare($consulta);
		  $result -> execute();
		  return $result;
	  }

	   protected function inserta_registroDP ($cuenta) // funcion insertar usuario
	  {
		 $sql=self:: connect_ODBC () -> prepare(
		  "INSERT INTO  [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]
		  (
		  [PK_IdRegistro]
		  ,[FK_IdUsuario]
		  ,[FK_IdFiltro]
		  ,[FK_IdEstado]
		  ,[FK_IdPerfil]
		  ,[FK_IdEsquema]
		  ,[FK_IdSexo]
          ,[FK_IdEstado_Civil]
		  ,[FK_IdNacionalidad]
		  ,[FK_IdPuesto]
		  ,[Apellido_Paterno]
		  ,[Apellido_Materno]
		  ,[Nombre]
		  ,[Nombre_Completo]
		  ,[Edad]
		  ,[Mail]
		  ,[Fecha_Nacimiento]
		  ,[Lugar_Nacimiento]
		  ,[Calle]
		  ,[Numero_Ext]
		  ,[Numero_Int]
		  ,[Municipio]
		  ,[Colonia]
		  ,[CP]
		  ,[RFC]
		  ,[CURP]
		  ,[NSS]
		  ,[Numero_Telefono]
		  ,[Estatus]

		  )
		  VALUES
		  (
		  :pkid,
		  :idu,
		  :filtro,
		  :estado,
		  :perfil,
		  :esquema,
		  :sexo,
          :estadoC,
		  :nacionalidad,
		  :puest,
		  :apa,
		  :ama,
		  :nom,
		  :nomco,
		  :edad,
		  :mail,
		  :fenac,
		  :lunac,
		  :calle,
		  :numext,
		  :numint,
		  :muni,
		  :colon,
		  :cp,
		  :rfc,
		  :curp,
		  :nss,
		  :numtel,
		  :estatus
		  )
		   ");
		  //definir punteros para pasar datos del controlador al modelo
		  $sql -> bindparam (":pkid",$cuenta['pkid']);
		  $sql -> bindparam (":idu",$cuenta['id_u']);
		  $sql -> bindparam (":filtro",$cuenta['filtro']);
		  $sql -> bindparam (":estado",$cuenta['estado']);
		  $sql -> bindparam (":perfil",$cuenta['perfil']);
		  $sql -> bindparam (":esquema",$cuenta['esquema']);
		  $sql -> bindparam (":sexo",$cuenta['sexo']);
          $sql -> bindparam (":estadoC",$cuenta['estadoC']);
		  $sql -> bindparam (":nacionalidad",$cuenta['naci']);
		  $sql -> bindparam (":puest",$cuenta['puest']);
		  $sql -> bindparam (":apa",$cuenta['apa']);
		  $sql -> bindparam (":ama",$cuenta['ama']);
		  $sql -> bindparam (":nom",$cuenta['nombre']);
		  $sql -> bindparam (":nomco",$cuenta['nomco']);
		  $sql -> bindparam (":edad",$cuenta['edad']);
	      $sql -> bindparam (":mail",$cuenta['mail']);
		 $sql -> bindparam (":fenac",$cuenta['fechaN']);
		 $sql -> bindparam (":lunac",$cuenta['luna']);
	     $sql -> bindparam (":calle",$cuenta['calle']);
		 $sql -> bindparam (":numext",$cuenta['numext']);
		 $sql -> bindparam (":numint",$cuenta['numint']);
		 $sql -> bindparam (":muni",$cuenta['muni']);
		  $sql -> bindparam (":colon",$cuenta['colo']);
		 $sql -> bindparam (":cp",$cuenta['postal']);
	     $sql -> bindparam (":rfc",$cuenta['rfc']);
	     $sql -> bindparam (":curp",$cuenta['curp']);
		 $sql -> bindparam (":nss",$cuenta['nss']);
		  $sql -> bindparam (":numtel",$cuenta['tel']);

		  $sql -> bindparam (":estatus",$cuenta['estatus']);

	  	//print_r($sql);
		  $sql -> execute();// ejecuta consulta
		  return $sql;
	  }

	  protected function update_registroDP ($cuenta) // funcion insertar usuario
	  {
		 $sql=self:: connect_ODBC () -> prepare(
		  "UPDATE  [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]
		  SET
		  [FK_IdUsuario]=:idu
		  ,[FK_IdEstado]=:lunac
		  ,[FK_IdPerfil]=:perfil
		  ,[FK_IdEsquema]=:esquema
	      ,[FK_IdSexo]=:sexo
          ,[FK_IdEstado_Civil]=:estadoC
		  ,[FK_IdNacionalidad]=:nacionalidad

		  ,[FK_IdReingreso]=:rei
      ,[FK_IdCP]=:colon

		  ,[Edad]=:edad
		  ,[Mail]=:mail
		  ,[Fecha_Nacimiento]=:fenac
		  --,[Lugar_Nacimiento]=:lunac
	       ,[Calle]=:calle
		  ,[Numero_Ext]=:numext
		  ,[Numero_Int]=:numint
		  -- ,[Municipio]=:muni
		   ,[CP]= :cp
		  ,[RFC]= :rfc
		  ,[CURP]=:curp
		  ,[NSS]= :nss
		  ,[Numero_Telefono]=:numtel
		  ,[contacto]=:contacto
		  ,[contacto_telefono]=:telcon
		  ,[Estatus] = :estatus

		   Where PK_IdREgistro=:id

		   ");
		  //definir punteros para pasar datos del controlador al modelo
		  $sql -> bindparam (":id",$cuenta['pkid']);
		  $sql -> bindparam (":idu",$cuenta['id_u']);
		  //$sql -> bindparam (":estado",$cuenta['estado']);
		  $sql -> bindparam (":perfil",$cuenta['perfil']);
		  $sql -> bindparam (":esquema",$cuenta['esquema']);
		  $sql -> bindparam (":sexo",$cuenta['sexo']);
          $sql -> bindparam (":estadoC",$cuenta['estadoC']);
		  $sql -> bindparam (":nacionalidad",$cuenta['naci']);
		//  $sql -> bindparam (":puesto",$cuenta['puesto']);
		  $sql -> bindparam (":rei",$cuenta['rei']);
		 // $sql -> bindparam (":apa",$cuenta['apa']);
		 // $sql -> bindparam (":ama",$cuenta['ama']);
		 // $sql -> bindparam (":nombre",$cuenta['nombre']);
		 // $sql -> bindparam (":nomco",$cuenta['nomco']);
		  $sql -> bindparam (":edad",$cuenta['edad']);
	      $sql -> bindparam (":mail",$cuenta['mail']);
		 $sql -> bindparam (":fenac",$cuenta['fechaN']);
		 $sql -> bindparam (":lunac",$cuenta['luna']);
	     $sql -> bindparam (":calle",$cuenta['calle']);
		 $sql -> bindparam (":numext",$cuenta['numext']);
		 $sql -> bindparam (":numint",$cuenta['numint']);
		 // $sql -> bindparam (":muni",$cuenta['muni']);
		  $sql -> bindparam (":colon",$cuenta['colo']);
		 $sql -> bindparam (":cp",$cuenta['postal']);
	     $sql -> bindparam (":rfc",$cuenta['rfc']);
	     $sql -> bindparam (":curp",$cuenta['curp']);
		 $sql -> bindparam (":nss",$cuenta['nss']);
		  $sql -> bindparam (":numtel",$cuenta['tel']);
		   $sql -> bindparam (":contacto",$cuenta['contacto']);
		    $sql -> bindparam (":telcon",$cuenta['telcon']);
		  $sql -> bindparam (":estatus",$cuenta['estatus']);

	  	 print_r($sql);
		  $sql -> execute();// ejecuta consulta
		  return $sql;
	  }




	protected function inserta_filtroJ ($cuenta)
	{// funcion insertar usuario
		$sql=self:: connect_ODBC () -> prepare(
			"
      INSERT INTO  [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP] (
				[PK_IdRegistro]
				,[FK_IdUsuario]
				,[FK_IdFiltro]
				,[FK_IdPerfil]
				,[FK_IdRegistrEstatus]
				,[FK_IdPuesto]
				,[FK_IdReingreso]
				,[FK_IdODS]
				,[Apellido_Paterno]
				,[Apellido_Materno]
				,[Nombre]
				,[Nombre_Completo]
				,[CURP]

				,[Filtro]
				,[Estatus]
				,[Fecha_Contratacion]
			)
			VALUES (
				:pkid,
				:idu,
				:filtroid,
				:perfil,
				:reestatus,
				:puesto,
				:rei,
				:idODS,
				:apa,
				:ama,
				:nom,
				:nomco,
				:curp,

				:filtro,
				:estatus,
				:fechacon
			)"
		);
		//definir punteros para pasar datos del controlador al modelo
		$sql -> bindparam (":pkid",$cuenta['pkid']);
		$sql -> bindparam (":idu",$cuenta['id_u']);
		$sql -> bindparam (":filtroid",$cuenta['filtroid']);
		$sql -> bindparam (":perfil",$cuenta['perfil']);
		$sql -> bindparam (":reestatus",$cuenta['estre']);
		$sql -> bindparam (":puesto",$cuenta['puesto']);
		$sql -> bindparam (":rei",$cuenta['rei']);
		$sql -> bindparam (":idODS",$cuenta['idODS']);
		$sql -> bindparam (":apa",$cuenta['apa']);
		$sql -> bindparam (":ama",$cuenta['ama']);
		$sql -> bindparam (":nom",$cuenta['nombre']);
		$sql -> bindparam (":nomco",$cuenta['nomco']);
		$sql -> bindparam (":curp",$cuenta['curp']);
		$sql -> bindparam (":filtro",$cuenta['filtro']);
		$sql -> bindparam (":estatus",$cuenta['estatus']);

		$sql -> bindparam (":fechacon",$cuenta['fechacon']);
	  	print_r($sql);
		$sql -> execute();// ejecuta consulta
		return $sql;
	}
		protected function inserta_filtroPNP($cuenta)
		{// funcion insertar usuario
		$sql=self:: connect_ODBC () -> prepare(
			"INSERT INTO  [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP] (
				[PK_IdRegistro]
				,[FK_IdUsuario]
				,[FK_IdFiltro]
				,[FK_IdPerfil]
				,[FK_IdRegistrEstatus]
				,[FK_IdPuesto]
				,[FK_IdReingreso]
				,[FK_IdODS]
				,[Apellido_Paterno]
				,[Apellido_Materno]
				,[Nombre]
				,[Nombre_Completo]
				,[CURP]
				,[Filtro]
				,[Estatus]
				,[Captura_Pnp]
				,[Fecha_Contratacion]
			)
			VALUES (
				:pkid,
				:idu,
				:filtroid,
				:perfil,
				:reestatus,
				:puesto,
				:rei,
				:idODS,
				:apa,
				:ama,
				:nom,
				:nomco,
				:curp,
				:filtro,
				:estatus,
				:pnpcon,
				:fechacon
			)"
		);

		//definir punteros para pasar datos del controlador al modelo
		$sql -> bindparam (":pkid",$cuenta['pkid']);
		$sql -> bindparam (":idu",$cuenta['id_u']);
		$sql -> bindparam (":filtroid",$cuenta['filtroid']);
		$sql -> bindparam (":perfil",$cuenta['perfil']);
		$sql -> bindparam (":reestatus",$cuenta['estre']);
		$sql -> bindparam (":puesto",$cuenta['puesto']);
		$sql -> bindparam (":rei",$cuenta['rei']);
		$sql -> bindparam (":idODS",$cuenta['idODS']);
		$sql -> bindparam (":apa",$cuenta['apa']);
		$sql -> bindparam (":ama",$cuenta['ama']);
		$sql -> bindparam (":nom",$cuenta['nombre']);
		$sql -> bindparam (":nomco",$cuenta['nomco']);
		$sql -> bindparam (":curp",$cuenta['curp']);
		$sql -> bindparam (":filtro",$cuenta['filtro']);
		$sql -> bindparam (":estatus",$cuenta['estatus']);
		$sql -> bindparam (":pnpcon",$cuenta['pnpcon']);
		$sql -> bindparam (":fechacon",$cuenta['fechacon']);
	  	//print_r($sql);
		$sql -> execute();// ejecuta consulta
		return $sql;
	}

protected function inserta_filtroPNP_ODS($cuenta) {// funcion insertar usuario
		$sql=self:: connect_ODBC () -> prepare(
			"INSERT INTO  [PRO_SERVER_COMESA].[dbo].[PSC.Bitacora_ODS](
				[FK_IdRegistro]
                ,[FK_IdODS]
				,[FK_IdUsuario]
                ,[Fecha_ODS]
                ,[FechaActualiza]
			)
			VALUES (
				:fkid,
				:fkods,
				:user,
				:fechaods,
				:fechacon
			)"
		);

		//definir punteros para pasar datos del controlador al modelo
		$sql -> bindparam (":fkid",$cuenta['pkid']);
		$sql -> bindparam (":fkods",$cuenta['idODS']);
		$sql -> bindparam (":user",$cuenta['id_u']);
		$sql -> bindparam (":fechaods",$cuenta['fechaods']);
		$sql -> bindparam (":fechacon",$cuenta['fechacon']);
	  	print_r($sql);
		$sql -> execute();// ejecuta consulta
		return $sql;
	}



	protected function upd_DP ($cuenta) { // funcion actualiza usuario
		$sql=self:: connect_ODBC () -> prepare(
			"UPDATE [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]
			SET
			[FK_IdEstado]=:luna
			,[FK_IdEsquema]=:esquema
			,[FK_IdSexo]=:sexo
			,[FK_IdEstado_Civil]=:estadoC
			,[FK_IdNacionalidad]=:naci
			,[FK_IdPuesto]=:puest
      ,[FK_IdCP]=:colo
			,[Apellido_Paterno]=:apa
			,[Apellido_Materno]=:ama
			,[Nombre]=:nombre
			,[Nombre_Completo]=:nomco
			,[Edad]=:edad
			,[Mail]=:mail
			,[Fecha_Nacimiento]=:fechaN
			--,[Lugar_Nacimiento]=:luna
			,[Calle]=:calle
			,[Numero_Ext]=:numext
			,[Numero_Int]=:numint
			--,[Municipio]=:muni
			--,[Colonia]=:colo
			,[CP]=:postal
			,[RFC]=:rfc
			,[CURP]=:curp
			,[NSS]=:nss
			,[Numero_Telefono]=:tel
            ,[Contacto]=:contacto
            ,[Contacto_Telefono]=:telcon
			,[Fecha_Actualiza]=:fechaA
			WHERE [PK_IdRegistro]=:id"
		);
		$sql -> bindparam (":id",$cuenta['id']);
		//$sql -> bindparam (":estado",$cuenta['estado']);
		$sql -> bindparam (":esquema",$cuenta['esquema']);
		$sql -> bindparam (":sexo",$cuenta['sexo']);
		$sql -> bindparam (":estadoC",$cuenta['estadoC']);
		$sql -> bindparam (":naci",$cuenta['naci']);

		$sql -> bindparam (":apa",$cuenta['apa']);
		$sql -> bindparam (":ama",$cuenta['ama']);
		$sql -> bindparam (":nombre",$cuenta['nombre']);
		$sql -> bindparam (":nomco",$cuenta['nomco']);
		$sql -> bindparam (":edad",$cuenta['edad']);
		$sql -> bindparam (":mail",$cuenta['mail']);
		$sql -> bindparam (":fechaN",$cuenta['fechaN']);
		$sql -> bindparam (":luna",$cuenta['estado']);
		$sql -> bindparam (":calle",$cuenta['calle']);
		$sql -> bindparam (":numext",$cuenta['numext']);
		$sql -> bindparam (":numint",$cuenta['numint']);
		//$sql -> bindparam (":muni",$cuenta['muni']);
		$sql -> bindparam (":colo",$cuenta['colo']);
		$sql -> bindparam (":postal",$cuenta['postal']);
		$sql -> bindparam (":rfc",$cuenta['rfc']);
		$sql -> bindparam (":curp",$cuenta['curp']);
		$sql -> bindparam (":nss",$cuenta['nss']);
		$sql -> bindparam (":tel",$cuenta['tel']);
		$sql -> bindparam (":puest",$cuenta['puest']);
		$sql -> bindparam (":contacto",$cuenta['contacto']);
		$sql -> bindparam (":telcon",$cuenta['telcon']);
		$sql -> bindparam (":fechaA",$cuenta['fechaA']);

		$sql -> execute();
		// print_r($sql);
		return $sql;
	}



	protected function upd_Filtro ($cuenta) { // funcion actualiza usuario
		$sql=self:: connect_ODBC () -> prepare(
			"UPDATE [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]
			SET

			[FK_IdFiltro]=:filtroid
			,[FK_IdPuesto]=:puesto
			,[Apellido_Paterno]=:apa
			,[Apellido_Materno]=:ama
			,[Nombre]=:nombre
			,[Nombre_Completo]=:nomco
			,[CURP]=:curp
		    ,[Filtro]=:filtro
			,[Fecha_Actualiza]=:fechaA
			WHERE [PK_IdRegistro]=:id"
		);
		$sql -> bindparam (":id",$cuenta['id']);
		$sql -> bindparam (":filtroid",$cuenta['filtroid']);
		$sql -> bindparam (":puesto",$cuenta['puesto']);
		$sql -> bindparam (":apa",$cuenta['apa']);
		$sql -> bindparam (":ama",$cuenta['ama']);
		$sql -> bindparam (":nombre",$cuenta['nombre']);
		$sql -> bindparam (":nomco",$cuenta['nomco']);
		$sql -> bindparam (":curp",$cuenta['curp']);

		$sql -> bindparam (":filtro",$cuenta['filtro']);
		$sql -> bindparam (":fechaA",$cuenta['fechaA']);

		$sql -> execute();
		//print_r($sql);
		return $sql;
	}

		protected function upd_Filtro_ODS ($cuenta) { // funcion actualiza usuario
		$sql=self:: connect_ODBC () -> prepare(
			"UPDATE [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]
			SET

			[FK_IdFiltro]=:filtroid
			,[FK_IdPuesto]=:puesto
			,[Apellido_Paterno]=:apa
			,[Apellido_Materno]=:ama
			,[Nombre]=:nombre
			,[Nombre_Completo]=:nomco
			,[CURP]=:curp
		     ,[Filtro]=:filtro
			 ,[Captura_Pnp]=:capnp
			,[Fecha_Actualiza]=:fechaA
			WHERE [PK_IdRegistro]=:id"
		);
		$sql -> bindparam (":id",$cuenta['id']);
		$sql -> bindparam (":filtroid",$cuenta['filtroid']);
		$sql -> bindparam (":puesto",$cuenta['puesto']);
		$sql -> bindparam (":apa",$cuenta['apa']);
		$sql -> bindparam (":ama",$cuenta['ama']);
		$sql -> bindparam (":nombre",$cuenta['nombre']);
		$sql -> bindparam (":nomco",$cuenta['nomco']);
		$sql -> bindparam (":curp",$cuenta['curp']);
        $sql -> bindparam (":capnp",$cuenta['capnp']);
		$sql -> bindparam (":filtro",$cuenta['filtro']);
		$sql -> bindparam (":fechaA",$cuenta['fechaA']);

		$sql -> execute();
		//print_r($sql);
		return $sql;
	}

	protected function insert_ODS ($cuenta) { // funcion actualiza usuario
		$sql=self:: connect_ODBC () -> prepare(
			"INSERT [PRO_SERVER_COMESA].[dbo].[PSC.ODS]
			(
				[PK_IdODS]
				,[FK_IdFrente]
				,[FK_IdDireccionR]
				,[Numero_Comesa]
				,[ODS_Comesa]
				,[Estatus]
				,[Fecha_Inicio]
				,[Fecha_Fin]
				,[FechaActualiza]
			)
			VALUES (
				:pkid,
				:idfrente,
                :direq,
				:numcome,
				:ods,
				:estatus,
				:q,
				:r,
				:fecha
			)"
		);
		$sql -> bindparam (":pkid",$cuenta['pkid']);
		$sql -> bindparam (":idfrente",$cuenta['fre']);
		$sql -> bindparam (":numcome",$cuenta['numco']);
		$sql -> bindparam (":ods",$cuenta['ods']);
		$sql -> bindparam (":direq",$cuenta['direq']);
		$sql -> bindparam (":estatus",$cuenta['estatus']);
		$sql -> bindparam (":q",$cuenta['q']);
		$sql -> bindparam (":r",$cuenta['r']);
		$sql -> bindparam (":fecha",$cuenta['fechacon']);

		$sql -> execute();
		//print_r($sql);
		return $sql;
	}

	protected function upd_DB ($cuenta) {
		$sql=self:: connect_ODBC() -> prepare(
			"UPDATE [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDB]
			SET
			[FK_IdInfonavit]=:info
			,[FK_IdBanco]=:banco
			,[Clabe]=:clabeI
			,[Num_Inf]=:numeroI
			,[Tipo_Inf]=:tipoC
			,[Valor_inf]=:valorTI
			,[Fecha_Actualiza]=:fechaA
			WHERE [FK_IdRegistro]=:id"
		);

		$sql -> bindparam (":id",$cuenta['id']);
		$sql -> bindparam (":info",$cuenta['info']);
		$sql -> bindparam (":banco",$cuenta['banco']);
		$sql -> bindparam (":clabeI",$cuenta['clabeI']);
		$sql -> bindparam (":numeroI",$cuenta['numeroI']);
		$sql -> bindparam (":tipoC",$cuenta['tipoC']);
		$sql -> bindparam (":valorTI",$cuenta['valorTI']);
		$sql -> bindparam (":fechaA",$cuenta['fechaA']);

		$sql -> execute();
		print_r($sql);
		return $sql;
	}

	protected function upd_DB2 ($cuenta) {
		$sql=self:: connect_ODBC() -> prepare(
			"UPDATE [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDB]
			SET
			[FK_IdInfonavit]=:info
			,[Banco]=:banco
			,[Clabe]=:clabeI
			,[Num_Inf]=:numeroI
			,[Tipo_Inf]=:tipoC
			,[Valor_inf]=:valorTI
			,[Fecha_Actualiza]=:fechaA
			WHERE [FK_IdRegistro]=:id"
		);

		$sql -> bindparam (":id",$cuenta['id']);
		$sql -> bindparam (":info",$cuenta['info']);
		$sql -> bindparam (":banco",$cuenta['banco']);
		$sql -> bindparam (":clabeI",$cuenta['clabeI']);
		$sql -> bindparam (":numeroI",$cuenta['numeroI']);
		$sql -> bindparam (":tipoC",$cuenta['tipoC']);
		$sql -> bindparam (":valorTI",$cuenta['valorTI']);
		$sql -> bindparam (":fechaA",$cuenta['fechaA']);

		$sql -> execute();

		return $sql;
	}

    protected function inserta_registroCT ($cuenta) {// funcion insertar usuario
      $sql=self:: connect_ODBC () -> prepare("
        INSERT INTO [PRO_SERVER_COMESA].[dbo].[PSC.Costo_Traslado](
       [FK_IdRegistro]
      ,[Origen]
      ,[Destinos]
      ,[Costo]
	  ,[Fecha_Viaje]
	  ,[FechaActualiza]
        )
        VALUES (
          :fkidR,
		  :origen,
		  :destino,
          :costo,
		  :fechaV,
		  :fechaA
        )
      ");
      //definir punteros para pasar datos del controlador al modelo
      $sql -> bindparam (":fkidR",$cuenta['fkidR']);
	  $sql -> bindparam (":origen",$cuenta['origen']);
	  $sql -> bindparam (":destino",$cuenta['destino']);
      $sql -> bindparam (":costo",$cuenta['costo']);
	  $sql -> bindparam (":fechaV",$cuenta['fechaV']);
	  $sql -> bindparam (":fechaA",$cuenta['fechaA']);

      //print_r($sql);
      $sql -> execute();// ejecuta consulta
      return $sql;
    }

	protected function inserta_registroDB ($cuenta) {
		$sql=self:: connect_ODBC () -> prepare(
			"
			INSERT INTO
			[PRO_SERVER_COMESA].[dbo].[PSC.RegistroDB]
			(
			[FK_IdRegistro]
			,[FK_IdInfonavit]
			,[FK_IdBanco]
			,[cuenta]
			,[Clabe]
			,[Num_Inf]
			,[Tipo_Inf]
			,[Valor_inf]
			)
			VALUES (
			:pkid,
			:info,
			:banco,
			:cuenta,
			:clabeI,
			:numinf,
			:tipoinf,
			:valorinf
			)
		   ");
			$sql -> bindparam (":pkid",$cuenta['pkid']);
			$sql -> bindparam (":info",$cuenta['info']);
			$sql -> bindparam (":banco",$cuenta['banco']);
			$sql -> bindparam (":cuenta",$cuenta['cuenta']);
			$sql -> bindparam (":clabeI",$cuenta['clabeI']);
			$sql -> bindparam (":numinf",$cuenta['numeroI']);
			$sql -> bindparam (":tipoinf",$cuenta['tipoC']);
			$sql -> bindparam (":valorinf",$cuenta['valorTI']);

			$sql -> execute();
			print_r($sql);
			return $sql;
	}

	  protected function inserta_asistencia ($cuenta)
	  {
		 $sql=self:: connect_ODBC () -> prepare(
		  "
		   INSERT INTO
         [PRO_SERVER_COMESA].[dbo].[PSC.Registro_Asistencia]
         ([FK_IdUsuario],[FK_IdTipoAsistencia],[Fecha_Asistencia],[Fecha_c],[Hora_1],[FechaActualiza],[Rowid])
		  VALUES (:id,:evento,:fecha,:fechac,:hora,:fechaact,:rowid)
		   ");

		  $sql -> bindparam (":id",$cuenta['id']);
		  $sql -> bindparam (":evento",$cuenta['evento']);
		  $sql -> bindparam (":fecha",$cuenta['fecha']);
		  $sql -> bindparam (":fechac",$cuenta['fecha_c']);
		  $sql -> bindparam (":hora",$cuenta['hora']);
		  $sql -> bindparam (":fechaact",$cuenta['fechaact']);
		  $sql -> bindparam (":rowid",$cuenta['rowid']);
		  $sql -> execute();
		  return $sql;
	  }

	  protected function inserta_ayuda ($cuenta)
	  {
		 $sql=self:: connect_ODBC () -> prepare(
		  "INSERT INTO [PRO_SERVER_COMESA].[dbo].[PSC.Registro_Ayuda]
		  ([FK_IdUsuario],[Nombre_us],[Correo_us],[Telefono_us],[Nota],[FechaActualiza],[Rowid])
		  VALUES
		  (:fkid,:nombre,:email,:tel,:ayuda,:fechaact,:rowid)
		   ");

		  $sql -> bindparam (":fkid",$cuenta['fkid']);
		  $sql -> bindparam (":nombre",$cuenta['nombre']);
		  $sql -> bindparam (":email",$cuenta['email']);
		  $sql -> bindparam (":tel",$cuenta['tel']);
		  $sql -> bindparam (":ayuda",$cuenta['ayuda']);
		  $sql -> bindparam (":fechaact",$cuenta['fechaact']);
		  $sql -> bindparam (":rowid",$cuenta['rowid']);
		  $sql -> execute();
		// print_r($sql);
		  return $sql;
	  }

	  // inserta QR
	    protected function inserta_QR ($cuenta)
	  {
		 $sql=self:: connect_ODBC () -> prepare(
		  "
		   INSERT INTO
         [PRO_SERVER_COMESA].[dbo].[PSC.validacionQR]
         (
	   [FK_IdUsuario]
      ,[FK_IdTipoDocumento]
      ,[nombre_codigo]
      ,[ruta]
      ,[FechaActualiza]
		 )
		  VALUES (:usuario,:documento,:cod,:ruta,:fechaact)
		   ");

		  $sql -> bindparam (":usuario",$cuenta['usuario']);
		  $sql -> bindparam (":documento",$cuenta['documento']);
		  $sql -> bindparam (":ruta",$cuenta['ruta']);
		  $sql -> bindparam (":cod",$cuenta['cod']);
		  $sql -> bindparam (":fechaact",$cuenta['fechaact']);
		  $sql -> execute();
		  return $sql;
		  print_r($sql);
	  }

	  	  //Insertar reporte

	  	  protected function inserta_reporte_model($reporte)
	  {
		 $sql=self:: connect_ODBC () -> prepare(
		  "
		   INSERT INTO [PRO_SERVER_COMESA].[dbo].[PSC.Reportes]
         ([FK_IdTipoReporte]
	  ,[FK_IdProyecto]
      ,[FK_IdEsquema]
      ,[FK_IdNomina]
      ,[FK_IdMes]
      ,[FK_IdPeriodo]
	  ,[FK_IdUsuario]
      ,[Nombre_Reporte]
      ,[Doc_Ruta]
      ,[Nombre_Doc]
      ,[Estatus]
	  ,[Descripcion]
      ,[FechaActualiza])
	   VALUES
	   ( :tipor,:pro, :esqr, :nomina, :mes, :peri, :fkid, :nombre, :docruta, :nombrec, :estatus, :decri, :fecha )");

		  $sql -> bindparam (":tipor",$reporte['tipor']);
		  $sql -> bindparam (":pro",$reporte['pro']);
		  $sql -> bindparam (":esqr",$reporte['esqr']);
		  $sql -> bindparam (":nomina",$reporte['nomina']);
		  $sql -> bindparam (":mes",$reporte['mes']);
		  $sql -> bindparam (":peri",$reporte['peri']);
		  $sql -> bindparam (":fkid",$reporte['fkid']);
		  $sql -> bindparam (":nombre",$reporte['nombre']);
		   $sql -> bindparam (":docruta",$reporte['docruta']);
		  $sql -> bindparam (":nombrec",$reporte['nombrec']);
		  $sql -> bindparam (":estatus",$reporte['estatus']);
		   $sql -> bindparam (":decri",$reporte['decri']);
		   $sql -> bindparam (":fecha",$reporte['fecha']);
		  $sql -> execute();
		//print_r($sql);
		  return $sql;
	  }

	 protected function upd_pass ($cuenta) // funcion actualiza usuario
	  {
		 $sql=self:: connect_ODBC () -> prepare(


		  "UPDATE [PRO_SERVER_COMESA].[dbo].[PSC.Usuario]
		   SET [Mail]=:correo
			WHERE PK_IdUsuario=:idU
		   ");
		  $sql -> bindparam (":idU",$cuenta['idu']);
		  $sql -> bindparam (":correo",$cuenta['correo']);
		  $sql -> execute();
		print_r($sql);
		  return $sql;
	  }

	  public static function passencrypt($string)
	  {
		  $output=FALSE;
		  $key=hash ('sha256', SECRET_KEY);
		  $iv=substr(hash('sha256', SECRET_IV), 0, 16);
		  $output=openssl_encrypt($string,METHOD, $key, 0, $iv);
		  $output=base64_encode($output);
		  return $output;
	  }

	  public static function passdecryption ($string)
	  {
		  $key=hash ('sha256', SECRET_KEY);
		  $iv= substr (hash ('sha256', SECRET_IV), 0, 16);
		  $output = openssl_decrypt (base64_decode($string), METHOD, $key, 0 , $iv);// devolver valor desencriptado
		  return $output;
	  }

	  protected function  generator_PK($word, $widht, $num)
	  {
		  for($i=001; $i<= $widht; $i++)
		  {
			  $numero = rand (0, 9);
			  $word.= $numero;
		  }

		  return $word."".$num;
	  }

	  protected function clean_string($cadena)
	  {
		  $cadena = trim ($cadena);
		  $cadena= stripslashes ($cadena);
		  $cadena = str_ireplace ('<script>', '', $cadena); // remover javascript
		  $cadena = str_ireplace ('</script>', '', $cadena); // remover javascript
		  $cadena = str_ireplace ('<script src>', '', $cadena); // remover javascript
		  $cadena = str_ireplace ('<script type=>', '', $cadena); // remover javascript
		  $cadena = str_ireplace ('SELECT * FROM', '', $cadena); // Remover SQL

		  return $cadena;
	  }
	  protected function  bitacora_evento($cuenta){
		  $sql= self :: connect_ODBC()-> prepare
		                         ("INSERT INTO [PRO_SERVER_COMESA].[dbo].[PSC.Bitacora_Evento]
		                           ([Nombre],[Clave],[Cve_Usuario],[Hora_Inicio],[Hora_Final],[FechaActualiza])
		                            VALUES(:nombitacora,:clave,:cvuser,:hinicio,:hfinal,:factualiza)");

		  $sql -> bindparam (":nombitacora",$cuenta['nbitacora']);
		  $sql -> bindparam (":clave",$cuenta['clave']);
		  $sql -> bindparam (":cvuser",$cuenta['cuser']);
		  $sql -> bindparam (":hinicio",$cuenta['hinicio']);
		  $sql -> bindparam (":hfinal",$cuenta['hfinal']);
		  $sql -> bindparam (":factualiza",$cuenta['factualiza']);
		  $sql -> execute();// ejecuta consulta
		  return $sql;

	  }

	  protected function bitacora_update($clave,$hora)
	  {
		  $sql= self :: connect_ODBC()-> prepare ("Update [PRO_SERVER_COMESA].[dbo].[PSC.Bitacora_Evento]
		                                           set [Hora_Final] = :hora
												   where [Clave] = :clave ");
			$sql -> bindparam (":hora",$hora);
	        $sql -> bindparam (":clave",$clave);
			$sql -> execute();

		      return $sql;

	  }

	  protected function bitacora_delete($codigo)
	  {
		    $sql= self :: connect_ODBC()-> prepare (" Delete [PRO_SERVER_COMESA].[dbo].[PSC.Bitacora_Evento] Where
			                                         [Cve_Usuario] =:cve_codigo");
				 $sql -> bindparam (":cve_codigo",$codigo);
				 $sql -> execute();// ejecuta consulta
		         return $sql;
	  }

	  protected function sweet_alert($datos) {
      if ($datos['Alerta']=="basic") {
        $alerta="
          <script>
            swal (
              '".$datos['Titulo']."',
              '".$datos['Texto']."',
              '".$datos['Tipo']."'
            );
          </script>
        ";
      }
		  elseif ($datos['Alerta']=="recarga") {
        $alerta="
          <script>
            swal ({
              title:  '".$datos['Titulo']."',
              text: '".$datos['Texto']."',
              type: '".$datos['Tipo']."',
              confirmButtonText: 'Aceptar'
            }).then(
              function() {
                location.reload();
              }
            );
          </script>
        ";
      }
      elseif($datos['Alerta']=="clean") {
        $alerta="
          <script>
            swal ({
              title:'".$datos['Titulo']."',
              text: '".$datos['Texto']."',
              type: '".$datos['Tipo']."',
				      confirmButtonText: 'Aceptar'
	          }).then(function() {
              $('.FormularioAjax')[0].reset();
		        });
          </script>
        ";
      }
		  return $alerta;
	  }

    public function paginate($reload, $page, $tpages, $adjacents) {
      $prevlabel = "&lsaquo; Anterior";
      $nextlabel = "Siguiente &rsaquo;";
      $out = '<ul class="pagination pagination-large">';

      // etiqueta anterior
      if($page==1) {
        $out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
      }
      else if($page==2) {
        $out.= "<li><span><a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a></span></li>";
      }else {
        $out.= "<li><span><a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a></span></li>";
      }

      // inicio
      if($page>($adjacents+1)) {
        $out.= "<li><a href='javascript:void(0);' onclick='load(1)'>1</a></li>";
      }
      // rango
      if($page>($adjacents+2)) {
        $out.= "<li><a>...</a></li>";
      }
      // paginas

      $pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
      $pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
      for($i=$pmin; $i<=$pmax; $i++) {
        if($i==$page) {
          $out.= "<li class='active'><a>$i</a></li>";
        }else if($i==1) {
          $out.= "<li><a href='javascript:void(0);' onclick='load(1)'>$i</a></li>";
        }else {
          $out.= "<li><a href='javascript:void(0);' onclick='load(".$i.")'>$i</a></li>";
        }
      }

      // rango
      if($page<($tpages-$adjacents-1)) {
        $out.= "<li><a>...</a></li>";
      }

      // ultimo registro
      if($page<($tpages-$adjacents)) {
        $out.= "<li><a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a></li>";
      }

      // siguiente
      if($page<$tpages) {
        $out.= "<li><span><a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a></span></li>";
      }else {
        $out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
      }
      $out.= "</ul>";
      return $out;
    }
  }
