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

        .circulo-libre {
            background-color: lightskyblue;
            border-radius: 50%;
            width: 120px;
            height: 120px;
        }

        .circulo-ocupado {
            background-color: red;
            border-radius: 50%;
            width: 120px;
            height: 120px;
        }

        .fondo-mesas {
            background-image: url("../img/fondo-mesas.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .clic-circular {
            -webkit-clip-path: circle(50%);
            clip-path: circle(50%);
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    include("../conexion.php");
    include("../header.php");
    include("navbar.php");

    ?>
    <main>
        <section class="min-vh-100 align-items-center">
            <div class="container">
                <div class="row mt-4 contenedor text-center p-5 fondo-mesas">
                    <div class="col-12"><h1>Comensales</h1></div>
                    <div class="col-12"><h4>¿Con cuantos contamos?</h4></div>
                    <div class="col-12">
                        <form action="" method="POST" class="row justify-content-center">
                        <div class="col-3"><input type="number" name="comensales" class="form-control text-center mt-4"></div>
                        <div class="col-auto"><button type="submit" class="btn btn-warning mt-4">Reservar</button></div>
                        <div class="col-auto"><a href="" class="btn btn-secondary mt-4">Volver</a></div>
                    </form>
                    </div>
                    
                </div>
            </div>
        </section>
    </main>
    <?php
    include("../footer.php");
    ?>
</body>

</html>