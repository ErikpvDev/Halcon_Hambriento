<?php
include("seguridad.php");
include("../conexion.php");

require_once '../vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\EscposImage;

function printEuroSymbol(Printer $printer)
{
    // ESC t 19 = PC858 (contiene símbolo €)


    // Imprimir byte 0xD5 (símbolo € en PC858)
    $printer->getPrintConnector()->write(chr(0xD5));

    // Restaurar codepage estándar (PC437)

}

try {

    // Configurar impresora - Usar conexión de red
    $ipImpresora = "192.168.36.170";  // Cambiar a la IP de tu impresora
    $puertoImpresora = 9100;         // Puerto por defecto para impresoras ESC/POS
    $connector = new NetworkPrintConnector($ipImpresora, $puertoImpresora);
    $printer = new Printer($connector);

    // Configuración inicial de la impresora
    $printer->setPrintLeftMargin(0);
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->setTextSize(1, 1);

    $numMesa = $_GET['numMesa'];

    $queryPedido = "SELECT idPedido FROM pedido WHERE pagado=0 AND numMesa='$numMesa'";

    $resultPedido = mysqli_query($conn, $queryPedido);

    $idPedido = mysqli_fetch_assoc($resultPedido);

    $idPedido = $idPedido['idPedido'];
    // Generar número de factura
    $num_factura = date('Ymd') . $idPedido;

    // Cabecera del ticket
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $printer->text("HALCÓN HAMBRIENTO\n");
    $printer->selectPrintMode();
    $printer->text("C/ Example, 123 - Ciudad\n");
    $printer->text("Tel: 912345678\n");
    $printer->text("CIF: B12345678\n");
    $printer->text(str_repeat("-", 32) . "\n");

    // Información de la factura
    $printer->setJustification(Printer::JUSTIFY_LEFT);
    $printer->text("Factura Nº: " . $num_factura . "\n");
    $printer->text("Mesa: " . $numMesa . " \n");
    $printer->text("Fecha: " . date('d/m/Y H:i') . "\n");
    $printer->text(str_repeat("-", 32) . "\n\n");

    // Cabecera de la tabla
    $printer->text(str_repeat("=", 42) . "\n");
    $printer->text(sprintf("%-16s %11s %6s %6s\n", "PRODUCTO", "PRECIO", "UDS", "TOTAL"));
    $queryProductosComprados = "SELECT idProducto,SUM(cant) as cantidad FROM pedidoproducto WHERE idPedido='$idPedido' GROUP BY idProducto";
    $resultProdCom = mysqli_query($conn, $queryProductosComprados);
    $total;
    $printer->getPrintConnector()->write("\x1B\x74\x02");
    while ($row = mysqli_fetch_assoc($resultProdCom)) {

        $idProducto = $row['idProducto'];
        $queryP = "SELECT * FROM producto WHERE idProducto='$idProducto'";
        $resultP = mysqli_query($conn, $queryP);
        $rowP = mysqli_fetch_assoc($resultP);

        $cant=$row['cantidad'];
        $nombreP = $rowP['nombre'];
        $nombreP = iconv("UTF-8","CP850//TRANSLIT",$nombreP);
        $precio = $rowP['precio'];

        $total_producto = $cant * $precio;

        // FORMATEAR TEXTO (ajusta longitudes según necesites)
        $linea  = str_pad(substr($nombreP, 0, 20), 20);   // Producto
        $linea .= str_pad(number_format($precio, 2), 8, ' ', STR_PAD_LEFT); // Precio
        $linea .= str_pad($cant, 5, ' ', STR_PAD_LEFT);   // Uds
        $linea .= str_pad(number_format($total_producto, 2), 8, ' ', STR_PAD_LEFT);  // Total

        $printer->text($linea . "\n");
        $total += $total_producto;
    }
    $printer->getPrintConnector()->write("\x1B\x74\x00");
    $printer->text(str_repeat("=", 42) . "\n\n");

    // Detalles de productos
    $iva = 0.10; // 10% IVA


    // Cálculos finales
    $BI = $total/(1+$iva); 

    $printer->getPrintConnector()->write("\x1B\x74\x13");
    // Totales
    $printer->text(str_repeat("-", 32) . "\n");
    $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $printer->text(sprintf("Base Imponible: %10.2f \xD5\n", $BI));
    $printer->text(sprintf("IVA (10%%): %15.2f \xD5\n", ($total-$BI)));
    $printer->text(str_repeat("=", 32) . "\n");
    $printer->setEmphasis(true);
    $printer->text(sprintf("TOTAL: %18.2f \xD5\n", $total));
    $printer->setEmphasis(false);

    $printer->getPrintConnector()->write("\x1B\x74\x00");

    // Pie del ticket
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text("\n");
    $printer->text("¡Gracias por su visita!\n");
    $printer->text("www.vegarestaurant.com\n");
    $printer->text("\n");
    $printer->text("Conserve esta factura\n");
    $printer->text("para cualquier reclamación\n");
    $printer->text("\n\n");

    // Cortar ticket
    $printer->cut();
    $printer->close();

    header("LOCATION:index.php");
} catch (Exception $e) {
    echo "Error al imprimir ticket: " . $e->getMessage();
}
