<?php 
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $typeUser = $_SESSION['Type'];

    if(isset($_POST['save'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $vehicle = $_POST['vehicle'];
        $plates = $_POST['plates'];
        $adress = $_POST['adress'];
        $accountNumber = $_POST['account_number'];
        $price = $_POST['price'];
        $cardNumber = $_POST['card_number'];
        $bank = $_POST['bank'];

        //imagen Ine
        $directorio = "assets/images/"; 
        $nombreDoc = $_FILES['image_url']['name'];
        
        $formatosDoc = array('.JPG','.jpg','.png','.PNG','.PDF','.pdf','.docx'); //formatos a admitir
        $tmpDoc = $_FILES['image_url']['tmp_name']; //Nombre temporal del archivo
        $extension = substr($nombreDoc, strrpos($nombreDoc,'.'));   //Para cortar la caden y obtener solo la 
                                    
        $ruta = $directorio.$nombreDoc; 
    
        if(in_array($extension, $formatosDoc)){ //Verifica que se encuente la extension o un valor en el arreglo
            $nombreDoc = html_entity_decode($nombreDoc);
            if(move_uploaded_file($_FILES['image_url']['tmp_name'], $ruta)){
                //Se subio img
            } else {
                echo "no se movio";
            }
        } else {
            echo "no es la extension";
        }

        // Imagen circulación
         $directorio2 = "assets/images/"; 
         $nombreDoc2 = $_FILES['image_url_circulacion']['name'];
         
         $formatosDoc2 = array('.JPG','.jpg','.png','.PNG','.PDF','.pdf','.docx'); //formatos a admitir
         $tmpDoc2 = $_FILES['image_url_circulacion']['tmp_name']; //Nombre temporal del archivo
         $extension2 = substr($nombreDoc2, strrpos($nombreDoc2,'.'));   //Para cortar la caden y obtener solo la 
                                     
         $ruta2 = $directorio2.$nombreDoc2; 
     
         if(in_array($extension2, $formatosDoc2)){ //Verifica que se encuente la extension o un valor en el arreglo
             $nombreDoc2 = html_entity_decode($nombreDoc2);
             if(move_uploaded_file($_FILES['image_url_circulacion']['tmp_name'], $ruta2)){
                 //Se subio img
             } else {
                 echo "no se movio";
             }
         } else {
             echo "no es la extension";
         }

         // Imagen personal
         $directorio3 = "assets/images/"; 
         $nombreDoc3 = $_FILES['image_url_circulacion']['name'];
         
         $formatosDoc3 = array('.JPG','.jpg','.png','.PNG','.PDF','.pdf','.docx'); //formatos a admitir
         $tmpDoc3 = $_FILES['image_url_circulacion']['tmp_name']; //Nombre temporal del archivo
         $extension3 = substr($nombreDoc2, strrpos($nombreDoc3,'.'));   //Para cortar la caden y obtener solo la 
                                     
         $ruta3 = $directorio3.$nombreDoc3; 
     
         if(in_array($extension3, $formatosDoc3)){ //Verifica que se encuente la extension o un valor en el arreglo
             $nombreDoc3 = html_entity_decode($nombreDoc3);
             if(move_uploaded_file($_FILES['image_url_circulacion']['tmp_name'], $ruta3)){
                 //Se subio img
             } else {
                 echo "no se movio";
             }
         } else {
             echo "no es la extension";
         }
    

        $query_save_choferes = "INSERT INTO choferes(name, phone, vehicle, plates, adress, account_number, price, card_number, bank, image_url, image_url_circulacion, image_url_person) VALUES('$name', '$phone', '$vehicle', '$plates', '$adress', '$accountNumber', '$price', '$cardNumber', '$bank', '$ruta', '$ruta2', '$ruta3')";
        $result_save_choferes = mysqli_query($conexion, $query_save_choferes);

        if($result_save_choferes) {
            echo "<script>window.location='new-choferes.php?bien'; </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO-FER - choferes</title>
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
                    text: 'Se guardo correctamente!',
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

                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2 class="text-dark">Choferes</h2>

                            <a href="DashboardAdmin.php" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-counterclockwise"></i>
                                Regresar atrás
                            </a>
                        </div>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 text-primary">Choferes</h6>
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
                                                    <th>Foto Ine</th>
                                                    <th>Tarjeta de circulación</th>
                                                    <th>Foto personal</th>
                                                    <th>Foto de licencia de conducir</th>
                                                    <th>Número de seguro</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $search_data_chofer = "SELECT * FROM drivers ORDER BY name_driver ASC";
                                                    $result_data_chofer = mysqli_query($conexion, $search_data_chofer);

                                                    while($row = mysqli_fetch_array($result_data_chofer)) {
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
                                                    <td><img src="<?php echo $row['image_ine']; ?>" alt="" class="img-fluid"></td>
                                                    <td><img src="<?php echo $row['image_circulacion']; ?>" alt="" class="img-fluid"></td>
                                                    <td><img src="<?php echo $row['image_personal']; ?>" alt="" class="img-fluid"></td>
                                                    <td><img src="<?php echo $row['image_conducir']; ?>" alt="" class="img-fluid"></td>
                                                    <td><?php echo $row['number_seguro']; ?></td>
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
            

            <!-- Modal -->
            <div class="modal fade" id="choferes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo chofer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="new-choferes.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label>Nombre: </label>
                                        <input type="text" placeholder="Ejemplo: Jorge Hernadez Zaragoza, etc..." class="form-control" name="name">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label>Teléfono: </label>
                                        <input type="text" placeholder="Ejemplo: 3313 145 5678, etc..." class="form-control" name="phone">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label>Vehículo: </label>
                                        <input type="text" placeholder="Ejemplo: Honda Civic, etc..." class="form-control" name="vehicle">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label>Placas: </label>
                                        <input type="text" placeholder="Ejemplo: JW-60-261, etc..." class="form-control" name="plates">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label>Dirección: </label>
                                        <input type="text" placeholder="Ejemplo: Avenida los arcos #478, etc..." class="form-control" name="adress">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label>Número de cuenta: </label>
                                        <input type="text" placeholder="Número de cuenta bancaría..." class="form-control" name="account_number">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label>Número de tarjeta: </label>
                                        <input type="text" placeholder="Número de tarjeta de crédito..." class="form-control" name="card_number">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label>Banco: </label>
                                        <input type="text" placeholder="Nombre del banco..." class="form-control" name="bank">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label>Precio por kilometro: </label>
                                        <input type="text" placeholder="Ejemplo: 12, etc..." class="form-control" name="price">
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label class="form-label">Foto del Ine: </label>
                                        <input type="file" class="form-control" name="image_url">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label class="form-label">Tarjeta de circulación: </label>
                                        <input type="file" class="form-control" name="image_url_circulacion">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label class="form-label">Foto personal: </label>
                                        <input type="file" class="form-control" name="image_url_circulacion">
                                    </div>
                                </div>
                            </div>
                            

                            <input type="submit" value="Registrar" class="btn btn-primary btn-block" name="save">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- End Modal -->
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
    <script>
        let table = $('#dataTable').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        
        });
    </script>
</body>
</html>