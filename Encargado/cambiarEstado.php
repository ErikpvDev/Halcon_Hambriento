<?php
    include("seguridad.php");
    include("../conexion.php");

    if($_SERVER['REQUEST_METHOD'] === 'GET'){

        
        $idP = $_GET['cod_act'];
        $row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT activo FROM producto WHERE idProducto='$idP'"));
        $estado = $row['activo'] == 1 ? 0 : 1;
        
        $query = "UPDATE producto SET activo='$estado' WHERE idProducto='$idP'";
        
        mysqli_query($conn,$query);
        
        echo mysqli_error($conn);
        
        mysqli_close($conn);
        
        header("LOCATION:index.php");
    }else{
        header("LOCATION:../cerrar_sesion.php");
    }
?>