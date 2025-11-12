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

        .fondo-mesas {
            background-image: url("../img/fondo-mesas.jpg");
            background-size: cover;
            background-repeat: no-repeat;
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

    $queryUsuarioaElegido="SELECT usuario FROM pedido WHERE pagado=0";

    $result = mysqli_query($conn,$queryUsuarioaElegido);

    if(mysqli_num_rows($result)>=1)
        header("LOCATION:carta.php");
    ?>
    <section class="d-flex align-items-center">
        <div class="container">
            <div class="row mt-4 contenedor text-center p-3 fondo-mesas">
                <div id="mesaocupada" class="h2" style="color:red;"></div>
                <h1>Mesas</h1>
                <h4>Elija una mesa</h4>
                <?php
                $queryMesas = "SELECT * FROM mesa";

                $result = mysqli_query($conn, $queryMesas);

                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['numMesa'];
                    $ocupado = $row['ocupado'];
                    echo "<div class='col-6 col-sm-4'>";
                    if (!$ocupado) {
                        echo "<a href='mesaElegida.php?cod=$id' style='text-decoration:none;' class='circulo-libre mx-auto my-4 text-dark fw-bold clic-circular'>
                            <div><span class='h2'>$id</span></div>
                            </a>";
                    } else {
                        echo "<a href='#' onclick='mensajeOcupado()' style='text-decoration:none;' class='circulo-ocupado mx-auto my-4 text-light fw-bold clic-circular'>
                            <div><span class='h2'>$id</span></div>
                            </a>";
                    }
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    include("../footer.php");
    ?>
    <script>
        let iniciado = false;

        function borrarMensaje() {
            document.getElementById("mesaocupada").textContent = "";
            iniciado=false;

        }

        function mensajeOcupado() {
            if (!iniciado) {
                iniciado=true;
                document.getElementById("mesaocupada").textContent = "Esa mesa esta ocupada, elija otra porfavor";
                setTimeout(borrarMensaje, 3000)
            }
            return false;
        }
    </script>
</body>

</html>