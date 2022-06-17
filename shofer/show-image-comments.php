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
    <title>SHO-FER imagen</title>
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

        <?php 
            include "./config/conexion.php";

            if(isset($_GET['id_comment'])) {
                $idComment = $_GET['id_comment'];

                $search_imagen_for_id = "SELECT * FROM comments WHERE id_comment = '$idComment'";
                $result_imagen = mysqli_query($conexion, $search_imagen_for_id);

                if($result_imagen) {
                    $rowImagen = mysqli_fetch_array($result_imagen);

                    $imagenComment = $rowImagen['image'];
                }
            }
        ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/navbar.php" ?>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                            <?php if($typeUser === "Administrador") {?>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h2 class="text-dark">Imagen del comentario</h2>

                                    <a href="DashboardAdmin.php" class="btn btn-secondary btn-sm">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                        Regresar atrás
                                    </a>
                                </div>
                            <?php }?>

                            <?php if($typeUser === "Cliente") {?>
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h2 class="text-dark">Imagen del comentario</h2>

                                    <a href="DashboardCliente.php" class="btn btn-secondary btn-sm">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                        Regresar atrás
                                    </a>
                                </div>
                            <?php }?>

                           <div class="card shadow-lg">
                                <div class="card-header">Imagen del comentario</div>

                                <div class="card-body">
                                    <?php 
                                        if(!$imagenComment) {
                                            echo "No imagen para mostrar";
                                        } 
                                    ?>
                                    <img src="<?php echo $imagenComment; ?>" alt="" class="img-card-top img-fluid rounded mx-auto">
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