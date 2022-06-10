<?php 
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $typeUser = $_SESSION['Type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHO-FER - boleta de pedido</title>
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

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/navbar.php" ?>

                <?php 
                    include "./config/conexion.php";

                    if(isset($_GET['id_order'])) {
                        $idOrder = $_GET['id_order'];

                        $search_orders = "SELECT * FROM orders WHERE id_order = '$idOrder'";
                        $result_orders = mysqli_query($conexion, $search_orders);

                        if($result_orders) {
                            $row = mysqli_fetch_array($result_orders);

                            $folio = $row['id_order'];
                            $dateSend = $row['date_send'];
                            $nameFlower = $row['name_flower'];
                            $colonia = $row['colonia'];
                            $cruceCalles = $row['cruce_calles'];
                            $personReceive = $row['person_receive'];
                            $phone = $row['phone'];
                        }
                    }
                ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="main">
                                <div class="container mt-3">
                                    <div class="card shadow-lg animate__animated animate__fadeIn">
                                        <div class="card-header">
                                        <?php 
                                            $query_delivery_order_chofer = "SELECT * FROM orders INNER JOIN delivery_chofer ON orders.id_order = delivery_chofer.id_order WHERE orders.id_order = '$idOrder'";
                                            $result_delivery_order_chofer = mysqli_query($conexion, $query_delivery_order_chofer);

                                            $data_chofer = mysqli_fetch_array($result_delivery_order_chofer);
                                            $number_data_chofer = mysqli_num_rows($result_delivery_order_chofer);

                                            if($number_data_chofer === 0) {
                                        ?>
                                            Fecha:
                                            <strong><?php echo $dateSend; ?></strong>
                                            <span class="float-right badge badge-danger"> <strong>Estado:</strong> Pendiente</span>
                                        <?php } else {?>
                                            Fecha:
                                            <strong><?php echo $dateSend; ?></strong>
                                            <span class="float-right badge badge-success"> <strong>Estado:</strong>
                                                Entregado -
                                                Fecha y hora de entrega: <?php echo date("m/d/Y h:i A", strtotime($data_chofer['hour_order_delivery'])); ?>
                                            </span>
                                        <?php }?>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-4">
                                                <div class="col-6 col-md-6">
                                                    <h6 class="mb-2">De:</h6>
                                                    <div>
                                                        Folio: <strong><?php echo "00".$folio; ?></strong>
                                                    </div>
                                                    <div>
                                                        <strong><?php echo $nameFlower; ?></strong>
                                                    </div>
                                                    <div>Colonia: <?php echo $colonia; ?></div>
                                                    <div>Cruce de calles: <?php echo $cruceCalles; ?></div>
                                                    <div>Persona que recibe: <?php echo $personReceive; ?></div>
                                                    <div>Teléfono: <?php echo "+52 ".$phone; ?></div>
                                                </div>

                                                <div class="col-6 col-md-6">
                                                    <h6 class="mb-2">Para:</h6>
                                                    <div>
                                                        <strong>Fercho</strong>
                                                    </div>
                                                    <div>Correo electronico: fercho@floreria.com</div>
                                                    <div>Dirección: Avenida de los arcos #789</div>
                                                    <div>Empresa: CHOFER</div>
                                                    <div>Teléfono: +48 123 456 789</div>
                                                </div>

                                            </div>

                                            <!--<div class="table-responsive-sm">
                                                <table class="table table-sm table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" width="2%" class="center">#</th>
                                                            <th scope="col" width="20%">Producto/Servicio</th>
                                                            <th scope="col" class="d-none d-sm-table-cell" width="50%">Descripción</th>

                                                            <th scope="col" width="10%" class="text-right">P. Unidad</th>
                                                            <th scope="col" width="8%" class="text-right">Num.</th>
                                                            <th scope="col" width="10%" class="text-right">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-left">1</td>
                                                            <td class="item_name">Origin License</td>
                                                            <td class="item_desc d-none d-sm-table-cell">Extended License</td>

                                                            <td class="text-right">999,00€</td>
                                                            <td class="text-right">1</td>
                                                            <td class="text-right">999,00€</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="center">2</td>
                                                            <td class="item_name">Custom Services</td>
                                                            <td class="item_desc d-none d-sm-table-cell">Instalation and Customization (cost per hour)</td>

                                                            <td class="text-right">150,00€</td>
                                                            <td class="text-right">20</td>
                                                            <td class="text-right">3.000,00€</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="center">3</td>
                                                            <td class="item_name">Hosting</td>
                                                            <td class="item_desc d-none d-sm-table-cell">1 year subcription</td>

                                                            <td class="text-right">499,00€</td>
                                                            <td class="text-right">1</td>
                                                            <td class="text-right">499,00€</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="center">4</td>
                                                            <td class="item_name">Platinum Support</td>
                                                            <td class="item_desc d-none d-sm-table-cell">1 year subcription 24/7</td>

                                                            <td class="text-right">3.999,00€</td>
                                                            <td class="text-right">1</td>
                                                            <td class="text-right">3.999,00€</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>-->
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-5">
                                                </div>

                                                <!--<div class="col-lg-4 col-sm-5 ml-auto">
                                                    <table class="table table-sm table-clear">
                                                        <tbody>
                                                            <tr>
                                                                <td class="left">
                                                                    <strong>Subtotal</strong>
                                                                </td>
                                                                <td class="text-right bg-light">8.497,00€</td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td class="left">
                                                                    <strong>Total</strong>
                                                                </td>
                                                                <td class="text-right bg-light">
                                                                    <strong>7.477,36€</strong>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>-->

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>

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