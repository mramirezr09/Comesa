<?php
$conn = sqlsrv_connect(SERVER,CONNINF);

 $perfil_us=$_SESSION['perfil_sgmx'];

    $qry1="SELECT * FROM [PRO_SERVER_COMESA].[dbo].[PSC.Usuario] where FK_IdPerfil=$perfil_us";
	$llamadas= sqlsrv_query($conn,$qry1,PARAMS,OPTION);

if ($perfil_us==1)
{
?>

<nav class="navbar navbar-inverse" role="navigation">

  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"> </i> COMESA</a>
  </div>

  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
		<li class=""><a href="<?php echo SRVURL.'Registros_Comesa'?>"><i class="fa fa-ticket" aria-hidden="true"></i> Contratación</a></li>
		<li class=""><a href="<?php echo SRVURL.'reportes'?>"><i class="fa fa-ticket" aria-hidden="true"></i> Reporteria</a></li>
	 <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sitemap" aria-hidden="true"></i>
          Entregables <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
		<li><a href="<?php echo SRVURL.'tickets_Call/'?>">Lista de Asistencia</a></li>
          <li><a href="<?php echo SRVURL.'tickets_Sis/'?>">Lista de Actividades</a></li>


        </ul>
      </li>
    </ul>
	<!--<ul class="nav navbar-nav">

	</ul>-->


<ul class="nav navbar-nav navbar-right">
<li>
<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<img src="<?php echo SRVURL; ?>Script/assets/login/<?php echo $_SESSION['Img_sgmx']?>" alt=""><?php echo utf8_encode($_SESSION['usuario_sgmx']);?>
<span class=" fa fa-angle-down"></span>
</a>



<ul class="dropdown-menu dropdown-usermenu ">


<li><a href="dashboard.php"><i class="fa fa-user"></i> Mi cuenta</a></li>
  <li class="divider"></li>
<li><a href="<?php echo $logcon -> passencrypt($_SESSION['token_sgmx'] )?>" title="Salir del sistema" class="btn-exit-system"><i>Cerrar Sesión</i></a></li>
</ul>
</ul>
  </div>


</nav>

<?php
}
elseif($perfil_us==2)
{
?>

<nav class="navbar navbar-inverse" role="navigation">

  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"> </i> COMESA</a>
  </div>

  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
  	  <!-- <li class=""><a href="<?php echo SRVURL.'Inicio_Comesa'?>"><i class="fa fa-dashboard" aria-hidden="true"></i> Inicio</a></li> -->
  		<li class="nav-item active"><a href="<?php echo SRVURL.'Filtro_Comesa'?>"><i class="fa fa-gavel" aria-hidden="true"></i> Filtro Juridico</a></li>
  		<li class=""><a href="<?php echo SRVURL.'NEJRSkE3WWFx'?>"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Reportes</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-database" aria-hidden="true"></i>
          Ordenes de Suministro <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo SRVURL.'capturarODS/'?>">Capturar ODS</a></li>
          <li><a href="<?php echo SRVURL.'consultarODS/'?>">Consultar ODS</a></li>
        </ul>
      </li>
    </ul>
	<!--<ul class="nav navbar-nav">

	</ul>-->


<ul class="nav navbar-nav navbar-right">
<li>
<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<img src="<?php echo SRVURL; ?>Script/assets/login/<?php echo $_SESSION['Img_sgmx']?>" alt=""><?php echo utf8_encode($_SESSION['usuario_sgmx']);?>
<span class=" fa fa-angle-down"></span>
</a>



<ul class="dropdown-menu dropdown-usermenu ">


<li><a href="dashboard.php"><i class="fa fa-user"></i> Mi cuenta</a></li>
  <li class="divider"></li>
<li><a href="<?php echo $logcon -> passencrypt($_SESSION['token_sgmx'] )?>" title="Salir del sistema" class="btn-exit-system"><i>Cerrar Sesión</i></a></li>
</ul>
</ul>
  </div>


</nav>

<?php
}

elseif($perfil_us==3)
{
?>

<nav class="navbar navbar-inverse" role="navigation">

  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#"> </i> COMESA</a>
  </div>

  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
	   <!-- <li class=""><a href="<?php echo SRVURL.'Inicio_Comesa'?>"><i class="fa fa-dashboard" aria-hidden="true"></i> Inicio</a></li> -->
		<li class="nav-item active"><a href="<?php echo SRVURL.'Filtro_Comesa'?>"><i class="fa fa-gavel" aria-hidden="true"></i> Filtro COMESA</a></li>
    <li class=""><a href="<?php echo SRVURL.'Registros_Comesa'?>"><i class="fa fa-ticket" aria-hidden="true"></i> Contratación PNP</a></li>
	<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-database" aria-hidden="true"></i>
          Ordenes de Suministro <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo SRVURL.'capturarODS/'?>">Capturar ODS</a></li>
          <li><a href="<?php echo SRVURL.'consultarODS/'?>">Consultar Prefactura ODS</a></li>
          <!-- <li><a href="<?php echo SRVURL.'prefacturaODS/'?>">Consultar Prefactura ODS</a></li> -->
        </ul>
      </li>

    </ul>
	<!--<ul class="nav navbar-nav">

	</ul>-->


<ul class="nav navbar-nav navbar-right">
<li>
<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<img src="<?php echo SRVURL; ?>Script/assets/login/<?php echo $_SESSION['Img_sgmx']?>" alt=""><?php echo utf8_encode($_SESSION['usuario_sgmx']);?>
<span class=" fa fa-angle-down"></span>
</a>



<ul class="dropdown-menu dropdown-usermenu ">


<li><a href="dashboard.php"><i class="fa fa-user"></i> Mi cuenta</a></li>
  <li class="divider"></li>
<li><a href="<?php echo $logcon -> passencrypt($_SESSION['token_sgmx'] )?>" title="Salir del sistema" class="btn-exit-system"><i>Cerrar Sesión</i></a></li>
</ul>
</ul>
  </div>


</nav>

<?php
}


else
{
	?>

<div class="top_nav"><!-- top navigation -->
<div class="nav_menu">
<nav>
<div class="nav toggle">
<a id="menu_toggle"><i class="fa fa-bars"></i></a>
</div>
<ul class="nav navbar-nav navbar-right">
<li class="">
<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
<img src="<?php echo SRVURL; ?>Script/assets/profile/<?php echo $_SESSION ['Img_sgmx']?>" alt=""><?php echo $_SESSION['usuario_sgmx']?>
<span class=" fa fa-angle-down"></span>
</a>
<ul class="dropdown-menu dropdown-usermenu pull-right">
<li><a href="<?php echo SRVURL ?>MiCuenta/"><i class="fa fa-user"></i> Mi cuenta</a></li>
<li><a href="<?php echo $logcon -> passencrypt($_SESSION['token_sgmx'] )?>" title="Salir del sistema" class="btn-exit-system"><i>Cerrar Sesión</i></a></li>
</ul>
</li>
</ul>
</nav>
</div>
</div><!-- /top navigation -->
<?php
}
