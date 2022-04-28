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
    $aColumns = array('t1.[Nombre_Completo]','t1.[Curp]','t11.Nombre_Fase','t3.Nombre_Puesto');
    $sTable = "[dbo].[PSC.RegistroDP]t1
                left join [dbo].[PSC.RegistroDB]t2 on t1.PK_IdRegistro = t2.FK_IdRegistro
                left join [dbo].[PSC.Puesto]t3 on t1.FK_IdPuesto = t3.PK_IdPuesto
                left join [dbo].[PSC.Registro_Estatus]t4 on t1.FK_IdPuesto = t4.PK_IdRegistrEstatus
                left join [dbo].[PSC.Sexo]t5 on t1.FK_IdSexo = t5.PK_IdSexo
                left join [dbo].[PSC.Estado]t6 on t1.FK_IdEstado = t6.PK_IdEstado
                left join [dbo].[PSC.Esquema_Nomina]t7 on t1.FK_IdEsquema = t7.PK_IdEsquema
				left join [dbo].[PSC.Filtro_Juridico]t9 on t1.FK_IdFiltro=t9.PK_IdFiltro
				left join [dbo].[PSC.Usuario_Nacionalidad]t8 on t1.FK_IdNacionalidad= t8.PK_IdNacionalidad
				left join [dbo].[PSC.Banco]t10 on t2.FK_IdBanco=t10.PK_IdBanco
				left join [dbo].[PSC.Fase_Puesto]t11 on t3.FK_IdFase=t11.PK_IdFase ";
   $sWhere = "";

    if ( $_GET['q'] != "")
	 {
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, '', -3 );
            $sWhere .= ')';
        }

    else {
		    $sWhere.=" ";
		}
    include './funcion.class.sgmx.paginador.php';
	  $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
    $per_page = 15;
    $adjacents  = 4;
    $offset = ($page - 1) * $per_page;
    $sql =  "SELECT count(*) AS numrows FROM $sTable $sWhere group by t1.Nombre_Completo ";
	//($sql);
	$count_query= sqlsrv_query($con,$sql,PARAMS,OPTION);
    $row=sqlsrv_num_rows($count_query);
		//print_r($row);
    $numrows = $row;
    $total_pages = ceil($numrows/$per_page);
    $reload = './Controller-RegistroGestion.php';


		 $query1= "SELECT [PK_IdRegistro] as ID
                ,t1.[Nombre_Completo] as NombreU
				        ,t1.[Nombre] as Nombrer
                ,t1.[FK_IdSexo] as sexoid
				,t3.FK_IdFase as Fase
				,t3.Sueldo_Mensual as NSueldo
				,t11.Nombre_Fase as NFase
        	      ,t1.[Apellido_Paterno] as apellidoP
                ,t1.[Apellido_Materno] as apellidoM
        	      ,t4.[Nombre] as registroE
        	      ,t1.[FK_IdPuesto] as puesto
				        ,t1.edad
                 ,t1.FK_IdEstado_Civil as estadoc
				        ,t1.FK_IdRegistrEstatus
        	      ,[CURP] as curp
                ,[RFC] as rfc
				        ,convert (char(30),t1.Fecha_Nacimiento,120) as 'fechaN'
                ,[Lugar_Nacimiento] as lugarN
        	      ,[FK_IdNacionalidad] as nacion
				        ,t8.nombre as nacionalidad
        	      ,[Edad] as edad
        	      ,[Mail] as mail
        	      ,[Numero_Telefono] as numT
        	      ,[NSS]
        	      ,t1.[FK_IdEstado] as nombree
                ,[CP] as cp
        	      ,[FK_IdEsquema] as esqueman
                ,[Municipio] as municipio
                ,[Colonia] as colonia
        	      ,[Calle] as calle
                ,[Numero_Ext] as numE
                ,[Numero_Int] as numI
                ,t10.Nombre_Banco as banco
        	      ,t2.Clabe as clabe
                ,t2.FK_IdInfonavit as siNoInf
        	      ,t2.Num_Inf as numInf
        	      ,t2.Tipo_Inf as tipoInf
        	      ,t2.Valor_inf as valorinf
				  ,t9.nombre as filtro
				  ,t1.[FK_IdFiltro] as idfiltro
				  ,t1.Fk_IdODS as ODS
				  ,t13.PK_IdFrente as frente
				  ,t1.Captura_Pnp as captura
                FROM [PRO_SERVER_COMESA].[dbo].[PSC.RegistroDP]t1
                left join [dbo].[PSC.RegistroDB]t2 on t1.PK_IdRegistro = t2.FK_IdRegistro
                left join [dbo].[PSC.Puesto]t3 on t1.FK_IdPuesto = t3.PK_IdPuesto
                left join [dbo].[PSC.Registro_Estatus]t4 on t1.FK_IdPuesto = t4.PK_IdRegistrEstatus
                left join [dbo].[PSC.Sexo]t5 on t1.FK_IdSexo = t5.PK_IdSexo
                left join [dbo].[PSC.Estado]t6 on t1.FK_IdEstado = t6.PK_IdEstado
                left join [dbo].[PSC.Esquema_Nomina]t7 on t1.FK_IdEsquema = t7.PK_IdEsquema
				left join [dbo].[PSC.Filtro_Juridico]t9 on t1.FK_IdFiltro=t9.PK_IdFiltro
				left join [dbo].[PSC.Usuario_Nacionalidad]t8 on t1.FK_IdNacionalidad= t8.PK_IdNacionalidad
				left join [dbo].[PSC.Banco]t10 on t2.FK_IdBanco=t10.PK_IdBanco
				left join [dbo].[PSC.Fase_Puesto]t11 on t3.FK_IdFase=t11.PK_IdFase
				left join [dbo].[PSC.ODS]t12 on t1.Fk_IdODS=t12.PK_IdODS
				left join [dbo].[PSC.Frente]t13 on t13.PK_IdFrente=t12.FK_IdFrente
				        $sWhere
                         group by t1.Nombre_Completo
						    ,t1.PK_IdRegistro,
							t3.FK_IdFase,
							t9.nombre,
							t13.PK_IdFrente,
							t1.FK_IDFiltro,
							t1.Captura_Pnp,
			          t1.Nombre,
			          t1.Apellido_Paterno,
					  t11.Nombre_Fase,
					  t3.Sueldo_Mensual,
					      t8.nombre,
					      t1.edad,
                t1.[FK_IdSexo],
			          t1.Apellido_Materno,
			          t4.Nombre,
			          t1.FK_IdPuesto,
			          CURP,
			          RFC,
			          Fecha_Nacimiento
			          ,[Lugar_Nacimiento]
      	        ,[FK_IdNacionalidad]
      	        ,[Edad]
				,t1.FK_IdEstado_Civil
      	        ,[Mail]
      	        ,[Numero_Telefono]
      	        ,[NSS]
      	        ,t1.[FK_IdEstado]
                ,[CP]
      	        ,[FK_IdEsquema]
                ,[Municipio]
                ,[Colonia]
      	        ,[Calle]
                ,[Numero_Ext]
                ,[Numero_Int]
                ,t1.Fk_IdODS
                ,t10.Nombre_Banco
      	        ,t2.Clabe
                ,t2.FK_IdInfonavit
      	        ,t2.Num_Inf
      	        ,t2.Tipo_Inf
      	        ,t2.Valor_inf
			          ,t1.FK_IdRegistrEstatus
			         order by t1.Nombre_Completo DESC
			         OFFSET $offset ROWS FETCH NEXT $per_page ROWS ONLY";
         // print_r($query1);
               $query1=sqlsrv_query($con,$query1,PARAMS,OPTION);

               if ($numrows>0){
            ?>

            <table class="table table-striped jambo_table bulk_action">
              <thead>
                  <tr class="headings">
                      <th class="column-title">ID Registro</th>
  				            <th class="column-title">Nombre</th>
  				            <th class="column-title">Puesto</th>
							<th class="column-title">Fase</th>

                      <th class="column-title">CURP</th>

                      <th class="column-title">Filtro Juridico</th>
					  <th class="column-title">Capturo PNP</th>

                      <th class="column-title no-link last"><span class="nobr"></span></th>

                  </tr>
              </thead>
            <tbody>
            <?php
              while ($r=sqlsrv_fetch_array($query1)) {
                $id=$r['ID'];
                $nombre=$r['NombreU'];
				 $nfase=$r['NFase'];
                $nsueldo=$r['NSueldo'];
				$filtroid=$r['idfiltro'];
				 $nombrer=$r['Nombrer'];
				 $fase=$r['Fase'];
                $apellidoP=$r['apellidoP'];
                $apellidoM=$r['apellidoM'];
                $registroE=$r['registroE'];
                $puesto=$r['puesto'];
                $estadocid=$r['estadoc'];
			    $registroid=$r['FK_IdRegistrEstatus'];
                $curp=$r['curp'];
				$curpa=$r['curp'];
                $numT=$r['numT'];
				$nss=$r['NSS'];
                $nombree=$r['nombree'];
                $cp=$r['cp'];
                $rfc=$r['rfc'];
                $esqueman=$r['esqueman'];
				$filtro=$r['filtro'];
				$ods=$r['ODS'];
				$frente=$r['frente'];
				$capnp=$r['captura'];
				$sql = sqlsrv_query($con, "select * from [dbo].[PSC.Puesto]
	                                                   where Pk_IdPuesto=$puesto
													   and Estatus=1",PARAMS,OPTION);

							if($c=sqlsrv_fetch_array($sql))

							{
								$puesto_n=$c['Nombre_Puesto'];
							}
			    $sql1 = sqlsrv_query($con, "select * from [dbo].[PSC.Filtro_Juridico]
	                                                   where Pk_IdFiltro='$filtroid'
													   and Estatus=1",PARAMS,OPTION);
							;
							if($c=sqlsrv_fetch_array($sql1))

							{
								$filtro_n=$c['Nombre'];

							}

					$sql = sqlsrv_query($con, "select * from [dbo].[PSC.Fase_Puesto]
	                                                   where PK_IdFase=$fase
													   and Estatus=1",PARAMS,OPTION);

							if($c=sqlsrv_fetch_array($sql))

							{
								$fase_n=$c['Nombre_Fase'];
							}

			      ?>



				<input type="hidden" value="<?php echo $id;?>" id="id<?php echo $id;?>">
				<input type="hidden" value="<?php echo $filtroid;?>" id="filtroid<?php echo $id;?>">
				<input type="hidden" value="<?php echo utf8_encode($nombre);?>" id="nombre<?php echo $id;?>">
				<input type="hidden" value="<?php echo $nss;?>" id="nss<?php echo $id;?>">
				<input type="hidden" value="<?php echo utf8_encode($nombrer);?>" id="nombrer<?php echo $id;?>">
				<input type="hidden" value="<?php echo utf8_encode($apellidoP);?>" id="apellidoP<?php echo $id;?>">
				<input type="hidden" value="<?php echo utf8_encode($apellidoM);?>" id="apellidoM<?php echo $id;?>">
    			<input type="hidden" value="<?php echo $registroid;?>" id="registroid<?php echo $id;?>">
    			<input type="hidden" value="<?php echo $puesto;?>" id="puesto<?php echo $id;?>">
				<input type="hidden" value="<?php echo $edad;?>" id="edad<?php echo $id;?>">
				<input type="hidden" value="<?php echo $estadocid;?>" id="estadocid<?php echo $id;?>">
				<input type="hidden" value="<?php echo $curp;?>" id="curp<?php echo $id;?>">
				<input type="hidden" value="<?php echo $curpa;?>" id="curpa<?php echo $id;?>">
				<input type="hidden" value="<?php echo $rfc;?>" id="rfc<?php echo $id;?>">

				<input type="hidden" value="<?php echo $fase;?>" id="fase<?php echo $id;?>">
				<input type="hidden" value="<?php echo $nsueldo;?>" id="nsueldo<?php echo $id;?>">

				<input type="hidden" value="<?php echo $numT;?>" id="numT<?php echo $id;?>">
				<input type="hidden" value="<?php echo $nombree;?>" id="nombree<?php echo $id;?>">
				<input type="hidden" value="<?php echo $cp;?>" id="cp<?php echo $id;?>">
				<input type="hidden" value="<?php echo $esqueman;?>" id="esqueman<?php echo $id;?>">
			    <input type="hidden" value="<?php echo $ods;?>" id="ods<?php echo $id;?>">
				<input type="hidden" value="<?php echo $frente;?>" id="frente<?php echo $id;?>">


				  	 <tr class="even pointer">
                     <td><?php echo $id;?></td>
                     <td><?php echo utf8_encode  ($nombre);?></td>
  					 <td><?php echo $puesto_n;?></td>
					 <td><?php echo $fase_n;?></td>
                      <td><?php echo $curp;?></td>
					  <?php
                        switch ($filtro_n)
						{
						 case 'No Apto'  : $color = 'red'; break; // inicia el sla urgente menos de 8 horas
						 case 'No en aptitud' : $color = '#FF5733'; break; // inicia el sla medio 24 horas
						 case 'Apto'  : $color = '#1db954'; break;  //inicial el sla bajo 48 horas
						 case 'Sin Asignar': $color = '#f9f9f9'; break; //SLA Concluido
						}
						switch ($filtro_n)
						{
						 case 'No Apto'  : $colorl = '#F9FFF4'; break;
						 case 'No en aptitud' : $colorl = '#F9FFF4'; break;
						 case 'Apto'  : $colorl = '#F9FFF4'; break;
						 case 'Sin Asignar': $colorl = '#5A5A5A'; break;
						}
						?>


                        <td style = "background-color: <?php echo $color ?>; color: <?php echo $colorl ?>;"><center><strong><?php echo $filtro_n;?></strong></center></td>


						   <?php
						   if($capnp==1)
						   {
							   ?>
					      <td><?php echo 'SI';?></td>

						   <?php
						   }
						   else
						   {
							   ?>
							   <td><?php echo 'NO';?></td>
							   <?php
						   }
							   ?>

						          <td>


                        <span class="pull-right">


  							<a href="#" class='btn btn-default' title='Editar Registro' onclick="obtener_datos('<?php echo $id;?>');" data-toggle="modal" data-target=".bs-example-modal-lg-upd">
								<i class="glyphicon glyphicon-edit"></i>
							</a>

						</span>
                      </td>
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
