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
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>img//Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include("../conexion.php");
    include("../header.php");
    include("navbar.php");

    $dni = $_GET['dni'];

    $queryEmpleado = "SELECT * FROM usuario WHERE dni='$dni'";

    $resultEmpleado = mysqli_query($conn, $queryEmpleado);

    $rowE = mysqli_fetch_assoc($resultEmpleado);

    $nombre = $rowE['nombre'];
    $apellidos = $rowE['apellidos'];
    $email = $rowE['email'];
    $tlf = $rowE['telefono'];
    $direccion = $rowE['direccion'];
    ?>
    <section class="container">
        <main class="row justify-content-center align-items-center">
            <div class="col-12 col-md-10 col-lg-8 mt-5 text-center table-responsive p-4">
                <div class="col-12 mt-4">
                    <div class="contenedor text-start shadow-lg p-4">

                        <h3 class="mb-4 text-center">Información del empleado</h3>
                        <form action="actualizarPersonal.php" method="POST">
                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label for="dni" class="form-label"><strong>DNI:</strong></label>
                                    <input class="border rounded p-2 bg-dark w-100 text-light form-control" value='<?php echo $dni ?>' name="dni" readonly>
                                </div>

                                <div class="mb-3 col-12">
                                    <label for="nom" class="form-label"><strong>Nombre:</strong></label>
                                    <input class="border rounded p-2 bg-dark w-100 text-light form-control" value='<?php echo $nombre ?>' name="nom" required>
                                </div>

                                <div class="mb-3 col-12">
                                    <label for="apellidos" class="form-label"><strong>apellidos:</strong></label>
                                    <input class="border rounded p-2 bg-dark w-100 text-light form-control" value='<?php echo $apellidos ?>' name="apellidos" required>
                                </div>

                                <div class="mb-3 col-12">
                                    <label for="email" class="form-label"><strong>Email:</strong></label>
                                    <input class="border rounded p-2 bg-dark w-100 text-light form-control" value='<?php echo $email ?>' name="email" required>
                                </div>

                                <div class="mb-3 col-12">
                                    <label for="tlf" class="form-label"><strong>Teléfono:</strong></label>
                                    <input class="border rounded p-2 bg-dark w-100 text-light form-control" value='<?php echo $tlf ?>' name="tlf" maxlength="9" minlength="9" required>
                                </div>

                                <div class="mb-3 col-12">
                                    <label for="direc" class="form-label"><strong>Dirección:</strong></label>
                                    <input class="border rounded p-2 bg-dark w-100 text-light form-control" value='<?php echo $direccion ?>' name="direc" required>
                                </div>

                                <div class="text-center mt-4 col-6">
                                    <a href="gestionarPersonal.php" class="btn btn-warning px-5">Volver</a>
                                </div>
                                <div class="text-center mt-4 col-6">
                                    <button type="submit" class="btn btn-warning px-5">Cambiar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <?php
    include("../footer.php");
    ?>
</body>

</html>