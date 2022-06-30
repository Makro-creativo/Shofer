<?php 
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $uid = $_SESSION['UID'];

    if(isset($_POST['inboxAdmin'])) {
        $idUser = $_POST['id_chofer_uid'];
        $asunto = $_POST['asunto'];
        $description = $_POST['description'];
        //imagen
        $directorio = "assets/images/"; 
        $nombreDoc = $_FILES['image_url']['name'];
        
        $formatosDoc = array('.JPG','.jpg','.png','.PNG','.PDF','.pdf','.docx'); //formatos a admitir
        $tmpDoc = $_FILES['image_url']['tmp_name']; //Nombre temporal del archivo
        $extension = substr($nombreDoc, strrpos($nombreDoc,'.'));   //Para cortar la caden y obtener solo la 
                                    
        $ruta = $directorio.$nombreDoc; 
    
        if(in_array($extension, $formatosDoc)){ //Verifica que se encuente la extension o un valor en el arreglo
            $nombreDoc = html_entity_decode($nombreDoc);
            if(move_uploaded_file($_FILES['image_url']['tmp_name'], $ruta)){
                //Se subio img
            } else {
                echo "no se movio";
            }
        } else {
            echo "no es la extension";
        }

        $search_name_user = "SELECT name FROM users WHERE id = '$uid'";
        $result_name_user = mysqli_query($conexion, $search_name_user);

        $rowName = mysqli_fetch_array($result_name_user);
        $nameUser = $rowName['name'];

        $query_inbox_admin = "INSERT INTO inbox_admin(id_user, asunto, description, image_url, from_id, to_id, status, created_at, name_user) VALUES('$idUser', '$asunto', '$description', '$ruta', '$uid', '1', 0, NOW(), '$nameUser')";
        $result_inbox_admin = mysqli_query($conexion, $query_inbox_admin);

        if($result_inbox_admin) {
            echo "<script>window.location='new-inbox.php?bien'; </script>";
        }
    }
?>