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
              <h1 class="m-0">Perfil de usuario</h1>
            </div><!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

          <div class="row">

            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <!-- <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture"> -->
                  </div>

                  <h3 class="profile-username text-center">Francisco Monsalve</h3>

                  <p class="text-muted text-center">Ingeniero de Software</p>

                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>Proyectos<br>iniciados</b> <a class="float-right">0</a>
                    </li>
                    <li class="list-group-item">
                      <b>Proyectos<br>terminados</b> <a class="float-right">0</a>
                    </li>
                    <li class="list-group-item">
                      <b>Ranking</b> <a class="float-right">0</a>
                    </li>
                  </ul>

                  <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
              <div class="card card-primary card-outline">
                <div class="card-header">
                  Cambiar contraseña
                </div>
                <div class="card-body">
                  <form action="">

                    <div class="form-group row">
                      <div class="col-12">
                        <label for="inputName" class="">Nueva contraseña</label>
                        <input type="password" class="form-control" id="inputName" placeholder="Nueva contraseña">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-12">
                        <label for="inputName" class="">Contraseña anterior</label>
                        <input type="password" class="form-control" id="inputName" placeholder="Contraseña anterior">
                      </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                      <div class="col-12">
                        <button class="btn btn-outline-success btn-block">Guardar</button>
                      </div>
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>


            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Permisos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Proyectos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#userrol" data-toggle="tab">Rol</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">



                     <table id="tbl_permisos" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size: 14px;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Código</th>
                          <th>Nombre</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>1001</td>
                          <td>Acceso a la plataforma</td>
                          <td><button class="btn btn-sm btn-success">Asignado</button></td>
                        </tr>

                        <tr>
                          <td>1</td>
                          <td>1002</td>
                          <td>Administrador - Usuarios</td>
                          <td><button class="btn btn-sm btn-success">Asignado</button></td>
                        </tr>

                        <tr>
                          <td>1</td>
                          <td>1003</td>
                          <td>Administrador - Nuevo Usuario</td>
                          <td><button class="btn btn-sm btn-success">Asignado</button></td>
                        </tr>

                        <tr>
                          <td>1</td>
                          <td>1004</td>
                          <td>Administrador - Gestión de usuarios</td>
                          <td><button class="btn btn-sm btn-success">Asignado</button></td>
                        </tr>

                        <tr>
                          <td>1</td>
                          <td>1005</td>
                          <td>Administrador - Proyectos</td>
                          <td><button class="btn btn-sm btn-outline-danger">Sin asignar</button></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <table id="tbl_proyectos" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size: 14px;">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nombre</th>
                          <th>Detalle</th>
                          <th>Fecha inicio</th>
                          <th>Fecha fin</th>
                          <th>Estado</th>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>

                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Nombre">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Apellido</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Apellido">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Correo</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Correo">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Celular</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Celular">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">País</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="País">
                        </div>
                      </div>
                      <hr>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experiencia</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experiencia"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Habilidades</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experiencia"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-info">Guardar</button>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="tab-pane" id="userrol">
                    Seleccione el rol de usuario
                    <form action="">

                      <div class="form-group row">
                        <select id="id_cliente" name="id_cliente" class="selectpicker" title="-- Seleccione Rol --" data-live-search="true" data-width="100%" data-size="5" data-style="btn-primary" required>
                          <option value="1">Usuario</option>
                          <option value="2">Director</option>
                          <option value="3">Administrador</option>
                        </select>
                      </div>
                      <div class="form-group row">
                        <button class="btn btn-outline-primary">Guardar</button>  
                      </div>
                    </form>

                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

          <!-- <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Datos del usuario</h5>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>

                  </div>
                </div>
                <div class="card-body">
                  
                  <div class="row">
                    

                  </div>
               




                </div>
              </div>
            </div>
          </div> -->



        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    

    <?php include "../../estructura/footer.php" ?>
  </div>

  <?php include "../../estructura/estructura-button.php" ?>

  <script src="../../public/js/perfil-usuario.js"></script>
</body>
</html>
