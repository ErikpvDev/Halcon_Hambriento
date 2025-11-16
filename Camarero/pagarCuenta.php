<?php
    include("seguridad.php");
    include("../conexion.php");

    $numMesa=$_GET['numMesa'];

    $queryPedido="UPDATE pedido SET pagado=1 WHERE numMesa='$numMesa' AND pagado=0 ";

    mysqli_query($conn,$queryPedido);

    $queryMesa = "UPDATE mesa SET ocupado=0 WHERE numMesa='$numMesa'";

    mysqli_query($conn,$queryMesa);

    header("LOCATION:index.php");


?>