<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="assets/images/favicon_shofer.svg" type="image/x-icon">
  <title>SHO-FER - Login</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="../css/ruang-admin.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
  </style>
</head>

<body class="bg-hero-login">
    <?php
        if(isset($_GET['error'])) {
    ?>       

        <script>
            Swal.fire(
                'Error',
                'Acceso incorrecto, Intente de nuevo',
                'error'
            )
        </script>
    <?php } ?>

  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5 form-opacity mt-6">
          <img src="../img/logos_shofer-02.png" alt="Logo shofer" class="img-card-top img-fluid mx-auto" style="width: 120px; height:120px;">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12 p-2">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Iniciar sesión</h1>
                  </div>
                  <form class="user" action="access.php" method="POST">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Nombre de usuario..." name="username">
                    </div>

                    <div class="input-group">
                      <input class="form-control py-2" type="password" name="password" placeholder="Contraseña" id="txtPassword">
                      <span class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" onclick="showPassword()" id="show_password">
                          <i class="bi bi-eye-slash-fill"></i>
                        </button>
                      </span>
                    </div>
                   
                    <div class="form-group mt-4">
                      <button type="submit" class="btn btn-secondary btn-block">
                        <i class="bi bi-box-arrow-right"></i>
                        Ingresar
                      </button>
                    </div>
                    
                    <div class="d-flex justify-content-center align-items-center">
                      <a href="/shofer/shofer" class="text-secondary">
                        <p class="text-center" style="font-size: 20px;">
                          <i class="bi bi-arrow-left-circle-fill" style="font-size: 20px;"></i>
                          Regresar a incio
                        </p>
                      </a>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
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
</body>

</html>