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
    <link rel="icon" type="image/x-icon" href="/Practica-Restaurante/img/Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="/Practica-Restaurante/styles.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-image: url("../img/johannes-holm-00.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
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
                <div class="col-auto contenedor text-center mt-5">
                    <h1>Under Construction</h1>
                </div>
            </div>
        </div>
    </section>

    <?php
    include("../footer.php");
    ?>
</body>

</html>