<?php
    include "./config/conexion.php";

    $sql = "UPDATE inbox_admin SET status = 1 WHERE status = 0";	
    $result = mysqli_query($conexion, $sql);

    $sql = "SELECT * FROM inbox_admin ORDER BY id DESC limit 10";
    mysqli_query($conexion, $sql);
?>