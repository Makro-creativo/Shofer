<?php
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $uid = $_SESSION['UID'];

    $sql = "UPDATE asign_orders_chofer SET status = 1 WHERE status = 0 AND id_user = '$uid'";	
    $result = mysqli_query($conexion, $sql);

    $sql = "SELECT * FROM asign_orders_chofer ORDER BY id_order DESC limit 10";
    mysqli_query($conexion, $sql);
?>