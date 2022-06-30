<?php 
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $uid = $_SESSION['UID'];
    $uid2 = $_SESSION['UID2'];
    $typeUser = $_SESSION['Type'];

    error_reporting(0);

    if(isset($_POST['inbox'])) {
        $idChoferAdd = $_POST['id_user_chofer'];
        $asunto = $_POST['asunto'];
        $description = $_POST['description'];
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

        echo $query_save_inbox = "INSERT INTO inbox(id_user, asunto, description, image, from_id, to_id, status, created_At) VALUES('$idChoferAdd', '$asunto', '$description', '$ruta', '$uid', '$uid2', '0', NOW())";
        //$result_save_inbox = mysqli_query($conexion, $query_save_inbox);

        /*if($result_save_inbox) {
            echo "<script>window.location='new-inbox.php?bien'; </script>";
        }*/
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHO-FER - inbox</title>
    <link rel="shortcut icon" href="assets/images/favicon_shofer.svg" type="image/x-icon">
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
                    text: 'Se envío correctamente el mensaje!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "new-inbox.php";
                });
            </script>
        <?php } ?>

        <?php   
            if(isset($_GET['bien'])){
        ?>
            <script>
                Swal.fire({
                    title: 'Listo',
                    text: 'Se envío correctamente el mensaje!',
                    icon: 'success',
                        confirmButtonText: 'Ok'
                    })
                    .then(function() {
                        window.location = "new-inbox.php";
                });
            </script>
        <?php } ?>

        <?php include "./partials/menuLeft.php" ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "./partials/navbar.php" ?>
                
                <div class="container">
                    <h2 class="d-flex justify-content-start mb-4">Inbox</h2>
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4 mt-4">
                        
                            <div class="card shadow-lg">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inbo">
                                    Redactar
                                </button>

                                <?php if($typeUser === "Administrador") {?>
                                    <div class="card-header">
                                        Folder
                                    </div>
                                <?php }?>

                                <?php if($typeUser === "Chofer") {?>
                                    <div class="card-header">
                                        Folder
                                    </div>
                                <?php }?>
                                
                                <?php if($typeUser === "Administrador") {?>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-inbox"></i>
                                                Inbox
                                            </div>
                                            <span class="badge bg-primary rounded-pill">
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $search_count_inbox_admin = "SELECT * FROM inbox_admin";
                                                    $result_count_inbox = mysqli_query($conexion, $search_count_inbox_admin);

                                                    $count_inbox_admin = mysqli_num_rows($result_count_inbox);

                                                    echo $count_inbox_admin;
                                                ?>
                                            </span>
                                        </li>
                                
                                    </ul>
                                <?php }?>

                                <?php if($typeUser === "Chofer") {?>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-inbox"></i>
                                                Inbox
                                            </div>
                                            <span class="badge bg-primary rounded-pill">
                                                <?php 
                                                    include "./config/conexion.php";

                                                    $total_inbox_chofer = "SELECT * FROM users INNER JOIN inbox ON users.id = inbox.id_user WHERE type = 'Chofer' AND inbox.id_user = '$uid'";
                                                    $result_total_inbox = mysqli_query($conexion, $total_inbox_chofer);

                                                    $count_inbox_chofer = mysqli_num_rows($result_total_inbox);

                                                    echo $count_inbox_chofer;
                                                ?>
                                            </span>
                                        </li>
                                
                                    </ul>
                                <?php }?>
                            </div>
                        </div>
                        
                        <?php if($typeUser === "Administrador") {?>
                            <div class="col-md-8 col-sm-12 col-lg-8 col-xl-8 col-xxl-8 mt-4">
                                <div class="card shadow-lg">
                                    <div class="card-header">Inbox</div>

                                    <div class="card-body">
                                        <div class="list-group">
                                            <?php 
                                                include "./config/conexion.php";
                        
                                                $search_info_inbox_admin = "SELECT * FROM inbox_admin ORDER BY created_at DESC";
                                                $result_info_inbox = mysqli_query($conexion, $search_info_inbox_admin);

                                                while($rowInboxAdmin = mysqli_fetch_array($result_info_inbox)) {
                                            ?>
                                            <a href="show-inbox-for-admin.php?id=<?php echo $rowInboxAdmin['id']; ?>" class="list-group-item list-group-item-action active" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"><?php echo $rowInboxAdmin['asunto']; ?></h5>
                                                <small><?php echo date("m/d/Y h:i A",strtotime($rowInboxAdmin['created_at'])); ?></small>
                                                </div>
                                                <small>De: <?php echo $rowInboxAdmin['name_user']; ?></small>
                                            </a>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>


                        <?php if($typeUser === "Chofer") {?>
                            <div class="col-md-8 col-sm-12 col-lg-8 col-xl-8 col-xxl-8 mt-4">
                                <div class="card shadow-lg">
                                    <div class="card-header">Inbox</div>

                                    <div class="card-body" id="inbox">
                                        <div class="list-group">
                                            <?php  
                                                include "./config/conexion.php";

                                                $search_all_inbox_chofer = "SELECT * FROM users INNER JOIN inbox ON users.id = inbox.id_user WHERE inbox.id_user = '$uid' AND type = 'Chofer'";
                                                $result_all_inbox_chofer = mysqli_query($conexion, $search_all_inbox_chofer);

                                                while($row = mysqli_fetch_array($result_all_inbox_chofer)) {
                                            ?>
                                            <a href="show-inbox-for-id.php?id=<?php echo $row['id']; ?>" class="list-group-item list-group-item-action active" aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"><?php echo $row['asunto']; ?></h5>
                                                <small><?php echo date("m/d/Y h:i A", strtotime($row['description'])); ?></small>
                                                </div>
                                            </a>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                </div>


            </div>
            <br>
            
            <?php if($typeUser === "Administrador") {?>
            <!-- Modal for create inbox -->
            <div class="modal fade" id="inbo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo mensaje</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       <form action="new-inbox.php" method="POST" enctype="multipart/form-data">
                           <div class="row">
                               <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                   <div class="form-group">
                                       <label>Seleccionar distinario: </label>
                                       <select name="id_user_chofer" class="form-control">
                                           <option disabled selected>Elegir destinario</option>
                                           <?php 
                                                include "./config/conexion.php";

                                                $search_choferes = "SELECT * FROM users WHERE type = 'Chofer' ORDER BY name ASC";
                                                $result_choferes = mysqli_query($conexion, $search_choferes);

                                                while($rowChofer = mysqli_fetch_array($result_choferes)) {
                                                    $idChofer = $rowChofer['id'];
                                                    $nameChofer = $rowChofer['name'];
                                           ?>
                                            <option value="<?php echo $idChofer ?>"><?php echo $nameChofer; ?></option>
                                           <?php }?>
                                       </select>
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                               <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                   <div class="form-group">
                                       <label>Asunto: </label>
                                       <input type="text" placeholder="Asunto" name="asunto" class="form-control">
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                               <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                   <div class="form-group">
                                       <label>Describe tu mensaje: </label>
                                       <textarea name="description" cols="30" rows="10" placeholder="Describir mensaje" class="form-control"></textarea>
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                               <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                   <div class="form-group">
                                       <label class="form-label"></label>
                                       <input type="file" name="image" class="form-control">
                                   </div>
                               </div>
                           </div>

                          <button type="submit" class="btn btn-primary" name="inbox">
                            <i class="bi bi-inbox-fill"></i>
                            Enviar
                          </button>
                       </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- End Modal for create inbox -->
            <?php }?>

            <?php if($typeUser === "Chofer") {?>
            <!-- Modal for create inbox -->
            <div class="modal fade" id="inbo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nuevo mensaje</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                       <form action="new-inbox-for-admin.php" method="POST" enctype="multipart/form-data">
                           <input type="hidden" name="id_chofer_uid" value="<?php echo $uid; ?>">
                           <div class="row">
                               <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                   <div class="form-group">
                                       <label>Asunto: </label>
                                       <input type="text" placeholder="Asunto" name="asunto" class="form-control">
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                               <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                   <div class="form-group">
                                       <label>Describe tu mensaje: </label>
                                       <textarea name="description" cols="30" rows="10" placeholder="Describir mensaje" class="form-control"></textarea>
                                   </div>
                               </div>
                           </div>

                           <div class="row">
                               <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                   <div class="form-group">
                                       <label class="form-label"></label>
                                       <input type="file" name="image_url" class="form-control">
                                   </div>
                               </div>
                           </div>

                          <button type="submit" class="btn btn-primary" name="inboxAdmin">
                            <i class="bi bi-inbox-fill"></i>
                            Enviar
                          </button>
                       </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>
            <!-- End Modal for create inbox -->
            <?php }?>

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
</body>
</html>