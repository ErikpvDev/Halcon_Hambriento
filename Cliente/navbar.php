<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">
        <!-- Cuenta -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="cursor:pointer;">
                    <i class="bi bi-person-circle col-auto"></i> <?php echo $_SESSION['name'] ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Ver Perfil</a></li>
                    <li><a class="dropdown-item" href="../cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>