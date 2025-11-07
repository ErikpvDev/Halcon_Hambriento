<?php
    session_start();
    if(isset($_SESSION["rol"])){
        if($_SESSION['rol']==1)
            header("LOCATION:/Practica-Restaurante/Camarero/index.php");
        else if($_SESSION['rol']==2)
            header("LOCATION:/Practica-Restaurante/Encargado/index.php");

    }
?>