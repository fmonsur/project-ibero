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
              <h1 class="m-0">Porcentajes operativos</h1>
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
                  <h5 class="card-title">Confirguración de divisas</h5>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>

                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <table id="tbl_divisa" class="table table-striped table-border dt-responsive table-condensed table-hover" style="width:100%; font-size: 14px;">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>ISO</th>
                            <th>Estado</th>
                            <th>Opciones</th>                            
                          </tr>
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
      </section>
    </div>

    <?php include "../../estructura/footer.php" ?>
  </div>

  <?php include "../../estructura/estructura-button.php" ?>

  <script src="../../public/js/divisa.js"></script>
</body>
</html>
