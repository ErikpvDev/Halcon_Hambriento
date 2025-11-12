<?php
include("seguridad.php");
include("../conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_SESSION['dni'];
    $numMesa = $_POST['mesa'];
    $fecha = date('d-m-Y');
    $hora = date('h:i:sa');
    $numComen = $_POST['comensales'];
    


    $queryReserva = "INSERT INTO reserva VALUES ('$usuario','$numMesa','$fecha','$hora','$numComen')";

    mysqli_query($conn,$queryReserva);

    $queryPedido = "INSERT INTO pedido VALUES (0,0,'$usuario','$numMesa')";

    mysqli_query($conn,$queryPedido);


    $queryOcuparMesa = "UPDATE mesa SET ocupado=1 WHERE numMesa='$numMesa'";

    mysqli_query($conn,$queryOcuparMesa);

    header("LOCATION:carta.php");

}
