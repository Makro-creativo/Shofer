<?php 
    if(!isset($_SESSION)) {
        session_start();
    }

    $conexion = mysqli_connect("localhost", "root", "") or die ("Problemas con la conexíon de la base de datos");
    mysqli_select_db($conexion, "shofer") or die ("Problemas al seleccionar la base de datos");
    mysqli_set_charset($conexion, "utf8");
?>