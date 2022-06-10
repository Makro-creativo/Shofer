<?php 
    include "./config/conexion.php";

    if(isset($_POST['edit'])) {
        $idUserEdit = $_POST['id_user_edit'];
        $arrayUserEdit = explode("_", $idUserEdit);
        $idNameUserEdit = $arrayUserEdit[0];

        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['type'];

        $query_user_update = "UPDATE users SET id='$idUserEdit', name='$name', username='$username', password='$password', type='$type' WHERE id = '$idNameUserEdit'";
        $result_user_update = mysqli_query($conexion, $query_user_update);

        if($result_user_update) {
            echo "<script>window.location='edit-user.php?bien'; </script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO-FER - editar usuario</title>
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
<body id="page-top">
    <div id="wrapper">
        <?php include "./partials/menuLeft.php" ?>

        <?php   
            if(isset($_GET['bien'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se actualizo correctamente!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "new-users.php";
                });
            </script>
        <?php } ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/navbar.php" ?>

                <?php 
                    include "./config/conexion.php";

                    if(isset($_GET['id'])) {
                        $idUser = $_GET['id'];

                        $search_data_user = "SELECT * FROM users WHERE id = '$idUser'";
                        $result_data_user = mysqli_query($conexion, $search_data_user);

                        if($result_data_user) {
                            $row = mysqli_fetch_array($result_data_user);

                            $name = $row['name'];
                            $username = $row['username'];
                            $password = $row['password'];
                            $type = $row['type'];
                        }
                    }
                
                ?>

                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="text-dark">Editar usuario</h2>

                            <a href="new-users.php" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-counterclockwise"></i>
                                Regresar atrás
                            </a>
                        </div>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 text-primary">Editar usuario</h6>

                                    <a href="new-users.php" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i>
                                        Nuevo usuario
                                    </a>
                                </div>

                                <div class="card-body">
                                    <form action="edit-user.php" method="POST">
                                        <input type="hidden" name="id_user_edit" value="<?php echo $idUser; ?>">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Nombre completo: </label>
                                                    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Nombre de usuario: </label>
                                                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Contraseña: </label>
                                                    <input type="text" name="password" class="form-control" value="<?php echo $password; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Rol de usuario: </label>
                                                    <input type="text" name="type" class="form-control" value="<?php echo $type; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Actualizar" class="btn btn-primary btn-block" name="edit">
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




    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/ruang-admin.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../js/demo/chart-area-demo.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>