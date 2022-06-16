<?php
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $sql = "UPDATE answers SET status = 1 WHERE status = 0";	
    $result = mysqli_query($conexion, $sql);

    $sql = "SELECT * FROM answers ORDER BY id_comment DESC limit 10";
    mysqli_query($conexion, $sql);
?>