<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prueba | Editar Clientes</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>styles/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>styles/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?=base_url()?>home">Home</a></li>
    <li class="breadcrumb-item"><a href="<?=base_url()?>clientes">Clientes</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar Cliente</li>
  </ol>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="<?=base_url()?>styles/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Prueba</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url()?>styles/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$nombre?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php 
            foreach ($menus->result() as $key) {
           ?>
          <li class="nav-item">
            <a href="<?=base_url()?><?=$key->url?>" class="nav-link">
              <i class="nav-icon <?=$key->icon?>"></i>
              <p>
                <?=$key->menu?>
              </p>
            </a>
          </li>
          <?php 
            }
           ?>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-body">
          <h3>Editar Cliente</h3>
          <hr>
          <form>
            <?php
            $id = $this->input->GET('id'); 
            foreach ($data_client->result() as $key) { ?>
                <div class="row">
                  <div class="col">
                    <label for="exampleFormControlSelect1">Nombre(*)</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombres" required="true" value="<?=$key->nombres?>">
                  </div>
                  <div class="col">
                    <label for="exampleFormControlSelect1">Nit(*)</label>
                    <input type="text" class="form-control" id="nit" placeholder="Nit" required="true" value="<?=$key->nit?>">
                  </div>
                  <div class="col">
                    <label for="exampleFormControlSelect1">Correo Electronico(*)</label>
                    <input type="text" class="form-control" id="correo" placeholder="Correo Electronico" required="true" value="<?=$key->correo?>">
                  </div>
                  <div class="col">
                    <label for="exampleFormControlSelect1">Dirección(*)</label>
                    <input type="text" class="form-control" id="direccion" placeholder="Dirección" required="true" value="<?=$key->direccion?>">
                  </div>
                  <div class="col">
                   <a href="#" class="btn btn-primary" onclick="update_client(<?=$id?>);">Actualizar</a>
                  </div>
                </div>
                <?php 
                  }
                 ?>
              </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <div class="alert alert-success alert-dismissible show fade" id="alert_ok" style="position: fixed; z-index: 100; top: 93%; right: 1%;display: none;" align="left">
        <div id="txt_ok"><strong>Exito! </strong>Operacion realizada correctamente</div>
  </div>
  <div class="alert alert-danger alert-dismissible show fade" id="alert_err" style="position: fixed; z-index: 100; top: 93%; right: 1%; display: none;" align="left">
        <div id="txt_err"><strong>Error! </strong>Ha ocurrido un problema</div>
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>styles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>styles/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>styles/dist/js/demo.js"></script>
<script type="text/javascript">
  //funcion para editar usuario
    function update_client(id){
      var nombre = $('#nombre').val(); 
      var nit = $('#nit').val();
      var correo = $('#correo').val();
      var direccion = $('#direccion').val();
      $.ajax({
        // la información a enviar
        // (también es posible utilizar una cadena de datos)
        data: {"nombre" : nombre, "nit" : nit, "correo" : correo,'id' : id,"direccion" : direccion},
        // la URL para la petición
        url : '<?=base_url()?>clientes/editar_cliente',
        // especifica si será una petición POST o GET
        type : 'POST',
        //mientars
        beforeSend:function(){
          console.log('se esta procesando su solicitud');
        }
    })
       .done(function(data){
          if (data == "bien") {
            document.getElementById('alert_ok').style.display = "block";
          }else if(data == "mal"){
            document.getElementById('alert_err').style.display = "block";
          }                                                                                                  
       });
       setTimeout(function(){ 
        $('#alert_ok').alert('close');
       }, 1500);
      setTimeout(function(){ 
          $('#alert_err').alert('close');
         }, 1500);
    }

    
</script>
</body>
</html>
