<?php
require('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
require('../../Script/core/Globalcfg.php');

session_start(array('name'=>'SGMX'));
$id_u=$_SESSION['id_sgmx'];
	$tabla = '';
	$con = sqlsrv_connect(SERVER,CONNINF);
	$action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';   
	
	
	if ($action=='ajax')
	{
           $q =strip_tags($_REQUEST['q'], ENT_QUOTES);

		   
         $aColumns = array('t1.FK_IdPeriodorecibo');
         $sTable = "[dbo].[PSA.Recibos]t1";
		 $combo= array($q);
         $sWhere = "";
        if ( $_GET['q'] != "")
        {
            $sWhere = "WHERE (t1.FK_IdUsuario='$id_u' AND ";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
				
                $sWhere .= $aColumns[$i]." = '".$combo[$i]."' AND ";
				
            }
            $sWhere = substr_replace( $sWhere, '', -4 );
            $sWhere .= ')';
			
		}
        else
		{
		$sWhere.="where t1.FK_IdUsuario='$id_u' ";
		}
   $sWhere.=" group by t1.Pk_IdRecibo";
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
		$reload = './Controller-EstadoMoviAfili.php';	
		//print_r($row);
		
  
  $sql="SELECT 
									  t1.[PK_IdRecibo] AS ID,
									  
									  t5.Nombre as Unidad,
									  t2.Nombre AS Tipo_Doc,
									  t1.Nombre_Doc As Nombre_docu,
									  (t3.Apallido_Paterno+' '+t3.Apallido_Materno+' '+t3.Nombre) AS Usuario,
									  t1.[Nombre_Recibo] AS Documento,
									  t4.Nombre as 'Periodo',
									  t1.Doc_Ruta AS Ruta
									  FROM [PSA.Recibos]t1
									  INNER JOIN  [PSA.Tipo_Documento]t2 ON t2.PK_IdTipoDocumento=t1.FK_IdTipoDocumento
									  INNER JOIN [PSA.UsuarioAsistencia]t3 ON t1.Fk_IdUsuario=t3.PK_IdUsuario
									  LEFT JOIN [PSA.Periodo_Recibo]t4 on t1.FK_IdPeriodoRecibo=t4.Pk_IdPeriodoRecibo
									  LEFT JOIN [PSA.Proyecto]t5 on t3.FK_IdProyecto=t5.PK_IdProyecto
									$sWhere
									,t1.Pk_Idrecibo,
									t1.Nombre_recibo,
									t2.Nombre,
									t5.Nombre,
									t3.Apallido_Paterno,
									t3.Apallido_Materno,
									t3.Nombre,
									t1.Nombre_Doc,
								
									t4.Nombre,
									t1.Doc_Ruta
									order by t1.Pk_Idrecibo ASC 
			                        OFFSET $offset ROWS FETCH NEXT  $per_page ROWS ONLY
									";
 //print_r($sql);
                          $sql=sqlsrv_query($con,$sql,PARAMS,OPTION);
  
				
        if ($numrows>0){
             
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
					<th class="column-title">N. </th>
					<th class="column-title">Unidad</th>
					<th class="column-title">Periodo</th>
					 <th class="column-title">Usuario </th>
					  <th class="column-title">Tipo Documento </th>                                      
						<th class="column-title">Nombre</th> 
               


     
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				       $cont=1;
                        while ($res=sqlsrv_fetch_array($sql)) {
							 
						    $id=$cont++;
                            $rep=utf8_encode ($res['Unidad']);
						    $peri=utf8_encode ($res['Periodo']);
							$user=utf8_encode ($res['Usuario']);
							$esq=utf8_encode ($res['Tipo_Doc']);
							$doc=utf8_encode ($res['Nombre_docu']);
						


                ?>
            
                    <tr class="even pointer">
                        <td><?php echo $id;?></td>
                        <td><?php echo $rep;?></td>
                        <td><?php echo $peri; ?></td>
			            <td><?php echo $user;?></td>
                        <td><?php echo $esq; ?></td>
                        <td><?php echo $doc;?></td>
                        
						
                        <td ><span class="pull-right">
					    
						 <a href="<?php echo SRVURL.$res["Ruta"].$res["Documento"]?>"  download="<?php echo $res["Documento"] ?>" class='btn btn-default' title='Descargar Archivo'>
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