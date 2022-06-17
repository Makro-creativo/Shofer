<?php 
  include "./config/conexion.php";

  if(!isset($_SESSION)) {
    session_start();
  }

  $typeUser = $_SESSION['Type'];
?>


<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <?php if($typeUser === "Administrador") {?>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="DashboardAdmin.php">
          <div class="sidebar-brand-icon">
            <img src="../img/logos_shofer1.png" style="width: 80px; height: 80px;">
          </div>
          <div class="sidebar-brand-text mx-3">SHO-FER</div>
        </a>
      <?php }?>

      <?php if($typeUser === "Cliente") {?>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="DashboardCliente.php">
          <div class="sidebar-brand-icon">
          <img src="../img/logos_shofer1.png" style="width: 80px; height: 80px;">
          </div>
          <div class="sidebar-brand-text mx-3">SHO-FER</div>
        </a>
      <?php }?>

      <?php if($typeUser === "Chofer") {?>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="DashboardChofer.php">
          <div class="sidebar-brand-icon">
          <img src="../img/logos_shofer1.png" style="width: 80px; height: 80px;">
          </div>
          <div class="sidebar-brand-text mx-3">SHO-FER</div>
        </a>
      <?php }?>
      <hr class="sidebar-divider my-0">
      <?php if($typeUser === "Administrador") {?>
        <li class="nav-item active">
          <a class="nav-link" href="DashboardAdmin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de control</span></a>
        </li>
      <?php }?>

      <?php if($typeUser === "Cliente") {?>
        <li class="nav-item active">
          <a class="nav-link" href="DashboardCliente.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de control</span></a>
        </li>
      <?php }?>

      <?php if($typeUser === "Chofer") {?>
        <li class="nav-item active">
          <a class="nav-link" href="DashboardChofer.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de control</span></a>
        </li>
      <?php }?>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Menú
      </div>
      <?php if($typeUser === "Administrador") {?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="bi bi-people-fill"></i>
          <span>Usuarios</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-users.php">Usuarios</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#clients"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="bi bi-person-badge-fill"></i>
          <span>Clientes</span>
        </a>
        <div id="clients" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-clients.php">Clientes</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#chofer"
          aria-expanded="true" aria-controls="collapseBootstrap">
          <i class="bi bi-truck"></i>
          <span>Choferes</span>
        </a>
        <div id="chofer" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="new-choferes.php">Choferes</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#order"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="bi bi-info-circle-fill"></i>
            <span>Solicitud de servicio</span>
          </a>
          <div id="order" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="new-orders.php">Servicio</a>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inbox"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="bi bi-inbox-fill"></i>
            <span>Inbox</span>
          </a>
          <div id="inbox" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="new-inbox.php">Inbox</a>
            </div>
          </div>
        </li>
      <?php }?>

      <!-- Navbar for User Client -->
      <?php if($typeUser === "Cliente") {?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#chofer"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="bi bi-info-circle-fill"></i>
            <span>Solicitud de servicio</span>
          </a>
          <div id="chofer" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="new-orders.php">Servicio</a>
            </div>
          </div>
        </li>
      <?php }?>

      <!-- Navbar for User Chofer -->
      <?php if($typeUser === "Chofer") {?>
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#chofer"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="bi bi-info-circle-fill"></i>
            <span>Solicitud de servicio</span>
          </a>
          <div id="chofer" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="show-order-chofer.php">Servicio</a>
            </div>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#inbox"
            aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="bi bi-inbox-fill"></i>
            <span>Inbox</span>
          </a>
          <div id="inbox" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="new-inbox.php">Inbox</a>
            </div>
          </div>
        </li>
      <?php }?>
    </ul>
    <!-- Sidebar -->