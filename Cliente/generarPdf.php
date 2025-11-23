<?php

require_once('../vendor/autoload.php');

include("seguridad.php");
include("../conexion.php");

$mpdf = new \Mpdf\Mpdf([


    ]);


$usuario=$_SESSION['dni'];

$idPedido=$_GET['id'];

$queryFecha = "SELECT fecha,hora FROM pedido WHERE idPedido='$idPedido'";

$resultFecha=mysqli_query($conn,$queryFecha);

$rowF=mysqli_fetch_assoc($resultFecha);

$fecha=date("ymd",strtotime($rowF['fecha']));
$fecha_mostrar=$rowF['fecha'];
$hora=$rowF['hora'];

$numFactura=$fecha.$idPedido;


$queryCliente="SELECT * FROM usuario WHERE dni='$usuario'";

$resultCliente=mysqli_query($conn,$queryCliente);

$rowC=mysqli_fetch_assoc($resultCliente);

$nombreCliente=$rowC['nombre'];
$apellidosCliente=$rowC['apellidos'];

$queryProductos="SELECT idProducto,SUM(cant) as cantidad FROM pedidoproducto WHERE idPedido='$idPedido' GROUP BY idProducto";

$resultProductos=mysqli_query($conn,$queryProductos);


$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura Galáctica - Halcón Hambriento</title>
    <style>
        body {
            font-family: "Arial", sans-serif; 
            font-size: 10pt;
            color: #00BFFF;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }

        /* Títulos */
        .factura-title {
            font-size: 28pt;
            color: #00BFFF; /* Azul Brillante */
            border-bottom: 2px solid #00BFFF;
            width:50%;
            padding-bottom: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .logo-box {
            text-align: center;
            font-size: 12pt;
            float: right;
            width: 100px;
        }

        /* Secciones de Datos (Facturar A, Enviar A, Detalles) */
        .section-header {
            color: #FFD700; /* Oro/Amarillo (Estrella) para los encabezados de sección */
            font-weight: bold;
            font-size: 11pt;
            border-bottom: 1px dashed #333;
            margin-bottom: 5px;
            padding-bottom: 2px;
            text-transform: uppercase;
        }
        .info-block {
            float: left;
            width: 30%;
            margin-right: 3%;
        }
        .info-block p {
            margin: 2px 0;
            font-size: 9pt;
            color: #ccc;
        }
        .factura-details {
            float: right;
            width: 30%;
            text-align: right;
        }
        .factura-details div {
            margin-bottom: 2px;
        }
        .detail-label {
            float: left;
            width: 60%;
            color: #FFD700;
        }
        .detail-value {
            float: right;
            width: 40%;
            font-weight: bold;
            color: #00BFFF;
        }

        /* ===============================
           Tabla de Productos
           =============================== */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        .items-table th {
            background-color: #00BFFF; /* Azul Brillante */
            color: #0d0d0d; /* Texto Oscuro */
            padding: 8px 10px;
            text-align: left;
            text-transform: uppercase;
            font-size: 9pt;
        }
        .items-table td {
            border-bottom: 1px dotted #555;
            padding: 8px 10px;
        }
        .text-right {
            text-align: right;
        }
        
        /* Cálculos (Subtotal, IVA, Total) */
        .totals-block {
            float: right;
            width: 300px;
            margin-top: 20px;
            padding: 10px 0;
            border-top: 1px solid #00BFFF;
        }
        .totals-block div {
            margin-bottom: 5px;
        }
        .totals-label {
            float: left;
            width: 60%;
            color: #ccc;
        }
        .totals-value {
            float: right;
            width: 40%;
            font-weight: bold;
            color: #00BFFF;
        }
        .total-final {
            font-size: 14pt;
            color: #FFD700; /* Oro */
            font-weight: bold;
            border-top: 2px solid #FFD700;
            padding-top: 5px;
        }
        
        /* Estilos específicos para mPDF: forzar fondo y texto en el PDF */
        @page {
            background-color: #0d0d0d;
        }
        body {
            background-color: #0d0d0d;
        }

    </style>
</head>
<body>

<div class="container">

    <div class="clearfix">
        <div class="logo-box"><img src="../img/Halcon-Hambriento-Icono.png"></div>
        <div class="factura-title">RECIBO</div>
    </div>
    
    <p style="font-size: 12pt; font-weight: bold; color: #FFD700;">HALCÓN HAMBRIENTO</p>
    
    <div class="clearfix">
        
        <div class="info-block">
            <div class="section-header">CLIENTE</div>
            <p>Cliente: <strong>'.$nombreCliente.' '.$apellidosCliente.'</strong></p>
            <p>DNI: <strong>'.$usuario.'</strong></p>
        </div>

        <div class="factura-details">
            <div class="clearfix">
                <div class="detail-label">Nº de Factura:</div>
                <div class="detail-value">'.$numFactura.'</div>
            </div>
            <div class="clearfix">
                <div class="detail-label">Fecha:</div>
                <div class="detail-value">'.$fecha_mostrar.'</div>
            </div>
            <div class="clearfix">
                <div class="detail-label">Hora:</div>
                <div class="detail-value">'.$hora.'</div>
            </div>
        </div>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 5%;">CANT.</th>
                <th style="width: 50%;">PRODUCTOS</th>
                <th class="text-right" style="width: 20%;">PRECIO UNITARIO</th>
                <th class="text-right" style="width: 20%;">IMPORTE</th>
            </tr>
        </thead>
        <tbody>';
            $total = 0;
            if(mysqli_num_rows($resultProductos)===0){
                $html.="<tr>";
                $html.='<td colspan="4">NO HAY PRODUCTOS, SI ESTO ES UN ERROR CONTACTA CON UN ENCARGADO</td>';
                $html.="</tr>";
            }else{

            while($rowPr = mysqli_fetch_assoc($resultProductos)) {
                $idProd=$rowPr['idProducto'];
                $cant=$rowPr['cantidad'];

                $queryInfoProd="SELECT * FROM producto WHERE idProducto='$idProd'";

                $resultInfoProf=mysqli_query($conn,$queryInfoProd);

                $rowInfoP=mysqli_fetch_assoc($resultInfoProf);

                $precio=$rowInfoP['precio'];
                $nombre=$rowInfoP['nombre'];

                $totalLinea=$precio * $cant; 
                $total += $totalLinea; 
                
                $html.= "<tr>
                <td>$cant</td>
                <td>$nombre</td>
                <td>".number_format($precio, 2)." €</td>
                <td>".number_format($totalLinea, 2)." €</td>
                </tr>";
            }

            $iva=0.1;

            $BI=$total/(1+$iva);
            }
        $html.='</tbody>
    </table>

    <div class="totals-block clearfix">
        <div class="clearfix">
            <div class="totals-label">Subtotal</div>
            <div class="totals-value">'.number_format($BI, 2).' €</div>
        </div>
        <div class="clearfix">
            <div class="totals-label">Impuesto (10% IVA):</div>
            <div class="totals-value">'.number_format(($total-$BI), 2).' €</div>
        </div>
        <div class="clearfix total-final">
            <div class="totals-label">TOTAL</div>
            <div class="totals-value">'.number_format($total, 2).' €</div>
        </div>
    </div>
    
    <div style="clear: both; text-align: center; margin-top: 50px; font-size: 18pt; color: #FFD700; font-weight:bold;">
        ¡QUE LA FUERZA TE ACOMPAÑE!
    </div>

</div>
</body>
</html>';

$mpdf->writeHtml($html);
        $mpdf->output();

?>