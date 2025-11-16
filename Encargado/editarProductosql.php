<?php

    include("seguridad.php");
    include("../conexion.php");

    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $id = $_POST['id'];
        $nombre = $_POST['nom'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $categ = $_POST['cat'];

        $queryimg = "SELECT img FROM producto WHERE idProducto='$id'";
        $resultimg = mysqli_query($conn,$queryimg);
        $rowimg = mysqli_fetch_assoc($resultimg);

        if($_FILES['imagen']['error'] != UPLOAD_ERR_OK){
            $imginsertar = $rowimg['img'];
        }else{
            
            if(file_exists($rowimg['img']))
                unlink($rowimg['img']);

            
            $imginsertar= "../img_productos/".time().".png";

            COPY($_FILES["imagen"]["tmp_name"],$imginsertar);
        }

        $query="SELECT idCategoria FROM categoria WHERE nombre='$categ'";

        $result=mysqli_query($conn,$query);

        $row = mysqli_fetch_assoc($result);

        $categ=$row["idCategoria"];

        

        $query = "UPDATE producto SET nombre='$nombre',precio='$precio',stock='$stock',categoria='$categ',img='$imginsertar' WHERE idProducto='$id'";

        mysqli_query($conn,$query);

        echo mysqli_error($conn);

        header("LOCATION:index.php");
    }

?>