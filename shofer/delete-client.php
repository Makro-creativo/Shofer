<?php 
    include "./config/conexion.php";

    if(isset($_GET['id'])) {
        $idUser = $_GET['id'];

        $query_delete_client = "DELETE FROM users WHERE id = '$idUser'";
        $result_delete_client = mysqli_query($conexion, $query_delete_client);

        if(!$result_delete_client) {
            die("No se puedo eliminar el cliente, intentelo de nuevo...");
        }

        header("location: new-clients.php");
    }

?>