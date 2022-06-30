<?php 
    include "./config/conexion.php";

    if(isset($_POST['saveKilometer'])) {
        $idOrderKilometer = $_POST['id_order_kilometer'];
        $kilometer = $_POST['kilometer'];

        $query_save_kilometer = "INSERT INTO asign_kilometer_order(id_order, kilometer, created_at) VALUES('$idOrderKilometer', '$kilometer', NOW())";
        $result_save_kilometer = mysqli_query($conexion, $query_save_kilometer);

        if($result_save_kilometer) {
            echo "<script>window.location='new-orders.php?exito'; </script>";
        }
    }
?>