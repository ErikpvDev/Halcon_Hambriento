<?php
    include("seguridad.php");
    include("../conexion.php");

    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $nombre = $_POST['nom'];

        $query = "INSERT INTO categoria VALUES (0,'$nombre')";

        mysqli_query($conn,$query);

        echo mysqli_error($conn);

        header("LOCATION:categorias.php");
    }
?>