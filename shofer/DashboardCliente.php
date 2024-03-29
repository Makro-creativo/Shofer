<?php 
  include "./config/conexion.php";

  if(!isset($_SESSION)) {
    session_start();
  }

  $uid = $_SESSION['UID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="assets/images/favicon_shofer.svg" type="image/x-icon">
  <title>CHO-FER - Dashboard</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./assets/css/index.css">
  <style>
    .navbar-light {
      background-color: #1c1c1d !important;
    }

    .sidebar-brand {
      background-color: #555555 !important;
    }
  </style>
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include "./partials/menuLeft.php" ?>

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
       <?php include "./partials/navbar.php" ?>

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Panel de control</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="DashboardCliente.php">Inicio</a></li>
              <li class="breadcrumb-item active" aria-current="page">Panel de control</li>
            </ol>
          </div>

          <div class="row mb-3">   
            <!-- Pending Orders Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Mis servicios (Realizados)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php 
                          include "./config/conexion.php";

                          $search_data_orders = "SELECT * FROM orders WHERE id_user = '$uid'";
                          $result_data_orders = mysqli_query($conexion, $search_data_orders);

                          $count_orders = mysqli_num_rows($result_data_orders);

                          echo $count_orders;
                        ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="bi bi-flower2 fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

    
          </div>
          <!--Row-->


          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No estás apunto de irte!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Estás seguro de cerrar sesión</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancelar</button>
                  <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>

      <?php include "./partials/footer.php" ?>
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../js/demo/chart-area-demo.js"></script>
  <script type="text/javascript">
      function cleanNotificationAnswer() {
        $.ajax({
          url: "./notifications-answer.php",
          type: "POST",
          processData:false,
          success: function(data){
            $("#notification-count-answer").remove();                  
          },
          error: function(error){
            console.log(error);
          }           
        });
      }                                  
  </script>
</body>

</html>