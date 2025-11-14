<?php 
    include("seguridad.php");
    include("../conexion.php");


    $idProducto=$_POST['idproducto'];
    $com = $_POST['comentario'];

    for($i=0;$i<count($_SESSION['productos']);$i++){
        if($_SESSION['productos'][$i][0]==$idProducto){
            $_SESSION['productos'][$i][2]=$com;
        }
    }


    

    echo mysqli_error($conn);

    header("LOCATION:carta.php");

?>