
       
<?php

session_start(array('name'=>'SCLP'));
  require('../../APP/Controller/funcion.class.sclp.define.BBDD.php');
    $con = sqlsrv_connect(SERVER,CONNINF);
   $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';  

$perfil=$_SESSION['perfil_sclp'];   

    if($action == 'ajax'){
        // pendiente pasar por modelo princiapl
		   $p =strip_tags($_REQUEST['p'], ENT_QUOTES);
           $q =strip_tags($_REQUEST['q'], ENT_QUOTES);
         $aColumns = array('t1.PK_FolioTask','t1.FK_IdEstatus');//Columnas de busqueda
         $sTable = "[dbo].[PSC.SD_TASK]t1";
         $sWhere = "";
		 $sWhere =" where t1.FK_IdEstatus in (1,2,3,4)  and t1.FK_IdPerfil=$perfil";
        if ( $_GET['q'] != "" )
        {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, '', -3 );
            $sWhere .= ' and t1.FK_IdPerfil='.$perfil.' )';
        }
		
		 elseif ( $_GET['p'] != "" )
        {
			if ($_GET['p'] == 8)
			{
				 $sWhere = "WHERE  t1.FK_IdPerfil=$perfil";
			}
			else{
            $sWhere = "WHERE  t1.FK_IdEstatus=$p and t1.FK_IdPerfil=$perfil";
			}
        }
        
		 $sWhere.=" group by Pk_FolioTASK ";
        include './funcion.class.sclp.paginador.php'; //herencia de paginación
        //paginacion variables
     
	    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; //registros por pagina
        $adjacents  = 4; //adyacientes
        $offset = ($page - 1) * $per_page;
		
		
        //realiza el count para la paginacion de resultados*/
		$sql =  "SELECT count(*) AS numrows FROM $sTable $sWhere ";
		//print_r($sql);
		$count_query= sqlsrv_query($con,$sql,PARAMS,OPTION); 
        $row=sqlsrv_num_rows($count_query);
        $numrows = $row;
        $total_pages = ceil($numrows/$per_page);
        $reload = './Controller-llamadas-gestion.php';
        //construye query tickets
		
	
		  $query= " SELECT 
					  t1.PK_FolioTASK as TASK,
					  t2.PK_IdEstatus as ESTATUS,
					  t4.PK_IdUsuario as 'ASIGNADO A',
					  t1.Cliente as 'SOLICITADO POR',
					  t3.Nombre as PROYECTO,
					  t1.FK_IdProyecto as PRO,
					  t5.PK_IdTipoSolicitud as 'TIPO DE SOLICITUD',
					  t7.PK_IdPrioridad as PRIORIDAD,
					  t6.PK_IdCategoria as CATEGORIA,
					  t1.titulo_solicitud as TITULO,
					  t1.Detalle_Solicitud as DESCRIPCION,
					  t8.Nombre as PERFIL,
					  convert (char(30),t1.Fecha_Apertura,120) as 'FECHA INICIO',
					  convert (char(30),t1.Fecha_Respuesta,120) as 'FECHA SEG',
					  convert (char(30),t1.Fecha_Pendiente,120) as 'FECHA PEN',
					  convert (char(30),t1.Fecha_cierre,120) as 'FECHA CIERRE',
				      convert (char(30),t1.Fecha_Cancelado,120) as 'FECHA CAN'
					 
					  FROM [PSC.SD_TASK]t1
					  LEFT JOIN [PSC.SD_Estatus]t2 ON t1.FK_IdEstatus=t2.PK_IdEstatus
					  LEFT JOIN [PSC.Usuario]t4 ON t1.FK_IdUsuario=t4.PK_IdUsuario
					  LEFT JOIN [PSC.SD_Proyecto]t3 ON t1.FK_IdProyecto=t3.PK_IdProyecto
					  LEFT JOIN [PSC.SD_TipoSolicitud]t5 ON t1.FK_IdTipoSolicitud=t5.PK_IdTipoSolicitud
					  LEFT JOIN [PSC.SD_Categoria]t6 ON t1.FK_IdCategoria=t6.PK_IdCategoria
					  LEFT JOIN [PSC.SD_SLAPrioridad]t7 ON t1.FK_IdPrioridad=t7.PK_IdPrioridad
					  LEFT JOIN [PSC.Perfil_Usuario]t8 ON t1.Fk_IdPerfil=t8.Pk_IdPerfil
					  $sWhere  
					  ,t2.PK_IdEstatus,t4.PK_IdUsuario,t1.Cliente,
					  t3.nombre,t7.Nombre,t1.Detalle_Solicitud,
					  t5.PK_IdTipoSolicitud,t7.PK_IdPrioridad,t6.PK_IdCategoria,
					  t8.Nombre,t1.Titulo_solicitud,t1.Fecha_Apertura,
					  t1.Fecha_Cierre,t1.Fecha_Respuesta,t1.Fecha_Pendiente,
					  t1.Fecha_Cancelado,t1.FK_IdProyecto,t1.FK_IdPerfil

					ORDER BY t1.Pk_FolioTASK ASC  
					OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY";
       
	   
        /*$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";*/
		//print_r($query);
       $query=sqlsrv_query($con,$query,PARAMS,OPTION);
	  
        //looping de la tabla
        if ($numrows>0){
             
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">Folio </th>
                        <th class="column-title">Estatus </th>
                        <th class="column-title">Asignado </th>
                        <th class="column-title">Cliente </th>
                         <th class="column-title">Servicio </th> 
                        <th class="column-title">Solicitud </th>
                        <th class="column-title">Urgencia / Impacto </th>
                        <th>Apertura </th>
                        <th>Cierre </th>
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				
                        while ($r=sqlsrv_fetch_array($query)) {
							 
							$id=$r['TASK'];
                            $folio=$r['TASK'];
                            $creado=$r['FECHA INICIO'];
                            $solicita=$r['SOLICITADO POR'];
                            $proyecto=$r['PROYECTO'];
							$pro=$r['PRO'];
							$cierre=$r['FECHA CIERRE'];
							$seguimiento=$r['FECHA SEG'];
							$pendiente=$r['FECHA PEN'];
							$cancelado=$r['FECHA CAN'];
							$titulo=$r['TITULO'];
							$descripcion=$r['DESCRIPCION'];
							$perfil=$r['PERFIL'];
							
							// Combos por  Primary key a la funcion JS get value
							
							$asignado=$r['ASIGNADO A'];
							$solicitud=$r['TIPO DE SOLICITUD'];
							$categoria=$r['CATEGORIA'];
							$estatus_tk=$r['ESTATUS'];
							$prioridad=$r['PRIORIDAD'];
							
	                        $sql = sqlsrv_query($con, "select * from [dbo].[PSC.Usuario] 
	                                                   where Pk_IdUsuario=$asignado
													   and Estatus=1",PARAMS,OPTION);
							
							if($c=sqlsrv_fetch_array($sql))
							
							{
								$asignado_name=$c['Nombre'];
							}
	                        
							$sql = sqlsrv_query($con, "select * from [PSC.SD_TipoSolicitud] 
	                                                   where PK_IdTipoSolicitud=$solicitud
													   and Estatus=1",PARAMS,OPTION);
	
	                        if($c=sqlsrv_fetch_array($sql))
							
							{
								$solicitud_name=$c['Solicitud'];
							}	
							
							$sql = sqlsrv_query($con, "select * from [PSC.SD_Categoria] where 
							                           PK_IdCategoria=$categoria
													   and Estatus=1",PARAMS,OPTION);
	
	                        if($c=sqlsrv_fetch_array($sql))
							
							{
								$categoria_name=$c['Nombre'];
							}
							
							$sql = sqlsrv_query($con, "select * from [PSC.SD_Estatus] where 
							                           PK_IdEstatus=$estatus_tk
													   and Status=1",PARAMS,OPTION);
	
	                        if($c=sqlsrv_fetch_array($sql))
							
							{
								$estatus_name=$c['Nombre'];
							}						
							
								$sql = sqlsrv_query($con, "select * from [PSC.SD_SLAPrioridad] where 
							                           PK_IdPrioridad=$prioridad
													   and Estatus=1",PARAMS,OPTION);
	
	                        if($c=sqlsrv_fetch_array($sql))
							
							{
								$sla_name=$c['Nombre'];
							}	
						
							  $fol= $SESSION['folio']=$r['TASK'];
	
							//$_SESSION['folio']=$folio;
                            //header("location:/APP/Model/Controller-carga-archivos.php");

                
                ?>

                    <input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">

                    <!-- me obtiene los datos -->
                    <input type="hidden" value="<?php echo $folio;?>" id="folio<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $asignado;?>" id="asignado<?php echo $id;?>">
                    <input type="hidden" value="<?php echo utf8_encode($solicita);?>" id="solicita<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $proyecto;?>" id="proyecto<?php echo $id;?>">
					<input type="hidden" value="<?php echo $pro;?>" id="pro<?php echo $id;?>">
                    <input type="hidden" value="<?php echo utf8_encode($solicitud);?>" id="solicitud<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $categoria;?>" id="categoria<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $creado;?>" id="creado<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $prioridad;?>" id="prioridad<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $cierre;?>" id="cierre<?php echo $id;?>">
                    <input type="hidden" value="<?php echo utf8_encode($titulo);?>" id="titulo<?php echo $id;?>">
                    <input type="hidden" value="<?php echo utf8_encode($descripcion);?>" id="descripcion<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $perfil;?>" id="perfil<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $estatus_tk;?>" id="estatus_tk<?php echo $id;?>"></form>
                    <input type="hidden" value="<?php echo utf8_encode($seguimiento);?>" id="seguimiento<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $pendiente;?>" id="pendiente<?php echo $id;?>">
                    <input type="hidden" value="<?php echo $cancelado;?>" id="cancelado<?php echo $id;?>">
                    
                    
                  
                     
                    <tr class="even pointer">
               <td> <a href="#" title='Ver Ticket' value="<?php  echo $id?>" onClick="todos('<?php echo $id;?>');" data-toggle="modal" 
               data-target=".bs-example-modal-lg-udp"><?php echo $folio; ?></a></td>
               
              
                        <td><?php echo $estatus_name; ?></td>
                        <td><?php echo utf8_encode ($asignado_name); ?></td>
                        <td><?php echo utf8_encode ($solicita);?></td>
                        <td><?php echo utf8_encode ($proyecto);?></td>
                        <td><?php echo utf8_encode ($solicitud_name);?></td>
                        <?php
                        switch ($sla_name)
						{
						 case 'Alta'  : $color = 'red'; break; // inicia el sla urgente menos de 8 horas
						 case 'Media' : $color = '#F0E91B'; break; // inicia el sla medio 24 horas
						 case 'Baja'  : $color = '#1db954'; break;  //inicial el sla bajo 48 horas
						 case 'Terminada': $color = '#f9f9f9'; break; //SLA Concluido
						}
						switch ($sla_name)
						{
						 case 'Alta'  : $colorl = '#F9FFF4'; break; 
						 case 'Media' : $colorl = '#F9FFF4'; break; 
						 case 'Baja'  : $colorl = '#F9FFF4'; break; 
						 case 'Terminada': $colorl = '#5A5A5A'; break; 
						}
						?>

        
                        <td style = "background-color: <?php echo $color ?>; color: <?php echo $colorl ?>;"><center><strong><?php echo $sla_name;?></strong></center></td>
                        <td><?php echo $creado;?></td>
                        <td><?php echo $cierre;?></td>
                        <td ><span class="pull-right">
                        
                    </tr>
                <?php
                    } //en while
                ?>
                <tr>
                    <td colspan=10><span class="pull-right">
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
              <strong>Aviso!</strong> No hay datos para mostrar!
            </div>
        <?php    
        }
		
		
    }
	
?>