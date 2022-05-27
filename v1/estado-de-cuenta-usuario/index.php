<?php 
if (isset($_GET['id_usuario']) && !empty($_GET['id_usuario'])) {
  $id_usuario = $_GET['id_usuario'];
}else{
  $id_usuario = '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

 <?php include "../../estructura/estructura-top.php" ?>
</head>


<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <?php include "../../estructura/preload-logo.php" ?>
    <?php include "../../estructura/navbar.php" ?>
    <?php include "../../estructura/sidebar.php" ?>





    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-12">
              <input type="hidden" id="id_usuario" value="<?php echo $id_usuario ?>">
              <button type="button" class="btn btn-outline-secondary float-right" onclick="history.back()">Volver</button>
              <h1 class="m-0">Estados de cuenta usuario</h1>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">

                  <!-- <div class="card-tools">
                    <button type="button" class="btn btn-light">Volver</button>

                  </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <table id="tbl_gestionar_proyectos" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size: 12px; ">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Nivel</th>
                            <th>Valor</th>
                          <!--   <th>Anticipo</th>
                            <th>Cliente</th>
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th>Dias</th>
                            <th>Estado</th> -->
                            <th>OP</th>
                          </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- ./card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->


        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <!-- <aside class="control-sidebar control-sidebar-dark"> -->
      <!-- Control sidebar content goes here -->
      <!-- </aside> -->
      <!-- /.control-sidebar -->

      <?php include "../../estructura/footer.php" ?>
    </div>

    <?php include "../../estructura/estructura-button.php" ?>

    <script src="../../public/js/estado-de-cuenta-usuario.js"></script>
  </body>
  </html>
