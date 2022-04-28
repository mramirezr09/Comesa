  <?php
  $id_u=$_SESSION['id_sgmx'];
   $con = sqlsrv_connect(SERVER,CONNINF);
  
  $query= "
            SELECT 
       [PK_IdUsuario]
      ,[Mail]
      ,[Login]
      ,[Password]
      ,[Img_Perfil]
       FROM [PRO_SERVER_ASISTENCIA].[dbo].[PSA.UsuarioAsistencia]
			WHERE PK_IdUsuario='$id_u'";
      //print_r($query);
       $query=sqlsrv_query($con,$query,PARAMS,OPTION);
  
					 while ($row=sqlsrv_fetch_array($query)) {
        $login = $row['Login'];
        $email = $row['Mail'];
        $profile_pic = $row['Img_Perfil'];
        $pass = $row['Password'];
  
    }
  ?>

  <div class="right_col" role="main"> <!-- page content -->
        <div class="">
            <div class="page-title">
               
                <!-- content -->
                <br><br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="image view view-first">
                            <img class="thumb-image" style="width: 100%; display: block;" src="<?php echo SRVURL ?>Script/assets/profile/<?php echo $profile_pic; ?>" alt="image" />
                        </div>
                        <span class="btn btn-my-button btn-file">
                            <form method="post" id="formulario" enctype="multipart/form-data">
                            Cambiar Imagen de perfil: <input type="file" name="file">
                            </form>
                        </span>
                        <div id="respuesta"></div>
                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-12">
                        <?php include "lib/alerts.php";
                            profile(); //llamada a la funcion de alertas
                        ?>    
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Informacion personal</h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                            <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <form  data-parsley-validate class="form-horizontal form-label-left"  method="post" id="upd_pass" name="upd_pass">
								<div id="result_user2"></div>
								<input type="hidden" id="mod_id" name="mod_id" value="<?php echo $id_u; ?>">
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Login
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="name" id="first-name" class="form-control col-md-7 col-xs-12" value="<?php echo $login; ?>" readonly>
                                        </div>
                                    </div>
									
									<!--
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Correo electronico 
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="mod-mail" name="mod-mail" class="form-control col-md-7 col-xs-12" value="<?php echo $email; ?>">
                                        </div>
                                    </div>
                                       !-->
                                    <br><br><br>
                                    <h2 style="padding-left: 50px">Cambiar Contraseña</h2>
                            
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña antigua
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="mod_pass1" name="mod_pass1" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="**********">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nueva contraseña 
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="mod_pass2" name="mod_pass2" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar contraseña nueva
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input id="mod_pass3" name="mod_pass3" class="date-picker form-control col-md-7 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" name="token" class="btn btn-success">Actualizar Datos</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->
	<script type="text/javascript" src="/Script/js/funcion.Jquery.updimage.js"></script>
	<script type="text/javascript" src="/Script/js/funcion.Jquery.updpass.js"></script>