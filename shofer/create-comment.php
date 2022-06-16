<?php 
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $uid2 = $_SESSION['UID2'];

    if(isset($_POST['saveComment'])) {
        $search_clients = "SELECT id_user FROM clients";
        $result_clients = mysqli_query($conexion, $search_clients);
        
        $rowClient = mysqli_fetch_array($result_clients);
        $idClient = $rowClient['id_user'];

        $idOrder = $_POST['id_order_comment'];
        //imagen 
        $directorio = "assets/images/"; 
        $nombreDoc = $_FILES['image']['name'];
        
        $formatosDoc = array('.JPG','.jpg','.png','.PNG','.PDF','.pdf','.docx'); //formatos a admitir
        $tmpDoc = $_FILES['image']['tmp_name']; //Nombre temporal del archivo
        $extension = substr($nombreDoc, strrpos($nombreDoc,'.'));   //Para cortar la caden y obtener solo la 
                                    
        $ruta = $directorio.$nombreDoc; 
    
        if(in_array($extension, $formatosDoc)){ //Verifica que se encuente la extension o un valor en el arreglo
            $nombreDoc = html_entity_decode($nombreDoc);
            if(move_uploaded_file($_FILES['image']['tmp_name'], $ruta)){
                //Se subio img
            } else {
                echo "no se movio";
            }
        } else {
            echo "no es la extension";
        }

        $description = $_POST['description'];
        $idUser = $_POST['id_user'];


        $query_save_comment = "INSERT INTO comments(id_order, image, description, from_id, to_id, status, created_at, id_user) VALUES('$idOrder', '$ruta', '$description', '$uid2', '1', '0', NOW(), '$uid2')";
        $result_comment = mysqli_query($conexion, $query_save_comment);

        if($result_comment) {
            echo "<script>window.location='show-order-for-id.php?exito'; </script>";
        }

    }
?>