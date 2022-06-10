<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_user'])) {
        $idUser = $_GET['id_user'];

        $query_delete_chofer = "DELETE FROM choferes WHERE id_user = '$idUser'";
        $result_delete_chofer = mysqli_query($conexion, $query_delete_chofer);

        if(!$result_delete_chofer) {
            die("No se pudo eliminar correctamente el chofer, intentalo de nuevo...");
        }

        header("location: new-choferes.php");
    }
?>