<?php 
    include "./config/conexion.php";

    if(isset($_GET['id_user'])) {
        $idChofer = $_GET['id_user'];

        $search_choferes = "SELECT * FROM choferes WHERE id_user = '$idChofer'";
        $result_choferes = mysqli_query($conexion, $result_choferes);

        if($result_choferes) {
            $rowChoferes = mysqli_fetch_array($result_choferes);

            $idChofer = $rowChoferes['id_user'];
        }
    }
?>
<?php 
    include "./config/conexion.php";

    $search_all_orders = "SELECT * FROM orders";
    $result_all_orders = mysqli_query($conexion, $search_all_orders);

     while($row = mysqli_fetch_array($result_all_orders)) {
         $idOrder = $row['id_order'];
?>
    <tr>
        <td><?php echo "00".$row['id_order']; ?></td>
        <td><?php echo date("m/d/Y", strtotime($row['date_send'])); ?></td>
        <td><?php echo $row['person_receive']; ?></td>
        <td><?php echo $row['colonia']; ?></td>
        <td><?php echo $row['cruce_calles']; ?></td>
        <td><?php echo $row['name_flower']; ?></td>
        <td>
            <?php
                $telephone = $row['phone']; 
                $format = "(".substr($telephone,0,3).")"." ".substr($telephone,5,3)."-".substr($telephone,6,4);

                echo $format;
            ?>
        </td>
        <td><?php echo $row['name_encargado']; ?></td>
        <td><?php echo $row['adress']; ?></td>
        <td><?php echo $row['name_and_phone']; ?></td>
        <td><?php echo $row['references_coto']; ?></td>
        
        <?php if($typeUser === "Cliente") {?>
            <td>
                <a href="edit-order.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-success">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </td>
        <?php }?>

        <?php if($typeUser === "Cliente") {?>
            <td>
                <a href="edit-order.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-danger">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        <?php }?>

        <?php if($typeUser === "Cliente") {?>
            <td>
                <a href="edit-order.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        <?php }?>

        <?php if($typeUser === "Administrador") {?>
            <td>
                <a href="show-order-for-id.php?id_order=<?php echo $row['id_order']; ?>" class="btn btn-primary">
                    <i class="bi bi-eye-fill"></i>
                </a>
            </td>
        <?php }?>

        <?php if($typeUser === "Administrador") {?>
            <td>
                <?php 
                    $query = "SELECT * FROM orders INNER JOIN asign_orders_chofer ON orders.id_order = asign_orders_chofer.id_order WHERE orders.id_order = '$idOrder'";
                    $result = mysqli_query($conexion, $query);
                    $data = mysqli_fetch_array($result);

                    $number = mysqli_num_rows($result);
                    
                    if($number === 0) {
                ?>

                <form action="created-asignated-order.php" method="POST">
                    <input type="hidden" name="id_order" value="<?php echo $row['id_order']; ?>">
                    <select name="id_user" class="form-control">
                        <option selected disabled>Seleccionar chofer</option>
                        <?php 
                            include "./config/conexion.php";

                            $search_choferes = "SELECT * FROM choferes ORDER BY name ASC";
                            $result_choferes = mysqli_query($conexion, $search_choferes);

                            while($rowChoferes = mysqli_fetch_array($result_choferes)) {
                                $idChofer = $rowChoferes['id_user'];
                                $nameChofer = $rowChoferes['name'];
                        ?>
                            <option value="<?php echo $idChofer; ?>"><?php echo $nameChofer; ?></option>
                        <?php }?>
                    </select>
                    <input type="submit" value="Asignar chofer" class="btn btn-secondary btn-sm" name="save">
                </form>

                <?php } else {?>
                   <span class="badge badge-success">El servicio fue asignado a: <?php echo $data['name_chofer']; ?>
                        <i class="bi bi-file-earmark-check-fill"></i>
                    </span>
                <?php }?>
            </td>
        <?php }?>
    </tr>
<?php }?>