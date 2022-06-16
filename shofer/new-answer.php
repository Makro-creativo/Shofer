<?php 
    include "./config/conexion.php";

    session_start();

    $uid2 = $_SESSION['UID2'];

    if(isset($_POST['saveAnswer'])) {
        $search_comments = "SELECT id_comment FROM comments";
        $result_comments = mysqli_query($conexion, $search_comments);

        $rowComments = mysqli_fetch_array($result_comments);
        $idComment = $rowComments['id_comment'];

        $idAnswer = $_POST['id_order_answer'];
        $message = $_POST['message'];

        $query_insert_answer = "INSERT INTO answers(id_comment, id_order, message, id_user, from_id, to_id, status, created_at) VALUES('$idComment', '$idAnswer', '$message', '1', '1', '$uid2', '0', NOW())";
        $result_insert = mysqli_query($conexion, $query_insert_answer);

        if($result_insert) {
            echo "<script>window.location='show-order-for-id.php?success'; </script>";
        }
    }
?>