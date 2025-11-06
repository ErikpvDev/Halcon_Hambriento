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

</head>

<body>
    <?php
    include("../header.php");
    include("../conexion.php");
    include("navbar.php");
    ?>

    <section>
        <div class="container">
            <div class="row justify-content-center align-items-center caja">
                <div class="col-8">
                    <div class="row justify-content-center">
                        <div class="col-12 mt-5">
                            <p class="h2 text-center">ACCEDE A TU CUENTA</p>
                        </div>
                        <div class="col col-md-8 mt-4">
                            <div class="row">
                                <form action="" method="POST">
                                    <div class="col-12 d-grid mx-sm-auto">
                                        <input type="text" name="dni" id="dni" class="form-control" placeholder="DNI" required>
                                    </div>
                                    <div class="col-12  mt-3 mb-2 mx-sm-auto">
                                        <input type="password" class="form-control" id="pass" name="pass" placeholder="CONTRASEÑA" required>
                                    </div>
                                    <div class="col-12  mt-4 d-grid mb-5 mx-sm-auto">
                                        <button class="btn btn-lg btn-warning" type="submit">INICIAR SESIÓN</button>
                                    </div>
                                </form>
                                <?php
                                if (isset($sms)) {
                                    echo "<div class='col-12 text-center mb-4'>" . $sms . "</div>";
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-1 text-center">
                            <p class="text-center cuenta">¿NO TIENES CUENTA?</p>
                            <a class="btn btn-warning w-30" href="registro.php" role="buttom">REGÍSTRATE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include("../footer.php");
    ?>
</body>

</html>