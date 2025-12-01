<?php
include("seguridad.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Halcón Hambriento</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>Bootstrap/css/bootstrap.min.css">
    <script src="<?php echo BASE_URL; ?>Bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>img//Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .caja-estadistica {
            background: #2b2b2b;
            border-radius: 18px;
        }
    </style>
</head>

<body>
    <?php
    include("../conexion.php");
    include("../header.php");
    include("navbar.php");

    $ingresos_totales = 0;
    $comensales_totales = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['fecha_inicio']) && isset($_POST['fecha_fin'])) {
            $fecha_inicio = $_POST['fecha_inicio'];
            $fecha_fin = $_POST['fecha_fin'];
            $tipo = $_POST['tipo'];

            if (strtotime($fecha_inicio) <= strtotime($fecha_fin)) {
                $queryPedidos = "SELECT idPedido,numComensales FROM pedido WHERE pagado=1 AND fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";

                $resultPedido = mysqli_query($conn, $queryPedidos);

                while ($row = mysqli_fetch_assoc($resultPedido)) {
                    $idPedido = $row['idPedido'];
                    $comensalPedido = $row['numComensales'];

                    $queryProductosdePedido = "SELECT idProducto, SUM(cant) AS cantidad FROM pedidoproducto WHERE idPedido = '$idPedido' GROUP BY idProducto";

                    $resultProductosdePedido = mysqli_query($conn, $queryProductosdePedido);

                    while ($rowPdP = mysqli_fetch_assoc($resultProductosdePedido)) {
                        $idProducto = $rowPdP['idProducto'];
                        $cant = $rowPdP['cantidad'];

                        $queryProductosPrecio = "SELECT precio FROM producto WHERE idProducto='$idProducto'";

                        $resultProductosPrecio = mysqli_query($conn, $queryProductosPrecio);

                        $precioProducto = mysqli_fetch_assoc($resultProductosPrecio);

                        $precioProducto = $precioProducto['precio'];

                        if ($tipo === "ambos") {
                            $ingresos_totales += $cant * $precioProducto;
                            $comensales_totales += $comensalPedido;
                        } else if ($tipo === "ingresos") {
                            $ingresos_totales += $cant * $precioProducto;
                        } else {
                            $comensales_totales += $comensalPedido;
                        }
                    }
                }
            } else {
                $_SESSION['error'] = true;
            }
        }
    }

    ?>
    <section class="container">
        <main class="row justify-content-center align-items-center">
            <div class="col-12 col-md-10 col-lg-8 mt-5 contenedor text-center p-4">
                <h1 class="mb-4">Informes de Rendimiento</h1>

                <div class="text-start p-4">

                    <form action="" method="POST" class="row">

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Fecha Inicio</label>
                            <input type="date" class="form-control bg-dark text-light" name="fecha_inicio" value='<?php if (isset($fecha_inicio)) echo $fecha_inicio ?>' required>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label ">Fecha Fin</label>
                            <input type="date" class="form-control bg-dark text-light" name="fecha_fin" value='<?php if (isset($fecha_fin)) echo $fecha_fin ?>' required>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Tipo de Informe</label>
                            <select class="form-select bg-dark text-light" name="tipo">
                                <option value="ingresos">Ingresos Totales</option>
                                <option value="comensales" <?php  if($comensales_totales!=0 && $ingresos_totales==0) echo "selected"; ?>>Número de Comensales</option>
                                <option value="ambos" <?php if($comensales_totales!=0 && $ingresos_totales!=0) echo "selected"; ?>>Ambos</option>
                            </select>
                        </div>

                        <div class="col-12 mt-5">
                            <button type="submit" class="btn btn-warning w-100 py-2">GENERAR INFORME</button>
                        </div>

                    </form>
                </div>

                <div class="text-start p-4 mt-4" style="border-radius: 20px;">
                    <h4 class="mb-3 text-center">Resultados</h4>
                    <div id="resultadoInforme">
                        <?php
                        if (isset($_SESSION['error'])) {
                            echo ' <div class="alert bg-dark text-center" style="border-radius: 12px;">
                                        ⚠️ La fecha de inicio no puede ser posterior a la fecha de fin.
                                    </div>';
                            unset($_SESSION['error']);
                        } else {
                            if ($ingresos_totales !== 0 && $comensales_totales !== 0) {
                                echo "<div class='card shadow-lg caja-estadistica'>
                                        <div class='card-body text-center text-light'>
                                            <h4 class='mb-2'>👥 Comensales</h4>
                                            <p class='display-5 fw-bold text-warning'>$comensales_totales</p>
                                        </div>
                                    </div>";
                                echo "<br>";
                                echo "<div class='card shadow-lg caja-estadistica'>
                                        <div class='card-body text-center text-light'>
                                            <h4 class='mb-2'>💰 Ingresos</h4>
                                            <p class='display-5 fw-bold text-warning'>$ingresos_totales €</p>
                                        </div>
                                    </div>";
                            } else {
                                if ($comensales_totales !== 0) {
                                    echo "<div class='card shadow-lg caja-estadistica'>
                                            <div class='card-body text-center text-light'>
                                                <h4 class='mb-2'>👥 Comensales</h4>
                                                <p class='display-5 fw-bold text-warning'>$comensales_totales</p>
                                            </div>
                                        </div>";
                                } else {
                                    if ($ingresos_totales !== 0) {
                                        echo "<div class='card shadow-lg caja-estadistica'>
                                                <div class='card-body text-center text-light'>
                                                    <h4 class='mb-2'>💰 Ingresos</h4>
                                                    <p class='display-5 fw-bold text-warning'>$ingresos_totales €</p>
                                                </div>
                                            </div>";
                                    } else {
                                        echo '<p class="text-center text-secondary">No hay datos que mostrar</p>';
                                    }
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <?php
    include("../footer.php");
    ?>
</body>

</html>