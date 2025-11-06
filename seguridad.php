<?php
    session_start();
    if(!isset($_SESSION['dni']) && !isset($_SESSION['pass']))
        header("LOCATION:/Practica-Restaurante/index.php");
?>