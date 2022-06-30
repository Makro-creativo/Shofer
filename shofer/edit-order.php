<?php 
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    error_reporting(0);

    $uid = $_SESSION['UID'];

    if(isset($_POST['edit'])) {
        $idOrder = $_POST['id_order_edit'];
        $dateSend = $_POST['date_send'];
        $personReceive = $_POST['person_receive'];
        $colonia = $_POST['colonia'];
        $cruceCalles = $_POST['cruce_calles'];
        $nameFlower = $_POST['name_flower'];
        $phone = $_POST['phone'];
        $nameEncargado = $_POST['name_encargado'];
        $adress = $_POST['adress'];
        $nameAndPhone = $_POST['name_and_phone'];
        $referencesCoto = $_POST['references_coto'];

        //imagen
        $directorio = "assets/images/"; 
        $nombreDoc = $_FILES['image']['name'];
        
        $formatosDoc = array('.JPG','.jpg','.png','.PNG','.PDF','.pdf','.docx'); //formatos a admitir
        $tmpDoc = $_FILES['image']['tmp_name']; //Nombre temporal del archivo
        $extension = substr($nombreDoc, strrpos($nombreDoc,'.'));   //Para cortar la caden y obtener solo la 
                                    
        $ruta = $directorio.$nombreDoc; 
    
        if(in_array($extension, $formatosDoc)){ //Verifica que se encuente la extension o un valor en el arreglo
            $nombreDoc = html_entity_decode($nombreDoc);
            if(move_uploaded_file($_FILES['image']['tmp_name'], $ruta)){
                //Se subio img
            } else {
                echo "no se movio";
            }
        } else {
            echo "no es la extension";
        }

        $query_update = "UPDATE orders SET date_send='$dateSend', person_receive='$personReceive', colonia='$colonia', cruce_calles='$cruceCalles', name_flower='$nameFlower', phone='$phone', name_encargado='$nameEncargado', adress='$adress', id_user='$uid', name_and_phone='$nameAndPhone', references_coto='$referencesCoto', image='$ruta' WHERE id_order = '$idOrder'";
        $result_update = mysqli_query($conexion, $query_update);

        if($result_update) {
            echo "<script>window.location='edit-order.php?bien'; </script>";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO-FER - editar servicio</title>
    <link rel="shortcut icon" href="assets/images/favicon_shofer.svg" type="image/x-icon">
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
                        window.location = "new-orders.php";
                });
            </script>
        <?php } ?>

        <?php include "./partials/menuLeft.php" ?>

        <?php 
            include "./config/conexion.php";

            if(isset($_GET['id_order'])) {
                $idOrder = $_GET['id_order'];

                $search_order_for_id = "SELECT * FROM orders WHERE id_order = '$idOrder'";
                $result_order_for_id = mysqli_query($conexion, $search_order_for_id);

                if($result_order_for_id) {
                    $rowOrder = mysqli_fetch_array($result_order_for_id);

                    $dateSend = $rowOrder['date_send'];
                    $personReceive = $rowOrder['person_receive'];
                    $colonia = $rowOrder['colonia'];
                    $cruceCalles = $rowOrder['cruce_calles'];
                    $nameFlower = $rowOrder['name_flower'];
                    $phone = $rowOrder['phone'];
                    $nameEncargado = $rowOrder['name_encargado'];
                    $adress = $rowOrder['adress'];
                    $nameAndPhone = $rowOrder['name_and_phone'];
                    $referencesCoto = $rowOrder['references_coto'];
                    $image = $rowOrder['image'];
                }
            }
        ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/navbar.php" ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="text-dark">Editar servicio</h2>

                                <a href="new-orders.php" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                    Regresar atrás
                                </a>
                            </div>

                            <div class="card shadow-lg">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary m-0">Editar servicio</h6>

                                    <a href="new-orders.php" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i>
                                        Nuevo servicio
                                    </a>
                                </div>

                                <div class="card-body">
                                    <form action="edit-order.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id_order_edit" value="<?php echo $idOrder; ?>">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Fecha: </label>
                                                    <input value="<?php echo $dateSend; ?>" type="date" name="date_send" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Quién recibe: </label>
                                                    <input value="<?php echo $personReceive; ?>" type="text" placeholder="Ejemplo: Jorge Gonzales Hernandez, etc..." class="form-control" name="person_receive">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                                <div class="form-group">
                                                    <label>Teléfono: </label>
                                                    <input value="<?php echo $phone; ?>" type="text" placeholder="Ejemplo: 33311324567, etc..." class="form-control" name="phone">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4 mt-4">
                                                <div class="form-group">
                                                    <label>Nombre y Teléfono de quién envía: </label>
                                                    <input value="<?php echo $nameAndPhone; ?>" type="text" placeholder="Ejemplo: Fernando, etc..." class="form-control" name="name_and_phone">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4 mt-4">
                                                <div class="form-group">
                                                    <label>Dirección: </label>
                                                    <input value="<?php echo $adress; ?>" type="text" placeholder="Ejemplo: Avenida de los arcos #476, etc..." class="form-control" name="adress">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4 mt-4">
                                                <div class="form-group">
                                                    <label>Colonia y Municipio: </label>
                                                    <input value="<?php echo $colonia ?>" type="text" placeholder="Ejemplo: La moderna, etc..." class="form-control" name="colonia">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Cruce entre calles: </label>
                                                    <input value="<?php echo $cruceCalles; ?>" type="text" placeholder="Ejemplo: Es afuera del coto 4, a dos casas de la entrada, etc..." class="form-control" name="cruce_calles">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Nombre de la florería: </label>
                                                    <input value="<?php echo $nameFlower; ?>" type="text" placeholder="Ejemplo: florería san jose, etc..." class="form-control" name="name_flower">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Encargado de la florería: </label>
                                                    <input value="<?php echo $nameEncargado; ?>" type="text" placeholder="Ejemplo: Adrian Hernandez, etc..." class="form-control" name="name_encargado">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Referencias de tu domicilio: </label>
                                                    <input value="<?php echo $referencesCoto; ?>" type="text" placeholder="Ejemplo: Esta cerca de un coto, enfrenta está un súper, etc..." class="form-control" name="references_coto">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div class="form-group">
                                                    <label class="form-label">Imagen del ramo: </label>
                                                    <input value="<?php echo $image; ?>" type="file" name="image" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Actualizar servicio" class="btn btn-primary btn-block" name="edit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

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