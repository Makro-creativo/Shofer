<?php 
    include "./config/conexion.php";

    error_reporting(0);

    if(!isset($_SESSION)) {
        session_start();
    }

    $uid = $_SESSION['UID'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHO-FER - lista de datos</title>
    <link rel="shortcut icon" href="assets/images/favicon_shofer.svg" type="image/x-icon">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <style>
    .navbar-light {
      background-color: #1c1c1d !important;
    }

    .sidebar-brand {
      background-color: #555555 !important;
    }
  </style>
</head>
<body>
    <div id="wrapper">
        <?php include "./partials/menuLeft.php" ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/navbar.php" ?>

                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="text-dark">Servicios</h2>
                            <a href="DashboardChofer.php" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-counterclockwise"></i>
                                Regresar atrás
                            </a>
                        </div>

                        <div class="co-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 text-primary">Servicios</h6>

                                    <?php if($typeUser === "Chofer") {?>
                                        <a href="new-data-driver.php" class="btn btn-primary btn-sm">
                                            <i class="bi bi-plus-circle"></i>
                                            Registrar mis datos
                                        </a>
                                    <?php }?>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush table-hover" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Vehículo</th>
                                                    <th>Placas</th>
                                                    <th>Dirección</th>
                                                    <th>Número de cuenta</th>
                                                    <th>Número de tarjeta de crédito</th>
                                                    <th>Nombre del banco</th>
                                                    <th>Precio por kilometro</th>
                                                    <th>Foto Ine</th>
                                                    <th>Tarjeta de circulación</th>
                                                    <th>Foto personal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $search_data_drivers = "SELECT * FROM drivers WHERE id_user = '$uid'";
                                                    $result_data_drivers = mysqli_query($conexion, $search_data_drivers);

                                                    while($row = mysqli_fetch_array($result_data_drivers)) {
                                                ?>  
                                                <tr>
                                                    <td><?php echo $row['id']; ?></td>
                                                    <td><?php echo $row['name_driver']; ?></td>
                                                    <td><?php echo $row['vehicle']; ?></td>
                                                    <td><?php echo $row['plates']; ?></td>
                                                    <td><?php echo $row['adress']; ?></td>
                                                    <td><?php echo $row['account_number']; ?></td>
                                                    <td><?php echo $row['card_number']; ?></td>
                                                    <td><?php echo $row['bank']; ?></td>
                                                    <td><?php echo number_format($row['price_for_kilometer'], 2)." Pesos"; ?></td>
                                                    <td><img src="<?php echo $row['image_ine']; ?>" alt="" class="img-fluid"></td>
                                                    <td><img src="<?php echo $row['image_circulacion']; ?>" alt="" class="img-fluid"></td>
                                                    <td><img src="<?php echo $row['image_personal']; ?>" alt="" class="img-fluid"></td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <br>

            <?php include "./partials/footer.php" ?>

        </div>

    </div>








    <script src="../vendor/jquery/jquery.min.js"></script>      
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/ruang-admin.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../js/demo/chart-area-demo.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>