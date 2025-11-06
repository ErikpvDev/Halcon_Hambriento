<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="insertarcarta.php"><i class="bi bi-list-check"> Prueba</i></a>
                </li>
            </ul>


            <ul class="navbar-nav offset-12 me-5">
                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-fill"> <?php echo $_SESSION['name']; ?></a></i>
                    <ul class="dropdown-menu dropdown-menu-start">
                        <li><a class="dropdown-item" href="../cerrar_sesion.php">Cerrar sesión</a></li>
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</nav>