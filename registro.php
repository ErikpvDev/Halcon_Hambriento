<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Halcón Hambriento</title>
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <script src="Bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="img//Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="/Practica-Restaurante/styles.css">

</head>

<body>
    <div class="container-fluid">
    <?php
    include("header_Inicio.php");
    include("conexion.php");

    
    mysqli_close($conn);
    ?>
    </div>

    <section>
        <video id="video" autoplay muted loop class="video-background">
            <source src="video/fondo_video.mp4" type="video/mp4">
        </video>
        <div class="container">
            <div class="row justify-content-center align-items-center caja">
                <div class="col-6">
                    <form action="registrosql.php" method="POST" class="row">
                        <div class="col-12 mb-4">
                            <p class="h2 text-center">REGISTRO DE CUENTA</p>
                        </div>
                        <div class="col-6 mb-3">
                            <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI" required>
                        </div>
                        <div class="col-6 mb-3">
                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña" required>
                        </div>
                        <div class="col-6 mb-3">
                            <input type="text" name="nom" id="nom" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="col-6 mb-3">
                            <input type="text" name="ape" id="ape" class="form-control" placeholder="Apellidos" required>
                        </div>
                        <div class="col-6 mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="col-6 mb-3">
                            <input type="text" name="telf" id="telf" class="form-control" placeholder="Teléfono" required>
                        </div>
                        <div class="col-12 mb-3">
                            <input type="text" name="direc" id="direc" class="form-control" placeholder="Dirección" required>
                        </div>
                        <div class="col-12 d-grid mt-4 mb-5">
                            <button class="btn btn-lg btn-warning" type="submit">REGISTRAR CUENTA</button>
                        </div>
                    </form>
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo "<div class='col-12 text-center mb-4' style='color:red;'>" . $_SESSION['error'] . "</div>";
                        unset($_SESSION['error']);
                    }

                    ?>
                    <div class="col-12 mb-1 text-center">
                        <p class="text-center cuenta">¿YA TIENES CUENTA?</p>
                        <a class="btn btn-warning w-30" href="index.php" role="button">INICIAR SESIÓN</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include("footer.php");
    ?>
</body>

</html>