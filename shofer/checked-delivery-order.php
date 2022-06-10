<?php 
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $uid2 = $_SESSION['UID2'];

    if(isset($_POST['click'])) {
        $idDelivery = $_POST['id_delivery_chofer'];
        $dateDelivery = $_POST['hour_order_delivery'];

        $query_insert_delivery_order = "INSERT INTO delivery_chofer(id_order, id_user, from_id, to_id, status, hour_order_delivery) VALUES('$idDelivery', '$uid2', '$uid2', '1', '0', NOW())";
        $result_inser_delivery_order = mysqli_query($conexion, $query_insert_delivery_order);

       if($result_inser_delivery_order) {
            echo "<script>window.location='show-order-chofer.php?success'; </script>";
        }
    }
?>