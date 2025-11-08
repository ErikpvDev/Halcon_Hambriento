<?php
    include("../conexion.php");

    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $nombre = $_POST['nom'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $categ = $_POST['cat'];
        
        $query="SELECT idCategoria FROM categoria WHERE nombre='$categ'";

        $result=mysqli_query($conn,$query);

        $row = mysqli_fetch_assoc($result);

        $categ=$row["idCategoria"];

        $id = $_POST['id'];

        $query = "UPDATE producto SET nombre='$nombre',precio='$precio',stock='$stock',categoria='$categ' WHERE idProducto='$id'";

        mysqli_query($conn,$query);

        echo mysqli_error($conn);

        header("LOCATION:index.php");
    }

?>