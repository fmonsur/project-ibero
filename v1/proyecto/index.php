<?php 
if (isset($_GET['id_proyecto']) && !empty($_GET['id_proyecto'])) {
  $id_proyecto = $_GET['id_proyecto'];
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <?php include "../../estructura/estructura-top.php" ?>
    <style type="text/css">
      .tabla {
        font-size: 12px;
      }
      .tabla tr {
        border-top : solid 1px #343A40;
      }
      .usr_porcent{
        background-color: #343A40;
        color: #fff;
        width: 50px;
        margin-top: 4px;
        margin-bottom: 4px;
      }
      .fa-save, .fa-trash{
        cursor: pointer;
      }
    </style>
  </head>
  <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
      <?php include "../../estructura/preload-logo.php" ?>
      <?php include "../../estructura/navbar.php" ?>
      <?php include "../../estructura/sidebar.php" ?>
      <div class="content-wrapper">
        <section class="content">
          <div class="container-fluid">
            <!-- // *******************************************************
            //     NOMBRE DEL PROYECTO
            // ******************************************************* -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-10">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="modal_datos_del_proyecto()"><i class="fa fa-eye"></i></button>&nbsp;
                        <span>ID proyecto </span><span><?php echo $id_proyecto?></span>
                        <!-- ID DEL PROYECTO -->
                        <input type="hidden" id="id_proyecto" name="id_proyecto" value="<?php echo $id_proyecto ?>">
                        <!-- VALOR ADMINISTRATITVO -->
                        <input type="hidden" id="valor_adminstrativo">
                        <!-- VALOR FINAL PROYECTO -->
                        <input type="hidden" id="valor_final_proyecto">
                        <h1 class="m-0" id="lbl_nombre"></h1>
                      </div>
                      <div class="col-2">
                        <button type="button" class="btn btn-outline-light float-right" onclick="history.back()">Volver</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>





            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">

                      <input type="hidden" id="valor_proyecto" name="valor_proyecto" class="form-control">
                      <input type="hidden" id="id_cliente" name="id_cliente">
                      <input type="hidden" id="nivel" name="nivel">
                      <input type="hidden" id="valor_avance" name="valor_avance">

                      <div class="col-lg-3 col-md-6 col-sm-12">
                        <span class="text-primary" onclick="distribucionPorcentajeAdministrativo()" style="cursor: pointer;">Porcentaje administrativo</span>
                      </div>





                      <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="form-check form-check-inline">
                          <input id="check_anticipo" name="check_anticipo" class="form-check-input" type="checkbox" id="check_arte" name="check_arte" value="1">
                          <label class="form-check-label" for="check_arte">Adelanto</label>
                        </div><br>
                        <!-- <button type="button" class="btn btn-success" onclick="calcularProyecto()">Calcular</button> -->
                        <button type="button" class="btn btn-success" onclick="validarAdelanto()">Calcular</button>
                        <span class="text-danger" id="cambiar-seleccion">Debes cambiar la selección</span>
                      </div>

                      <div class="col-lg-3 col-md-6 col-sm-12">
                        <!-- <div class="form-check form-check-inline"> -->
                          <label for="">Porcentaje admin Forja</label>
                          <input type="number" id="porcentaje_admin_forja" min="0" max="100">
                          <!-- </div> -->
                          <button type="button" class="btn btn-success" onclick="agregarValorAdministrativoForja()">Calcular</button>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-12">
                          <div class="form-group">
                            <label for="id_estado">Estado</label>
                            <select id="id_estado" name="id_estado" class="selectpicker" title="Seleccione opción"   data-width="100%" data-size="5" data-style="btn-primary"></select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <!-- // *******************************************************
              //     SECCIÓN DE ARTE
              // ******************************************************* -->
              <div class="row" id="div_arte">
                <div class="col-lg-12 col-md-12 col-sm-12" id="seccion_arte">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title">Arte </h5>&nbsp;&nbsp;
                      <span class="lbl_valor_arte_final"></span>&nbsp;&nbsp;
                      <small>(
                        <span class="lbl_porcentaje_arte text-success"></span>
                        <span class="text-success lbl_valor_arte"></span> + 
                        <span class="text-warning">Tip</span>
                        <span class="text-warning lbl_valor_tip_arte"></span>)
                      </small>
                      <input type="hidden" id="total_valor_arte">
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                          <div class="form-group">
                            <div>
                              <label for="direccion_arte">Dirección de Arte</label>
                              <button type="button" class="btn btn-sm btn-outline-light float-right" onclick="btnAgregarUsuario('#direccion_arte',2)">Agregar</button>
                            </div>
                            <select id="direccion_arte" name="direccion_arte" class="selectpicker" title="Seleccione opción" data-live-search="true" data-width="100%" data-size="5" data-style="btn-primary"></select>
                          </div> 
                          <div class="form-group">
                            <div>
                              <label for="artistas">Artistas</label>
                              <button type="button" class="btn btn-sm btn-outline-light float-right" onclick="btnAgregarUsuario('#artistas',5)">Agregar</button>
                            </div>
                            <select id="artistas" name="artistas" class="selectpicker" title="Seleccione opción" data-live-search="true" data-width="100%" data-size="5" data-style="btn-primary"></select>
                          </div> 
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12">
                          <table id="tbl_arte" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size:13px ;">
                            <thead>
                              <th>Rol</th>
                              <th>Nombre</th>
                              <th>%</th>
                              <th>Valor</th>
                              <th>Opciones</th>
                            </thead>
                            <tbody>  
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- // *******************************************************
              //     SECCIÓN DE ANIMACIÓN
              // ******************************************************* -->
              <div class="row" id="div_animacion">
                <div class="col-lg-12 col-md-12 col-sm-12" id="seccion_animacion">
                  <div class="card"> 
                    <div class="card-header">
                      <h5 class="card-title">Animación </h5>&nbsp;&nbsp;
                      <span class="lbl_valor_animacion_final"></span>
                      <small>(
                        <span class="lbl_porcenteje_animacion text-success"></span>
                        <span class="lbl_valor_animacion text-success"></span> + 
                        <span class="text-warning">Tip </span>
                        <span class="lbl_valor_tip_animacion text-warning"></span>)
                      </small>
                      <input type="hidden" id="total_valor_animacion">
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                          <div class="form-group">
                            <div>
                              <label for="direccion_arte">Dirección de animación</label>
                              <button type="button" class="btn btn-sm btn-outline-light float-right" onclick="btnAgregarUsuario('#direccion_animacion',3)">Agregar</button>
                            </div>
                            <select id="direccion_animacion" name="direccion_animacion" class="selectpicker" title="Seleccione opción" data-live-search="true" data-width="100%" data-size="5" data-style="btn-primary"></select>
                          </div> 
                          <div class="form-group">
                            <div>
                              <label for="artistas">Animadores</label>
                              <button type="button" class="btn btn-sm btn-outline-light float-right" onclick="btnAgregarUsuario('#animadores',6)">Agregar</button>
                            </div>
                            <select id="animadores" name="animadores" class="selectpicker" title="Seleccione opción" data-live-search="true" data-width="100%" data-size="5" data-style="btn-primary"></select>
                          </div> 
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12">
                          <table id="tbl_animacion" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size:13px ;">
                            <thead>
                              <th>Rol</th>
                              <th>Nombre</th>
                              <th>%</th>
                              <th>Valor</th>
                              <th>Opciones</th>
                            </thead>
                            <tbody>  
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- // *******************************************************
              //     SECCIÓN DE SONIDO
              // ******************************************************* -->
              <div class="row" id="div_sonido">
                <div class="col-lg-12 col-md-12 col-sm-12" id="seccion_sonido">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title">Extra Sonido </h5>&nbsp;&nbsp;
                      <span class="lbl_valor_extra_sonido_final"></span>
                      <small>(
                        <span class="lbl_valor_extra_sonido text-success"></span> - 
                        <span class="text-danger">Comisión </span>
                        <span class="lbl_valor_extra_sonido_comision text-danger"></span> + 
                        <span class="text-warning">Tip </span>
                        <span class="lbl_valor_tip_sonido text-warning"></span>)
                      </small>
                      <input type="hidden" id="valor_extra_sonido_final">
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                          <div class="form-group">
                            <div>
                              <label for="artistas">Sonidistas</label>
                              <button type="button" class="btn btn-sm btn-outline-light float-right" onclick="btnAgregarUsuario('#sonidistas',10)">Agregar</button>
                            </div>
                            <select id="sonidistas" name="sonidistas" class="selectpicker" title="Seleccione opción" data-live-search="true" data-width="100%" data-size="5" data-style="btn-primary"></select>
                          </div> 
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12">
                          <table id="tbl_sonido" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size:13px ;">
                            <thead>
                              <th>Rol</th>
                              <th>Nombre</th>
                              <th>%</th>
                              <th>Valor</th>
                              <th>Opciones</th>
                            </thead>
                            <tbody>  
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- // *******************************************************
              //     SECCIÓN DE EXTRA ARTE y EXTRA SONIDO
              // ******************************************************* -->
              <div class="row">
                <!-- ******************** EXTRA ARTE ******************** -->
                <div class="col-lg-6 col-md-6 col-sm-12" id="div_extra_arte">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title">Extra Árte </h5>&nbsp;&nbsp;
                      <span class="lbl_valor_extra_arte_final"></span>
                      <input type="hidden" id="valor_extra_arte_final">
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <table id="tbl_extra_arte" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size:13px ;">
                            <thead>
                              <th>Nombre</th>
                              <th>%</th>
                              <th>Valor</th>
                              <!-- <th>Opciones</th> -->
                            </thead>
                            <tbody>  
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- ******************** EXTRA ANIMACIÓN ******************** -->
                <div class="col-lg-6 col-md-6 col-sm-12" id="div_extra_animacion">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title">Extra Animación </h5>&nbsp;&nbsp;
                      <span class="lbl_valor_extra_animacion_final"></span>
                      <input type="hidden" id="valor_extra_animacion_final">
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                          <table id="tbl_extra_animacion" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size:13px ;">
                            <thead>

                              <th>Nombre</th>
                              <th>%</th>
                              <th>Valor</th>
                              <!-- <th>Opciones</th> -->
                            </thead>
                            <tbody>  
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </section>
      </div>

      <?php 
      include "../ventanas-modales/editar-porcentaje.php";
      include "../ventanas-modales/porcentajes-administrativos.php";
      include "../ventanas-modales/datos-del-proyecto.php";

      include "../../estructura/footer.php" 
      ?>
    </div>

    <?php include "../../estructura/estructura-button.php" ?>

    <script src="../../public/js/proyecto.js"></script>
  </body>
  </html>
<?php }else{
  header('Location: ../');

} 
?>
