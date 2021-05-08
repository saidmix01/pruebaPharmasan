<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Prueba | Clientes</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>styles/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>styles/dist/css/adminlte.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?=base_url()?>home">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Clients</li>
  </ol>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
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
      <br>
      <div class="card">
        <div class="card-body">
          <h3>Administración de Cliente</h3>
          <hr>
          <div class="row">
            <div class="col-md-12" align="center">
              <form>
                <div class="row">
                  <div class="col">
                    <label for="exampleFormControlSelect1">Nombre(*)</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombres" required="true">
                  </div>
                  <div class="col">
                    <label for="exampleFormControlSelect1">Nit(*)</label>
                    <input type="text" class="form-control" id="nit" placeholder="Nit" required="true">
                  </div>
                  <div class="col">
                    <label for="exampleFormControlSelect1">Correo Electronico(*)</label>
                    <input type="text" class="form-control" id="correo" placeholder="Correo Electronico" required="true">
                  </div>
                  <div class="col">
                    <label for="exampleFormControlSelect1">Direccion(*)</label>
                    <input type="text" class="form-control" id="direccion" placeholder="Direccion" required="true">
                  </div>
                  <div class="col">
                   <a href="#" class="btn btn-primary" onclick="crear();">Crear</a>
                  </div>
                </div>
              </form>
           <hr>
           <div class="table-responsive">
            <!--  Tabla usuarios  -->
             <table id="example1" class="table table-sm table-bordered table-hover">
                      <thead>
                      <tr align="center">
                        <th>NIT</th>
                        <th>NOMBRE</th>
                        <th>CORREO</th>
                        <th>DIRECCION</th>
                        <th>ACCIONES</th>
                      </tr>
                      </thead>
                      <tbody id="tabla_user">
                        <?php 
                          foreach ($allclientes->result() as $key) {
                         ?>
                      <tr align="center">
                        <td><?=$key->nit?></td>
                        <td><?=$key->nombres?></td>
                        <td><?=$key->correo?></td>
                        <td><?=$key->direccion?></td>
                        <td>
                          <a href="#" onclick="del_cliente(<?=$key->id_client?>);"><i class="far btn btn-outline-danger fa-trash-alt"></i></a>
                          <a href="<?=base_url()?>clientes/cargar_info_cliente?id=<?=$key->id_client?>"><i class="far btn btn-outline-info fa-edit"></i></a>
                        </td>
                      </tr>
                      <?php 
                        }
                       ?>
                     </tbody>
                  </table>
                </div>
            </div>
          </div>
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
  <!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<!--MIS SCRIPTS-->
<script type="text/javascript">
  function crear() {
    var nombre = $('#nombre').val(); 
    var nit = $('#nit').val();
    var correo = $('#correo').val();
    var direccion = $('#direccion').val();
       $.ajax({
        // la información a enviar
        // (también es posible utilizar una cadena de datos)
        data: {"nombre" : nombre, "nit" : nit, "correo" : correo,"direccion" : direccion},
        // la URL para la petición
        url : '<?=base_url()?>clientes/crear_cliente',
        // especifica si será una petición POST o GET
        type : 'POST',
        //mientars
        beforeSend:function(){
          console.log('se esta procesando su solicitud');
        }
    })
       .done(function(data){
          if (data == "bien") {
            cargar_tabla();
            document.getElementById('alert_ok').style.display = "block";
          }else if(data == "mal"){
            cargar_tabla();
            document.getElementById('alert_err').style.display = "block";
          }                                                                                                
       });
        setTimeout(function(){ 
          $('#alert_ok').alert('close');
         }, 1500);
        setTimeout(function(){ 
          $('#alert_err').alert('close');
         }, 1500);
        setTimeout(function(){ 
          location.reload();
         }, 1000);
  }

  //funcion para eliminar usuario
    function del_cliente(id){
       $.ajax({
        // la información a enviar
        // (también es posible utilizar una cadena de datos)
        data: {"id" : id},
        // la URL para la petición
        url : '<?=base_url()?>clientes/borrar_cliente',
        // especifica si será una petición POST o GET
        type : 'POST',
        //mientars
        beforeSend:function(){
          console.log('se esta procesando su solicitud');
        }
    })
       .done(function(data){
          if (data == "bien") {
            cargar_tabla();
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
        setTimeout(function(){ 
          location.reload();
         }, 1500);
        
    }
</script>
<script>
    $(document).ready(function(){
         $('#example1').DataTable({
          "paging": true,
          "pageLength": 25,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "language":{
          "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
      }
        });
    });
    function cargar_tabla(){
      var result = document.getElementById("tabla_user");
      var xmlhttp;
            if (window.XMLHttpRequest) {
                xmlhttp = new XMLHttpRequest();
            } else {
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    result.innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "<?=base_url()?>clientes/load_tabla?val=1", true);
            xmlhttp.send();
    }
  </script>
</body>
</html>