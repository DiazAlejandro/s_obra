<?php
    $host = "localhost";
    $user = "root";
    $pass = "1234";
    $db   = "ctrl_obra";

    $conexion = mysqli_connect($host,$user,$pass,$db)
                or die('Error en la conexión servidor');

?>