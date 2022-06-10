<?php
    include "./config/conexion.php";

    if(isset($_POST['saveClient'])) {
        $info_client = $_POST['info_client'];
        $array = explode("_", $info_client);
        $idClient = $array[0];
        $nameClient = $array[1];

        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['type'];

        $query_save_client = "INSERT INTO users(id_user, name, username, password, type) VALUES('$idClient', '$nameClient', '$username', '$password', '$type')";
        $result_save_client = mysqli_query($conexion, $query_save_client);

        if($result_save_client) {
            echo "<script>window.location='new-users.php?bien'; </script>";
        }
    }
?>