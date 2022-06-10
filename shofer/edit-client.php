<?php 
    include "./config/conexion.php";

    if(isset($_POST['edit'])) {
       $idUser = $_POST['id_client_edit'];
       $numberClient = $_POST['number_client'];
       $nameFlower = $_POST['name_flower'];
       $nameClient = $_POST['name_client'];
       $phone = $_POST['phone'];
       $adress = $_POST['adress'];
       $status = $_POST['status'];

       $query_update_client = "UPDATE clients SET id_user='$idUser', number_client='$numberClient', name_flower='$nameFlower', name_client='$numberClient', phone='$phone', adress='$adress', status='$status' WHERE id_user = '$idUser'";
       $result_update_client = mysqli_query($conexion, $query_update_client);

       if($result_update_client) {
        echo "<script>window.location='edit-client.php?bien'; </script>";
       }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO-FER - editar cliente</title>
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
                        window.location = "new-clients.php";
                });
            </script>
        <?php } ?>


        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/navbar.php" ?>

                <?php 
                    include "./config/conexion.php";
                    
                    if(isset($_GET['id_user'])) {
                        $idUser = $_GET['id_user'];

                        $search_client = "SELECT * FROM clients WHERE id_user = '$idUser'";
                        $result_client = mysqli_query($conexion, $search_client);

                        if($result_client) {
                            $row = mysqli_fetch_array($result_client);

                            $numberClient = $row['number_client'];
                            $nameFlower = $row['name_flower'];
                            $nameClient = $row['name_client'];
                            $phone = $row['phone'];
                            $adress = $row['adress'];
                            $status = $row['status'];
                        }
                    }
                ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="text-dark">Editar usuario</h2>

                                <a href="new-clients.php" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                    Regresar atrás
                                </a>
                            </div>

                            <div class="card shadow-lg">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary m-0">Editar usuario</h6>

                                    <a href="new-clients.php" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i>
                                        Nuevo cliente
                                    </a>
                                </div>

                                <div class="card-body">
                                    <form action="edit-client.php" method="POST">
                                        <input type="hidden" name="id_client_edit" value="<?php echo $idUser; ?>">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Número de cliente: </label>
                                                    <input value="<?php echo $numberClient; ?>" type="text" placeholder="Ejemplo: cli01, cli02, etc..." name="number_client" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Nombre de la florería: </label>
                                                    <input value="<?php echo $nameFlower; ?>" type="text" placeholder="Ejemplo: Florería fernando, etc..." name="name_flower" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Nombre del encargado: </label>
                                                    <input value="<?php echo $nameClient; ?>" type="text" placeholder="Ejemplo: Jose Hernandez, etc..." name="name_client" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Teléfono: </label>
                                                    <input value="<?php echo $phone; ?>" type="text" placeholder="Ejemplo: 3331-135-2312, etc..." name="phone" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Dirección: </label>
                                                    <input value="<?php echo $adress; ?>" type="text" placeholder="Ejemplo: Avenida los arcos #456, etc..." name="adress" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Estatus: </label>
                                                    <select name="status" require class="form-control">
                                                        <option selected disabled>Selecciona una opción</option>
                                                        <option value="Activo" <?php if($status == "Activo"){?> selected <?php } ?>>Actico</option>
                                                        <option value="Inactivo" <?php if($status == "Inactivo"){?> selected <?php } ?>>Inactivo</option>
                                                        <option value="Suspendido" <?php if($status == "Suspendido"){?> selected <?php } ?>>Suspendido</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Actualizar cliente" class="btn btn-primary btn-block" name="edit">
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