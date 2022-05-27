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
              <h1 class="m-0">Nuevo proyecto</h1>
            </div>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="container-fluid">
          <form method="post" id="frm_nuevo_proyecto">
            <div class="row">
              <div class="col-md-8">
                <!-- ============================================= -->
                <!-- Tarjeta del Proyecto -->
                <!-- ============================================= -->
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Datos del proyecto</h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-12 form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                      </div> 
                      <div class="col-lg-4 form-group">
                        <label for="id_moneda">Divisa</label>
                        <select id="id_moneda" name="id_moneda" class="selectpicker" title="-- Seleccione divisa --"data-width="100%" data-size="5" data-style="btn-primary" required>
                        </select>
                      </div>
                      <div class="col-lg-8 form-group">
                        <label for="nivelProyecto">Nivel</label>
                        <select id="nivelProyecto" name="nivelProyecto" class="selectpicker" title="-- Seleccione nivel --"data-width="100%" data-size="5" data-style="btn-primary" required>
                        </select>
                      </div>
                      <div class="col-lg-4 form-group">
                        <label for="valor_proyecto">Valor proyecto</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                          <input type="number" class="form-control" id="valor_proyecto" name="valor_proyecto" placeholder="Valor" required>
                        </div>
                      </div>



                      <div class="col-lg-8 form-group">
                        <br>
                        <label id="lbl_check_obligatorio" class="text-danger">Debe seleccionar al menos una opción</label>
                        <br>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="check_arte" name="check_arte" value="1">
                          <label class="form-check-label" for="check_arte">Subdirección de Arte</label>
                        </div>

                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="checkbox" id="check_animacion" name="check_animacion" value="1">
                          <label class="form-check-label" for="check_animacion">Subdirección de Animación</label>
                        </div>
                      </div>



                      <div class="col-lg-12 form-group">
                        <label for="id_cliente">Cliente</label>
                        <select id="id_cliente" name="id_cliente" class="selectpicker" title="-- Seleccione cliente --"data-width="100%" data-size="5" data-style="btn-primary" data-live-search="true" required>
                        </select>
                      </div>
                      <div class="col-lg-4 form-group">
                        <label for="fecha_inicio">Fecha de inicio </label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" >
                      </div>
                      <div class="col-lg-4 form-group">
                        <label for="fecha_posible_fin">Fecha posible fin </label>
                        <input type="date" class="form-control" id="fecha_posible_fin" name="fecha_posible_fin" >
                      </div>
                      <div class="col-lg-4 form-group">
                        <label for="valor_tip">Valor TIP</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                          <input type="number" class="form-control" id="valor_tip" name="valor_tip" placeholder="Valor TIP">
                        </div>
                      </div>
                      <div class="col-lg-4 form-group">
                        <label for="valor_pago_eps">Valor pago EPS</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                          <input type="number" class="form-control" id="valor_pago_eps" name="valor_pago_eps" placeholder="Valor EPS">
                        </div>
                      </div>
                      <div class="col-lg-4 form-group">
                        <label for="valor_pago_retencion">Valor retenciones</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                          <input type="number" class="form-control" id="valor_pago_retencion" name="valor_pago_retencion" placeholder="Valor retenciones">
                        </div>
                      </div>                      
                    </div>
                  </div>
                </div>                  
              </div>

              <div class="col-md-4">
                <!-- ============================================= -->
                <!-- Tarjeta de Arte y Animación-->
                <!-- ============================================= -->
                <div class="card">

                  <div class="card-header">
                    <h5 class="card-title">Arte y animación</h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>



                  <div class="card-body">
                    <div class="row">

                      <div class="col-lg-12">
                        <label for="valor_extra_arte">Extra Arte</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                          <input type="number" class="form-control" id="valor_extra_arte" name="valor_extra_arte" placeholder="Valor extra">
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <label for="valor_extra_animacion">Extra Animación</label>
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                          <input type="number" class="form-control" id="valor_extra_animacion" name="valor_extra_animacion" placeholder="Valor extra">
                        </div>
                      </div>

                    </div>
                  </div>




                </div>
                <!-- ============================================= -->
                <!-- Tarjeta de Anticipo -->
                <!-- ============================================= -->

                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Extre sonido</h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <!-- <label for="valor_extra_sonido"></label> -->
                        <div class="input-group mb-2">
                          <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                          </div>
                          <input type="number" class="form-control" id="valor_extra_sonido" name="valor_extra_sonido" placeholder="Extra sonido">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ============================================= -->
                <!-- Tarjeta de Observción -->
                <!-- ============================================= -->
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Observación</h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="col-lg-12 form-group">
                          <!-- <label for="detalle">Observación</label> -->
                          <textarea class="form-control" id="detalle" name="detalle" rows="3"></textarea>
                        </div>




                      </div>
                    </div>
                  </div>
                </div>



              </div>
              
              <div class=" col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="col-lg-4 form-group">
                      <label for="">&nbsp;</label>
                      <button type="submit" class="btn btn-success btn-block">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>  
        </div>
      </section>
    </div>

    <?php include "../../estructura/footer.php" ?>
  </div>

  <?php include "../../estructura/estructura-button.php" ?>

  <script src="../../public/js/nuevo-proyecto.js"></script>
</body>
</html>
