<?php
    include 'php/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Obra</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data" action="php/obra.php">
                <h2>Registrar Obra</h2>
            Nombre de la Obra: <input name="nombre_obra" type="text" size="45" maxlength="45"> <br>
            Fecha de registro: <input name="fecha" type="date" size="70" maxlength="70"> <br>
            <!--Avance de la Obra: <input name="avance" type="number" size="70" maxlength="70" > <br>-->
            Tipo de Obra:      <input name="tipo" type="text" size="70" maxlength="70"> <br>
            
            Fecha de inicio:   <input name="fecha_inicio" type="date" size="70" maxlength="70"> <br>
            Fecha de final:    <input name="fecha_fin" type="date" size="70" maxlength="70"> <br>

            Seleccione cliente:<select name="cliente">
                <option value="0">Seleccione</option>
                <?php
                    $consultaCliente = "SELECT * FROM cliente";
                    $result = mysqli_query($conexion,$consultaCliente);
                    while ($mostrar = mysqli_fetch_array($result)){
                        echo '<option value="'.$mostrar[idcliente].'">'.$mostrar[nombre].'</option>';
                    }
                ?>
            </select><br>

            Seleccione responsable: <select name="responsable">
                <option value="0">Seleccione</option>
                <?php
                    $consultaResponsable = "SELECT * FROM responsable";
                    $result = mysqli_query($conexion,$consultaResponsable);
                    while ($mostrar = mysqli_fetch_array($result)){
                        echo '<option value="'.$mostrar[idresponsable].'">'.$mostrar[nombre].'</option>';
                    }
                ?>
            </select><br>
            
            <h2>Ubicacion de la Obra</h2>
                <p>Calle:<input type="text" name="calle" /></p>
                <p>Colonia:<input type="text" name="colonia" /></p>
                <p>Municipio:<input type="text" name="municipio" /></p>
                <p>Estado:<input type="text" name="estado" /></p>
                Estatus: <select name="statusd">
                    <option value="V">Verificado</option>
                    <option value="F">No Validado</option>
                </select><br>
            

        
        
        <p><input type="submit" value="Enviar" /></p>

    </form>

    <table>
        <tr>
            <td>ID OBRA</td>
            <td>NOMBRE OBRA</td>
            <td>F REGISTRO</td>
            <td>AVANCE</td>
            <td>TIPO</td>
            <td>FECHA INICIO</td>
            <td>FECHA FINAL</td>
            <td>CLIENTE</td>
            <td>RESPONSABLE</td>
            <td>DIRECCION</td>
        </tr>
        <?php
            $consultaObra = "SELECT 
                    obra.idobra,
                    obra.nombre_obra,
                    obra.fecha_registro,
                    obra.avance,
                    obra.tipo_obra,
                    obra.fecha_inicio,
                    obra.fecha_fin,
                    CONCAT_WS (' ',cliente.nombre,cliente.apellidos)as cliente,
                    CONCAT_WS (' ',responsable.nombre, responsable.apellidos) as responsable,
                    CONCAT_WS (' ',data_entities.calle, data_entities.colonia, 
                                    data_entities.municipio, data_entities.estado) as direccion
                    FROM obra
                        INNER JOIN cliente
                            ON obra.idcliente = cliente.idcliente
                        INNER JOIN responsable 
                            ON responsable.idresponsable = obra.idresponsable
                        INNER JOIN data_entities
                            ON obra.iddata_entities = data_entities.iddata_entities";
            $result = mysqli_query($conexion,$consultaObra);
            while ($mostrar = mysqli_fetch_array($result)){
            ?>
            <tr>  
                <td><?php echo $mostrar['idobra'] ?></td>
                <td><?php echo $mostrar['nombre_obra'] ?></td>
                <td><?php echo $mostrar['fecha_registro'] ?></td>
                <td><?php echo $mostrar['avance'] ?></td>
                <td><?php echo $mostrar['tipo_obra'] ?></td>
                <td><?php echo $mostrar['fecha_inicio'] ?></td>
                <td><?php echo $mostrar['fecha_fin'] ?></td>
                <td><?php echo $mostrar['cliente'] ?></td>
                <td><?php echo $mostrar['responsable'] ?></td>
                <td><?php echo $mostrar['direccion'] ?></td>
            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>