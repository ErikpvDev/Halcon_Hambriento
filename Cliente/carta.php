<?php

use Dom\Mysql;

include("seguridad.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Halcón Hambriento</title>
    <link rel="stylesheet" href="/Practica-Restaurante/Bootstrap/css/bootstrap.min.css">
    <script src="/Practica-Restaurante/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="/Practica-Restaurante/img/Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="/Practica-Restaurante/styles.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        section {
            margin-bottom: 60px;
        }

        .carta {
            border: 1px solid #ff9800
        }

        td {
            vertical-align: middle;
        }

        .imagen-producto {
            height: 50px;
            width: auto;
        }

        .input-cant{

        }
    </style>
</head>

<body>
    <?php
    include("../conexion.php");
    include("../header.php");
    include("navbar.php");

    if (isset($_GET['producto'])) {
        $id = $_GET['producto'];
    }

    ?>
    <section class="d-flex align-items-center">
        <div class="container">
            <div class="row mt-4 text-center p-3 justify-content-between">
                <div class="contenedor carta col-7">
                    <h1 style="border-bottom: 1px solid #ff9800;">Carta</h1>
                    <form action="addProductoAPedido.php" method="POST">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped table-hover align-items-center">
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th></th>
                                </tr>
                                <?php
                                $queryBusqueda = "SELECT * FROM producto WHERE stock>0 AND activo=1 ";

                                $result = mysqli_query($conn, $queryBusqueda);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $nombre = $row['nombre'];
                                    $precio = $row['precio'];
                                    $id = $row['idProducto'];
                                    $img = $row['img'];
                                    echo "<tr>";
                                    echo "<td><img src='$img' class='imagen-producto'></td>";
                                    echo "<td>$nombre</td>";
                                    echo "<td>$precio €</td>";
                                    echo "<td><button type='submit' class='btn btn-warning me-2'>Añadir</button><span class='me-2'>x</span><input type='text' size='1' value='2' name='cantidad' class='text-center'><input type='hidden' name='idProducto' value='$id'></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-4 contenedor carta">
                    <h1 style="border-bottom: 1px solid #ff9800;">Pedido</h1>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover align-items-center">

                            <?php
                            $usuario = $_SESSION['dni'];

                            $queryUsuario = "SELECT idPedido FROM pedido WHERE pagado=0 AND usuario='$usuario'";

                            $result = mysqli_query($conn, $queryUsuario);

                            $idpedido = mysqli_fetch_assoc($result);

                            $idpedido = $idpedido['idPedido'];

                            $queryPedido = "SELECT * FROM pedidoproducto WHERE idPedido=$idpedido";

                            $resultPedido = mysqli_query($conn, $queryPedido);

                            while ($row = mysqli_fetch_assoc($resultPedido)) {
                                $idProd = $row['idProducto'];
                                $cant = $row['cant'];
                                $queryProducto = "SELECT * FROM producto WHERE idProducto='$idProd'";
                                $resultProducto = mysqli_query($conn, $queryProducto);
                                $rowProducto = mysqli_fetch_assoc($resultProducto);

                                $nombreProd = $rowProducto['nombre'];
                                $imgProd = $rowProducto['img'];

                                echo "<tr>";
                                echo "<td><img src='$imgProd' class='imagen-producto'></td>";
                                echo "<td>$nombreProd</td>";
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