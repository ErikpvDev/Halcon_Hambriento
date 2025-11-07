<?php
    include("conexion.php");
    include("seguridad.php");
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $dni = $_POST['dni'];
        $pass = $_POST['pass'];
        $nombre = $_POST['nom'];
        $apellidos = $_POST['ape'];
        $email = $_POST['email'];
        $telefono = $_POST['telf'];
        $direccion = $_POST['direc'];

        $query = "SELECT id FROM usuario WHERE id='$dni'";

        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)>=1){
            $_SESSION['error']="La cuenta ya está registrada, prueba iniciando sesión";
            header("LOCATION:registro.php");
        }

    }
?>