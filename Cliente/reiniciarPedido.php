<?php

    include("seguridad.php");

    unset($_SESSION['productos']);

    header("LOCATION:carta.php");
?>