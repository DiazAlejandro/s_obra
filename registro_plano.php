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
    <title>Document</title>
</head>
<body>
    <form action="php/plano.php" method="POST" enctype="multipart/form-data">
        <h2>Registrar Plano</h2>
        Descripcion: <input name="descripcion" type="text" size="255" maxlength="255"> <br>
        Seleccione plano:<input name="file" type="file" ><br>

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
        <p class="center"><input type="submit" value="Subir Plano"></p>
    </form>
    <table>
        <tr>
            <td>ID PLANO</td>
            <td>ID OBRA</td>
            <td>DESCRIPCION</td>
            <td>DOCUMENTO</td>
        </tr>
        <?php
            $consultaPlano = "SELECT * FROM plano";
            $result = mysqli_query($conexion,$consultaPlano);
            while ($mostrar = mysqli_fetch_array($result)){
            ?>
        
            <tr>
                
                <td><?php echo $mostrar['idplano'] ?></td>
                <td><?php echo $mostrar['idobra'] ?></td>
                <td><?php echo $mostrar['descripcion'] ?></td>
                <td><a href="<?php echo 'control_obra/'.$mostrar['documento_plano'] ?>">Documento</a></td>

            </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>