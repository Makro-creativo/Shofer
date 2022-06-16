<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_order'])) {
        $idOrder = $_GET['id_order'];

        $query_delete_order = "DELETE FROM orders WHERE id_order = '$idOrder'";
        $result_delete_order = mysqli_query($conexion, $query_delete_order);

        if(!$result_delete_order) {
            die("No se pudo eliminar correctamente el servicio, intentelo de nuevo...");
        }

        header("location: new-orders.php");
    }
?>