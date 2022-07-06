<?php 
    include "./config/conexion.php";

    if(!isset($_SESSION['UID'])) {
        session_start();
    }

    $uid = $_SESSION['UID'];

    if(isset($_POST['save'])) {
        $idChofer = $_POST['id_user'];
        $array = explode("_", $idChofer);
        // Data of asign orders to choferes
        $idOrder = $_POST['id_order'];

        $search_choferes = "SELECT id, name FROM users WHERE id = '$idChofer'";
        $result_choferes = mysqli_query($conexion, $search_choferes);
        $rowChofer = mysqli_fetch_array($result_choferes);
        $idUserChofer = $rowChofer['id'];
        $nameChofer = $rowChofer['name'];
            
        $query_save_asign_order = "INSERT INTO asign_orders_chofer(id_user, id_order, from_id, to_id, status, name_chofer, created_at) VALUES('$idUserChofer   ', '$idOrder', '$uid', '$idUserChofer', '0', '$nameChofer', NOW())";
        $result_save_asign_order = mysqli_query($conexion, $query_save_asign_order);

        if($result_save_asign_order) {
            echo "<script>window.location='new-orders.php?exitoService'; </script>";
        }
    }
?>