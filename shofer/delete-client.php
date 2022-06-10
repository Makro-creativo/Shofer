<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_user'])) {
        $idUser = $_GET['id_user'];

        $query_delete_client = "DELETE FROM clients WHERE id_user = '$idUser'";
        $result_delete_client = mysqli_query($conexion, $query_delete_client);

        if(!$result_delete_client) {
            die("No se puedo eliminar el cliente, intentelo de nuevo...");
        }

        header("location: new-clients.php");
    }

?>