<?php
  require('../../Script/core/Globalcfg.php"');
  session_start(array('name'=>'SGMX'));
  $id_u=$_SESSION['id_sgmx'];
  require('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
  $con = sqlsrv_connect(SERVER,CONNINF);
  $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

  $rangoi= $_GET['q'];

  if($action == 'ajax') {
    $q =strip_tags($_REQUEST['q'], ENT_QUOTES);
    $sTable = "[dbo].[PSC.ODS]t1";
    $sWhere = "";
    if ( $_GET['q'] != "") {
      $sWhere ="WHERE  t1.[ODS_Comesa] LIKE '%".$q."%' OR t2.[Nombre_Frente] LIKE '%".$q."%'";
    }
    else {
    $sWhere ="";
  }
  include './funcion.class.sgmx.paginador.php';
  $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
  $per_page = 15;
  $adjacents  = 4;
  $offset = ($page - 1) * $per_page;
  $sql =  "SELECT
      count(*) AS numrows
    FROM $sTable
    inner join [dbo].[PSC.Frente]t2 on t2.PK_IdFrente = t1.FK_Idfrente
    $sWhere group by t1.ODS_Comesa";
	// print_r($sql);
  $count_query= sqlsrv_query($con,$sql,PARAMS,OPTION);
  $row=sqlsrv_num_rows($count_query);
  //print_r($row);
  $numrows = $row;
  $total_pages = ceil($numrows/$per_page);
  $reload = './Controller-consultaODS.php';

  $query1= "SELECT
    t1.[PK_IdODS] as 'ID'
	,t2.Nombre_Frente as 'Nombre_Frente'
    ,t1.[ODS_Comesa] as 'ODS'
  FROM [PRO_SERVER_COMESA].[dbo].[PSC.ODS]t1
  inner join [dbo].[PSC.Frente]t2 on t2.PK_IdFrente = t1.FK_Idfrente
	$sWhere

  order by t1.ODS_Comesa DESC
  OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY";
  // print_r($query1);
  $query1=sqlsrv_query($con,$query1,PARAMS,OPTION);
  if ($numrows>0) {
  ?>
  <table class="table table-striped jambo_table bulk_action">
    <thead>
      <tr class="headings">
        <th class="column-title">ID Orden</th>
        <th class="column-title">Frente</th>
        <th class="column-title">ODS</th>
        <th class="column-title">Prefactura</th>
        <th class="column-title no-link last"><span class="nobr"></span></th>
      </tr>
    </thead>
    <tbody>
      <?php
        while ($r=sqlsrv_fetch_array($query1)) {
          $id=$r['ID'];
          $frente=$r['Nombre_Frente'];
          $ods=$r['ODS'];
	      ?>
          <tr class="even pointer">
            <td><?php echo $id;?></td><!--  Mau puñetas -->
            <td><?php echo $frente;?></td>
            <td><?php echo $ods;?></td>
			<span class="pull-right">
			<td>
			<a href="<?php echo SRVURL.'Actualizafoto?foto='.$id ?>" class='btn btn-default' title='Actualizar foto'>
								<i class="glyphicon glyphicon-camera"></i>
							</a>
		    </td>
			</span>
          </tr>
            <?php
            } //en while
          ?>
          <tr>
            <td colspan=6><span class="pull-right">
              <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
            </span>
          </td>
        </tr>
      </table>
    </div>
    <?php
  }
  else {
    ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Aviso!</strong> No hay datos para mostrar!<!--No hay datos para mostrar!-->
    </div>
    <?php
  }
}
?>
