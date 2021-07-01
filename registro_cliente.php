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
    <?php
        date_default_timezone_set('America/Mexico_City');
        $fecha_actual = date ("Y-m-d H:i:s");
    ?>

    <!--FORMULARIO-->
    <form action="/s_obra/php/cliente.php" method="POST" enctype="multipart/form-data">
         <h2>Cliente</h2>
        <p>Nombre(s):<input type="text" name="nombre" /></p>
        <p>Apellidos:<input type="text" name="apellidos" /></p>
        
        Seleccione Sexo: <select name="sexo">
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select><br>

        <p>Telefono:<input type="text" name="telefono" /></p>
        <p>Correo:<input type="text" name="correo" /></p>
        <p>Fecha_Registro:<input type="datetime" name="fecha" readonly value="<?= $fecha_actual?>"/></p>

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
            <td>Id_cliente</td>
            <td>Nombre</td>
            <td>Apellidos</td>
            <td>Sexo</td>
            <td>Telefono</td>
            <td>Correo_e</td>
            <td>Fecha_registro</td>
        </tr>
        <?php
            $consultaCliente= "SELECT * FROM cliente";
            $result = mysqli_query($conexion,$consultaCliente);
            while ($mostrar = mysqli_fetch_array($result)){
            ?>
             <tr>
                <td><?php echo $mostrar['idcliente'] ?></td>
                <td><?php echo $mostrar['nombre'] ?></td>
                <td><?php echo $mostrar['apellidos'] ?></td>
                <td><?php echo $mostrar['sexo'] ?></td>
                <td><?php echo $mostrar['telefono'] ?></td>
                <td><?php echo $mostrar['correo_e'] ?></td>
                <td><?php echo $mostrar['fecha_registro'] ?></td>

            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>