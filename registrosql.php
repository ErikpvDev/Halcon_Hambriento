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

        $query = "SELECT dni FROM usuario WHERE dni='$dni'";

        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)>=1){
            $_SESSION['error']="La cuenta ya está registrada, prueba iniciando sesión";
            header("LOCATION:registro.php");
        }else{
            $insercion = "INSERT INTO usuario VALUES ('$dni','$pass','$nombre','$apellidos',0,'$email','$telefono','$direccion',1)";

            mysqli_query($conn,$insercion);

            echo mysqli_error($conn);

            $_SESSION['dni'] = $dni;
            $_SESSION['pass'] = $pass;
            $_SESSION['rol'] = 0;
            $_SESSION['name'] = $nombre;

            header("LOCATION:/Practica-Restaurante/Cliente/index.php");
        }

    }
?>