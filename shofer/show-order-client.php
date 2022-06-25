<?php 
    include "./config/conexion.php";

    $search_all_orders = "SELECT * FROM orders WHERE id_user = '$uid'";
    $result_all_orders = mysqli_query($conexion, $search_all_orders);

    while($row = mysqli_fetch_array($result_all_orders)) {
?>
    <tr>
        <td><?php echo "00".$row['id_order']; ?></td>
        <td><?php echo date("m/d/Y", strtotime($row['date_send'])); ?></td>
        <td><?php echo $row['person_receive']; ?></td>
        <td><?php echo $row['adress']; ?></td>
        <td><?php echo $row['colonia']; ?></td>
        <td><?php echo $row['cruce_calles']; ?></td>
        <td><?php echo $row['references_coto']; ?></td>
        <td><?php echo $row['name_flower']; ?></td>
        <td><?php echo $row['name_encargado']; ?></td>
        <td>
            <?php
                $telephone = $row['phone']; 
                $format = "(".substr($telephone,0,3).")"." ".substr($telephone,5,3)."-".substr($telephone,6,4);

                echo $format;
            ?>
        </td>
        <td>
            <img src="<?php echo $row['image']; ?>" alt="" class="img-fluid">
        </td>

        <div id="modal" class="modal">
            <span id="modal-close" class="modal-close">&times;</span>
            <img id="modal-content" class="modal-content">
            <div id="modal-caption" class="modal-caption"></div>
            </div>

        <?php if($typeUser === "Cliente") {?>
            <td>
                <a href="edit-order.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-success">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </td>
        <?php }?>

        <?php if($typeUser === "Cliente") {?>
            <td>
                <a href="delete-order.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        <?php }?>

        <?php if($typeUser === "Cliente") {?>
            <td>
                <a href="show-order-for-id.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        <?php }?>
    </tr>
<?php }?>

