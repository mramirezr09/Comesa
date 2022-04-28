<?php
  require('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
  session_start(array('name'=>'SGMX'));
  $id_u=$_SESSION['id_sgmx'];
  $con = sqlsrv_connect(SERVER,CONNINF);
  $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

  $rangoi= $_GET['q'];
  $rangof= $_GET['r'];
  $_SESSION['inicio']=$rangoi;
  $_SESSION['fin']=$rangof;

  if($action == 'ajax') {
    $q =strip_tags($_REQUEST['q'], ENT_QUOTES);
    $r =strip_tags($_REQUEST['r'], ENT_QUOTES);
    $aColumns = array('t1.FK_IdUsuario');
    $sTable = "[dbo].[PSA.Registro_Asistencia]t1";
    $sWhere = "";
    if ( $_GET['q'] != "" && $_GET['r'] != "") {
      $sWhere = " where t1.FK_IdUsuario='$id_u' and CAST(t1.Fecha_Asistencia as date) between '$q' and '$r' group by t1.FK_IdUsuario";
    }
    else {
      $sWhere.=" where t1.FK_IdUsuario='$id_u' group by convert( char(10),t1.Fecha_Asistencia,120 ) ";
    }
    include './funcion.class.sgmx.paginador.php';
    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 15;
    $adjacents  = 4;
    $offset = ($page - 1) * $per_page;

    $sql =  "SELECT count(*) AS numrows FROM $sTable $sWhere ";
    //print_r($sql);
    $count_query= sqlsrv_query($con,$sql,PARAMS,OPTION);
    $row=sqlsrv_num_rows($count_query);
    //print_r($row);
    $numrows = $row;
    $total_pages = ceil($numrows/$per_page);
    $reload = './Controller-Mireporte-gestion.php';

    $query= "SELECT
        t1.PK_IdUsuario AS ID,
        t1.Nombre AS Empleado,
        t2.Nombre AS Perfil,
        t3.Nombre AS Proyecto,
        CONVERT(varchar,t4.Hora_Entrada,8) AS Entrada,
        CONVERT(varchar,t4.Hora_Salida,8) AS Salida,
        t1.Fk_IdPuesto AS Puesto
      FROM [PSA.UsuarioAsistencia]t1
      LEFT JOIN [PSA.Perfil_Usuario]t2 ON t1.FK_IdPerfil=t2.PK_IdPerfil
      LEFT JOIN [PSA.Proyecto]t3 ON t1.FK_IdProyecto=t3.PK_IdProyecto
      LEFT JOIN [PSA.Horario_Empleado]t4 ON t1.FK_IdHorario=t4.PK_IdHorario
      WHERE t1.PK_IdUsuario='$id_u'
    ";
    //print_r($query);
    $query=sqlsrv_query($con,$query,PARAMS,OPTION);

    while ($res=sqlsrv_fetch_array($query)) {
      $entrada=$res['Entrada'];
      $salida=$res['Salida'];
      $userlog=$res['ID'];
    }

    $query1= "SELECT
      t1.FK_IdUsuario as ID,
      convert( char(10),t1.Fecha_Asistencia,120) AS Fecha,
      (t2.Apallido_Paterno+' '+t2.Apallido_Materno+' '+ t2.Nombre) as Nombre,
      t3.Nombre_Puesto as Puesto,
      (select CASE
        WHEN CONVERT(CHAR(5), '$entrada', 108)> = CONVERT(CHAR(5), MIN( t1.Fecha_Asistencia ) , 108) and Hora_1=1
        THEN 'A tiempo'
        WHEN Hora_1<=2
        THEN 'Incapacidad'
        ELSE 'Incidencia'
      END) as 'Estado entrada',
      MIN (CONVERT(CHAR(8), t1.Fecha_Asistencia,108 )) as 'Hora Entrada',
      MAX (CONVERT(CHAR(8), t1.Fecha_Asistencia,108 )) as 'Hora Salida',
      (select CASE
        WHEN  CONVERT(CHAR(5), MAX( t1.Fecha_Asistencia ) , 108) > =CONVERT(CHAR(5), '$salida', 108)
        THEN 'Completada' ELSE 'Incapacidad'
      END) as 'Jornada Total'
      FROM [PSA.Registro_Asistencia] t1
      INNER JOIN [PSA.UsuarioAsistencia]t2 on t2.PK_IdUsuario=t1.FK_IdUsuario
      LEFT JOIN [PSA.Puesto]t3 on t2.FK_IdPuesto=t3.PK_IdPuesto
      $sWhere
        ,convert( char(10),t1.Fecha_Asistencia,120 )
        ,t1.fk_IdUsuario,t3.Nombre_Puesto , t2.nombre, t1.hora_1,t1.fecha_c,  t2.Apallido_Materno, t2.Apallido_Paterno, CAST( t1.Fecha_Asistencia AS DATE )
      order by t1.fecha_c DESC
      OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY
    ";
    //print_r($query1);
    $query1=sqlsrv_query($con,$query1,PARAMS,OPTION);
    if ($numrows>0) {
      ?>
      <table class="table table-striped jambo_table bulk_action">
        <thead>
          <tr class="headings">
            <th class="column-title">ID Usuario </th>
            <th class="column-title">Fecha </th>
            <th class="column-title">Nombre </th>
            <th class="column-title">Puesto </th>
            <th class="column-title">Entrada </th>
            <th class="column-title">Hora Entrada </th>
            <th class="column-title">Hora Salida </th>
            <th class="column-title">Total Jornada </th>
            <th class="column-title no-link last"><span class="nobr"></span></th>
          </tr>
        </thead>
        <tbody>
      <?php

      while ($r=sqlsrv_fetch_array($query1)) {
        $id=$r['ID'];
        $fecha=$r['Fecha'];
        $nombre=$r['Nombre'];
        $puesto=$r['Puesto'];
        $estado=$r['Estado entrada'];
        $horae=$r['Hora Entrada'];
        $horas=$r['Hora Salida'];
        $jornada=$r['Jornada Total'];
      ?>
        <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
        <input type="hidden" value="<?php echo $fecha;?>" id="fecha<?php echo $id;?>">
        <input type="hidden" value="<?php echo $nombre;?>" id="nombre<?php echo $id;?>">
        <input type="hidden" value="<?php echo $puesto;?>" id="puesto<?php echo $id;?>">
        <input type="hidden" value="<?php echo $estado;?>" id="estado<?php echo $id;?>">
        <input type="hidden" value="<?php echo $horae;?>" id="horae<?php echo $id;?>">
        <input type="hidden" value="<?php echo $horas;?>" id="horas<?php echo $id;?>">
        <input type="hidden" value="<?php echo $jornada;?>" id="jornada<?php echo $id;?>">

        <tr class="even pointer">
          <td><?php echo $id;?></td>
          <td><?php echo $fecha; ?></td>
          <td><?php echo utf8_encode($nombre); ?></td>
          <td><?php echo $puesto;?></td>
          <?php
          switch ($estado) {
            case 'Falta'  : $color = 'red'; break;
            case 'Retardo' : $color = '#dd4b39'; break;
            case 'A tiempo'  : $color = '#00a65a'; break;
            case 'Incapacidad'  : $color = '#F7CC0D'; break;
          }
          switch ($estado) {
            case 'Incapacidad'  : $colorl = '#F9FFF4'; break;
            case 'Retardo' : $colorl = '#fff'; break;
            case 'Baja'  : $colorl = '#F9FFF4'; break;
            case 'A tiempo': $colorl = '#fff'; break;
          }
          ?>
          <td style = "background-color: <?php echo $color ?>; color: <?php echo $colorl ?>;"><center><strong><?php echo $estado;?></strong></center></td>
          <td><?php echo $horae;?></td>
          <td><?php echo $horas;?></td>
          <td><?php echo $jornada;?></td>
          <td><span class="pull-right"></td>
        </tr>
      <?php
      } //en while
      ?>
        <tr>
          <td colspan=6>
            <span class="pull-right">
              <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
            </span>
          </td>
        </tr>
      </table>
    </div>
    <?php
    }
    else{
    ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Aviso!</strong> No hay datos para mostrar!<!--No hay datos para mostrar!-->
    </div>
    <?php
    }
  }
