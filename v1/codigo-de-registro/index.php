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
            <div class="col-sm-6">
              <h1 class="m-0">Nuevo código de registro</h1>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">

            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <button class="btn btn-outline-primary btn-lg btn-block" onclick="generarCodigo()">Generar código</button>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3 align-content-center">
              <div class="info-box mb-3  elevation-3 align-content-center">
                <p id="codigo" class="h1 align-middle ml-4"></p>
              </div>
              <!-- <span class="badge-danger text-center h1 p-3">khkjhkj</span> -->
            </div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <button class="btn btn-outline-success btn-lg btn-block" onclick="guardarCodigo()">Guardar</button>
              </div>
            </div>

            <!-- fix for small devices only -->





          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Listado de códigos</h5>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                   <!--  <div class="btn-group">
                      <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                        <i class="fas fa-wrench"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" role="menu">
                        <a href="#" class="dropdown-item">Action</a>
                        <a href="#" class="dropdown-item">Another action</a>
                        <a href="#" class="dropdown-item">Something else here</a>
                        <a class="dropdown-divider"></a>
                        <a href="#" class="dropdown-item">Separated link</a>
                      </div>
                    </div>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button> -->
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <table id="tbl_codigos" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Código</th>
                            <th>Estado</th>
                            <th>Fecha de uso</th>
                            <th>Usuario</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>APH918</td>
                            <td><span class="badge badge-warning">Usado</span></td>
                            <td>2021-11-29</td>
                            <td>monsalveuribe@gmail.com</td>
                          </tr>
                          <tr>
                            <td>2</td>
                            <td>OEB375</td>
                            <td><span class="badge badge-warning">Usado</span></td>
                            <td>2021-11-25</td>
                            <td>lealexas@gmail.com</td>
                          </tr>
                          <tr>
                            <td>3</td>
                            <td>UME249</td>
                            <td><span class="badge badge-success">Disponible</span></td>
                            <td></td>
                            <td></td>
                          </tr>
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

    <script src="../../public/js/codigo-de-registro.js"></script>
  </body>
  </html>
