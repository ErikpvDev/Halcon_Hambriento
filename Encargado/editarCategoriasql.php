<?php
include("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nom'];
    $id = $_POST['id'];

    $query = "UPDATE categoria SET nombre='$nombre' WHERE idCategoria='$id'";

    mysqli_query($conn, $query);

    echo mysqli_error($conn);

    header("LOCATION:categorias.php");
} else {
    header("LOCATION:../cerrar_sesion.php");
}
?>