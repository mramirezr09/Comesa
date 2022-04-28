
<?php
$conn = sqlsrv_connect(SERVER,CONNINF);
 $qry2="SELECT * FROM [PRO_SERVER_ASISTENCIA].[dbo].[PSA.Alertas] where Estatus=1";
	$pendientes= sqlsrv_query($conn,$qry2,PARAMS,OPTION);
	
$tabla="";

$active1=$_SESSION['perfil_sgmx'];

if($active1==1)
{
}
else 
{
}
/*
else
{

		  $tabla.='
				  <body class="nav-md">
				 
				  <div class="container body">
				  <div class="main_container">
				  <div class="col-md-3 left_col">
				  <div class="left_col scroll-view">
				  <div class="navbar nav_title" style="border: 0;">
				  <link rel="stylesheet"   
				  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
				 <img src="'.SRVURL.'Script/assets/comesa_alt.png" > 
				   
				  </div>
				 <div class="clearfix"></div>
				  ';

		  $tabla.='
				  <div class="profile clearfix">
				  <div class="profile_pic">
				  <img src="'.SRVURL.'Script/assets/profile/'.$_SESSION['Img_sgmx'].'" class="img-circle profile_img">
				  </div>
		          ';

		  $tabla.=
				  '<div class="profile_info">
				  <h2>'.$_SESSION['usuario_sgmx'].'</h2>
				  <a href="#"><i class="fa fa-circle text-success"></i><span> Empleado</span></a>
				  </div>
				  </div>
				  <br />
				  ';

			$tabla.='
					  <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"><!-- sidebar menu -->
					  <div class="menu_section">
					  <ul class="nav side-menu">
					';

			if ($active1==2)
			  {
			  		if (sqlsrv_num_rows($pendientes)>=1)
					{
                  $tabla.='
						<li class="">
						<a STYLE="Color: red" data-fancybox="gallery" href="'.SRVURL.'Script/IMG/2.png" title="Notificaciones">
						<i class="fa fa-bell" aria-hidden="true" STYLE="Color: #FFC300">
						</i><strong STYLE="color: #FFC300"> Notificaciones '.sqlsrv_num_rows($pendientes).'</strong></a>
						</li>
						';
					}
				$tabla.='
						<li class="" >
						<a href="'.SRVURL.'Recibos/"><i class="fa fa-qrcode"></i> Mis recibos de nómina</a>
						</li>
						';

				$tabla.='
						<li class="">
						<a href="'.SRVURL.'Mireporte/"><i class="fa fa-file-excel-o"></i> Mi reporte de asistencia</a>
						</li>
						';
				
	
                  $tabla.='
						<li class="">
						<a href="'.SRVURL.'Formatos/">
						<i class="fa fa-file-pdf-o" aria-hidden="true">
						</i> Mis documentos</a>
						</li>
						';
						
						
				$tabla.='
						<li class="">
						<a href="'.SRVURL.'Bienvenido"><i class="fa fa-calendar-check-o"></i> Check In</a>
						</li>
						';
					
					
				/*$tabla.='
						 
				   <li class="">
				   <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
				   <i class="fa fa-users"></i> Atención Visión <b class="caret"></b></a>
                   <ul class="dropdown-menu">
                   <li><a href="#"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>Formatos</a>
                   </li>
                   </ul>
              </li>
			  
				         ';

			    $tabla.='
				        <li class="">
						<a href="'.SRVURL.'Ayuda/"><i class="fa fa-question-circle-o"></i> Ayuda</a>
						</li>';
						
				$tabla.=' <li class="">
						  <a href="'.SRVURL.'Acerca/"><i class="fa fa-copyright"></i> Acerca de</a>
						  </li>';

			  }
			  
					 
					 elseif($active1==3)
					 {
						 
					
					    $tabla.='
						<li class="">
						<a href="'.SRVURL.'Administrador/"><i class="fa fa-home"></i> Inicio</a>
						</li>
						';
						
							  $tabla.='
						<li class="">
						<a href="'.SRVURL.'CargaReporte/"><i class="fa fa-upload"></i> Cargar Reporte</a>
						</li>
						';
						
						
						$tabla.='
						<li class="">
						<a href="'.SRVURL.'DocIncidencia/"><i class="fa fa-folder-open-o"></i> Documentar Incidencia</a>
						</li>
						';
						$tabla.='
						<li class="">
						<a href="'.SRVURL.'NEJRSkE3WWFx/"><i class="fa fa-search"></i> Reportes</a>
						</li>
						';
						
					 }
			  
		   
			  
			  $tabla.='
						</ul>
						</div>
						</div><!-- /sidebar menu -->
						</div>
						</div> 
						
					   ';
					   

echo $tabla;

return $tabla;



}
*/	