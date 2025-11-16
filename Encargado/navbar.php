<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">


        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>


        <!-- CENTRO: Productos / Categorías -->
        <div class="collapse navbar-collapse text-warning col-auto" id="menu">
            <ul class="navbar-nav col-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="categorias.php">Categorías</a></li>
            </ul>
        </div>


        <!-- DERECHA: Cuenta -->
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-person-circle col-auto"></i> <?php echo $_SESSION['name'] ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="../cerrar_sesion.php">Cerrar Sesión</a></li>
                </ul>
            </li>
        </ul>


    </div>
</nav>