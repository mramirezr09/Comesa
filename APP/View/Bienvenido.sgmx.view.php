
<?php
  $id_u=$_SESSION['id_sgmx'];
  $conn = sqlsrv_connect(SERVER,CONNINF);

  $query="
  SELECT
  t1.PK_IdUsuario AS ID,
  (t1.Apallido_Paterno+' '+t1.Nombre) AS Empleado,
  t2.Nombre AS Perfil,
  t3.Nombre AS Proyecto,
  CONVERT(varchar,t4.Hora_Entrada,8) AS Entrada,
  CONVERT(varchar,t4.Hora_Salida,8) AS Salida,
  t5.Nombre_Puesto AS Puesto


  FROM [PSA.UsuarioAsistencia]t1
  LEFT JOIN [PSA.Perfil_Usuario]t2 ON t1.FK_IdPerfil=t2.PK_IdPerfil
  LEFT JOIN [PSA.Proyecto]t3 ON t1.FK_IdProyecto=t3.PK_IdProyecto
  LEFT JOIN [PSA.Horario_Empleado]t4 ON t1.FK_IdHorario=t4.PK_IdHorario
  LEFT JOIN [PSA.Puesto]t5 on t1.FK_IdPuesto = t5.PK_IdPuesto
  WHERE t1.PK_IdUsuario='$id_u'";

  $dat= sqlsrv_query($conn,$query,PARAMS,OPTION);
  while ($res = sqlsrv_fetch_array($dat)) {
    $ID=$res['ID'];
    $emp=$res['Empleado'];
    $per=$res['Perfil'];
    $pro=$res['Proyecto'];
    $ent=$res['Entrada'];
    $sal=$res['Salida'];
    $pues=$res['Puesto'];
  }
  /*$dat= sqlsrv_query($conn,$query,PARAMS,OPTION);
  $res= sqlsrv_fetch_array($dat);
  $ID=$res['ID'];*/
  $get_DB = new PDO (SGDB);
  $evento= $get_DB-> query("Select PK_IdRegistro as FK_IdRegistro ,Nombre from [dbo].[PSA.Tipo_Registro]");
  $evento= $evento ->fetchAll();
?>
  <body onLoad="IniciaReloj()">
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">
          <div id="clockdate">
            <div class="clockdate-wrapper">
              <div id="clock"></div>
              <div id="date"></div>
            </div>
          </div>
        </body>
        <!-- content -->
        <br>
        <div class="container" id="advanced-search-form">
          <form action ="<?php echo SRVURL;?>APP/ajax/funcion.class.sgmx.registroajax.php" method = "POST" data-form="save" class="form-label-left input_mask FormularioAjax" autocomplete="off" enctype ="multipart/form-data">
            <div id="result"></div>
            <div>
              <label for="username"><h2>Tarjeta de Asistencia</h2></label>
              <select class="combo-t" name="evento-as" required="" id="evento-as" >
                <option value="" selected>-- Selecciona --</option>
                <?php
                foreach($evento as $e):?>
                <option value="<?php echo $e['FK_IdRegistro']; ?>">
                  <?php echo $e['Nombre']; ?>
                </option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="form-group">
              <label for="Nombre">Id</label>
              <input type="text" class="form-control" name="id-as" value="<?php  echo $ID;?>" readonly>
            </div>
            <div class="form-group">
              <label for="last-name">Nombre</label>
              <input type="text" class="form-control" name="nombre-as"value="<?php echo  utf8_encode($emp);?> " readonly>
            </div>
            <div class="form-group">
              <label for="country">Proyecto</label>
              <input type="text" class="form-control" name="pro-as" value="<?php echo $pro;?> " readonly>
            </div>
            <div class="form-group">
              <label for="number">Puesto</label>
              <input type="text" class="form-control" name="pues-as" value="<?php echo $pues;?> " readonly>
            </div>
            <div class="form-group">
              <label for="age">Hora entrada</label>
              <input type="text" class="form-control" name="entrada-as" value="<?php echo $ent;?> " readonly>
            </div>
            <div class="form-group">
              <label for="email">Hora Salida</label>
              <input type="email" class="form-control" name="salida-as" value="<?php echo $sal;?>" readonly>
            </div>
            <!-- <fieldset>
              <div class="clearfix"></div>
            </fieldset>
            <button type="submit" class="btn btn-success btn-lg btn-responsive" id="search">
              <span class="glyphicon glyphicon-hand-up"></span> Checar
            </button>
            <div class="RespuestaAjax"></div> -->
          </form>
          <br>
          <br>
        </div>
        <div class="clearfix"></div>
        <div class="x_content">
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div><!-- /page content -->
