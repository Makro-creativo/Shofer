<?php 
    if(!isset($_SESSION['UID'])) {
        session_start();
    }
    
    $typeUser = $_SESSION['Type'];
    $uid = $_SESSION['UID'];

    include "./config/conexion.php";

    if(isset($_POST['save'])) {
        $dateSend = $_POST['date_send'];
        $personReceive = $_POST['person_receive'];
        $colonia = $_POST['colonia'];
        $cruceCalles = $_POST['cruce_calles'];
        $nameFlower = $_POST['name_flower'];
        $phone = $_POST['phone'];
        $nameEncargado = $_POST['name_encargado'];
        $adress = $_POST['adress'];
        $references_coto = $_POST['references_coto'];

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

        $query_save_order = "INSERT INTO orders(date_send, person_receive, colonia, cruce_calles, name_flower, phone, name_encargado, adress, from_id, to_id, status, id_user, references_coto, image, created_date) VALUES('$dateSend', '$personReceive', '$colonia', '$cruceCalles', '$nameFlower', '$phone', '$nameEncargado', '$adress', '$uid', '1', '0', '$uid', '$references_coto', '$ruta', NOW())";
        $result_save_order = mysqli_query($conexion, $query_save_order);

        if($result_save_order) {
            echo "<script>window.location='new-orders.php?bien'; </script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO-FER - nuevo pedido</title>
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
                        window.location = "new-orders.php";
                });
            </script>
        <?php } ?>

        <?php   
            if(isset($_GET['exito'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se asigno servicio exitosamente!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "new-orders.php";
                });
            </script>
        <?php } ?>

        <?php   
            if(isset($_GET['exito'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se asignaron los kilometros exitosamente!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "new-orders.php";
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
                            <h2 class="text-dark">Servicios</h2>
                            <?php if($typeUser === "Administrador") {?>
                                <a href="DashboardAdmin.php" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                    Regresar atrás
                                </a>
                            <?php }?>

                            <?php if($typeUser === "Cliente") {?>
                                <a href="DashboardCliente.php" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                    Regresar atrás
                                </a>
                            <?php }?>
                        </div>

                        <div class="co-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 text-primary">Servicios</h6>

                                    <?php if($typeUser === "Cliente") {?>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#new-order">
                                            <i class="bi bi-plus-circle"></i>
                                            Nuevo servicio
                                        </button>
                                    <?php }?>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush table-hover" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Folio</th>
                                                    <th>Fecha</th>
                                                    <th>Quién recibe</th>
                                                    <th>Dirección</th>
                                                    <th>Colonia</th>
                                                    <th>Cruce entre calles</th>
                                                    <th>Referencias del domicilio</th>
                                                    <th>Nombre de la florería</th>
                                                    <th>Nombre del encargado</th>
                                                    <th>Teléfono</th>
                                                    <th>Imagen del ramo</th>

                                                    <?php if($typeUser === "Cliente") {?>
                                                        <th>Editar</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Cliente") {?>
                                                        <th>Eliminar</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Cliente") {?>
                                                        <th>Detalle del servicio</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Detalle del servicio</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Asignar servicio</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Kilometros</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if($typeUser === "Administrador") {
                                                        include "./show-order-admin.php";
                                                    } else if($typeUser === "Cliente") {
                                                        include "./show-order-client.php";
                                                    } else if($typeUser === "Chofer") {
                                                        include "./show-order-chofer.php";
                                                    } else {
                                                        echo "No hay datos disponibles para está sección";
                                                    }
                                               ?>
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
            <div class="modal fade" id="new-order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo servicio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="new-orders.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_user_Active" value="<?php echo $uid; ?>">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Fecha: </label>
                                        <input type="date" name="date_send" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Quién recibe: </label>
                                        <input type="text" placeholder="Ejemplo: Jorge Gonzales Hernandez, etc..." class="form-control" name="person_receive">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Teléfono: </label>
                                        <input type="text" placeholder="Ejemplo: 33311324567, etc..." class="form-control" name="phone">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Dirección: </label>
                                        <input type="text" placeholder="Ejemplo: Avenida de los arcos #476, etc..." class="form-control" name="adress">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Colonia y Municipio: </label>
                                        <input type="text" placeholder="Ejemplo: La moderna, etc..." class="form-control" name="colonia">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Cruce entre calles: </label>
                                        <input type="text" placeholder="Ejemplo: Es afuera del coto 4, a dos casas de la entrada, etc..." class="form-control" name="cruce_calles">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Nombre de la florería: </label>
                                        <input type="text" placeholder="Ejemplo: florería san jose, etc..." class="form-control" name="name_flower">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Encargado de la florería: </label>
                                        <input type="text" placeholder="Ejemplo: Adrian Hernandez, etc..." class="form-control" name="name_encargado">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Referencias de tu domicilio: </label>
                                        <input type="text" placeholder="Ejemplo: Esta cerca de un coto, enfrenta está un súper, etc..." class="form-control" name="references_coto">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                    <div class="form-group">
                                        <label class="form-label">Imagen del ramo: </label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <input type="submit" value="Guardar servicio" class="btn btn-primary btn-block" name="save">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->

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