<?php 
    include "./config/conexion.php";

    if(isset($_POST['edit'])) {
        $idChoferEdit = $_POST['id_chofer_edit'];
        $arrayChoferEdit = explode("_", $idChoferEdit);
        $idNameChoferEdit = $arrayUserEdit[0];
        
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $vehicle = $_POST['vehicle'];
        $plates = $_POST['plates'];
        $adress = $_POST['adress'];
        $accountNumber = $_POST['account_number'];
        $price = $_POST['price'];
        $kilometer = $_POST['kilometer'];

        $query_update_chofer = "UPDATE choferes SET id_user='$idChoferEdit', name='$name', phone='$phone', vehicle='$vehicle', plates='$plates', adress='$adress', account_number='$accountNumber', price='$price', kilometer='$kilometer' WHERE id_user = '$idChoferEdit'";
        $result_update_chofer = mysqli_query($conexion, $query_update_chofer);

        if($result_update_chofer) {
            echo "<script>window.location='edit-chofer.php?bien'; </script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO-FER - editar chofer</title>
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
                        window.location = "new-choferes.php";
                });
            </script>
        <?php } ?>

        <?php include "./partials/menuLeft.php" ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/navbar.php" ?>

                <?php 
                    include "./config/conexion.php";

                    if(isset($_GET['id_user'])) {
                        $idUser = $_GET['id_user'];

                        $search_data_choferes = "SELECT * FROM choferes WHERE id_user = '$idUser'";
                        $result_data_choferes = mysqli_query($conexion, $search_data_choferes);

                        if($result_data_choferes) {
                            $row = mysqli_fetch_array($result_data_choferes);

                            $name = $row['name'];
                            $phone = $row['phone'];
                            $vehicle = $row['vehicle'];
                            $plates = $row['plates'];
                            $adress = $row['adress'];
                            $accountNumber = $row['account_number'];
                            $price = $row['price'];
                            $kilometer = $row['kilometer'];
                        }
                    }
                ?>

                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="text-dark">Editar chofer</h2>

                            <a href="new-choferes.php" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-counterclockwise"></i>
                                Regresar atrás
                            </a>
                        </div>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 text-primary">
                                        Editar chofer
                                    </h6>

                                    <a href="new-choferes.php" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i>
                                        Nuevo chofer
                                    </a>
                                </div>

                                <div class="card-body">
                                    <form action="edit-chofer.php" method="POST">
                                        <input type="hidden" name="id_chofer_edit" value="<?php echo $idUser; ?>">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Nombre: </label>
                                                    <input value="<?php echo $name; ?>" type="text" placeholder="Ejemplo: Jorge Hernadez Zaragoza, etc..." class="form-control" name="name">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Teléfono: </label>
                                                    <input value="<?php echo $phone; ?>" type="text" placeholder="Ejemplo: 3313 145 5678, etc..." class="form-control" name="phone">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Vehículo: </label>
                                                    <input value="<?php echo $vehicle; ?>" type="text" placeholder="Ejemplo: Honda Civic, etc..." class="form-control" name="vehicle">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Placas: </label>
                                                    <input value="<?php echo $plates; ?>" type="text" placeholder="Ejemplo: JW-60-261, etc..." class="form-control" name="plates">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Dirección: </label>
                                                    <input value="<?php echo $adress; ?>" type="text" placeholder="Ejemplo: Avenida los arcos #478, etc..." class="form-control" name="adress">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Número de cuenta: </label>
                                                    <input value="<?php echo $accountNumber; ?>" type="text" placeholder="Ejemplo: 4242424242424242, etc..." class="form-control" name="account_number">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Precio: </label>
                                                    <input value="<?php echo $price; ?>" type="text" placeholder="Ejemplo: 12, etc..." class="form-control" name="price">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Kilometros: </label>
                                                    <input value="<?php echo $kilometer;
                                                     ?>" type="number" placeholder="Ejemplo: 10, etc..." class="form-control" name="kilometer">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Actualizar chofer" class="btn btn-primary btn-block" name="edit">
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