<?php 
    include "./config/conexion.php";

    if(isset($_POST['save'])){
        $nameClient = $_POST['name'];
        $usernameClient = $_POST['username'];
        $passClient = $_POST['password'];
        $emailClient = $_POST['email'];
        $nameFlower = $_POST['name_flower'];
        $phone = $_POST['phone'];
        $adress = $_POST['adress'];
        //$status = $_POST['status'];
        
        $query_verify_users = "SELECT * FROM users WHERE username = '$usernameClient'";
        $result_verify_user = mysqli_query($conexion, $query_verify_users);

        if(mysqli_num_rows($result_verify_user) > 0) {
            echo "<script>window.location='signUpProvider.php?verify'; </script>";
        } else if($_POST['password'] === $_POST['repeatpassword']) {
             $passClient = $_POST['password'];
             //Insertar nuevo registro de correo
             $insert = "INSERT INTO users(name, username, password, type, email, name_flower, phone, adress, status) VALUES ('$nameClient', '$usernameClient', '$passClient', 'Cliente', '$emailClient', '$nameFlower', '$phone', '$adress', 'Activo')";
             $query = mysqli_query($conexion, $insert);
 
             //Buscar dato insertadš
             $search = "SELECT * FROM users WHERE password = '$passClient' ORDER BY id DESC";
             $queryS = mysqli_query($conexion, $search);
             $row = mysqli_fetch_array($queryS);
             $Perfil = $row['type'];
             // Variables de Sesion
             $_SESSION['name'] = $row['name'];
             $_SESSION['username'] = $row['username'];
             $_SESSION['Type'] = $row['type'];
             $_SESSION['UID'] = $row['id'];
             // Redirección Segun el tipo de usuario
             if($Perfil=="Administrador"){
               echo "<script>window.location='DashboardAdmin.php'; </script>";
             }else if($Perfil == "Cliente") {
               echo "<script>window.location='DashboardCliente.php'; </script>";
             } else if($Perfil == "Chofer") {
               echo "<script>window.location='DashboardChofer.php'; </script>";
             } else {
                 echo "<script>window.location='signUpProvider.php?error'; </script>";
             }
        } else {
            echo "<script>window.location='signUpProvider.php?batPassword'; </script>";
        }
        
    } 
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHO-FER - cuenta proveedor</title>
    <link href="./assets/images/favicon_shofer.svg" rel="icon">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .hero-provider {
            background-color: #000000;
            width: 100%;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <?php
        if(isset($_GET['error'])) {
    ?>       

        <script>
            Swal.fire(
                'Error',
                'No se pudo crear la cuenta, intentelo de nuevo',
                'error'
            )
        </script>
    <?php } ?>


    <?php
        if(isset($_GET['verify'])) {
    ?>       

        <script>
            Swal.fire(
                'Error',
                'El nombre de usuario con el que intentas registrarte ya existe, intenta con otro',
                'error'
            )
        </script>
    <?php } ?>

    <?php
        if(isset($_GET['batPassword'])) {
    ?>       

        <script>
            Swal.fire(
                'Error',
                'Las contraseñas no coinciden, intente nuevamente.',
                'error'
            )
        </script>
    <?php } ?>
    <!-- Navbar of sign up -->  
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="assets/images/rojo/shofer_rojo_512.png" alt="logo" class="img-fluid" width="100" height="100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="login.php" class="btn btn-dark">¿Ya tienes una cuenta?</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <!-- End Navbar of sign up -->
        
    <!-- Hero main for provider -->
    <div class="hero-provider">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 col-lg-5 col-xl-5 col-xxl-5 mt-4">
                    <h2 class="text-white fw-bold mt-4 display-4">Recibe tu arreglo floral sano y salvo</h2>

                    <p class="text-white mt-4">
                        Regístrate cómo proveedor para realizar tus servicios fácil y rápido.
                    </p>
                </div>

                <div class="col-md-7 col-sm-12 col-lg-7 col-xl-7 col-xxl-7 mt-4">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h4 class="text-center mb-3">Regístrate</h4>

                            <form action="signUpProvider.php" method="POST">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <label>Nombre completo: </label>
                                            <input type="text" name="name" placeholder="Nombre completo..." class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12  ">
                                        <div class="form-group">
                                            <label>Nombre de usuario: </label>
                                            <input type="text" name="username" class="form-control" placeholder="Nombre de usuario..." required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="form-group">
                                            <label>Correo electrónico: </label>
                                            <input type="email" name="email" class="form-control" placeholder="correoexample.hotmail.com" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="input-group">
                                            <input class="form-control" type="password" name="password" placeholder="Contraseña" id="txtPassword">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary
                                                " type="button" onclick="showPassword()" id="show_password">
                                                    <i class="bi bi-eye-slash-fill"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12 col-xxl-12">
                                        <div class="input-group">
                                            <input class="form-control" type="password" name="repeatpassword" placeholder="Repetir contraseña" id="repeatPassword">
                                            <span class="input-group-append">
                                                <button class="btn btn-outline-secondary
                                                " type="button" onclick="showPasswordRepeat()" id="show_password_repeat">
                                                    <i class="bi bi-eye-slash-fill"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                        <div class="form-group">
                                            <label>Nombre de la empresa: </label>
                                            <input type="text" name="name_flower" class="form-control" placeholder="Nombre de la florería..." required>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                        <div class="form-group">
                                            <label>Dirección: </label>
                                            <input type="text" name="adress" class="form-control" placeholder="Direción..." required>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-lg-4 col-xl-4 col-xxl-4 mt-3">
                                        <div class="form-group">
                                            <label>Número de teléfono: </label>
                                            <input type="text" name="phone" class="form-control" placeholder="Número de teléfono..." required>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <input type="submit" value="Regístrate" class="btn btn-dark" name="save">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End hero main for provider -->







  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/ruang-admin.min.js"></script>
  <script type="text/javascript">
    function showPassword(){
        let change = document.getElementById("txtPassword");
        if(change.type == "password"){
          change.type = "text";
          $('.icon').removeClass('fa-solid fa-eye-slash').addClass('fa-solid fa-eye');
        } else {
          change.type = "password";
          $('.icon').removeClass('fa-solid fa-eye').addClass('fa-solid fa-eye-slash');
        }
      } 
      
      $(document).ready(function () {
      //CheckBox mostrar contraseña
      $('#ShowPassword').click(function () {
        $('#password').attr('type', $(this).is(':checked') ? 'text' : 'password');
      });
    });
</script>

<script type="text/javascript">
    function showPasswordRepeat(){
        let change = document.getElementById("repeatPassword");
        if(change.type == "password"){
          change.type = "text";
          $('.icon').removeClass('fa-solid fa-eye-slash').addClass('fa-solid fa-eye');
        } else {
          change.type = "password";
          $('.icon').removeClass('fa-solid fa-eye').addClass('fa-solid fa-eye-slash');
        }
      } 
      
      $(document).ready(function () {
      //CheckBox mostrar contraseña
      $('#ShowPassword').click(function () {
        $('#password').attr('type', $(this).is(':checked') ? 'text' : 'password');
      });
    });
</script>
</body>
</html>