<?php
    include 'php/conexion.php';
    session_start();
    if (isset($_SESSION['username'])){
        
    }else{
        $messaget = "❌ NO TIENE ACCESO A LA PÁGINA ❌";
        echo "<script type='text/javascript'>
            alert('$messaget');
            window.location.href = 'index.php';
            </script>";

    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Proveedores</title>
</head>
<body>
    <form action="php/proveedor.php" method="POST" enctype="multipart/form-data">
        <h2>Registro Proveedores</h2>
        RFC: <input name="rfc" type="text" size="13" maxlength="13"> <br>
        Razón social: <input name="razon_social" type="text" size="45" maxlength="45"> <br>
        Correo_e: <input name="correo_e" type="text" size="45" maxlength="45"> <br>
        Telefono: <input name="telefono" type="text" size="10" maxlength="10"> <br>
        
        <h2>Dirección</h2>
        <p>Calle:<input type="text" name="calle" /></p>
        <p>Colonia:<input type="text" name="colonia" /></p>
        <p>Municipio:<input type="text" name="municipio" /></p>
        <p>Estado:<input type="text" name="estado" /></p>
        Estatus: <select name="statusd">
            <option value="V">Verificado</option>
            <option value="F">No Validado</option>
        </select><br>

        <p class="center"><input type="submit" value="Registrar Proveedor"></p>
    </form>

    <table>
        <tr>
            <td>RFC</td>
            <td>RAZÓN SOCIAL</td>
            <td>CORREO ELECTRÓNICO</td>
            <td>TELEFONO</td>
            <td>DIRECCIÓN</td>
        </tr>
        <?php
            $consultaProveedor= "SELECT 
                proveedor_material.rfc_proveedor,
                proveedor_material.razon_social,
                proveedor_material.correo_e,
                proveedor_material.telefono,
                CONCAT_WS (' ',data_entities.calle, data_entities.colonia, 
                    data_entities.municipio, data_entities.estado) as direccion
            FROM proveedor_material 
                INNER JOIN data_entities 
                    on proveedor_material.iddata_entities = data_entities.iddata_entities";
                    
            $result = mysqli_query($conexion,$consultaProveedor);
            while ($mostrar = mysqli_fetch_array($result)){
            ?>
             <tr>
                <td><?php echo $mostrar['rfc_proveedor'] ?></td>
                <td><?php echo $mostrar['razon_social'] ?></td>
                <td><?php echo $mostrar['correo_e'] ?></td>
                <td><?php echo $mostrar['telefono'] ?></td>
                <td><?php echo $mostrar['direccion'] ?></td>
            </tr>
        <?php
            }
        ?>
    </table>

</body>
</html>