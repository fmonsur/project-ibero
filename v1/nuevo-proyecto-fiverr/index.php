<?php 
if (isset($_GET['id_proyecto']) && !empty($_GET['id_proyecto'])) {
  $id_proyecto = $_GET['id_proyecto'];
}else{
  $id_proyecto = '';
}
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
            <div class="col-12 form-group">
              <button type="button" class="btn btn-outline-light float-right mt-3" onclick="history.back()">Volver</button>
            </div>
          </div>

          <form class="row" id="frm_nuevo_proyecto">
            <div class="col-12">
              <div class="card">
                <div class="card-body">

                  <div class="row" id="nombre_proyecto">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <span class="badge badge-pill badge-success" id="lbl_guardado">Guardado</span>
                      <h3><span>ID </span><span id="lbl_id_proyecto"></span><span>&nbsp; - &nbsp;</span><span id="lbl_nombre">Nombre del proyecto</span></h3>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <input type="hidden" id="id_proyecto" name="id_proyecto" value="<?php echo $id_proyecto ?>">

                    <!-- ========================================================================================= -->
                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                      <label for="nivel">Nivel</label>
                      <select id="nivel" name="nivel" class="selectpicker" title="-- Seleccione nivel --"data-width="100%" data-size="5" data-style="btn-primary" required>
                      </select>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                      <label for="valor_proyecto">Valor proyecto</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
                        <input type="number" class="form-control" id="valor_proyecto" name="valor_proyecto" placeholder="Valor" required>
                      </div>
                    </div>
                    <!-- ========================================================================================= -->

                  </div>
                  <!-- ========================================================================================= -->
                  <div class="row">

                    <div class="col-lg-2 col-md-6 col-sm-12 form-group">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="arte_check" name="arte_check" value="1">
                        <label class="form-check-label" for="arte_check">Arte</label>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 form-group" >
                      <div class="form-check form-check-inline" id="div_subdireccioin_arte">
                        <input class="form-check-input" type="checkbox" id="subdireccioin_arte" name="subdireccioin_arte" value="1">
                        <label class="form-check-label" for="subdireccioin_arte">Subdirección de Arte</label>
                      </div>
                    </div>

                    <div class="col-lg-2 col-md-6 col-sm-12 form-group border-left">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="animacion_check" name="animacion_check" value="1">
                        <label class="form-check-label" for="animacion_check">Animación</label>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                      <div class="form-check form-check-inline"  id="div_subdireccioin_animacion">
                        <input class="form-check-input" type="checkbox" id="subdireccioin_animacion" name="subdireccioin_animacion" value="1">
                        <label class="form-check-label" for="subdireccioin_animacion">Subdirección de Animación</label>
                      </div>
                    </div>

                  </div>
                  <div class="row" id="selecion-radio">
                    <p style="color: red;">Seleccione una opción</p>
                  </div>
                  <!-- ========================================================================================= -->
                  <hr>
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group border-right">
                      <label for="valor_extra_arte">Extra Arte</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
                        <input type="number" class="form-control" id="valor_extra_arte" name="valor_extra_arte" placeholder="Valor extra">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group border-right">
                      <label for="valor_extra_animacion">Extra Animación</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
                        <input type="number" class="form-control" id="valor_extra_animacion" name="valor_extra_animacion" placeholder="Valor extra">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group border-right">
                      <label for="valor_extra_sonido">Extra Sonido</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
                        <input type="number" class="form-control" id="valor_extra_sonido" name="valor_extra_sonido" placeholder="Extra sonido">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 form-group">
                      <label for="valor_tip">Valor TIP</label>
                      <div class="input-group mb-2">
                        <div class="input-group-prepend">
                          <div class="input-group-text">$</div>
                        </div>
                        <input type="number" class="form-control" id="valor_tip" name="valor_tip" placeholder="Valor TIP">
                      </div>
                    </div>

                  </div>
                  <br>
                  <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="adelanto_check" name="adelanto_check" value="1">
                      <label class="form-check-label" for="adelanto_check">Adelanto</label>
                    </div>
                    <!-- <button type="button" class="btn btn-success" onclick="calcularProyecto()">Calcular</button> -->
                    <button type="submit" class="btn btn-success">Guardar proyecto</button>
                    <!-- <button type="button" class="btn btn-success" onclick="validarAdelanto()">Calcular</button> -->
                    <!-- <span class="text-danger" id="cambiar-seleccion">Debes cambiar la selección</span> -->
                  </div>
                  <br>

                </div>
              </div>
            </div>
          </form>








          <div id="paneles">
            <!-- // *******************************************************
            //     SECCIÓN DE DIRECCIONES
            // ******************************************************* -->
            <div class="row" id="seccion_directores">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">

                  <div class="card-header">
                    <h5 class="card-title">Directores </h5>&nbsp;&nbsp;
                    <small>
                      (<span class="text-warning lbl_valor_adminstrativo" id=""></span>)
                    </small>
                    <input type="hidden" id="valor_adminstrativo">
                    <div class="card-tools">
                      <button type="button" class="btn btn-outline-secondary">Limpiar</button>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>


                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="form-group">
                          <div id="select_direccion_arte">
                            <div>
                              <label for="direccion_arte">Dirección de Arte</label>
                              <button type="button" class="btn btn-sm btn-outline-light float-right" onclick="btnAgregarUsuario('#direccion_arte',2)">Agregar</button>
                            </div>
                            <select id="direccion_arte" name="direccion_arte" class="selectpicker" title="Seleccione opción" data-live-search="true" data-width="100%" data-size="5" data-style="btn-primary"></select>
                          </div>
                        </div> 
                        <div class="form-group">
                          <div id="select_direccion_animacion">
                            <div>
                              <label for="direccion_animacion">Dirección de animación</label>
                              <button type="button" class="btn btn-sm btn-outline-light float-right" onclick="btnAgregarUsuario('#direccion_animacion',3)">Agregar</button>
                            </div>
                            <select id="direccion_animacion" name="direccion_animacion" class="selectpicker" title="Seleccione opción" data-live-search="true" data-width="100%" data-size="5" data-style="btn-primary"></select>
                          </div>
                        </div> 
                      </div>
                      <div class="col-lg-8 col-md-12 col-sm-12">
                        <table id="tbl_directores" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size:13px ;">
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
            //     SECCIÓN DE ARTE
            // ******************************************************* -->
            <div class="row" id="seccion_arte">
              <div class="col-lg-12 col-md-12 col-sm-12">
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
                    <input type="hidden" id="valor_arte_final">
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
            <div class="row" id="seccion_animacion">
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
                    <input type="hidden" id="valor_animacion_final">
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
            <div class="row" id="seccion_sonido">
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
                            <label for="direccion_sonido">Director de sonido</label>
                            <button type="button" class="btn btn-sm btn-outline-light float-right" onclick="btnAgregarUsuario('#direccion_sonido',4)">Agregar</button>
                          </div>
                          <select id="direccion_sonido" name="direccion_sonido" class="selectpicker" title="Seleccione opción" data-live-search="true" data-width="100%" data-size="5" data-style="btn-primary"></select>
                        </div>
                        <div class="form-group">
                          <div>
                            <label for="sonidistas">Sonidistas</label>
                            <button type="button" class="btn btn-sm btn-outline-light float-right" onclick="btnAgregarUsuario('#sonidistas',7)">Agregar</button>
                          </div>
                          <select id="sonidistas" name="sonidistas" class="selectpicker" title="Seleccione opción" data-live-search="true" data-width="100%" data-size="5" data-style="btn-primary"></select>
                        </div> 
                      </div>
                      <div class="col-lg-8 col-md-12 col-sm-12">
                        <table id="tbl_dir_sonido" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size:13px ;">
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
                        <hr>
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
              <div class="col-lg-6 col-md-6 col-sm-12" id="seccion_extra_arte">
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
                            <th>Perfil</th>
                            <th>Nombre</th>
                            <th>%</th>
                            <th>Valor</th>
                            <th>Op</th>
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
              <div class="col-lg-6 col-md-6 col-sm-12" id="seccion_extra_animacion">
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

                            <th>Perfil</th>
                            <th>Nombre</th>
                            <th>%</th>
                            <th>Valor</th>
                            <th>Op</th>
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

<script src="../../public/js/nuevo-proyecto-fiverr.js"></script>
</body>
</html>
<?php 

?>
