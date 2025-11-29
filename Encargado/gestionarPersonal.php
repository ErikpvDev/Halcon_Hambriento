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
    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL; ?>img//Halcon-Hambriento-Icono.png">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>styles.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    include("../conexion.php");
    include("../header.php");
    include("navbar.php");
    ?>
    <section class="container">
        <main class="row justify-content-center align-items-center">
            <div class="col-12 col-md-10 col-lg-8 mt-5 contenedor text-center table-responsive p-4">
                <div class="col-12">
                    <h1 class="mt-3 mb-4">PERSONAL</h1>
                </div>

                <div id="error"></div>
                <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                                <th>Más detalles</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $queryPersonal = "SELECT * FROM usuario WHERE rol=1";

                            $resultPersonal = mysqli_query($conn, $queryPersonal);

                            while ($rowP = mysqli_fetch_assoc($resultPersonal)) {
                                $dni = $rowP['dni'];
                                $nombre = $rowP['nombre'];
                                $apellidos = $rowP['apellidos'];
                                $email = $rowP['email'];
                                $tlf = $rowP['telefono'];
                                $direccion = $rowP['direccion'];
                                $activo = $rowP['activo'];

                                echo "<tr>";
                                echo "<td>$dni</td>";
                                echo "<td>$nombre</td>";
                                echo "<td>$apellidos</td>";
                                if ($activo) {
                                    echo '<td style="width:auto;"><span class="badge bg-success">Activo</span></td>';
                                    echo "<td>
                                    <a class='btn btn-warning btn-sm' href='suspenderPersonal.php?dni=$dni'> 
                                        Suspender
                                    </a></td>";
                                }else{
                                    echo '<td><span class="badge bg-danger">Suspendido</span></td>';
                                    echo "<td>
                                    <a class='btn btn-info btn-sm' href='activarPersonal.php?dni=$dni'>
                                        Reactivar
                                    </a>
                                    </td>";
                                }
                                echo "<td><a href='masDetalles.php?dni=$dni'><svg xmlns='http://www.w3.org/2000/svg' width='27' height='27' fill='white' class='bi bi-info-circle' viewBox='0 0 16 16'>
                                    <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16'/>
                                    <path d='m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0'/>
                                    </svg></a></td>";
                                echo "<td><a href='eliminarPersonal.php?dni=$dni' class='btn btn-danger'>X</a></td>";
                                echo "</tr>";
                            }

                            ?>
                        </tbody>
                        <tr>
                            <td colspan="7" class="text-center">
                                <a href='addPersonal.php'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </table>
                    
                </div>

            </div>
        </main>
    </section>
    <?php
    include("../footer.php");
    ?>
</body>

</html>