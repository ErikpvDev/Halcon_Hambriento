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

        .pedido-container {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <?php
    if (!isset($_SESSION['productos'])) {
        $_SESSION['productos'] = [];
    }

    if (!isset($_SESSION['busqueda'])) {
        $_SESSION['busqueda'] = "";
    }
    include("../conexion.php");
    include("../header.php");
    include("navbar.php");

    if (isset($_POST['busqueda'])) {
        $_SESSION['busqueda'] = $_POST['busqueda'];
        $patronBusqueda = $_SESSION['busqueda'];
    } else {
        $patronBusqueda = "";
    }

    if ($patronBusqueda === "")
        $queryBusqueda = "SELECT * FROM producto WHERE stock>0 AND activo=1";
    else
        $queryBusqueda = "SELECT * FROM producto WHERE stock>0 AND activo=1 AND nombre LIKE '%$patronBusqueda%'";

    $result = mysqli_query($conn, $queryBusqueda);
    ?>
    <section class="d-flex align-items-center">
        <div class="container">
            <div class="row mt-4 text-center p-3 justify-content-between">

                <!-- CARTA -->

                <div class="contenedor carta col-7">
                    <h1 style="border-bottom: 1px solid #ff9800;">Carta</h1>
                    <form action="" method="POST" class="input-group mt-3 mb-3">
                        <input type="text" class="form-control" name="busqueda" placeholder="Buscar..." value='<?php echo $_SESSION['busqueda']; ?>'>
                        <button type="submit" class="btn btn-primary input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg></button>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover align-items-center">
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                            <?php

                            while ($row = mysqli_fetch_assoc($result)) {
                                $nombre = $row['nombre'];
                                $precio = $row['precio'];
                                $id = $row['idProducto'];
                                $img = $row['img'];
                                echo "<tr>";
                                echo "<td><img src='$img' class='imagen-producto'></td>";
                                echo "<td>$nombre</td>";
                                echo "<td>$precio €</td>";
                                echo "<td>
                                        <form action='' method='POST'>
                                        <input type='hidden' name='cod' value='$id'>
                                        <button type='submit' class='btn btn-warning ms-2'>Añadir</button>
                                        <span class='me-2'>x</span>
                                        <input type='number' min='1' value='1' name='cantidad' class='text-center' style='width:50px;'>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>

                <!-- PEDIDO -->

                <div class="col-4 contenedor carta pedido-container">
                    <h1 style="border-bottom: 1px solid #ff9800;">Pedido</h1>
                    <div class="table-responsive">
                        <table class="table table-dark table-striped table-hover align-items-center">

                            <?php
                            if (isset($_POST['cod']) && isset($_POST['cantidad'])) {

                                $cod = $_POST['cod'];
                                $cantidad = $_POST['cantidad'];
                                $comentario = "";
                                $encontrado = false;

                                for ($i = 0; $i < count($_SESSION['productos']) && !$encontrado; $i++) {

                                    if ($_SESSION['productos'][$i][0] == $cod) {

                                        $_SESSION['productos'][$i][1] += $cantidad;
                                        $encontrado = true;
                                    }
                                }

                                if (!$encontrado) {
                                    $_SESSION['productos'][] = [$cod, $cantidad, $comentario];
                                }
                            }

                            foreach ($_SESSION['productos'] as $prod) {

                                $id = $prod[0];
                                $cant = $prod[1];
                                $com = $prod[2];

                                $queryProducto = "SELECT * FROM producto WHERE idProducto='$id'";
                                $resultProducto = mysqli_query($conn, $queryProducto);
                                $row = mysqli_fetch_assoc($resultProducto);

                                $usuario = $_SESSION['dni'];

                                $queryPedido = "SELECT idPedido FROM pedido WHERE pagado=0 AND usuario='$usuario'";
                                $resultPedido = mysqli_query($conn, $queryPedido);
                                $idPedido = mysqli_fetch_assoc($resultPedido);
                                $idPedido = $idPedido['idPedido'];


                                echo "<tr>";
                                // Icono Comentario
                                if ($com == "") {
                                    echo "<td><a href='addComentario.php?idProducto=$id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' class='bi bi-chat-right-fill' viewBox='0 1 16 16'>
                                        <path d='M14 0a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z'/>
                                        </svg></a></td>";
                                } else {
                                    echo "<td><a href='addComentario.php?idProducto=$id'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' class='bi bi-chat-right-text-fill' viewBox='0 1 16 16'>
                                        <path d='M16 2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h9.586a1 1 0 0 1 .707.293l2.853 2.853a.5.5 0 0 0 .854-.353zM3.5 3h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1m0 2.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1 0-1m0 2.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1'/>
                                        </svg></a></td>";
                                }
                                echo "<td><img src='{$row['img']}' class='imagen-producto'></td>";
                                echo "<td>{$row['nombre']}</td>";
                                echo "<td>$cant</td>";
                                echo "<td><a href='restarProducto.php?idProducto=$id' class='btn btn-danger btn-sm'>-</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                        <?php
                            if(!empty($_SESSION['productos']))
                                echo "<a href='AddProductoAPedido.php' class='btn btn-warning mb-3'>Pedir</a>";
                            else
                                echo "<p>Que la Fuerza te acompañe... a pedir nuestras delicias</p> ";
                        ?>
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