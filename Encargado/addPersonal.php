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

    ?>
    <section>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-8 mt-5 contenedor text-center">
                    <h1 class="mt-3 mb-3">AÑADIR <?php if($_SESSION["rol_select"]==1) echo "CAMARERO";else echo "ENCARGADO"; ?></h1>
                    <form action="addPersonalsql.php" method="POST" class="text-start row">
                        <div class="col-12 col-md-6 mb-4">
                            <label for="dni" class="form-label">DNI <?php 
                                    if(isset($_SESSION['errorDNI'])) {
                                        echo "<span class='text-danger'>".$_SESSION['errorDNI']."</span>";
                                        unset($_SESSION['errorDNI']);
                                    }
                                ?></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0" />
                                    </svg>
                                </span>
                                <input type="text" class="form-control" name="dni" maxlength="9" minlength="9" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label for="nombre" class="form-label">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                    </svg>
                                </span>
                                <input type="text" class="form-control" name="nombre" value='<?php if(isset($_POST['nombre'])) echo $_POST['nombre'];  ?>' required>
                            </div>
                        </div>


                        <div class="col-12 mb-4">
                            <label for="apellidos" class="form-label">Apellidos</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5m.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
                                    </svg>
                                </span>
                                <input type="text" class="form-control" name="apellidos" value='<?php if(isset($_POST['apellidos'])) echo $_POST['apellidos'];  ?>' required>
                            </div>
                        </div>


                        <div class="col-12 col-md-6 mb-4">
                            <label for="pass" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4m0 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3" />
                                    </svg>
                                </span>
                                <input type="text" class="form-control" name="pass" value='<?php if(isset($_POST['pass'])) echo $_POST['pass'];  ?>' required>
                            </div>
                        </div>


                        <div class="col-12 col-md-6 mb-4">
                            <label for="email" class="form-label">Email <?php 
                                    if(isset($_SESSION['errorEmail'])) {
                                        echo "<span class='text-danger'>".$_SESSION['errorEmail']."</span>";
                                        unset($_SESSION['errorEmail']);
                                    }
                                ?></label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                        <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                                    </svg>
                                </span>
                                <input type="email" class="form-control" name="email"value='<?php if(isset($_POST['email'])) echo $_POST['email'];  ?>' required>
                            </div>
                        </div>


                        <div class="col-12 col-md-6 mb-4">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                                    </svg>
                                </span>
                                <input type="text" class="form-control" name="telefono" maxlength="9" minlength="9" value='<?php if(isset($_POST['telefono'])) echo $_POST['telefono'];  ?>' required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label for="direccion" class="form-label">Dirección</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                                    </svg>
                                </span>
                                <input type="text" class="form-control" name="direccion" value='<?php if(isset($_POST['direccion'])) echo $_POST['direccion'];  ?>'  required>
                            </div>
                        </div>

                        <div class="col-12 mb-4 mt-3">
                            <button type="submit" class="btn btn-warning d-grid w-100">AÑADIR</button>
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