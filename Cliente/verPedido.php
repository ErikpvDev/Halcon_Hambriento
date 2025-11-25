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
    .imagen-producto {
        height: 50px;
        width: auto;
    }
    </style>
</head>

<body>
    <?php
    include("../conexion.php");
    include("../header.php");
    include("navbar.php");


    $usuario=$_SESSION['dni'];

    $queryUsuarioaElegido="SELECT idPedido FROM pedido WHERE pagado=0 AND usuario='$usuario'";

    $resultElegido = mysqli_query($conn,$queryUsuarioaElegido);

    if(mysqli_num_rows($resultElegido)===0){
        header("LOCATION:index.php");
    }

    $usuario = $_SESSION['dni'];

    $queryMesa = "SELECT numMesa FROM pedido WHERE usuario='$usuario' AND pagado=0";

    $resultMesa = mysqli_query($conn, $queryMesa);

    $numMesa = mysqli_fetch_assoc($resultMesa);

    $numMesa = $numMesa['numMesa'];

    $queryPedido = "SELECT idPedido FROM pedido WHERE pagado=0 AND numMesa='$numMesa'";

    $resultPedido = mysqli_query($conn, $queryPedido);

    $idPed = mysqli_fetch_assoc($resultPedido);

    $idPed = $idPed['idPedido'];
    ?>
    <section class="d-flex align-items-center">
        <div class="container">
            <div class="row mt-4 text-center p-3 justify-content-between">
                <div class="contenedor carta col-12 col-md-5 mb-5 pedido-container">
                    <h1 style="border-bottom: 1px solid #ff9800;">Productos Pendientes</h1>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover align-items-center">
                            <?php
                            $queryProductosPendientes = "SELECT idProducto,idLinea,SUM(cant) AS cantidad FROM pedidoproducto WHERE servido=0 AND idPedido='$idPed' GROUP BY idProducto";

                            $resultPendientes = mysqli_query($conn, $queryProductosPendientes);
                            if (mysqli_num_rows($resultPendientes) > 0) {
                                while ($row = mysqli_fetch_assoc($resultPendientes)) {
                                    $id = $row['idProducto'];
                                    $cant = $row['cantidad'];
                                    $idLinea = $row['idLinea'];

                                    $queryProductoP = "SELECT * FROM producto WHERE idProducto='$id'";

                                    $resultProductoP = mysqli_query($conn, $queryProductoP);

                                    $rowP = mysqli_fetch_assoc($resultProductoP);

                                    $nombre = $rowP['nombre'];
                                    $precio = $rowP['precio'];
                                    $id = $rowP['idProducto'];
                                    $img = $rowP['img'];

                                    echo "<tr>";
                                    echo "<td><img src='$img' class='imagen-producto'></td>";
                                    echo "<td>$nombre</td>";
                                    echo "<td>x$cant</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>

                <div class="contenedor carta col-12 col-md-5 mb-5 pedido-container">
                    <h1 style="border-bottom: 1px solid #ff9800;">Productos Servidos</h1>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover align-items-center">
                            <?php

                            $queryProductosServidos = "SELECT idProducto,SUM(cant) AS cantidad FROM pedidoproducto WHERE servido=1 AND idPedido='$idPed' GROUP BY idProducto";

                            $resultServidos = mysqli_query($conn, $queryProductosServidos);

                            while ($row = mysqli_fetch_assoc($resultServidos)) {

                                $id = $row['idProducto'];
                                $cant = $row['cantidad'];

                                $queryProductoS = "SELECT * FROM producto WHERE idProducto='$id'";

                                $resultProductoS = mysqli_query($conn, $queryProductoS);

                                $rowS = mysqli_fetch_assoc($resultProductoS);

                                $nombre = $rowS['nombre'];
                                $precio = $rowS['precio'];
                                $id = $rowS['idProducto'];
                                $img = $rowS['img'];
                                echo "<tr>";
                                echo "<td><img src='$img' class='imagen-producto'></td>";
                                echo "<td>$nombre</td>";
                                echo "<td>x$cant</td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php
    include("../footer.php");
    ?>
</body>

</html>