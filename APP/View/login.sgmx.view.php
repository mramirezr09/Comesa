<!DOCTYPE html>
<html>
  <head>
    <div class="full-box header">
      <div class="full-box header-form-vision">
        <figure class="full-box">
          <!--<img src="<?php echo SRVURL; ?>Script/assets/Logotipo_PNPDMI.png" alt="Vision">-->
      </div>
      <div class="visionname" style="margin-left:30px;">Sistema integral para contratación</div>
    </div>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo SRVURL; ?>Script/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
  </head>
    <body class="hold-transition login-page">
      <div class="login-box">
        <?php
          /*
          $error=sha1(md5("cuenta inactiva"));
          if (isset($_GET['error']) && $_GET['error']==$error) {
          echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'>
          <strong>Error!</strong> Cuenta inactiva!
          </div>";
          }
          */
        ?>
        <div class="login-logo">
          <a href="#"><b></b>Contratación</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
          <p class="login-box-msg">Inicio de Sesión</p>
          <form action="" method="POST" autocomplete="off" >
            <div class="form-group has-feedback">
              <input type="text" class="form-control" id="UserName" name="usuario" placeholder="Usuario" required >
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control password1" id="UserPass" name = "clave" placeholder="Contraseña" required>
              <span class="fa fa-fw fa-eye password-icon show-password"></span>
            </div>
            <div class="row-pass">
              <div class="col-xs-8">
                <div class="checkbox icheck">
                  <label>
                    <input type="checkbox"> Recordar mi contraseña
                  </label>
                </div>
              </div><!-- /.col -->
              <div class="col-xs-4">
                <!-- <button type="submit" value="Iniciar sesión" cclass="btn btn-default"> Entrar </button> -->
                <button type="submit" value="Iniciar sesión" class="btn btn-primary btn-flat">Entrar</button>
              </div><!-- /.col -->
            </div>
          </form>
          <!-- <a href="">¿Olvidaste tu contraseña?</a><br> -->
        </div><!-- /.login-box-body -->
      </div><!-- /.login-box -->
    </body>
  <script src="<?php echo SRVURL; ?>Script/js/funcion.Jquery.password.js"></script>
</html>

<?php
  if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    require_once ('././APP/Controller/Controller-login.php');
    $login = new login();
    echo $login -> controller_login_session ();
  }
?>
