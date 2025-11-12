<?php
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

        .circulo-libre {
            background-color: lightskyblue;
            border-radius: 50%;
            width: 120px;
            height: 120px;
        }

        .circulo-ocupado {
            background-color: red;
            border-radius: 50%;
            width: 120px;
            height: 120px;
        }

        .carta {
            border: 1px solid #ff9800
        }

        .clic-circular {
            -webkit-clip-path: circle(50%);
            clip-path: circle(50%);
            display: flex;
            justify-content: center;
            align-items: center;
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
                    <form action="" method="POST">
                        <div class="table-responsive">
                            <table class="table table-dark">
                                <tr>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th></th>
                                </tr>
                                <?php
                                $queryBusqueda = "SELECT * FROM producto WHERE stock>0 AND  activo=1 ";

                                $result = mysqli_query($conn, $queryBusqueda);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $nombre = $row['nombre'];
                                    $precio = $row['precio'];
                                    $id = $row['idProducto'];
                                    echo "<tr>";
                                    echo "<td></td>";
                                    echo "<td>$nombre</td>";
                                    echo "<td>$precio</td>";
                                    echo "<td><a href='#?producto=$id' class='btn btn-warning'>Añadir</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="col-4 contenedor carta">
                <h1 style="border-bottom: 1px solid #ff9800;">Pedido</h1>
                <?php
                    $usuario = $_SESSION['dni'];

                    $queryUsuario = "SELECT idPedido FROM pedido WHERE pagado=0 AND usuario='$usuario'";

                    $result = mysqli_query($conn,$queryUsuario);

                    $idpedido = mysqli_fetch_assoc($result);

                    $idpedido=$idpedido['idPedido'];

                    $queryPedido = "SELECT * FROM pedido-producto WHERE idPedido=$idpedido";

                    $resultPedido = mysqli_query($conn,$queryPedido);

                    while($row=mysqli_fetch_assoc($resultPedido)){
                        echo "hola";
                    }
                ?>
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