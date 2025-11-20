<?php
    include("seguridad.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Halcón Hambriento</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>Bootstrap/css/bootstrap.min.css">
    <script src="<?php echo BASE_URL; ?>Bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>img/Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        include("../conexion.php");
        include("../header.php");
        include("navbar.php");
    ?>
    <section class="d-flex align-items-center">
        <div class="container">
            <div class="row mt-4 contenedor text-center p-3 border-warning">
                <h1 style="border-bottom: 1px solid ;">Pedidos</h1>
            </div>
        </div>
    </section>

    <?php
    include("../footer.php");
    ?>
</body>
</html>