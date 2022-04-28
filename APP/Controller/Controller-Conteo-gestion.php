       
<?php

session_start(array('name'=>'SGMX'));
$id_u=$_SESSION['id_sgmx'];
  require('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
  require('../../Script/core/Globalcfg.php"');
    $con = sqlsrv_connect(SERVER,CONNINF);
   $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';  

  // $rangoi= $_GET['q'];
	//$rangof= $_GET['r'];
	//$_SESSION['inicio']=$rangoi;
	//$_SESSION['fin']=$rangof;   

    if($action == 'ajax')
	{
      
           $q =strip_tags($_REQUEST['q'], ENT_QUOTES);
		  // $r =strip_tags($_REQUEST['r'], ENT_QUOTES);
         $aColumns = array('t1.FK_IdReingreso');
         $sTable = "[dbo].[PSC.RegistroDP]t1";
         $sWhere = "";
        if ( $_GET['q'] != "")
        {
            $sWhere = " where t1.FK_IdReingreso=1 and CAST(t1.Fecha_Contratacion as date)='$q'";
		}
        else
		{
		$sWhere.=" where t1.FK_IdReingreso=1 ";
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
        
	   
		  $query1= "  
					select t2.Nombre_Puesto,
					t3.Nombre_Fase,
					count(t1.FK_IdPuesto)as Total 

					from [PSC.RegistroDP]t1
					LEFT JOIN  [PSC.Puesto]t2 ON t1.FK_IdPuesto=t2.PK_IdPuesto 
					LEFT JOIN [PSC.Fase_Puesto]t3 on t2.FK_IdFase=t3.PK_IdFase		  
		  
				 $sWhere 
				group by t1.FK_IdPuesto , t2.Nombre_Puesto,t3.Nombre_Fase
				order by Total DESC
				OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY";
       
	   //print_r($query1);
       $query1=sqlsrv_query($con,$query1,PARAMS,OPTION);
	
       
        if ($numrows>0){
             
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">Nombre de Puesto </th>
                        <th class="column-title">Nombre de Fase </th>
                        <th class="column-title">Total </th>
           
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				
                        while ($r=sqlsrv_fetch_array($query1)) 
						{
							 
						$np=$r['Nombre_Puesto'];
                            $nf=$r['Nombre_Fase'];
                            $total=$r['Total'];
                           

                ?>
                     
                    <tr class="even pointer">
                    
                        <td><?php echo utf8_encode($np);?></td>
                        <td><?php echo utf8_encode($nf); ?></td>
                        <td><?php echo $total;?></td>
                        <td ><span class="pull-right">
                        
                    </tr>
                <?php
                    } //en while
                ?>
                <tr>
                    <td colspan=6><span class="pull-right">
                        <?php echo paginate($reload, $page, $total_pages, $adjacents);?>
                    </span></td>
                </tr>
              </table>
            </div>
			 <div class="col-md-6 col-sm-9 col-xs-12 col-md-offset-5">
			            <a href="<?php echo SRVURL.'ReporteConteo?q='.$q ?>" class='btn btn-success' title='Generar Reporte'>
								<i class="fa fa-file"></i>
							 Genera Excel</a> 
							 </div>
			  <br>
			  <br>
			  <br>
			  <br>
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