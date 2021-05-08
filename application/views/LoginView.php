<?php 
//destruimos la session
$this->session->sess_destroy();
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prueba | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>styles/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url()?>styles/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>styles/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Prueba</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Ingresa para iniciar tu sessión</p>

      <form action="<?=base_url()?>home" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="user" required="true">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Contraseña" name="pass" required="true">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          <!-- /.col -->
          <button type="submit" class="btn btn-primary btn-block">Iniciar</button>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->
    <!--Alertas-->
     <?php 
        if ($this->input->get('log')=="err") {
     ?>
     <div class="alert alert-danger alert-dismissible show fade" id="alert_err" style="position: fixed; z-index: 100; top: 93%; right: 1%;" align="left">
        <strong>Error! </strong>Contraseña Incorrecta
    </div>
     <?php 
        }
      ?>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>styles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>styles/dist/js/adminlte.min.js"></script>
<script type="text/javascript">
  setTimeout(function(){ 
    $('#alert_err').alert('close');
  }, 2000);
</script>
</body>
</html>