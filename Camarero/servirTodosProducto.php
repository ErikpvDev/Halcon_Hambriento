<?php 
    include("seguridad.php");
    include("../conexion.php");

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $idLinea=$_GET['idPedido'];
        $numMesa=$_GET['numMesa'];
        
        $queryServir = "UPDATE pedidoproducto SET servido=1 WHERE idPedido='$idLinea'";

        mysqli_query($conn,$queryServir);

        header("LOCATION:gestionarMesa.php?cod=$numMesa");
    }

?>