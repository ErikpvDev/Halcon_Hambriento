<?php
    include("seguridad.php");
    include("../conexion.php");
    if($_SERVER['REQUEST_METHOD']==='GET'){

        $cod = $_GET['cod'];
        
        $query = "DELETE FROM categoria WHERE idCategoria=$cod";
        
        mysqli_query($conn,$query);
        
        mysqli_close($conn);
        
        header("LOCATION:categorias.php");
    }else{
        header("LOCATION:../cerrar_sesion.php");
    }   
?>