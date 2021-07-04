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
    <title>Document</title>
</head>
<body>
    <?php
        date_default_timezone_set('America/Mexico_City');
        $fecha_actual = date ("Y-m-d H:i:s");
    ?>


    <form action="/s_obra/php/entrega.php" method="POST" enctype="multipart/form-data">
            <h2>Entrega</h2>
        Fecha:<input name="fecha" type="date" size="70" maxlength="70"> <br>
        Observaciones: <input name="observaciones" type="text" size="70" maxlength="70"> <br>
        Documento Entrega:<input name="file" type="file" ><br>
        
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
        Seleccione responsable: <select name="responsable">
            <option value="0">Seleccione</option>
            <?php
                $consultaResponsable = "SELECT * FROM responsable";
                $result = mysqli_query($conexion,$consultaResponsable);
                while ($mostrar = mysqli_fetch_array($result)){
                    echo '<option value="'.$mostrar[idresponsable].'">'.$mostrar[nombre].'</option>';
                }
            ?>
        </select>
        <p class="center"><input type="submit" value="Registar"></p>
    </form>
    <table>
        <tr>
            <td>Id_entrega</td>
            <td>Fecha</td>
            <td>Observaciones</td>
            <td>documento</td>
            <td>Id_obra</td>
            <td>Id_respponsable</td>
        </tr>
        <?php
            $consultaEntrega= "SELECT * FROM entrega";
            $result = mysqli_query($conexion,$consultaEntrega);
            while ($mostrar = mysqli_fetch_array($result)){
            ?>
             <tr>
                <td><?php echo $mostrar['identrega'] ?></td>
                <td><?php echo $mostrar['fecha'] ?></td>
                <td><?php echo $mostrar['observaciones'] ?></td>
                <td><a href="<?php echo 'control_obra/'.$mostrar['documento_entrega'] ?>">Documento de entrega</a></td>
                <td><?php echo $mostrar['idobra']?></td>
                <td><?php echo $mostrar['idresponsable']?></td>
                

            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>