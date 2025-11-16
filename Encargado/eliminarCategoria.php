<?php
    include("seguridad.php");
    include("../conexion.php");
    $cod = $_GET['cod'];

    $query = "DELETE FROM categoria WHERE idCategoria=$cod";

    mysqli_query($conn,$query);

    mysqli_close($conn);

    header("LOCATION:categorias.php");
?>