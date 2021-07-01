<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Cotizacion</title>
</head>
<body>
    <form action="/control_obra/php/cotizacion.php" method="POST" enctype="multipart/form-data">
        <h2>Cotizacion</h2>
        Tiempo Estimado:<input name="tiempo_estimado" type="text" size="70" maxlength="70"> <br>
        Capital Humano:<input name="capital_humano" type="text" size="70" maxlength="70"> <br>

        Seleccione obra:<select name="obra">
            <option value="0">Seleccione</option>
            <?php
                $consultaObra = "SELECT * FROM obra";
                $result = mysqli_query($conexion,$consultaObra);
                while ($mostrar = mysqli_fetch_array($result)){
                    echo '<option value="'.$mostrar[idobra].'">'.$mostrar[nombre_obra].'</option>';
                }
            ?>

        </select><br>
        <p class="center"><input type="submit" value="Guardar Cotización"></p>
    </form>
</body>
</html>