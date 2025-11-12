<?php 
    include("seguridad.php");
    include("../conexion.php");

    $queryPedido = "SELECT idPedido FROM pedido WHERE pagado=0 AND usuario='$usuario'";

    $resultPedido = mysqli_query($conn,$queryPedido);

    $idPed = mysqli_fetch_assoc($resultPedido);

    $idPed = $idPed['idPedido'];
    $idProd = $_GET['producto'];

?>