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

        $queryStock = "SELECT stock FROM producto WHERE idProducto='$idProd'";

        $resultStock=mysqli_query($conn,$queryStock);

        $stock = mysqli_fetch_assoc($resultStock);

        $stock = $stock['stock'];

        if($cant<=$stock){
            $queryInsert="INSERT INTO pedidoproducto VALUES (0,'$idPed','$idProd','$cant','$comentario',0)";

            mysqli_query($conn,$queryInsert);

            $nuevoStock=$stock-$cant;

            $queryRestarStock = "UPDATE producto SET stock='$nuevoStock' WHERE idProducto='$idProd'";

            mysqli_query($conn,$queryRestarStock);
        }
    }
    
    unset($_SESSION['productos']);

    header("LOCATION:carta.php");

?>