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
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>img/Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .pedido {
            background-color: #1f1e1eff;
            border-radius: 5px;
            border: 2px solid #ff9800;
        }

        ul {
            padding-left: 0;
        }
    </style>
</head>

<body>
    <?php
    include("../conexion.php");
    include("../header.php");
    include("navbar.php");
    ?>
    <section class="d-flex align-items-center">
        <div class="container my-5 pedido p-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="pb-2 mb-4 border-bottom border-warning">Mis Pedidos Anteriores</h1>
                </div>
            </div>

            <div class="row">
                <?php
                $usuario = $_SESSION['dni'];
                $queryPedidos = "SELECT * FROM pedido WHERE usuario='$usuario' ORDER BY fecha DESC, hora DESC";
                $resultPedido = mysqli_query($conn, $queryPedidos);

                if (mysqli_num_rows($resultPedido) > 0) {
                    while ($rowP = mysqli_fetch_assoc($resultPedido)) {
                        $fecha = $rowP['fecha'];
                        $hora = date("H:i", strtotime($rowP['hora'])); // Solo coge las horas y los minutos
                        $pagado = $rowP['pagado'];
                        $comensales = $rowP['numComensales'];

                        if ($pagado == 1) {
                            $estado_pago_texto = "Pagado";
                            $estado_pago_clase = "badge bg-success";
                        } else {
                            $estado_pago_texto = "No Pagado";
                            $estado_pago_clase = "badge bg-danger";
                        }
                ?>
                        <div class="col-md-6 col-lg-4 my-2">
                            <div class="card h-100 bg-dark">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="card-title text-warning">Pedido del <?php echo $fecha; ?></h5>
                                        <span class="<?php echo $estado_pago_clase; ?> fs-6 py-2 px-3 rounded-pill">
                                            <?php echo $estado_pago_texto; ?>
                                        </span>
                                    </div>

                                    <ul>
                                        <li class="d-flex justify-content-start align-items-center px-0">
                                            <strong>Hora: <?php echo $hora; ?></strong>
                                        </li>
                                        <li class="d-flex justify-content-start align-items-center px-0">
                                            <strong>Comensales: <?php echo $comensales; ?></strong>
                                        </li>
                                    </ul>
                                    <?php
                                    $Pedido = $rowP['idPedido'];
                                    if ($estado_pago_texto === "Pagado") {
                                        echo '<div class="mt-4 text-center">
                                        <a href="generarPdf.php?id=' . $Pedido . '" class="btn btn-outline-warning btn-sm" target=”_blank”>
                                            Ver Detalles <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                            </svg>
                                        </a>
                                    </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<div class="col-12">
                        <div class="h3 text-center">
                            Vacío, tu historial de pedidos está. Un buen momento para hacer uno, sí, es.
                        </div>
                        </div>';
                }
                ?>
            </div>
        </div>
    </section>

    <?php
    include("../footer.php");
    ?>
</body>

</html>