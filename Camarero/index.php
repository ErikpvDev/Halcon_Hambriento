<?php
include("seguridad.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Halcón Hambriento</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>Bootstrap/css/bootstrap.min.css">
    <script src="<?php echo BASE_URL ?>Bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL ?>img/Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>styles.css">
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
    ?>
    <section class="d-flex align-items-center">
        <div class="container">
            <div class="row mt-4 contenedor text-center p-3 fondo-mesas">
                <div id="mensaje" class="h2" style="color:white;"></div>
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
                        echo "<a onclick='mesaLibre()' style='text-decoration:none; cursor:pointer;' class='circulo-libre mx-auto my-4 text-dark fw-bold clic-circular'>
                            <div><span class='h2'>$id</span></div>
                            </a>";
                    } else {
                        echo "<a href='gestionarMesa.php?cod=$id' style='text-decoration:none;' class='circulo-ocupado mx-auto my-4 text-light fw-bold clic-circular'>
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
            document.getElementById("mensaje").textContent = "";
            iniciado=false;

        }

        function mesaLibre() {
            if (!iniciado) {
                iniciado=true;
                document.getElementById("mensaje").textContent = "No hay ningún comensal en esta mesa";
                setTimeout(borrarMensaje, 3000)
            }
            return false;
        }
    </script>
</body>

</html>