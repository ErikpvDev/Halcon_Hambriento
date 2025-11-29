<?php

include("seguridad.php");
include("../conexion.php");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $contra = $_POST['pass'];
    $email = $_POST['email'];
    $tlf = $_POST['telefono'];
    $direccion = $_POST['direccion'];

    $query = "INSERT INTO usuario VALUES ('$dni','$contra','$nombre','$apellidos',1,'$email','$tlf','$direccion',1)";

    mysqli_query($conn,$query);

    header("LOCATION:gestionarPersonal.php");
}else{
    header("LOCATION:../cerrar_sesion.php");
}




?>