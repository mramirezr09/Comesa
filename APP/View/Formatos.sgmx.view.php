<body>
<!--<script src="<?php echo SRVURL; ?>Script/js/funcion.Jquery.close.js"></script>-->
<?php
$id_u=$_SESSION['id_sgmx'];
$tabla="";
//require_once('../../Script/core/Globalcfg.php"');
//require('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
$tabla='<div class="right_col" role="main"><!-- page content -->
<div class="">
<div class="page-title">
<div class="clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12">

<div class="x_panel">
<div class="x_title">

<h3>Mis documentos </h3>
<ul class="nav navbar-right panel_toolbox">
<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
</li>
<li><a class="close-link"><i class="fa fa-close"></i></a>
</li>
</ul>
<div class="clearfix"></div></div>';

	$con = sqlsrv_connect(SERVER,CONNINF);






$tabla.='
        
		 <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">Documentos disponibles</h3>
      </div>
      <div class="panel-body">
	  
	  <table class="table">
  <thead>
    <tr>
       <th width="7%">ID</th>
      <th width="15%">Documento</th>
      <th width="45%">Nombre</th>
	  <th width="10%">Fecha</th>
      <th width="13%">Descargar</th>
    </tr>
  </thead>
  <tbody>';
  
   $resultComen = sqlsrv_query($con,"SELECT 
									  t1.PK_IdDocumento AS ID,
									  t2.Nombre AS Tipo_Doc,
									  t1.Nombre_Documento AS Documento,
									  t1.Nombre_Doc as Nombres,
									  t1.Doc_Ruta AS Ruta,
									  CONVERT(varchar,t1.FechaActualiza,106) AS Fecha
									  FROM [PSA.Documetacion]t1
									  INNER JOIN  [PSA.Tipo_Documento]t2 ON t2.PK_IdTipoDocumento=t1.FK_IdTipoDocumento
									  where t1.Fk_IdUsuario='$id_u'
									  ",
								  PARAMS,OPTION);
				
while($rowComen = sqlsrv_fetch_array($resultComen))
{
	$tabla.='
	
	 <tr>
      <th scope="row">'.$rowComen["ID"].'</th>
      <th scope="row">'.$rowComen["Tipo_Doc"].'</th>
      <td>'.$rowComen["Nombres"].'</td>
	  <td>'.$rowComen["Fecha"].'</td>
      <td><a title="Descargar Archivo" 
	       href="'.SRVURL.$rowComen["Ruta"].$rowComen["Documento"].'" download="'.$rowComen["Documento"].'"
		  style="color: blue; font-size:18px;"> <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> </a></td>
    </tr>';
	
	 }
 sqlsrv_free_stmt($resultComen);
 
 $tabla.=' </tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>';

echo $tabla;

return $tabla;
?>
</body>
	
