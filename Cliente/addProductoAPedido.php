<?php 
    include("seguridad.php");
    include("../conexion.php");

    $usuario = $_SESSION['dni'];

    $queryPedido = "SELECT idPedido FROM pedido WHERE pagado=0 AND usuario='$usuario'";

    $resultPedido = mysqli_query($conn,$queryPedido);

    $idPed = mysqli_fetch_assoc($resultPedido);

    $idPed = $idPed['idPedido'];
    $idProd = $_POST['idProducto'];
    $cant = $_POST['cantidad'];

    $query = "INSERT INTO pedidoproducto VALUES (0,'$idPed','$idProd',$cant,'')";

    mysqli_query($conn,$query);

    echo mysqli_error($conn);

    header("LOCATION:carta.php");

?>