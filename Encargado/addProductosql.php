<?php
    include("../conexion.php");

    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $nombre = $_POST['nom'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $cat = $_POST['cat'];

        $query = "INSERT INTO producto VALUES (0,'$nombre','$precio','$stock',1,'$cat')";

        mysqli_query($conn,$query);

        echo mysqli_error($conn);

        header("LOCATION:index.php");
    }

?>