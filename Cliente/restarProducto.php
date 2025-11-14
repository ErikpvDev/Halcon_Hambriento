<?php 

    include("seguridad.php");
    include("../conexion.php");

    $idProd = $_GET['idProducto'];

    for ($i = 0; $i < count($_SESSION['productos']); $i++) {
        if ($_SESSION['productos'][$i][0] == $idProd) {
            $_SESSION['productos'][$i][1]--;
        
    

        if ($_SESSION['productos'][$i][1] <= 0) {
                unset($_SESSION['productos'][$i]);
                $_SESSION['productos'] = array_values($_SESSION['productos']); // Reestructura el array
            }

        }
    }

    header("LOCATION:carta.php");

?>