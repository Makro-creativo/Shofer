<?php
    include "./config/conexion.php";

    // Estrayendo los datos de la Base de datos
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consultas para traer el nombre de usuario y contraseña del usuario que este ingresando
    $query_users = "SELECT * FROM users WHERE (username = '$username' AND password = '$password') OR (username = '$username' AND password = '$password')";
    $result_users = mysqli_query($conexion, $query_users);

    // Preguntando si hay algún usuario registrado en la Base de datos
    if(mysqli_num_rows($result_users) > 0) {
        $row = mysqli_fetch_array($result_users);

        $profile = $row['type'];

        // Variables de sesión
        $_SESSION['name'] = $row['name'];
        $_SESSION['username'] = $username;
        $_SESSION['Type'] = $row['type'];
        $_SESSION['UID'] = $row['id'];
        $_SESSION['UID2'] = $row['id_user'];

        // Direccionando según el tipo de usuario
        if($profile === "Administrador") {
            echo "<script>window.location='DashboardAdmin.php'; </script>";
        } else if($profile === "Cliente") {
            echo "<script>window.location='DashboardCliente.php'; </script>";
        } else if($profile === "Chofer") {
            echo "<script>window.location='DashboardChofer.php'; </script>";
        } else {
            echo "<script>window.location='login.php?error'; </script>";
        }
    } else {
        echo "<script>window.location='login.php?error'; </script>";
    }
?>