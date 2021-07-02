<?php
    include 'php/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permisos</title>
</head>
<body>
    <form action="/s_obra/php/permiso.php" method="POST" enctype="multipart/form-data"> 
        <h2>Permiso</h2>
        Documento Permiso: <input name="file" type="file"><br>
        Seleccione Obra:<select id="obra" name="obra">
            <option value="0">Seleccione</option>
            <?php
                $consultaObra = "SELECT * FROM obra";
                $result = mysqli_query($conexion,$consultaObra);
                while ($mostrar = mysqli_fetch_array($result)){
                    echo '<option value="'.$mostrar[idobra].'">'.$mostrar[nombre_obra].'</option>';
                }
            ?>
            </select><br>
            Fecha de inicio del permiso:<input type="date" name="fecha_i"/><br>
            Fecha de vencimiento del permiso:<input type="date" name="fecha_f"/><br>    
        <p class="center"><input type="submit" value="Guardar Permiso"></p>
    </form>

    <table>
        <tr>
            <td>ID PERMISO</td>
            <td>DOCUMENTO</td>
            <td>OBRA</td>
            <td>FECHA INICIO</td>
            <td>FECHA VENCIMIENTO</td>
        </tr>
        <?php
            $consultaPermiso = "SELECT 
                                permiso.idpermiso,
                                permiso.documento_permiso,
                                obra.nombre_obra,
                                permiso.fecha_inicio,
                                permiso.fecha_vencimiento
                            FROM permiso 
                                INNER JOIN obra 
                                    ON permiso.idobra = obra.idobra";
            $result = mysqli_query($conexion,$consultaPermiso);
            while ($mostrar = mysqli_fetch_array($result)){
            ?>
            <tr>  
                <td><?php echo $mostrar['idpermiso'] ?></td>
                <td><a href="<?php echo 's_obra/'.$mostrar['documento_permiso'] ?>">Permiso</a></td>
                <td><?php echo $mostrar['nombre_obra'] ?></td>
                <td><?php echo $mostrar['fecha_inicio'] ?></td>
                <td><?php echo $mostrar['fecha_vencimiento'] ?></td>
            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>