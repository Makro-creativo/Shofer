<?php
    include "./config/conexion.php";

    $sql = "UPDATE delivery_chofer SET status = 1 WHERE status = 0";	
    $result = mysqli_query($conexion, $sql);

    $sql = "SELECT * FROM delivery_chofer ORDER BY id_order DESC limit 5";
    mysqli_query($conexion, $sql);
?>