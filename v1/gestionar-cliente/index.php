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
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Gestión de Clientes</h1>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">


          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Registro de nuevo cliente</h5>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <form id="frm_nuevo_cliente">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="nombre">Nombre</label>
                          <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <label for="porcentaje_comision">Comisión</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">%</div>
                          </div>
                          <input type="number" class="form-control" id="porcentaje_comision" name="porcentaje_comision" placeholder="Comisión" required>
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <label for="porcentaje_anticipo">Anticipo</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">%</div>
                          </div>
                          <input type="number" class="form-control" id="porcentaje_anticipo" name="porcentaje_anticipo" placeholder="Anticipo" required>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-lg-4">
                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Listado de clientes</h5>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>

                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <table id="tbl_clientes" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size: 14px;">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Comisión</th>
                            <th>Anticipo</th>
                            <th>Estado</th>
                            <th>Opciones</th>                            
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

        </div>
      </section>
    </div>

    <?php include "../../estructura/footer.php" ?>
  </div>

  <?php include "../../estructura/estructura-button.php" ?>

  <script src="../../public/js/gestionar-cliente.js"></script>
</body>
</html>
