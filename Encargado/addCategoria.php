<?php
include("seguridad.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Halcón Hambriento</title>
    <link rel="stylesheet" href="/Practica-Restaurante/Bootstrap/css/bootstrap.min.css">
    <script src="/Practica-Restaurante/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="/Practica-Restaurante/img//Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="/Practica-Restaurante/styles.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include("../conexion.php");
    include("../header.php");
    include("navbar.php");
    ?>
    <section>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-8 mt-5 contenedor text-center">
                    <h1 class="mt-3 mb-3">AÑADIR CATEGORÍA</h1>
                    <form action="addCategoriasql.php" method="POST" class="text-start row">
                        <div class="col-12 mb-4">
                            <label for="nom" class="form-label">Nombre de la categoría</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
                                    </svg></span>
                                <input type="text" class="form-control" name="nom" placeholder="nombre" required>
                            </div>
                        </div>
                        <div class="col-12 mb-3 mt-3">
                            <button type="submit" class="btn btn-warning d-grid w-100">Aceptar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
    include("../footer.php");
    ?>
</body>

</html>