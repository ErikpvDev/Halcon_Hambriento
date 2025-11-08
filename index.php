<?php
    include("seguridad.php");
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

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $dni = $_POST['dni'];
            $password = $_POST['pass'];

            $consulta = "SELECT * FROM usuario WHERE dni='$dni'";

            $result = mysqli_query($conn, $consulta);

            if (mysqli_num_rows($result) != 1) {
                $sms = "Usuario no registrado";
            } else {
                $row = mysqli_fetch_assoc($result);

                $dni_bd = $row['dni'];
                $pass_bd = $row['pass'];
                $rol = $row['rol'];
                $nombre = $row['nombre'];
                if ($pass_bd == $password) {
                    $_SESSION['dni'] = $dni;
                    $_SESSION['pass'] = $password;
                    $_SESSION['rol'] = $rol;
                    $_SESSION['name'] = $nombre;
                    if ($rol == 0) {
                        header("LOCATION:Cliente/index.php");
                    } else if ($rol == 1) {
                        header("LOCATION:Camarero/index.php");
                    } else {
                        header("LOCATION:Encargado/index.php");
                    }
                } else {
                    $sms = "Contraseña incorrecta";
                }
            }
        }
        mysqli_close($conn);
        ?>
    </div>
    <section>
        <video id="video" autoplay muted loop class="video-background">
            <source src="video/fondo_video.mp4" type="video/mp4">
        </video>
        <div class="container">
            <div class="row justify-content-center align-items-center caja">
                <div class="col-8">
                    <div class="row justify-content-center">
                        <div class="col-12">
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
                                    echo "<div class='col-12 text-center mb-4' style='color:red;'>" . $sms . "</div>";
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-1 text-center">
                            <p class="text-center cuenta">¿NO TIENES CUENTA?</p>
                            <a class="btn btn-warning w-30" href="registro.php" role="button">REGÍSTRATE</a>
                        </div>
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