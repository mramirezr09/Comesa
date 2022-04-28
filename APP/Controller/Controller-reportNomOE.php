<?php
require('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
require('../../Script/core/Globalcfg.php');
	$tabla = '';
	$con = sqlsrv_connect(SERVER,CONNINF);
	$action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';   
	
	
	if ($action=='ajax')
	{
           $q =strip_tags($_REQUEST['q'], ENT_QUOTES);
		   $r =strip_tags($_REQUEST['r'], ENT_QUOTES);
		   $s =strip_tags($_REQUEST['s'], ENT_QUOTES);
		   $t =strip_tags($_REQUEST['t'], ENT_QUOTES);
		   
		  
		   
         $aColumns = array('t1.FK_IdEsquema','t1.FK_IdNomina','t1.Fk_IdMes','t1.Fk_IdPeriodo');
         $sTable = "[dbo].[PSA.Reportes]t1";
		 $combo= array($q,$r,$s,$t);
         $sWhere = "";
        if ( $_GET['q'] != "" && $_GET['r'] != "" && $_GET['s'] != "" && $_GET['t'] != "")
        {
            $sWhere = "WHERE (t1.FK_IdTipoReporte = 1 AND ";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
				
                $sWhere .= $aColumns[$i]." = '".$combo[$i]."' AND ";
				
            }
            $sWhere = substr_replace( $sWhere, '', -4 );
            $sWhere .= ')';
			
		}
        else
		{
		$sWhere.="where t1.FK_IdTipoReporte = 1 ";
		}
   $sWhere.=" group by t1.Nombre_Reporte";
   include './funcion.class.sgmx.paginador.php'; 
   
       $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; 
        $adjacents  = 4; 
        $offset = ($page - 1) * $per_page;
		
		
	 //Query del conteo de registor*/
     $sql =  "SELECT count(*) AS numrows FROM $sTable $sWhere ";

		$count_query= sqlsrv_query($con,$sql,PARAMS,OPTION); 
        $row=sqlsrv_num_rows($count_query);
        $numrows = $row;
        $total_pages = ceil($numrows/$per_page);
		$reload = './Controller-reportNomOE.php';	
		//print_r($row);
		
  
  $sql="select
									t1.pk_idreporte as ID,
									t2.Nombre as Reporte,
									t1.Nombre_Reporte as 'Nombre del Reporte',
									t7.nombre as Proyecto,
									t3.nombre as 'Tipo Esquema',
									t4.Nombre as 'Mes',
									t5.Nombre as 'Periodo',
									t6.Nombre as 'Tipo Nomina',
									t1.Doc_Ruta,
									t1.Nombre_Doc
									
									from [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Reportes] t1

									Left join [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Tipo_Reporte]t2 on t1.FK_IdTipoReporte = t2.PK_IdTipoReporte
									Left join [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Esquema_Nomina]t3 ON t1.FK_IdEsquema=t3.PK_IdEsquema
									Left join [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Mes_nomina]t4 ON t1.FK_IdMes=t4.PK_IdMes
									Left join [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Periodo_Nomina]t5 ON t1.FK_IdPeriodo=t5.PK_IdPeriodo
									Left join [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Tipo_Nomina]t6 ON t1.FK_IdNomina=t6.PK_IdNomina
									Left join [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Proyecto]t7 ON t1.FK_IdProyecto=t7.PK_IdProyecto
									$sWhere,
									t7.nombre,
									t1.FK_IdTipoReporte,
									t1.pk_idreporte, 
									t2.Nombre, 
									t1.Nombre_Reporte, 
									t1.Doc_Ruta, 
									t1.Nombre_Doc,
									t3.Nombre,
									t4.Nombre,
									t5.Nombre,
									t6.Nombre
									order by t1.FK_IdTipoReporte ASC 
			                        OFFSET $offset ROWS FETCH NEXT  $per_page ROWS ONLY
									";
// print_r($sql);
                          $sql=sqlsrv_query($con,$sql,PARAMS,OPTION);
  
				
        if ($numrows>0){
             
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
					 <th class="column-title">Unidad </th>
                        <th class="column-title">Reporte </th>					
                        <th class="column-title">Nombre Reporte </th>
						<th class="column-title">Tipo Nomina</th> 
                        <th class="column-title">Esquema </th>
                        <th class="column-title">Mes </th>
                         <th class="column-title">Periodo </th> 
                 
     
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				
                        while ($res=sqlsrv_fetch_array($sql)) {
							 
						    $pro=utf8_encode ($res['Proyecto']);
                            $rep=utf8_encode ($res['Reporte']);
							$nrep=utf8_encode ($res['Nombre del Reporte']);
							$nom=utf8_encode ($res['Tipo Nomina']);
							$esq=utf8_encode ($res['Tipo Esquema']);
							$mes=utf8_encode ($res['Mes']);
							$peri=$res['Periodo'];
							$ndoc=utf8_encode ($res['Nombre_Doc']);
							

                ?>
            
                    <tr class="even pointer">
                        <td><?php echo $pro;?></td>
                        <td><?php echo $rep;?></td>
                        <td><?php echo $nrep; ?></td>
			            <td><?php echo $nom;?></td>
                        <td><?php echo $esq; ?></td>
                        <td><?php echo $mes;?></td>
                        <td><?php echo $peri;?></td>
						
                        <td ><span class="pull-right">
					    
						 <a href="<?php echo SRVURL.$res["Doc_Ruta"].$res["Nombre_Doc"]?>"  download="<?php echo $res["Nombre_Doc"] ?>" class='btn btn-default' title='Descargar Archivo'>
                         <i class="glyphicon glyphicon-download-alt"></i>
						 </a> 
					
                    </tr>
                <?php
                    } //en while
                ?>
                <tr>
                    <td colspan=8><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
            </div>
            <?php
        }else{
           ?> 
            <div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Aviso!</strong> No hay datos para mostrar!<!--No hay datos para mostrar!-->
            </div>
        <?php    
        }
}
?>