<?php 
    include("seguridad.php");
    include("../conexion.php");


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $numMesa= $_POST['numMesa'];
        $idLinea=$_GET['idLinea'];


        $queryServir = "UPDATE pedidoproducto SET servido=1 WHERE idLinea='$idLinea'";

        mysqli_query($conn,$queryServir);

        header("LOCATION:gestionarMesa.php?cod=$numMesa");
    }else{
        header("LOCATION:../cerrar_sesion.php");
    }

?>