<?php

session_start(array('name'=>'SGMX'));
$id_u=$_SESSION['id_sgmx'];
  require('../../APP/Controller/funcion.class.sgmx.define.BBDD.php');
    $con = sqlsrv_connect(SERVER,CONNINF);
   $action = (isset($_REQUEST['action']) && $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';   
   
   $sede= $_GET['q'];
   $_SESSION['sede']=$sede;

    if($action == 'ajax')
	{
      
           $q =strip_tags($_REQUEST['q'], ENT_QUOTES);
		   //$r =strip_tags($_REQUEST['r'], ENT_QUOTES);
         $aColumns = array('t1.FK_IdUnidadAdm');
         $sTable = "[dbo].[PSA.UsuarioAsistencia]t1";
         $sWhere = "";
         if ( $_GET['q'] != "" )
        {
            $sWhere = "WHERE ";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." in (".$q.")";
            }
         
           
        }
		
		$sWhere.=" group by PK_IdUsuario";
        include './funcion.class.sgmx.paginador.php'; 
        
     
	    $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
        $per_page = 10; 
        $adjacents  = 4; 
        $offset = ($page - 1) * $per_page;
		
		
        
		 //Query del conteo de registor*/
      $sql =  "SELECT count(*) AS numrows FROM $sTable $sWhere ";
		//print_r($sql);
		$count_query= sqlsrv_query($con,$sql,PARAMS,OPTION); 
        $row=sqlsrv_num_rows($count_query);
        $numrows = $row;
        $total_pages = ceil($numrows/$per_page);
		$reload = './Controller-PlantiEmple.php ';
        
	$query= "select 
			PK_IdUsuario as 'N',			
			t2.Nombre as 'ENTIDAD',
			t3.Nombre_Estado as 'ESTADO',
			t4.Nombre_UnidadAdm as 'UNIDAD',
			t1.Apallido_Paterno + ' ' + t1.Apallido_Materno  + ' ' +  t1.Nombre as 'NOMBRE_COMPLETO',
			t6.[Nombre_TipoPago] as 'ESQUEMAP',
			t1.Apallido_Paterno as 'APELLIDO PATERNO',
			t1.Apallido_Materno as 'APELLIDO MATERNO',
			t1.Nombre as 'NOMBRE (S)',
			t7.[Nombre_Puesto] as 'PUESTO EN CONTRATO O PERFIL',
			t7.[Sueldo] as 'SUELDO MENSUAL NETO',
			t1.Banco as BANCO,
			t1.Cuenta as CUENTA,
			t1.Clabe as CLABE,
			t1.RFC,
			t1.CURP,
			t1.NSS as 'N.S.S',
			t8.Nombre_Sexo as SEXO,
			t1.Fecha_Nacimiento AS 'FECHA DE NACIMIENTO',
			t1.Lugar_Nacimiento as 'LUGAR DE NACIMIENTO'


			from [PRO_SERVER_ASISTENCIA].[dbo].[PSA.UsuarioAsistencia] t1

			left join [dbo].[PSA.Proyecto]t2 on t1.FK_IdProyecto = t2.[PK_IdProyecto]
			left join [dbo].[PSA.Estado]t3 on t1.FK_IdEstado = t3.[PK_IdEstado]
			left join [dbo].[PSA.UnidadAdm]t4 on t1.FK_IdUnidadAdm = t4.[PK_IdUnidadAdm]
			left join [dbo].[PSA.TipoPago]t6 on t1.FK_IdTipoPago = t6.[PK_IdTipoPago]
			left join [dbo].[PSA.Puesto]t7 on t1.FK_IdPuesto = t7.[PK_IdPuesto]
			left join [dbo].[PSA.Sexo]t8 on t1.FK_IdSexo = t8.[PK_IdSexo]
			$sWhere
			,
			t2.Nombre,
			t3.Nombre_Estado,
			t4.Nombre_UnidadAdm,
			t1.Apallido_Paterno,
			t1.Apallido_Materno,
			t6.[Nombre_TipoPago],
			t1.Apallido_Paterno,
			t1.Apallido_Materno,
			t1.Nombre,
			t7.[Nombre_Puesto],
			t7.[Sueldo],
			t1.Banco,
			t1.Cuenta,
			t1.Clabe,
			t1.RFC,
			t1.CURP,
			t1.NSS,
			t8.Nombre_Sexo,
			t1.Fecha_Nacimiento,
			t1.Lugar_Nacimiento
			order by t1.PK_IdUsuario ASC 
			OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY";
     //print_r($query);
       $query=sqlsrv_query($con,$query,PARAMS,OPTION);
	   
	   
       
        if ($numrows>0){
             
            ?>
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">
                        <th class="column-title">ID</th>
                        <th class="column-title">Login</th>
                        <th class="column-title">Estado</th>
                        <th class="column-title">Nombre Completo</th>
                         <th class="column-title">Unidad</th> 
                         <th class="column-title">Esquema</th> 
                        <th class="column-title">Puesto</th>
     
                        <th class="column-title no-link last"><span class="nobr"></span></th>
                    </tr>
                </thead>
                <tbody>
                <?php 
				
                        while ($res=sqlsrv_fetch_array($query)) {
							 
						 $Num=$res['N'];
                           //$Login=$res['Login'];
							$Entidad=utf8_encode($res['ENTIDAD']);
							$estado=utf8_encode($res['ESTADO']);
							$unidad=utf8_encode($res['UNIDAD']);
							$nombre=utf8_encode($res['NOMBRE_COMPLETO']);
							$esq=utf8_encode($res['ESQUEMAP']);
							

                ?>

                
                    
                    
                  
                     
                    <tr class="even pointer">
                    
                        <td><?php echo $Num;?></td>
                        <!-- <td><?php echo $Login; ?></td> -->
                        <td><?php echo $Entidad; ?></td>
                        <td><?php echo $estado;?></td>
                     <td><?php echo utf8_encode($nombre);?></td>
                        <td><?php echo $unidad;?></td>
                        
                        <td><?php echo $esq;?></td>
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