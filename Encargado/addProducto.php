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
    <link rel="icon" type="image/x-icon" href="/Practica-Restaurante/img//Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="/Practica-Restaurante/styles.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include("../conexion.php");
    include("../header.php");
    include("navbar.php");
    ?>
    <section>
        <div class="container">
            <div class="row mt-5 justify-content-center">
                <div class="col-8 mt-5 contenedor text-center">
                    <h1 class="mt-3 mb-3">AÑADIR PRODUCTO</h1>
                    <form action="addProductosql.php" method="POST" class="text-start row">
                        <input type="hidden" name="id" value="<?php echo $cod_editar ?>">
                        <div class="col-12 col-md-6 mb-4">
                            <label for="nom" class="form-label">Nombre del producto</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
                                    </svg></span>
                                <input type="text" class="form-control" name="nom" placeholder="nombre" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label for="precio" class="form-label">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-exchange" viewBox="0 0 16 16">
                                        <path d="M0 5a5 5 0 0 0 4.027 4.905 6.5 6.5 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05q-.001-.07.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.5 3.5 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98q-.004.07-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5m16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0m-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674z" />
                                    </svg></span>
                                <input type="text" class="form-control" name="precio" placeholder="Precio" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label for="stock" class="form-label">Stock</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box2-fill" viewBox="0 0 16 16">
                                        <path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4zM15 4.667V5H1v-.333L1.5 4h6V1h1v3h6z" />
                                    </svg></span>
                                <input type="text" class="form-control" name="stock" placeholder="Stock" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <label for="cat" class="form-label">Categoria</label>
                            <div class="input-group">
                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    </svg></span>
                                <select type="text" class="form-select" name="cat" placeholder="Categoria">
                                    <?php
                                        $queryCat="SELECT * FROM categoria";

                                        $resultCat = mysqli_query($conn,$queryCat);

                                        while($row=mysqli_fetch_assoc($resultCat)){
                                            $nombre = $row['nombre'];
                                            $cod = $row['idCategoria'];

                                            echo "<option value='$cod'>";
                                            echo $nombre;
                                            echo "</option>";
                                        }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3 mt-3">
                            <button type="submit" class="btn btn-warning d-grid w-100">INSERTAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php
    include("../footer.php");
    ?>
</body>

</html>