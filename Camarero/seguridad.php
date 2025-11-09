<?php
    session_start();
    if(isset($_SESSION["rol"])){
        if($_SESSION['rol']==0)
            header("LOCATION:/Practica-Restaurante/Cliente/index.php");
        else if($_SESSION['rol']==2)
            header("LOCATION:/Practica-Restaurante/Encargado/index.php");

    }
?>