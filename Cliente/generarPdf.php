<?php

require_once('vendor/outoload.php');

$numMesa=$_GET['numMesa'];

$mpdf = new \Mpdf\Mpdf([]);

$html = '
<!DOCTYPE html>
<html lang="es">
<head>
<style>
    body {
        font-family: Arial, sans-serif;
        color: #333;
        line-height: 1.5;
    }
    h1 {
        text-align: center;
        color: #1e73be;
        margin-bottom: 10px;
    }
    h2 {
        color: #1e73be;
        margin-top: 20px;
    }
    .header {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #1e73be;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table th {
        background-color: #1e73be;
        color: white;
        padding: 8px;
        text-align: left;
    }
    table td {
        border: 1px solid #ccc;
        padding: 8px;
    }
    .footer {
        text-align: center;
        font-size: 12px;
        color: #777;
        border-top: 1px solid #ccc;
        padding-top: 5px;
    }
    .total {
        font-weight: bold;
        color: #1e73be;
    }
</style>
</head>
<body>

<div class="header">Factura de Compra</div>

<h2>Cliente</h2>
<p>Nombre:<strong>';

$queryDni = "SELECT usuario FROM pedido WHERE numMesa='$numMesa' AND pagado=0";

$resultDni = mysqli_query($conn,$queryDni);

$dni = mysqli_fetch_assoc($resultDni);

$dni=$dni['usuario'];

$queryPedido="SELECT idPedido FROM pedido WHERE usuario='$dni' AND pagado=0";

$resultPedido=mysqli_query($conn,$queryPedido);

$idPedido = mysqli_fetch_assoc($resultPedido);

$idPedido=$idPedido['idPedido'];


$queryNombre = "SELECT nombre,email FROM usuario WHERE dni='$dni'";

$resultNombre=mysqli_query($conn,$queryNombre);

$rowCliente = mysqli_fetch_assoc($resultDni);

$nombreCliente = $rowCliente['nombre'];
$emailCliente = $rowCliente['email'];

// Datos cliente
$html +=$nombreCliente."</strong><br>";
$html +="Email: <strong>".$emailCliente."</strong><br>";
$html +="Fecha: <strong>".date("d/m/Y")."<strong></p>";

$html += "<h2>Productos</h2>
<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>";

$queryProductos="SELECT idProducto,SUM(cant) AS cantidad FROM pedidoproducto WHERE idPedido='$idPedido' GROUP BY idProducto";

$resutlProductos= mysqli_query($conn,$queryProductos);

while($row=mysqli_fetch_assoc($resutlProductos)){

    $idProd=$row['idProducto'];
    $cant=$row['cantidad'];

    $queryProducto="SELECT * FROM producto WHERE idProducto='$idProd'";

    $resultProducto=mysqli_query($conn,$queryProducto);

    $rowP=mysqli_fetch_assoc($resultProducto);

    $nombreP=$rowP['nombre'];
    $precio=$row['precio'];

    $html+="<tr>";
    $html+="<td>$nombreP</td>";
    $html+="<td>$precio</td>";
    $html+="<td>$cant</td>";

    $total = $precio*$cant;
    $html+="<td>$total</td>";
}

$mpdf->writeHtml($html, \Mpdf\HTML_ParserMode::HTML_BODY);
$mpdf->Output();

    header("LOCATION:pagarCuenta.php?numMesa=$numMesa");

?>