<?php
    include ("conexion.php");
    $cliente = $_POST['clientes'];
    $sql = "SELECT 
                idobra, 
                nombre_obra 
            FROM obra WHERE idcliente = '$cliente'";
    $result = mysqli_query($conexion, $sql);
    $cadena = "<label> Seleccione Obra</label>
               <select id = 'obra' name = 'obra'>";
    while ($ver = mysqli_fetch_row($result)){
        $cadena = $cadena.'<option value = '.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
    }
    echo $cadena."</select>";
?>