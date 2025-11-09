<?php
    session_start();
    if(isset($_SESSION['rol'])){
        if($_SESSION['rol']==0)
            header("LOCATION:/Practica-Restaurante/Cliente/index.php");
        else if($_SESSION['rol']==1)
            header("LOCATION:/Practica-Restaurante/Camarero/index.php");
    }
?>