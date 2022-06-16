 <?php 
    include "./config/conexion.php";

    if(!isset($_SESSION)) {
        session_start();
    }

    $typeUser = $_SESSION['Type'];
    $name = $_SESSION['name'];
    $uid = $_SESSION['UID'];
    $uid2 = $_SESSION['UID2'];
 ?>
 
 <!-- TopBar -->
 <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
    <button id="sidebarToggleTop" class="btn rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>
  <ul class="navbar-nav ml-auto">
    <?php if($typeUser === "Administrador") {?>
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link" href="DashboardAdmin.php">
        <i class="bi bi-house-door-fill mr-1"></i>
        Inicio
      </a>
    </li>
    <?php }?>

    <?php if($typeUser === "Cliente") {?>
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link" href="DashboardCliente.php">
        <i class="bi bi-house-door-fill mr-1"></i>
        Inicio
      </a>
    </li>
    <?php }?>

    <?php if($typeUser === "Chofer") {?>
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link" href="DashboardChofer.php">
        <i class="bi bi-house-door-fill mr-1"></i>
        Inicio
      </a>
    </li>
    <?php }?>

    
    <?php if($typeUser === "Chofer") {?>
    <!-- Notifications choferes -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="show-order-chofer.php" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"  onclick="notificationChofer()"></i>
        <span class="badge badge-danger badge-counter" id="notification_count">
          <?php 
            $search_notification_count = "SELECT * FROM asign_orders_chofer WHERE status = 0 AND id_user = '$uid2'";
            $result_notification_count = mysqli_query($conexion, $search_notification_count);

            $count_notification = mysqli_num_rows($result_notification_count);

            echo $count_notification;
          ?>
        </span>
      </a>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
      aria-labelledby="alertsDropdown">
      <h6 class="dropdown-header">
        Notificaciones
      </h6>
      <?php 
        $data_of_notifications = "SELECT * FROM orders INNER JOIN asign_orders_chofer ON orders.id_order = asign_orders_chofer.id_order INNER JOIN choferes ON asign_orders_chofer.id_user = choferes.id_user WHERE asign_orders_chofer.id_user = '$uid2' ORDER BY created_at DESC LIMIT 10";
        $result_of_notifications = mysqli_query($conexion, $data_of_notifications);

        while($rowNotification = mysqli_fetch_array($result_of_notifications)) {
          $folio = $rowNotification['id_order'];
      ?>
        <a class="dropdown-item d-flex align-items-center" href="show-order-for-id.php?id_order=<?php echo $rowNotification['id_order']; ?>">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
              <i class="bi bi-info-circle-fill text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500"><?php echo date("m/d/Y", strtotime($rowNotification['created_at'])); ?></div>
              <span class="font-weight-bold">Se te asigno un servicio con folio: <?php echo "00".$folio; ?></span>
            </div>
        </a>
      <?php }?>
    
      <a class="dropdown-item text-center small text-gray-500" href="show-order-chofer.php">Mostrar todas las notificaciones</a>
    </div>
  </li>
  <!-- End Notifications choferes --> 
  <?php }?>  

  <?php if($typeUser === "Administrador") {?>
    <!-- Notifications orders -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="new-orders.php" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw" onclick="cleanNotification()"></i>
        <span class="badge badge-danger badge-counter" id="notification-count">
          <?php 
            $search_notification_count = "SELECT * FROM orders WHERE status = 0";
            $result_notification_count = mysqli_query($conexion, $search_notification_count);

            $count_notification = mysqli_num_rows($result_notification_count);

            echo $count_notification;
          ?>
        </span>
      </a>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
      aria-labelledby="alertsDropdown">
      <h6 class="dropdown-header">
        Notificaciones
      </h6>
      <?php 
        $data_of_notifications = "SELECT * FROM orders ORDER BY date_send DESC LIMIT 10";
        $result_of_notifications = mysqli_query($conexion, $data_of_notifications);

        while($rowNotification = mysqli_fetch_array($result_of_notifications)) {
      ?>
        <a class="dropdown-item d-flex align-items-center" href="show-order-for-id.php?id_order=<?php echo $rowNotification['id_order']; ?>">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
            <i class="bi bi-bell-fill text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500"><?php echo date("m/d/Y", strtotime($rowNotification['date_send'])); ?></div>
              <span class="font-weight-bold"><?php echo $rowNotification['name_flower']; ?></span>
            </div>
        </a>
      <?php }?>
    
      <a class="dropdown-item text-center small text-gray-500" href="new-orders.php">Mostrar todas las notificaciones</a>
    </div>
  </li>
  <!-- End Notifications orders --> 
  <?php }?> 
  
  <?php if($typeUser === "Administrador") {?>
    <!-- Notifications comments -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="new-orders.php" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-chat-left-dots-fill" onclick="cleanNotificationComments()"></i>
        <span class="badge badge-danger badge-counter" id="notification-count-comments">
          <?php 
            $search_notification_comments = "SELECT * FROM comments WHERE status = 0";
            $result_notification_comments = mysqli_query($conexion, $search_notification_comments);

            $count_notification_comments= mysqli_num_rows($result_notification_comments);

            echo $count_notification_comments;
          ?>
        </span>
      </a>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
      aria-labelledby="alertsDropdown">
      <h6 class="dropdown-header">
        Notificaciones de comentarios
      </h6>
      <?php 
        $data_of_notifications_comments = "SELECT * FROM orders INNER JOIN comments ON orders.id_order = comments.id_order INNER JOIN clients ON clients.id_user = comments.id_user ORDER BY created_at DESC LIMIT 10";
        $result_of_notifications_comments = mysqli_query($conexion, $data_of_notifications_comments);

        while($rowNotificationComments = mysqli_fetch_array($result_of_notifications_comments)) {
      ?>
        <a class="dropdown-item d-flex align-items-center" href="show-order-for-id.php?id_order=<?php echo $rowNotificationComments['id_order']; ?>">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
              <i class="bi bi-chat-left-dots-fill text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500"><?php echo date("m/d/Y h:i A", strtotime($rowNotificationComments['created_at'])); ?></div>
              <span class="font-weight-bold"><?php echo $rowNotificationComments['name_client']; ?></span>
            </div>
        </a>
      <?php }?>
    
      <a class="dropdown-item text-center small text-gray-500" href="show-notification-delivery.php">Mostrar todas las notificaciones</a>
    </div>
  </li>
  <!-- End Notifications Ckecked order for chofer --> 
  <?php }?> 
  
  
  <?php if($typeUser === "Administrador") {?>
    <!-- Notifications Ckecked order for chofer -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="new-orders.php" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-alarm-fill" onclick="cleanNotificationChecked()"></i>
        <span class="badge badge-danger badge-counter" id="notification-count-chofer">
          <?php 
            $search_notification_count = "SELECT * FROM delivery_chofer WHERE status = 0";
            $result_notification_count = mysqli_query($conexion, $search_notification_count);

            $count_notification = mysqli_num_rows($result_notification_count);

            echo $count_notification;
          ?>
        </span>
      </a>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
      aria-labelledby="alertsDropdown">
      <h6 class="dropdown-header">
        Notificaciones de servicios entregados
      </h6>
      <?php 
        $data_of_notifications = "SELECT * FROM orders INNER JOIN delivery_chofer ON orders.id_order = delivery_chofer.id_order INNER JOIN choferes ON choferes.id_user = delivery_chofer.id_user ORDER BY hour_order_delivery DESC LIMIT 10";
        $result_of_notifications = mysqli_query($conexion, $data_of_notifications);

        while($rowNotification = mysqli_fetch_array($result_of_notifications)) {
      ?>
        <a class="dropdown-item d-flex align-items-center" href="show-order-for-id.php?id_order=<?php echo $rowNotification['id_order']; ?>">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
              <i class="bi bi-clock-fill text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500"><?php echo date("m/d/Y h:i A", strtotime($rowNotification['hour_order_delivery'])); ?></div>
              <span class="font-weight-bold"><?php echo $rowNotification['name']; ?></span>
            </div>
        </a>
      <?php }?>
    
      <a class="dropdown-item text-center small text-gray-500" href="show-notification-delivery.php">Mostrar todas las notificaciones</a>
    </div>
  </li>
  <!-- End Notifications comments --> 
  <?php }?>
  
  <!--<?php if($typeUser === "Cliente") {?>
  //Notifications answers for clients
  <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="new-orders.php" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-bell-fill" onclick="cleanNotificationAnswer()"></i>
        <span class="badge badge-danger badge-counter" id="notification-count-answer">
          <?php 
            $search_notification_count = "SELECT * FROM answers WHERE status = 0";
            $result_notification_count = mysqli_query($conexion, $search_notification_count);

            $count_notification = mysqli_num_rows($result_notification_count);

            echo $count_notification;
          ?>
        </span>
      </a>
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
      aria-labelledby="alertsDropdown">
      <h6 class="dropdown-header">
        Notificaciones
      </h6>
      <?php 
        $data_of_notifications = "SELECT * FROM orders INNER JOIN answers ON orders.id_order = answers.id_order INNER JOIN comments ON comments.id_comment = answers.id_comment WHERE answers.id_comment = '$uid2'";
        $result_of_notifications = mysqli_query($conexion, $data_of_notifications);

        while($rowNotification = mysqli_fetch_array($result_of_notifications)) {
      ?>
        <a class="dropdown-item d-flex align-items-center" href="show-order-for-id.php?id_order=<?php echo $rowNotification['id_order']; ?>">
          <div class="mr-3">
            <div class="icon-circle bg-primary">
             <i class="bi bi-chat-left-dots-fill text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500"><?php echo date("m/d/Y h:i A", strtotime($rowNotification['created_at'])); ?></div>
              <span class="font-weight-bold">Se respondio a tu comentario</span>
            </div>
        </a>
      <?php }?>
    
      <a class="dropdown-item text-center small text-gray-500" href="show-notification-delivery.php">Mostrar todas las notificaciones</a>
    </div>
  </li>
  // End notifications answers for clients
  <?php }?>-->
  
            
  <div class="topbar-divider d-none d-sm-block"></div>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <img class="img-profile rounded-circle" src="../img/boy.png" style="max-width: 60px">
          <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $name; ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="profile.php">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Perfil
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Cerrar sesión
          </a>
        </div>
      </li>
  </ul>
</nav>
<!-- Topbar -->