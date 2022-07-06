<?php 
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $typeUser = $_SESSION['Type'];
    
    if(isset($_POST['save'])) {
        $numberClient = $_POST['number_client'];
        $nameFlower = $_POST['name_flower'];
        $nameClient = $_POST['name_client'];
        $phone = $_POST['phone'];
        $adress = $_POST['adress'];
        $status = $_POST['status'];

        $query_insert_clients = "INSERT INTO clients(number_client, name_flower, name_client, phone, adress, status) VALUES('$numberClient', '$nameFlower', '$nameClient', '$phone', '$adress', '$status')";
        $result_insert_clients = mysqli_query($conexion, $query_insert_clients);

        if($result_insert_clients) {
            echo "<script>window.location='new-clients.php?bien'; </script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO-FER - clientes</title>
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
                        window.location = "new-clients.php";
                });
            </script>
        <?php } ?>

        <?php include "./partials/menuLeft.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/navbar.php" ?>

                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="text-dark">Clientes</h2>

                            <a href="DashboardAdmin.php" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-counterclockwise"></i>
                                Regresar atrás
                            </a>
                        </div>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12 mt-4">
                            <div class="card shadow-lg">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary m-0">Clientes</h6>

                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#client">
                                        <i class="bi bi-plus-circle"></i>
                                        Nuevo cliente
                                    </button>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush table-hover" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Número de cliente</th>
                                                    <th>Nombre de la florería</th>
                                                    <th>Nombre del encargado</th>
                                                    <th>Teléfono</th>
                                                    <th>Dirección</th>
                                                    <th>Estatus</th>

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

                                                    $search_data_clients = "SELECT * FROM users WHERE type = 'Cliente' ORDER BY id ASC";
                                                    $result_data_clients = mysqli_query($conexion, $search_data_clients);

                                                    while($row = mysqli_fetch_array($result_data_clients)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo "F00".$row['id']; ?></td>
                                                    <td><?php echo $row['name_flower']; ?></td>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td>
                                                        <?php 
                                                            $telephone = $row['phone']; 
                                                            $format = "(".substr($telephone,0,3).")"." ".substr($telephone,5,3)."-".substr($telephone,6,4);

                                                            echo $format;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['adress']; ?></td>
                                                    <td>
                                                        <?php 
                                                         switch($row['status']){
                                                            case 'Activo':
                                                                echo "<span class='badge badge-success'>$row[status]</span>";
                                                                break;
                                                            case 'Inactivo':
                                                                echo "<span class='badge badge-warning'>$row[status]</span>";
                                                                break;
                                                            case 'Suspendido':
                                                                echo "<span class='badge badge-danger'>$row[status]</span>";
                                                                break;
                                                            default:
                                                                echo "<span>$row[status]</span>";
                                                                break;
                                                            }
                                                        ?>
                                                    </td>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="edit-client.php?id=<?php echo $row['id']; ?>" class="btn btn-success">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="delete-client.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">
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
            <div class="modal fade" id="client" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="new-clients.php" method="POST">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Número de cliente: </label>
                                        <input type="text" placeholder="Ejemplo: cli01, cli02, etc..." name="number_client" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Nombre de la florería: </label>
                                        <input type="text" placeholder="Ejemplo: Florería fernando, etc..." name="name_flower" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Nombre del encargado: </label>
                                        <input type="text" placeholder="Ejemplo: Jose Hernandez, etc..." name="name_client" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Teléfono: </label>
                                        <input type="text" placeholder="Ejemplo: 3331-135-2312, etc..." name="phone" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Dirección: </label>
                                        <input type="text" placeholder="Ejemplo: Avenida los arcos #456, etc..." name="adress" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4">
                                    <div class="form-group">
                                        <label>Estatus: </label>
                                        <select name="status" require class="form-control">
                                            <option selected disabled>Selecciona una opción</option>
                                            <option value="Activo">Activo</option>
                                            <option value="Inactivo">Inactivo</option>
                                            <option value="Suspendido">Suspendido</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" value="Guardar cliente" class="btn btn-primary btn-block" name="save">
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