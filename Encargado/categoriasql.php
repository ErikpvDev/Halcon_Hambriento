<?php
include("../seguridad.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Halcón Hambriento</title>
    <link rel="stylesheet" href="/Practica-Restaurante/Bootstrap/css/bootstrap.min.css">
    <script src="/Practica-Restaurante/Bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="/Practica-Restaurante/img//Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="/Practica-Restaurante/styles.css">
    <style>
        .caja{
            background-color: aquamarine;
        }
    </style>
</head>

<body>
    <?php
        include("../conexion.php");
        include("../header.php");
        include("navbar.php");

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $opcion = $_POST['opcion'];
            if($opcion=="categoria"){
                header("LOCATION:categoriasql.php");
            }else{
                header("LOCATION:productosql.php");
            }
        }
    ?>
    <section>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-8">
                    <div class="row justify-content-center">
                        <div class="col-12 mt-5">
                            <p class="h2 text-center">Bienvenido <?php echo $_SESSION['name'] ?></p>
                        </div>
                        <div class="col-12 h3 text-center">¿Qué desea modificar?</div>
                        <div class="col col-md-8 mt-4">
                            <div class="row">
                                <form action="" method="POST">
                                    <div class="col-12 d-grid mx-sm-auto">
                                        <select name="opcion" id="opcion" class="form-select">
                                            <option value="categoria">CATEGORIAS</option>
                                            <option value="producto">PRODUCTOS</option>
                                        </select>
                                    </div>
                                    <div class="col-12  mt-4 d-grid mb-5 mx-sm-auto">
                                        <button class="btn btn-lg btn-warning" type="submit">MODIFICAR</button>
                                    </div>
                                </form>
                            </div>
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