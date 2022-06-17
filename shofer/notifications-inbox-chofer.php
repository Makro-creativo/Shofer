<?php
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $uid2 = $_SESSION['UID2'];

    $sql = "UPDATE inbox SET status = 1 WHERE status = 0 AND id_user = '$uid2'";	
    $result = mysqli_query($conexion, $sql);

    $sql = "SELECT * FROM inbox ORDER BY id DESC limit 10";
    mysqli_query($conexion, $sql);
?>