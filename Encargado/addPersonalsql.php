<?php

include("seguridad.php");
include("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $rol = $_SESSION["rol_select"];

    $queryDni = "SELECT dni FROM usuario WHERE dni='$dni'";

    $resultDni = mysqli_query($conn, $queryDni);

    $queryEmail = "SELECT email FROM usuario WHERE email='$email'";

    $resultEmail = mysqli_query($conn, $queryEmail);

    if (mysqli_num_rows($resultDni) > 0) {

        $_SESSION['errorDNI'] = "Ese DNI ya está registrado";
        header("LOCATION:addPersonal.php");

    } else {
        if (mysqli_num_rows($resultEmail) > 0) {

            $_SESSION['errorEmail'] = "Ese Email está en uso";
            header("LOCATION:addPersonal.php");
            
        } else {
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $contra = $_POST['pass'];
            $tlf = $_POST['telefono'];
            $direccion = $_POST['direccion'];

            $query = "INSERT INTO usuario VALUES ('$dni','$contra','$nombre','$apellidos',$rol,'$email','$tlf','$direccion',1)";

            mysqli_query($conn, $query);

            header("LOCATION:gestionarPersonal.php");
        }
    }
} else {
    header("LOCATION:../cerrar_sesion.php");
}
