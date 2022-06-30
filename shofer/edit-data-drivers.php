<?php 
    include "./config/conexion.php";

    error_reporting(0);

    if(!isset($_SESSION)) {
        session_start();
    }

    $uid = $_SESSION['UID'];

    if(isset($_POST['edit'])) {
        $idEditData = $_POST['id_chofer_edit'];
        $vehicle = $_POST['vehicle'];
        $plates = $_POST['plates'];
        $adress = $_POST['adress'];
        $accountNumber = $_POST['account_number'];
        $price = $_POST['price_for_kilometer'];
        //imagen Ine
        $directorio = "assets/images/"; 
        $nombreDoc = $_FILES['image_ine']['name'];
        
        $formatosDoc = array('.JPG','.jpg','.png','.PNG','.PDF','.pdf','.docx', '.tiff', '.psd', '.bmp', '.eps', '.svg'); //formatos a admitir
        $tmpDoc = $_FILES['image_ine']['tmp_name']; //Nombre temporal del archivo
        $extension = substr($nombreDoc, strrpos($nombreDoc,'.'));   //Para cortar la caden y obtener solo la 
                                    
        $ruta = $directorio.$nombreDoc; 
    
        if(in_array($extension, $formatosDoc)){ //Verifica que se encuente la extension o un valor en el arreglo
            $nombreDoc = html_entity_decode($nombreDoc);
            if(move_uploaded_file($_FILES['image_ine']['tmp_name'], $ruta)){
                //Se subio img
            } else {
                echo "no se movio";
            }
        } else {
            echo "no es la extension";
        }

        // Imagen circulación
         $directorio2 = "assets/images/"; 
         $nombreDoc2 = $_FILES['image_circulacion']['name'];
         
         $formatosDoc2 = array('.JPG','.jpg','.png','.PNG','.PDF','.pdf','.docx', '.tiff', '.psd', '.bmp', '.eps', '.svg'); //formatos a admitir
         $tmpDoc2 = $_FILES['image_circulacion']['tmp_name']; //Nombre temporal del archivo
         $extension2 = substr($nombreDoc2, strrpos($nombreDoc2,'.'));   //Para cortar la caden y obtener solo la 
                                     
         $ruta2 = $directorio2.$nombreDoc2; 
     
         if(in_array($extension2, $formatosDoc2)){ //Verifica que se encuente la extension o un valor en el arreglo
             $nombreDoc2 = html_entity_decode($nombreDoc2);
             if(move_uploaded_file($_FILES['image_circulacion']['tmp_name'], $ruta2)){
                 //Se subio img
             } else {
                 echo "no se movio";
             }
         } else {
             echo "no es la extension";
         }

         // Imagen personal
         $directorio3 = "assets/images/"; 
         $nombreDoc3 = $_FILES['image_personal']['name'];
         
         $formatosDoc3 = array('.JPG','.jpg','.png','.PNG','.PDF','.pdf','.docx', '.tiff', '.psd', '.bmp', '.eps', '.svg'); //formatos a admitir
         $tmpDoc3 = $_FILES['image_personal']['tmp_name']; //Nombre temporal del archivo
         $extension3 = substr($nombreDoc3, strrpos($nombreDoc3,'.'));   //Para cortar la caden y obtener solo la 
                                     
         $ruta3 = $directorio3.$nombreDoc3; 
     
         if(in_array($extension3, $formatosDoc3)){ //Verifica que se encuente la extension o un valor en el arreglo
             $nombreDoc3 = html_entity_decode($nombreDoc3);
             if(move_uploaded_file($_FILES['image_personal']['tmp_name'], $ruta3)){
                 //Se subio img
             } else {
                 echo "no se movio";
             }
         } else {
             echo "no es la extension";
         }

        $cardNumber = $_POST['card_number'];
        $bank = $_POST['bank'];

         // Imagen de conducir
         $directorio4 = "assets/images/"; 
         $nombreDo4 = $_FILES['image_conducir']['name'];
         
         $formatosDoc4 = array('.JPG','.jpg','.png','.PNG','.PDF','.pdf','.docx', '.tiff', '.psd', '.bmp', '.eps', '.svg'); //formatos a admitir
         $tmpDoc4 = $_FILES['image_conducir']['tmp_name']; //Nombre temporal del archivo
         $extension4 = substr($nombreDoc4, strrpos($nombreDoc4,'.'));   //Para cortar la caden y obtener solo la 
                                     
         $ruta4 = $directorio4.$nombreDoc4; 
     
         if(in_array($extension4, $formatosDoc4)){ //Verifica que se encuente la extension o un valor en el arreglo
             $nombreDoc4 = html_entity_decode($nombreDoc4);
             if(move_uploaded_file($_FILES['image_conducir']['tmp_name'], $ruta4)){
                 //Se subio img
             } else {
                 echo "no se movio";
             }
         } else {
             echo "no es la extension";
         }

         $query_update = "UPDATE drivers SET vehicle='$vehicle', plates='$plates', adress='$adress', account_number='$accountNumber', price_for_kilometer='$price', image_ine='$ruta', image_circulacion='$ruta2', image_personal='$ruta3', card_number='$cardNumber', bank='$bank', image_conducir='$ruta4' WHERE id = '$idEditData'";
         $result_update = mysqli_query($conexion, $query_update);

         if($result_update) {
            echo "<script>window.location='edit-data-drivers.php?bien'; </script>";
         }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHO-FER - editar</title>
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
<body>
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
                    window.location = "show-data-driver.php";
            });
        </script>
    <?php } ?>

        <?php include "./partials/menuLeft.php" ?>

        <?php 
            include "./config/conexion.php";

            if(isset($_GET['id'])) {
                $idEdit = $_GET['id'];

                $search_data_drivers = "SELECT * FROM drivers WHERE id = '$idEdit'";
                $result_data_drivers = mysqli_query($conexion, $search_data_drivers);

                if($result_data_drivers) {
                    $rowDriver = mysqli_fetch_array($result_data_drivers);

                    $nameDriver = $rowDriver['name_driver'];
                    $vehicle = $rowDriver['vehicle'];
                    $plates = $rowDriver['plates'];
                    $adress = $rowDriver['adress'];
                    $accountNumber = $rowDriver['account_number'];
                    $price = $rowDriver['price_for_kilometer'];
                    $imageIne = $rowDriver['image_ine'];
                    $imageCirculacion = $rowDriver['image_circulacion'];
                    $imagePersonal = $rowDriver['image_personal'];
                    $cardNumber = $rowDriver['card_number'];
                    $bank = $rowDriver['bank'];
                    $imageConducir = $rowDriver['image_conducir'];
                }
            }
        ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/navbar.php" ?>

                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="text-dark">Editar mis datos</h2>

                            <a href="show-data-driver.php" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-counterclockwise"></i>
                                Regresar atrás
                            </a>
                       </div>

                       <div class="col-md-12 col-sm-12-col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <form action="edit-data-drivers.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id_chofer_edit" value="<?php echo $idEdit; ?>">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Vehículo: </label>
                                                    <input value="<?php echo $vehicle; ?>" type="text" placeholder="Nombre del vehículo..." name="vehicle" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Placas: </label>
                                                    <input value="<?php echo $plates; ?>" type="text" placeholder="Número de placas..." name="plates" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Dirección: </label>
                                                    <input value="<?php echo $adress; ?>" type="text" placeholder="Tu dirección..." name="adress" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Número de cuenta: </label>
                                                    <input value="<?php echo $accountNumber; ?>" type="text" placeholder="Número de tu cuenta bancaría..." name="account_number" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Número de tarjeta: </label>
                                                    <input value="<?php echo $cardNumber; ?>" type="text" placeholder="Número de tarjeta de crédito..." name="card_number" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Nombre del banco: </label>
                                                    <input value="<?php echo $bank; ?>" type="text" placeholder="Nombre del banco..." name="bank" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label>Precio por kilometro: </label>
                                                    <input value="<?php echo $price; ?>" type="text" placeholder="Ejemplo: 12, 15, etc..." name="price_for_kilometer" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Foto del Ine: </label>
                                                    <input type="file" name="image_ine" class="form-control" value="<?php echo $imageIne; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tarjeta de circulación: </label>
                                                    <input type="file" name="image_circulacion" class="form-control" value="<?php echo $imageCirculacion; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="form-group">
                                                    <label class="form-label">Foto personal: </label>
                                                    <input type="file" name="image_personal" class="form-control" value="<?php echo $imagePersonal; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                                <div class="form-group">
                                                    <label class="form-label">Foto de licencia de conducir: </label>
                                                    <input type="file" name="image_conducir" class="form-control" value="<?php echo $imageConducir; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <input type="submit" value="Registrar" class="btn btn-primary btn-block" name="edit">
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