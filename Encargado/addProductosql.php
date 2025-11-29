<?php
include("seguridad.php");
include("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nom'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $cat = $_POST['cat'];
    $img = time() . ".png";
    $ruta = "../img_productos/" . $img;

    $query = "INSERT INTO producto VALUES (0,'$nombre','$precio','$stock',1,'$cat','$ruta')";

    mysqli_query($conn, $query);

    echo mysqli_error($conn);

    COPY($_FILES["imagen"]["tmp_name"], $ruta);

    header("LOCATION:index.php");
} else {
    header("LOCATION:../cerrar_sesion.php");
}
?>