<?php

    include("seguridad.php");
    include("../conexion.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $dni = $_POST['dni'];
        $nombre = $_POST['nom'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $tlf = $_POST['tlf'];
        $direccion = $_POST['direc'];

        $query = "UPDATE usuario SET nombre='$nombre',apellidos='$apellidos',email='$email',telefono='$tlf',direccion='$direccion' WHERE dni='$dni'";

        mysqli_query($conn,$query);

        header("LOCATION:gestionarPersonal.php");
    }else{
        header("LOCATION:cerrar_sesion.php");
    }



?>