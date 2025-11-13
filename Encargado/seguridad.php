<?php
    include("../config.php");

    session_start();
    if(isset($_SESSION['rol'])){
        if($_SESSION['rol']==0)
            header("LOCATION:".BASE_URL."Cliente/index.php");
        else if($_SESSION['rol']==1)
            header("LOCATION:".BASE_URL."Camarero/index.php");
    }else{
        header("LOCATION:".BASE_URL."index.php");
    }
?>