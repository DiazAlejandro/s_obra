<?php
    include 'php/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Avance</title>
</head>
<body>
    <?php
        date_default_timezone_set('America/Mexico_City');
        $fecha_actual = date ("Y-m-d H:i:s");
    ?>
    <form action="php/avance.php" method="POST" enctype="multipart/form-data">
        <p>Fecha:<input type="datetime" name="fecha" readonly value="<?= $fecha_actual?>"/></p>
        Avance: <input name="avance" type="number" size="45" maxlength="45"> <br>
        
        Seleccione obra:<select name="idobra">
            <option value="0">Seleccione</option>
            <?php
                $consultaObra = "SELECT * FROM obra";
                $result = mysqli_query($conexion,$consultaObra);
                while ($mostrar = mysqli_fetch_array($result)){
                    echo '<option value="'.$mostrar[idobra].'">'.$mostrar[nombre_obra].'</option>';
                }
            ?>
        </select><br>
        Observaciones: <input name="observaciones" type="text" size="45" maxlength="45"> <br>
        <p><input type="submit" value="Registrar" /></p>
    </form>
    <table>
        <tr>
            <td>ID_AVANCE</td>
            <td>FECHA</td>
            <td>AVANCE</td>
            <td>OBRA</td>
            <td>OBSERVACIONES</td>
        </tr>
        <?php
            $consultaCliente= "SELECT 
                            avance.idavance,
                            avance.fecha,
                            avance.avance,
                            obra.nombre_obra,
                            avance.observaciones
                        FROM avance 
                            INNER JOIN obra 
                                ON avance.idobra = OBRA.idobra";
            $result = mysqli_query($conexion,$consultaCliente);
            while ($mostrar = mysqli_fetch_array($result)){
            ?>
             <tr>
                <td><?php echo $mostrar['idavance'] ?></td>
                <td><?php echo $mostrar['fecha'] ?></td>
                <td><?php echo $mostrar['avance'] ?></td>
                <td><?php echo $mostrar['nombre_obra'] ?></td>
                <td><?php echo $mostrar['observaciones'] ?></td>
            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>