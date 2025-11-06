<?php
    session_start();
    unset($_SESSION['dni']);
    unset($_SESSION['pass']);
    unset($_SESSION['rol']);
    unset($_SESSION['name']);
    header("LOCATION:index.php");
?>