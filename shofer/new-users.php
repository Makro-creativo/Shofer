<?php 
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    if(isset($_POST['saveAdmin'])) {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['type'];

        $query_insert_user = "INSERT INTO users(name, username, password, type) VALUES('$name', '$username', '$password', '$type')";
        $result_insert_user = mysqli_query($conexion, $query_insert_user);

        if($result_insert_user) {
            echo "<script>window.location='new-users.php?bien'; </script>";
        }
    }

    $typeUser = $_SESSION['Type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO-FER - usuarios</title>
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
                        window.location = "new-users.php";
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
                            <h2 class="text-dark mb-4">Usuarios</h2>
                            <a href="DashboardAdmin.php" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-counterclockwise"></i>
                                Regresar atrás
                            </a>
                        </div>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 text-primary">Usuarios</h6>

                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#new-user">
                                        <i class="bi bi-plus-circle"></i>
                                        Nuevo usuario
                                    </button>
                                </div>  

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Nombre completo</th>
                                                    <th>Nombre de usuario</th>
                                                    <th>Contraseña</th>
                                                    <th>Tipo de Rol</th>

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

                                                    $search_users = "SELECT * FROM users ORDER BY name ASC";
                                                    $result_users = mysqli_query($conexion, $search_users);

                                                    while($row = mysqli_fetch_array($result_users)) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $row['name']; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td><?php echo $row['password']; ?></td>
                                                    <td><?php echo $row['type']; ?></td>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="edit-user.php?id=<?php echo $row['id']; ?>" class="btn btn-success">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="delete-user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" id="delete-user">
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
            <div class="modal fade" id="new-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <label>Selecciona una opción</label>
                            <select name="status" id="status" onChange="showForm(this.value);" class="form-control">
                                <option selected disabled>Eligir opción</option>
                                <option value="rol-client">Rol de cliente</option>
                                <option value="rol-chofer">Rol de chofer</option>
                                <option value="rol-administrador">Rol de administrador</option>
                            </select>
                        </form>

                        <div id="rol-client" style="display: none;">
                            <form action="new-rol-client.php" method="POST">
                                <div class="row">
                                    <div class="col-md-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                        <div class="form-group">
                                           <label>Eligir cliente: </label>
                                           <select name="info_client" require class="form-control">
                                               <option disabled selected>Eligir cliente</option>
                                               <?php 
                                                include "./config/conexion.php";
                                                        
                                                $query_client = "SELECT * FROM clients ORDER BY name_client ASC";
                                                $result_client = mysqli_query($conexion, $query_client);

                                                while($row = mysqli_fetch_array($result_client)) {
                                                    $idClient = $row['id_user'];
                                                    $nameClient = $row['name_client'];
                                               ?>
                                                <option value="<?php echo $idClient."_".$nameClient; ?>"><?php echo $nameClient; ?></option>
                                               <?php }?>
                                           </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                        <div class="form-group">
                                            <label>Nombre de usuario: </label>
                                            <input type="text" placeholder="Ejemplo: FernandoB, etc..." name="username" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="form-group">
                                            <label>Contraseña: </label>
                                            <input type="text" placeholder="Ejemplo: fernando*2022, etc..." name="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="form-group">
                                            <label>Tipo de Rol: </label>
                                            <select name="type" require class="form-control">
                                                <option selected disabled>Eligir Rol</option>
                                                <option value="Cliente">Cliente</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" value="Registrar" class="btn btn-primary btn-block" name="saveClient">
                            </form>
                        </div>

                        <div id="rol-chofer" style="display: none;">
                            <form action="new-rol-chofer.php" method="POST">
                                <div class="row">
                                    <div class="col-md-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                        <div class="form-group">
                                           <label>Eligir chofer: </label>
                                           <select name="info_chofer" require class="form-control">
                                               <option disabled selected>Eligir chofer</option>
                                               <?php 
                                                include "./config/conexion.php";
                                                        
                                                $query_client = "SELECT * FROM choferes ORDER BY name ASC";
                                                $result_client = mysqli_query($conexion, $query_client);

                                                while($row = mysqli_fetch_array($result_client)) {
                                                    $idChofer = $row['id_user'];
                                                    $nameChofer = $row['name'];
                                               ?>
                                                <option value="<?php echo $idChofer."_".$nameChofer; ?>"><?php echo $nameChofer; ?></option>
                                               <?php }?>
                                           </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                        <div class="form-group">
                                            <label>Nombre de usuario: </label>
                                            <input type="text" placeholder="Ejemplo: FernandoB, etc..." name="username" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="form-group">
                                            <label>Contraseña: </label>
                                            <input type="text" placeholder="Ejemplo: fernando*2022, etc..." name="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="form-group">
                                            <label>Tipo de Rol: </label>
                                            <select name="type" require class="form-control">
                                                <option selected disabled>Eligir Rol</option>
                                                <option value="Chofer">Chofer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" value="Registrar" class="btn btn-primary btn-block" name="saveChofer">
                            </form>
                        </div>

                        <div id="rol-administrador" style="display: none;">
                            <form action="new-users.php" method="POST">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                        <div class="form-group">
                                            <label>Nombre completo: </label>
                                            <input type="text" placeholder="Ejemplo: Fernando Rodriguez Hernandez, etc..." name="name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 mt-4">
                                        <div class="form-group">
                                            <label>Nombre de usuario: </label>
                                            <input type="text" placeholder="Ejemplo: FernandoR, etc..." name="username" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <label>Contraseña: </label>
                                        <input type="text" placeholder="Ejemplo: fer*2022, etc..." name="password" class="form-control">
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-lg-6 col-xl-6 col-xxl-6">
                                        <div class="form-group">
                                            <label>Tipo de Rol: </label>
                                            <select name="type" require class="form-control">
                                                <option selected disabled>Eligir opción</option>
                                                <option value="Administrador">Administrador</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" value="Registrar" class="btn btn-primary btn-block" name="saveAdmin">
                            </form>
                        </div>
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



    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/ruang-admin.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../js/demo/chart-area-demo.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        function showForm(id) {
            if(id === "rol-client") {
                $("#rol-client").show();
                $("#rol-administrador").hide();
                $("#rol-chofer").hide();
            }

            if(id === "rol-chofer") {
                $("#rol-client").hide();
                $("#rol-administrador").hide();
                $("#rol-chofer").show();
            }

            if(id === "rol-administrador") {
                $("#rol-client").hide();
                $("#rol-administrador").show();
                $("#rol-chofer").hide();
            }
        }
    </script>
    <script>
        let table = $('#dataTableHover').DataTable({
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