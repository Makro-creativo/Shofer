<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $idAnswer = $_GET['id'];
        
        $query_delete_answer = "DELETE FROM answers WHERE id = '$idAnswer'";
        $result_delete_answer = mysqli_query($conexion, $query_delete_answer);

        if(!$result_delete_answer) {
            die("No se pudo eliminar correctamente la respuesta...");
        }

        header("location: new-orders.php");
    }
?>