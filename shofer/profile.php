<?php 
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $name = $_SESSION['name'];
    $username = $_SESSION['username'];
    $typeUser = $_SESSION['Type'];

    if(isset($_POST['editProfile'])) {
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO-FER - perfil</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../vendor/datatables/dataTables.bootstrap4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <style>
    .navbar-light {
      background-color: #1c1c1d !important;
    }

    .sidebar-brand {
      background-color: #555555 !important;
    }
  </style>
    <style>
        .img-circle {
            margin: 0 auto !important;
            width:300px;
            height:300px;
            border-radius:150px;
            background-color: #6777EF !important;
        }

        .card {
            border-bottom-left-radius: 10px !important;
            border-bottom-right-radius: 10px !important;
            border-top-left-radius: 10px !important;
            border-top-right-radius: 10px !important;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLeft.php" ?>

        <?php 
            $idUser = (!empty ($_GET['id']) ) ? $_GET['id'] : NULL;   
                                                                                                                                                                          
            if ($idUser) {                                                       
                include "./config/conexion.php";    
                                                     
                $sql = "SELECT * FROM users WHERE id = '$idUser'"; 
                $result = mysqli_query($conexion, $sql);
                
                if($result) {
                    $row = mysqli_fetch_array($result);
                    
                    $id = $row['id'];
                }
            } 
        ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/navbar.php" ?>

                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="text-dark">Configuración de la cuenta</h2>

                            <?php if($typeUser === "Administrador") {?>
                                <a href="DashboardAdmin.php" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-house-door-fill"></i>
                                    Regresar a inicio
                                </a>
                            <?php }?>

                            <?php if($typeUser === "Cliente") {?>
                                <a href="DashboardCliente.php" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-house-door-fill"></i>
                                    Regresar a inicio
                                </a>
                            <?php }?>

                            <?php if($typeUser === "Chofer") {?>
                                <a href="DashboardChofer.php" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-house-door-fill"></i>
                                    Regresar a inicio
                                </a>
                            <?php }?>
                        </div>

                        <div class="col-md-5 col-sm-12 col-lg-5 col-xl-5 col-xxl-5 mt-4">
                            <div class="card shadow-lg p-2">
                                <img src="../img/boy.png" alt="Photo profile" class="card-img-top img-circle p-2">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <h5 class="card-text badge badge-primary">Nombre: <?php echo $name; ?></h5>
                                         </div>

                                        <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                            <p class="card-text badge badge-primary">
                                                 Nombre de usuario: <?php echo $username; ?>
                                            </p>
                                            </div>
                                    </div>

                                    <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <span class="badge badge-primary mx-auto">Tipo de rol: <?php echo $typeUser; ?></span>
                                            </div>
                                    </div>

                                    <a href="logout.php" class="btn btn-danger btn-block mt-4">Cerrar sesión</a>
                                    
                                </div>
                            </div>
                        </div>


                        <div class="col-md-7 col-sm-12 col-lg-7 col-xl-7 col-xxl-7 mt-4">
                            <div class="card shadow-lg">
                                <h2 class="p-4 text-center text-dark">Editar perfil</h2>
                                <div class="card-body">
                                    <form action="profile.php" method="POST">
                                        <input type="hidden" name="id_profile_edit" value="<?php echo $id; ?>">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div class="form-group">
                                                    <label>Nombre completo: </label>
                                                    <input value="<?php echo $name; ?>" type="text" name="name" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div class="form-group">
                                                    <label>Nombre de usuario: </label>
                                                    <input value="<?php echo $username; ?>" type="text" name="username" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Actualizar perfil" class="btn btn-primary btn-block" name="editProfile">
                                    </form>
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







        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/ruang-admin.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../js/demo/chart-area-demo.js"></script> 
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>
</html>