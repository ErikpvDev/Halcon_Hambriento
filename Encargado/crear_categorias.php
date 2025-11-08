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
            <div class="row justify-content-center align-items-center">
                <div class="col-8 mt-5 contenedor text-center table-responsive p-4">
                    <div class="col-12">
                        <h1 class="mt-3 mb-3">CATEGORÍAS</h1>
                    </div>
                    <table class="table table-dark table-striped table-hover  align-items-center">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Cantidad de productos</th>
                            </tr>
                        </thead>
                        <?php
                        $query = "SELECT * FROM categoria";

                        $result = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result)) {

                            $cod_Cat = $row['idCategoria'];
                            $nombre = $row['nombre'];
                            
                            $queryCount = "SELECT COUNT(idProducto) FROM producto WHERE categoria='$cod_Cat'";
                            
                            $resultCount= mysqli_query($conn,$queryCount);

                            $cant = mysqli_fetch_assoc($resultCount);
                            
                            $cant = $cant['COUNT(idProducto)'];
            
                            if($cant == null)
                                $cant=0;
                            echo "<tr>";
                            #Icono de editar
                            echo "<td><a href='#' style='text-decoration:none;' class='align-items-center me-3'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='white' class='bi bi-pencil-square' viewBox='0 1 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                            </svg>
                            </a></td>";
                            echo "<td>$nombre</td>";
                            echo "<td>$cant</td>";
                            echo"</tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php
    include("../footer.php");
    ?>
</body>

</html>