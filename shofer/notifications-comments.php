<?php
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $uid2 = $_SESSION['UID2'];

    $sql = "UPDATE comments SET status = 1 WHERE status = 0 AND id_user = '$uid2'";	
    $result = mysqli_query($conexion, $sql);

    $sql = "SELECT * FROM comments ORDER BY id_order DESC limit 5";
    mysqli_query($conexion, $sql);
?>