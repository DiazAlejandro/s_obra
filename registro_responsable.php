<?php
    include 'php/conexion.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--FORMULARIO-->
    <form action="php/responsable.php" method="POST" enctype="multipart/form-data">
        <h2>Responsable</h2>
        <p>Nombre(s):<input type="text" name="nombre" /></p>
        <p>Apellidos:<input type="text" name="apellidos" /></p>
        <p>Telefono:<input type="text" name="telefono" /></p>
        <p>Correo:<input type="text" name="correo" /></p>

        <h2>Dirección</h2>
        <p>Calle:<input type="text" name="calle" /></p>
        <p>Colonia:<input type="text" name="colonia" /></p>
        <p>Municipio:<input type="text" name="municipio" /></p>
        <p>Estado:<input type="text" name="estado" /></p>
        Estatus: <select name="statusd">
            <option value="V">Verificado</option>
            <option value="F">No Validado</option>
        </select><br>

        <p><input type="submit" value="Registrar" /></p>
    </form>
    <table>
        <tr>
            <td>ID</td>
            <td>NOMBRE</td>
            <td>APELLIDOS</td>
            <td>CORREO ELECTRÓNICO</td>
            <td>TELÉFONO</td>
            <td>DIRECCIÓN</td>
        </tr>
        <?php
            $consultaResponsable= "SELECT 
                responsable.idresponsable,
                responsable.nombre,
                responsable.apellidos,
                responsable.correo_e,
                responsable.telefono,
            CONCAT_WS (' ',data_entities.calle, data_entities.colonia,
                data_entities.municipio, data_entities.estado) as direccion
            FROM responsable
                INNER JOIN data_entities 
                    on responsable.iddata_entities = data_entities.iddata_entities";
            $result = mysqli_query($conexion,$consultaResponsable);
            while ($mostrar = mysqli_fetch_array($result)){
            ?>
             <tr>
                <td><?php echo $mostrar['idresponsable'] ?></td>
                <td><?php echo $mostrar['nombre'] ?></td>
                <td><?php echo $mostrar['apellidos'] ?></td>
                <td><?php echo $mostrar['correo_e']?></td>
                <td><?php echo $mostrar['telefono']?></td>
                <td><?php echo $mostrar['direccion']?></td>
            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>