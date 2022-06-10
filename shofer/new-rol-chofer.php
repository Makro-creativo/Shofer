<?php
    include "./config/conexion.php";

    if(isset($_POST['saveChofer'])) {
        $info_chofer = $_POST['info_chofer'];
        $array = explode("_", $info_chofer);
        $idChofer = $array[0];
        $nameChofer = $array[1];

        $username = $_POST['username'];
        $password = $_POST['password'];
        $type = $_POST['type'];

        $query_save_client = "INSERT INTO users(id_user, name, username, password, type) VALUES('$idChofer', '$nameChofer', '$username', '$password', '$type')";
        $result_save_client = mysqli_query($conexion, $query_save_client);

        if($result_save_client) {
            echo "<script>window.location='new-users.php?bien'; </script>";
        }
    }
?>