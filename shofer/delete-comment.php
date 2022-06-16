<?php 
    include "./config/conexion.php";
    error_reporting(0);

    if(isset($_GET['id_comment'])) {
        $idComment = $_GET['id_comment'];

        $query_delete_comment = "DELETE FROM comments WHERE id_comment = '$idComment'";
        $result_delete_comment = mysqli_query($conexion, $query_delete_comment);

        if(!$result_delete_comment) {
            die("No se pudo eliminar correctamente el comentario...");
        }

        header("location: new-orders.php");
    }
?>