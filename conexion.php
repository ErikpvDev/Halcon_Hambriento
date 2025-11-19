<?php
$servidor="localhost";
$user="root";
$clave="";
$basededatos="halcon_hambriento";
//Establecimiento de la conexión al servidor localhost, 
//con el usuario root y sin clave
$conn= mysqli_connect($servidor,$user,$clave);
//Charset para español
mysqli_set_charset($conn, "utf8");
//Seleccionamos la base de datos empresa
mysqli_select_db($conn,$basededatos);
//Imprimimos si hay algún error
echo mysqli_error($conn);
?>
