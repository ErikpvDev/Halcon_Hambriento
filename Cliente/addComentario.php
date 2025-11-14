<?php
include("seguridad.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Halcón Hambriento</title>
    <link rel="stylesheet" href="<?php echo BASE_URL;?>Bootstrap/css/bootstrap.min.css">
    <script src="<?php echo BASE_URL;?>Bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL;?>img/Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="<?php echo BASE_URL;?>styles.css">
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

        .textarea-sci {
            background: rgba(20, 20, 20, 0.85);
            border: 2px solid #ff9800;
            color: #ffd27f;
            resize: none;
            padding: 10px;
            box-shadow: 0 0 8px #ff9800;
        }

        .textarea-sci:focus {
            outline: none;
            box-shadow: 0 0 12px #ffa733;
        }
    </style>
</head>

<body>
    <?php
    include("../conexion.php");
    include("../header.php");
    include("navbar.php");

    $idProducto = $_GET['idProducto'];

    $usuario = $_SESSION['dni'];

     foreach($_SESSION['productos'] as $prod){
        if($prod[0] == $idProducto){
            $comentario = $prod[2];
        }
    }   

    ?>
    <section class="d-flex align-items-center">
        <div class="container">
            <div class="row mt-5 text-center p-3 justify-content-center">
                <div class="contenedor carta col-12 col-md-6 p-3">
                    <div class="row">
                        <form action="addComentariosql.php" method="POST">
                            <div class="col-12 mt-2">
                                <h1>Comentarios</h1>
                            </div>
                            <input type="hidden" name='idproducto' value='<?php echo $idProducto ?>'>
                            <input type="hidden" name='idpedido' value='<?php echo $idPedido?>'>
                            <div class="col-12 me-2 ms-2"><textarea name="comentario" id="comentario" placeholder="Escribe tus comentarios aquí..." class="textarea-sci"><?php echo $comentario; ?></textarea></div>
                            <div class="col-12"> <button type="submit" class="btn btn-warning mt-3 mb-3">Añadir Comentario</button></div>
                        </form>
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