<?php

include("seguridad.php");
include("../conexion.php");

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $dni = $_GET['dni'];

    $query= "DELETE FROM usuario WHERE dni='$dni'";

    mysqli_query($conn,$query);

    header("LOCATION:gestionarPersonal.php");
}else{
    header("LOCATION:../cerrar_sesion.php");
}

?>