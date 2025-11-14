<?php 
    include("seguridad.php");
    include("../conexion.php");

    $usuario = $_SESSION['dni'];
    $productos = $_SESSION['productos'];

    $queryPedido = "SELECT idPedido FROM pedido WHERE pagado=0 AND usuario='$usuario'";

    $resultPedido = mysqli_query($conn,$queryPedido);

    $idPed = mysqli_fetch_assoc($resultPedido);

    $idPed=$idPed['idPedido'];

    for($i=0;$i<count($productos);$i++){
        $idProd = $productos[$i][0];
        $cant = $productos[$i][1];
        $comentario=$productos[$i][2];
        $queryInsert="INSERT INTO pedidoproducto VALUES (0,'$idPed','$idProd','$cant','$comentario')";

        mysqli_query($conn,$queryInsert);
    }
    
    unset($_SESSION['productos']);

    header("LOCATION:carta.php");

?>