<?php
    include ("conexion.php");
    $cliente = $_POST['obra_act'];
    $sql = "SELECT * FROM cotizacion_obra WHERE idcotizacion = '$cliente'";
    $result = mysqli_query($conexion, $sql);
    $cadena = "";
    while ($ver = mysqli_fetch_row($result)){
        $cadena = $cadena.'<tr><td>'.$ver['idcotizacion'].'</td></tr>';
    }
    echo $cadena;
?>