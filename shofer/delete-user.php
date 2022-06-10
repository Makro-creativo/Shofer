<?php 
    include "./config/conexion.php";

    header('Content-type: application/json: charset=UTF-8');
    $response = array();

    if(isset($_GET['id'])) {
        $idUser = $_GET['id'];

        $query_delete_user = "DELETE FROM users WHERE id = '$idUser'";
        $result_delete_user = mysqli_query($conexion, $query_delete_user);

        if(!$result_delete_user) {
            die("No se pudo eliminar correctamente el usuario, intente de nuevo...");
        }

        header("location: new-users.php");
    }
?>