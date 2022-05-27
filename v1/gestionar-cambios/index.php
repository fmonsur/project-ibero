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
              <h1 class="m-0">Gestionar canjes</h1>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-md-12">
              <div class="card">




                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4 col-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-primary"><i class="fas fa-caret-down"></i> USD</span>
                        <h5 class="description-header" id="lbl_cantidad_usd">$0</h5>
                        <!-- <span class="description-text">TOTAL</span> -->
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-warning"><i class="fas fa-caret-down"></i> COP</span>
                        <h5 class="description-header" id="lbl_cambio_cop">$0</h5>
                        <!-- <span class="description-text">TOTAL</span> -->
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    

                    <div class="col-sm-4 col-6">
                      <div class="description-block">
                        <span class="description-percentage text-success"><i class="fas fa-caret-down"></i> Tasa Actual</span>
                        <h5 class="description-header" id="lbl_tasa">$0</h5>
                        <!-- <span class="description-text">TOTAL</span> -->
                      </div>
                      <!-- /.description-block -->
                    </div>
                  </div>
                  <!-- /.row -->
                </div>


              </div>
            </div>
          </div>


          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Agregar cambio</h5>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <form id="frm_nuevo_cambio">
                    <div class="row">

                      <div class="col-lg-4">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Cantidad" required>
                      </div>

                      <div class="col-lg-4">
                        <label for="cantidad_usd">Cantidad a cambiar</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                          <input type="number" class="form-control" id="cantidad_usd" name="cantidad_usd" placeholder="Cantidad" required>
                        </div>
                      </div>


                      <div class="col-lg-4">
                        <label for="cambio_cop">Valor de cambio COP</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                          <input type="number" class="form-control" id="cambio_cop" name="cambio_cop" placeholder="Valor COP" required>
                        </div>
                      </div>

                      <div class="col-lg-8">
                        <label for="detalle">Detalle</label>
                        <input type="text" class="form-control" id="detalle" name="detalle" placeholder="Detalle" >
                      </div>
                      
                      <div class="col-lg-4">
                        <label for="">&nbsp;</label>
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
                  <h5 class="card-title">Detalle de canjes</h5>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>

                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <table id="tbl_canjes" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size: 14px;">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>USD</th>
                            <th>COP</th>
                            <th>Tasa</th>
                            <th>Fecha</th>
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

  <script src="../../public/js/gestionar-cambios.js"></script>
</body>
</html>
