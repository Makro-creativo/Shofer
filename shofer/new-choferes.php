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
        $kilometer = $_POST['kilometer'];

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
    

        $query_save_choferes = "INSERT INTO choferes(name, phone, vehicle, plates, adress, account_number, price, kilometer, image_url, image_url_circulacion, image_url_person) VALUES('$name', '$phone', '$vehicle', '$plates', '$adress', '$accountNumber', '$price', '$kilometer', '$ruta', '$ruta2', '$ruta3')";
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

                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#choferes">
                                        <i class="bi bi-plus-circle"></i>
                                        Nuevo chofer
                                    </button>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush table-hover" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Id del chofer</th>
                                                    <th>Nombre</th>
                                                    <th>Teléfono</th>
                                                    <th>Vehiculo</th>
                                                    <th>Placas</th>
                                                    <th>Dirección</th>
                                                    <th>Número de cuenta</th>
                                                    <th>Precio</th>
                                                    <th>Kilometros</th>
                                                    <th>Foto del ine</th>
                                                    <th>Foto de circulación</th>
                                                    <th>Foto personal</th>
                                                    <th>Total a pagar</th>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Editar</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Eliminar</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $search_data_chofer = "SELECT * FROM choferes ORDER BY name ASC";
                                                    $result_data_chofer = mysqli_query($conexion, $search_data_chofer);

                                                    while($row = mysqli_fetch_array($result_data_chofer)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['id_user']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td>
                                                        <?php 
                                                            $telephone = $row['phone']; 
                                                            $format = "(".substr($telephone,0,3).")"." ".substr($telephone,5,3)."-".substr($telephone,6,4);

                                                            echo $format;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['vehicle']; ?></td>
                                                    <td><?php echo $row['plates']; ?></td>
                                                    <td><?php echo $row['adress']; ?></td>
                                                    <td><?php echo $row['account_number']; ?></td>
                                                    <td><?php echo number_format($row['price'], 2); ?></td>
                                                    <td><?php echo $row['kilometer']; ?> Kilometros</td>
                                                    <td>
                                                        <img src="<?php echo $row['image_url']; ?>" alt="" class="img-fluid">
                                                    </td>
                                                    <td>
                                                        <img src="<?php echo $row['image_url_circulacion']; ?>" alt="" class="img-fluid">
                                                    </td>
                                                    <td>
                                                        <img src="<?php echo $row['image_url_person']; ?>" alt="" class="img-fluid">
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $total = $row['price']*$row['kilometer'];

                                                            echo number_format($total, 2);
                                                        ?>
                                                    </td>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="edit-chofer.php?id_user=<?php echo $row['id_user']; ?>" class="btn btn-success">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="delete-chofer.php?id_user=<?php echo $row['id_user']; ?>" class="btn btn-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>
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
                                        <input type="text" placeholder="Ejemplo: 4242424242424242, etc..." class="form-control" name="account_number">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label>Precio: </label>
                                        <input type="text" placeholder="Ejemplo: 12, etc..." class="form-control" name="price">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label>Kilometros: </label>
                                        <input type="number" placeholder="Ejemplo: 10, etc..." class="form-control" name="kilometer">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                        <label class="form-label">Foto del ine: </label>
                                        <input type="file" class="form-control" name="image_url">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                    <div class="form-group">
                                    <label class="form-label">Foto de circulación: </label>
                                    <input type="file" class="form-control" name="image_url_circulacion">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <label class="form-label">Foto personal: </label>
                                        <input type="file" class="form-control" name="image_url_person">
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


        </div>
        <br>
        <?php include "./partials/footer.php" ?>

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