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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
</head>
<body>
    <?php
        date_default_timezone_set('America/Mexico_City');
        $fecha_actual = date ("Y-m-d H:i:s");
    ?>

    <form action="/s_obra/php/pago.php" method="POST" enctype="multipart/form-data">
            <h2>Pago</h2>
        Concepto:<input name="concepto" type="text" size="70" maxlength="70"> <br>
        Monto <input name="monto" type="number" size="70" maxlength="70"> <br>
        Fecha  <input name="fecha" type="datetime" size="70" maxlength="70" readonly value="<?= $fecha_actual?>"/></p>
        Documento de pago:<input name="file" type="file" ><br>
        
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
        Seleccione cotizacion: <select name="cotizacion">
            <option value="0">Seleccione</option>
            <?php
                $consultaCotizacion = "SELECT * FROM cotizacion";
                $result = mysqli_query($conexion,$consultaCotizacion);
                while ($mostrar = mysqli_fetch_array($result)){
                    echo '<option value="'.$mostrar[idcotizacion].'">'.$mostrar[idcotizacion].'</option>';
                }
            ?>
        </select>

        <p class="center"><input type="submit" value="Registrar"></p>

                        
    </form>
    <table>
        <tr>
            <td>id_pago</td>
            <td>Concepto</td>
            <td>Fecha</td>
            <td>id_cliente</td>
            <td>id_cotizacion</td>
            <td>documento</td>
        </tr>
        <?php
            $consultaPago = "SELECT * FROM pago";
            $result = mysqli_query($conexion,$consultaPago);
            while ($mostrar = mysqli_fetch_array($result)){
            ?>

            <tr>
                <td><?php echo $mostrar['concepto'] ?></td>
                <td><?php echo $mostrar['monto'] ?></td>
                <td><?php echo $mostrar['fecha'] ?></td>
                <td><?php echo $mostrar['idcliente']?></td>
                <td><?php echo $mostrar['idcotizacion']?></td>
                <td><a href="<?php echo 's_obra/'.$mostrar['documento_pago'] ?>">Documento de pago</a></td>

            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>