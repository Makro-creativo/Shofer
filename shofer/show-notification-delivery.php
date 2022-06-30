<?php 
    session_start();

    require "./config/conexion.php";
    
    $username = $_SESSION['username'];
    $typeUser = $_SESSION['Type'];
    $name = $_SESSION['name'];
    $uid = $_SESSION['UID'];
    $uid2 = $_SESSION['UID2'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO-FER - servicio chofer</title>
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
            if(isset($_GET['success'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se entrego correctamente!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "show-order-chofer.php";
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
                        </div>

                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table align-items-center table-flush table-hover" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Folio</th>
                                                    <th>Fecha</th>
                                                    <th>Quién recibe</th>
                                                    <th>Colonia</th>
                                                    <th>Cruce entre calles</th>
                                                    <th>Nombre de la florería</th>
                                                    <th>Teléfono</th>
                                                    <th>Nombre del encargado</th>
                                                    <th>Dirección</th>

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

                                                    <?php if($typeUser === "Chofer") {?>
                                                        <th>Detalle del servicio</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Chofer") {?>
                                                        <th>Marcar como entregado</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Hora y fecha de entrega</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <th>Entegado por</th>
                                                    <?php }?>

                                                    <?php if($typeUser === "Cliente") {?>
                                                        <th>Entegado por</th>
                                                    <?php }?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php 
                                                        include "./config/conexion.php";

                                                        $search_all_orders = "SELECT * FROM orders INNER JOIN delivery_chofer ON orders.id_order = delivery_chofer.id_order WHERE delivery_chofer.status = '1'";
                                                        $result_all_orders = mysqli_query($conexion, $search_all_orders);

                                                        while($row = mysqli_fetch_array($result_all_orders)) {
                                                            $idOrder = $row['id_order'];
                                                    ?>
                                                    <td><?php echo "00".$row['id_order']; ?></td>
                                                    <td><?php echo date("m/d/Y", strtotime($row['date_send'])); ?></td>
                                                    <td><?php echo $row['person_receive']; ?></td>
                                                    <td><?php echo $row['colonia']; ?></td>
                                                    <td><?php echo $row['cruce_calles']; ?></td>
                                                    <td><?php echo $row['name_flower']; ?></td>
                                                    <td>
                                                        <?php
                                                            $telephone = $row['phone']; 
                                                            $format = "(".substr($telephone,0,3).")"." ".substr($telephone,5,3)."-".substr($telephone,6,4);

                                                            echo $format;
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['name_encargado']; ?></td>
                                                    <td><?php echo $row['adress']; ?></td>

                                                    <?php if($typeUser === "Cliente") {?>
                                                        <td>
                                                            <a href="edit-order.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-success">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Cliente") {?>
                                                        <td>
                                                            <a href="edit-order.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-danger">
                                                                <i class="bi bi-trash"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Cliente") {?>
                                                        <td>
                                                            <a href="show-order-for-id.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-primary">
                                                                <i class="bi bi-eye-fill"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Chofer") {?>
                                                        <td>
                                                            <a href="show-order-for-id.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-primary">
                                                                <i class="bi bi-eye-fill"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <a href="show-order-for-id.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-primary">
                                                                <i class="bi bi-eye-fill"></i>
                                                            </a>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Chofer") {?>
                                                        <td>
                                                            <?php 
                                                                $query_delivery_order_chofer = "SELECT * FROM orders INNER JOIN delivery_chofer ON orders.id_order = delivery_chofer.id_order WHERE orders.id_order = '$idOrder'";
                                                                $result_delivery_order_chofer = mysqli_query($conexion, $query_delivery_order_chofer);

                                                                $data_chofer = mysqli_fetch_array($result_delivery_order_chofer);
                                                                $number_data_chofer = mysqli_num_rows($result_delivery_order_chofer);

                                                                if($number_data_chofer === 0) {
                                                            ?>

                                                            <form action="checked-delivery-order.php" method="POST">
                                                                <input type="hidden" name="id_delivery_chofer" value="<?php echo $idOrder; ?>">

                                                                <input type="hidden" name="hour_order_delivery">

                                                                <button type="submit" class="btn btn-success" name="click">
                                                                    <i class="bi bi-alarm-fill text-white"></i>
                                                                </button>
                                                            </form>

                                                            <?php } else {?>
                                                                <span class="badge badge-success"><i class="bi bi-alarm-fill"></i> Fecha y hora de entrega: <?php echo date('d/m/Y h:i A', strtotime($data_chofer['hour_order_delivery'])); ?></span>
                                                            <?php }?>
                                                        </td>
                                                    <?php }?>

                                                    <?php if($typeUser === "Administrador") {?>
                                                        <td>
                                                            <?php 
                                                                $query_delivery_for_admin = "SELECT * FROM orders INNER JOIN delivery_chofer ON orders.id_order = delivery_chofer.id_order INNER JOIN choferes ON choferes.id_user = delivery_chofer.id_user WHERE orders.id_order = '$idOrder'";
                                                                $result_delivery_for_admin = mysqli_query($conexion, $query_delivery_for_admin);

                                                                $data_delivery_for_admin = mysqli_fetch_array($result_delivery_for_admin);
                                                                $number_data_delivery_admin = mysqli_num_rows($result_delivery_for_admin);

                                                                if($number_data_delivery_admin > 0) {
                                                            ?>
                                                            <span class="badge badge-success"><i class="bi bi-alarm-fill"></i> Fecha y hora de entrega: <?php echo date('d/m/Y h:i A', strtotime($data_delivery_for_admin['hour_order_delivery'])); ?></span>
                                                        </td>
                                                    <?php }?>
                                                    
                                                    <?php }?>

                                                    <td>
                                                        <?php 
                                                            $query_delivery_chofer = "SELECT * FROM orders INNER JOIN delivery_chofer ON orders.id_order = delivery_chofer.id_order INNER JOIN choferes ON choferes.id_user = delivery_chofer.id_user WHERE orders.id_order = '$idOrder'";
                                                            $result_delivery_chofer = mysqli_query($conexion, $query_delivery_chofer);

                                                            $data_delivery_chofer = mysqli_fetch_array($result_delivery_chofer);
                                                            $number_data_delivery_chofer = mysqli_num_rows($result_delivery_chofer);

                                                            if($number_data_delivery_chofer > 0) {
                                                        ?>
                                                            <span class="badge badge-success"> Chofer: <?php echo $data_delivery_chofer['name']; ?></span>
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
    <script type="text/javascript">
      function notificationChofer() {
        $.ajax({
          url: "./notifications-chofer.php",
          type: "POST",
          processData:false,
          success: function(data){
            $("#notification_count").remove();                  
          },
          error: function(error){
            console.log(error);
          }           
        });
      }                                  
  </script> 
</body>
</html>