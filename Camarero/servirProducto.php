<?php 
    include("seguridad.php");
    include("../conexion.php");



    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idProd=$_POST['cod'];
        $idPed = $_POST['pedido'];
        $numMesa=$_GET['numMesa'];

        $queryServir = "UPDATE pedidoproducto SET servido=1 WHERE idPedido='$idPed' AND idProducto='$idProd'";

        mysqli_query($conn,$queryServir);

        header("LOCATION:gestionarMesa.php?cod=$numMesa");
    }

?>