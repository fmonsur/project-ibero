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
              <h1 class="m-0">Gestionar usuarios</h1>
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
                  <h5 class="card-title">Listado de códigos</h5>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>

                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <table id="tbl_usuarios" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size: 14px;">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th><i class="fa fa-user"></i></th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Fecha registro</th>
                            <th>Proyectos</th>
                            <th>Ganacias</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td><button class="btn btn-sm btn-outline-info" onclick="perfilDeUsuaril()"><i class="fas fa-eye"></i></button></td>
                            <td>Francisco Monsalve</td>
                            <td>monsalveuribe@gmail.com</td>
                            <td>2021-11-29</td>
                            <td>0</td>
                            <td>$0</td>
                            <td>
                              <i class="fa fa-toggle-on text-success mr-3" aria-hidden="true"></i>
                              <!-- <i class="fa fa-toggle-off text-warning" aria-hidden="true"></i> -->
                              <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </td>
                          </tr>
                          <tr>
                            <td>1</td>
                            <td><button class="btn btn-sm btn-outline-info" onclick="perfilDeUsuaril()"><i class="fas fa-eye"></i></button></td>
                            <td>Jhonn Jairo Leal</td>
                            <td>lealexas@gmail.com</td>
                            <td>2021-11-25</td>
                            <td>0</td>
                            <td>$0</td>
                            <td>
                              <!-- <i class="fa fa-toggle-on text-success" aria-hidden="true"></i> -->
                              <i class="fa fa-toggle-off text-warning mr-3" aria-hidden="true"></i>
                              <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </td>
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

    <script src="../../public/js/gestionar-usuarios.js"></script>
  </body>
  </html>
