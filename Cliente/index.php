<?php
include("../seguridad.php");
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
    <style>
        body {
            background: #302f2f;
            background: radial-gradient(circle, rgba(48, 47, 47, 1) 18%, rgba(22, 113, 115, 1) 100%);
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
            <div class="row"></div>
        </div>
    </section>

    <?php
    include("../footer.php");
    ?>
</body>

</html>