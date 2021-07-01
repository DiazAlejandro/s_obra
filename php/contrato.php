<?php
    include ("conexion.php");
    $cliente = $_POST['clientes'];
    $sql = "SELECT 
                obra.idobra,
                obra.nombre_obra,
                cotizacion.idcotizacion
            FROM cliente
                INNER JOIN OBRA 
                    ON cliente.idcliente = obra.idcliente
                INNER JOIN cotizacion 
                    ON obra.idobra = cotizacion.idobra
            WHERE cliente.idcliente ='$cliente'";

    $result = mysqli_query($conexion, $sql);
    $cadena = "<label> Seleccione Obra</label>
               <select id = 'obra' name = 'obra'>";
    while ($ver = mysqli_fetch_row($result)){
        $cadena = $cadena.'<option value = '.$ver[0].'>'.utf8_encode($ver[1]).'</option>';
        echo "Número de cotización: <label id = 'nocot' value = ".$ver[2].">".$ver[2]."</label><br>";
    }
    echo $cadena."</select>";

   
?>