<?php
    include "./config/conexion.php";

    if(isset($_POST['register'])){
        $nameCompleted = $_POST['nameCompleted'];
        $usernameUser = $_POST['usernameUser'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        
            //Insertar nuevo registro de correo
            $insert = "INSERT INTO users(name, username, password, type, email) VALUES ('$nameCompleted', '$usernameUser', '$pass',' Chofer', '$email')";
            $query = mysqli_query($conexion, $insert);

            //Buscar dato insertado
            $search = "SELECT * FROM users WHERE password = '$pass' ORDER BY id DESC";
            $queryS = mysqli_query($conexion, $search);
            $row = mysqli_fetch_array($queryS);
            $Profile = $row['type'];    
            // Variables de Sesion
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['Type'] = $row['type'];
            $_SESSION['UID'] = $row['id'];
            // Redirección Segun el tipo de usuario
            if($Profile == "Administrador"){
              echo "<script>window.location='DashboardAdmin.php'; </script>";
            }else if($Profile == "Cliente") {
              echo "<script>window.location='DashboardCliente.php'; </script>";
            } else if($Profile == "Chofer") {
              echo "<script>window.location='DashboardChofer.php'; </script>";
            }else{
              echo "<script>window.location='create-account.php?error'; </script>";
            }    
        
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHO-FER - Crear cuenta</title>
    <link href="img/logo/logo.png" rel="icon">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/ruang-admin.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .bg-hero-login {
        background-image: url("../img/fondo_shofer.jpg");
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        width: 100%;
        min-height: 100vh;
        }

        .form-opacity {
        opacity: 0.8;
        }

        .mt-6 {
        margin-top: 10rem !important;
        margin-bottom: 10rem !important;
        }

        body {
            font-family: "Karla", sans-serif;
            background-color: #fff;
            min-height: 100vh; }

        .brand-wrapper {
            padding-top: 7px;
            padding-bottom: 8px; }
        .brand-wrapper .logo {
            height: 25px; }

        .login-section-wrapper {
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
                    flex-direction: column;
        padding: 68px 100px;
        background-color: #fff; }
        @media (max-width: 991px) {
            .login-section-wrapper {
            padding-left: 50px;
            padding-right: 50px; } }
        @media (max-width: 575px) {
            .login-section-wrapper {
            padding-top: 20px;
            padding-bottom: 20px;
            min-height: 100vh; } }

.login-wrapper {
  width: 300px;
  max-width: 100%;
  padding-top: 24px;
  padding-bottom: 24px; }
  @media (max-width: 575px) {
    .login-wrapper {
      width: 100%; } }
  .login-wrapper label {
    font-size: 14px;
    font-weight: bold;
    color: #b0adad; }
  .login-wrapper .form-control {
    border: none;
    border-bottom: 1px solid #e7e7e7;
    border-radius: 0;
    padding: 9px 5px;
    min-height: 40px;
    font-size: 18px;
    font-weight: normal; }
    .login-wrapper .form-control::-webkit-input-placeholder {
      color: #b0adad; }
    .login-wrapper .form-control::-moz-placeholder {
      color: #b0adad; }
    .login-wrapper .form-control:-ms-input-placeholder {
      color: #b0adad; }
    .login-wrapper .form-control::-ms-input-placeholder {
      color: #b0adad; }
    .login-wrapper .form-control::placeholder {
      color: #b0adad; }
  .login-wrapper .login-btn {
    padding: 13px 20px;
    background-color: #fdbb28;
    border-radius: 0;
    font-size: 20px;
    font-weight: bold;
    color: #fff;
    margin-bottom: 14px; }
    .login-wrapper .login-btn:hover {
      border: 1px solid #fdbb28;
      background-color: #fff;
      color: #fdbb28; }
  .login-wrapper a.forgot-password-link {
    color: #080808;
    font-size: 14px;
    text-decoration: underline;
    display: inline-block;
    margin-bottom: 54px; }
    @media (max-width: 575px) {
      .login-wrapper a.forgot-password-link {
        margin-bottom: 16px; } }
  .login-wrapper-footer-text {
    font-size: 16px;
    color: #000;
    margin-bottom: 0; }

    .login-title {
    font-size: 30px;
    color: #000;
    font-weight: bold;
    margin-bottom: 25px; }

    .login-img {
    width: 100%;
    height: 100vh;
    -o-object-fit: cover;
        object-fit: cover;
    -o-object-position: left;
        object-position: left; }

    .footer-link {
    position: absolute;
    bottom: 1rem;
    text-align: center;
    width: 100%; }

/*# sourceMappingURL=login.css.map */
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
<main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
            <h2>Registrate para poder trabajar con nostros y poder hacer lo que más te apasiona</h2>
          </div>
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Crear cuenta</h1>
            <form action="create-account.php" method="POST">

              <div class="form-group">
                <label for="text">Nombre completo: </label>
                <input type="text" name="nameCompleted" id="email" class="form-control" placeholder="Nombre completo" required>
              </div>

              <div class="form-group">
                <label for="text">Nombre de usuarios: </label>
                <input type="text" name="usernameUser" id="email" class="form-control" placeholder="Ejemplo: JorgeM" required>
              </div>

              <div class="form-group">
                <label for="email">Correo electrónico: </label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@example.com">
              </div>

              <div class="form-group mb-4">
                <label for="password">Contraseña</label>
                <input type="password" name="pass" id="password" class="form-control" placeholder="Ingresar contraseña" required>
              </div>

              <input name="register" id="login" class="btn btn-block login-btn" type="submit" value="Registrate">
            </form>
            
            <p class="login-wrapper-footer-text">Si ya tienes una cuenta <a href="login.php" class="text-reset">Inicia sesión</a></p>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="../shofer/assets/images/drive-account.jpeg" alt="login image" class="login-img">
          <p class="text-white font-weight-medium text-center flex-grow align-self-end footer-link">
            <a href="../shofer/assets/images/drive.png" target="_blank" class="text-white">
          </p>
        </div>
      </div>
    </div>
  </main>
</body>
</html>