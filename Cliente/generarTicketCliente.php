<?php
include("seguridad.php");
include("../conexion.php");

require_once '../vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\EscposImage;

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

    // Cabecera del ticket
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
    $printer->text("HALCÓN HAMBRIENTO\n");
    $printer->selectPrintMode();
    $printer->text(str_repeat("-", 32) . "\n");

    // Numero de mesa
    $idPedido = $_GET['idPedido'];
    $queryNumMesa = "SELECT numMesa FROM pedido WHERE idPedido='$idPedido'";

    $resultNumMesa = mysqli_query($conn, $queryNumMesa);

    $numMesa = mysqli_fetch_assoc($resultNumMesa);
    $numMesa = $numMesa['numMesa'];

    // Orden de Cocina
    $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH | Printer::MODE_DOUBLE_HEIGHT);
    $printer->setReverseColors(true);
    $printer->text(" ORDEN DE COCINA \n");
    $printer->setReverseColors(false);
    $printer->feed(1);

    $printer->setTextSize(2, 2); // Doble tamaño
    $printer->text("MESA: " . $numMesa . "\n");
    $printer->setTextSize(1, 1); // Tamaño normal
    $printer->text("Pedido: #" . $idPedido . "\n");
    $printer->text("Fecha: " . date('d/m/Y H:i') . "\n");
    $printer->text(str_repeat("_", 42) . "\n\n");

    // Cabecera de la tabla
    $printer->text(str_repeat("=", 42) . "\n");
    $printer->getPrintConnector()->write("\x1B\x74\x02");


    $printer->setJustification(Printer::JUSTIFY_LEFT);

    // Codificación para acentos (depende de tu impresora, suele ser PC850 o WPC1252)
    $printer->getPrintConnector()->write("\x1B\x74\x02");

    foreach ($_SESSION['productos'] as $prod) {
        $id = $prod[0];
        $cant = $prod[1];
        $com = $prod[2];

        // Obtenemos nombre del producto
        $queryProducto = "SELECT nombre FROM producto WHERE idProducto='$id'";
        $resultProducto = mysqli_query($conn, $queryProducto);
        $row = mysqli_fetch_assoc($resultProducto);
        $nombre = $row['nombre'];

        // 1. Imprimir Cantidad y Nombre en Grande
        $printer->setEmphasis(true); // Negrita
        $printer->setTextSize(1, 2); // Doble alto y ancho para leer fácil
        if (!empty($com)) {
            if(strlen($com)>20){
                $com=substr($com,0,15);
            }
            $printer->text("$cant x $nombre");
            $printer->setTextSize(1, 2); // Letra alta pero estrecha para notas
            $printer->text("   NOTA: $com \n");
        }else{
            $printer->text("$cant x $nombre\n");
            $printer->setTextSize(1, 2); // Letra alta pero estrecha para notas
        }

        $printer->setTextSize(1, 1); // Resetear tamaño
        $printer->setEmphasis(false); // Quitar negrita
    }

    $printer->getPrintConnector()->write("\x1B\x74\x00");
    $printer->setJustification(Printer::JUSTIFY_CENTER);
    $printer->text(str_repeat("=", 42) . "\n\n");


    // --- PIE DEL TICKET ---
    $printer->feed(2);
    $printer->text("--- FIN DE ORDEN ---\n");
    $printer->feed(2);

    // Cortar papel
    $printer->cut();
    $printer->close();

    unset($_SESSION['productos']);
    header("LOCATION:carta.php");
} catch (Exception $e) {
    echo "Error al imprimir ticket: " . $e->getMessage();
}
