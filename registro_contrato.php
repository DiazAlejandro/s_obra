<?php
    include 'php/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Contrato</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" 
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>
    <?php
        date_default_timezone_set('America/Mexico_City');
        $fecha_actual = date ("Y-m-d H:i:s");
    ?>

    <form action="php/contrator.php" method="POST" enctype="multipart/form-data">
        <p>Fecha_Registro:<input type="datetime" name="fecha" readonly value="<?= $fecha_actual?>"/></p>
        Costo: <input name="precio" type="text" size="45" maxlength="45"> <br>
        Descripción: <input name="descripcion" type="text" size="45" maxlength="45"> <br>
        Derechos: <input name="derechos" type="text" size="45" maxlength="45"> <br>
        Obligación: <input name="obligaciones" type="text" size="45" maxlength="45"> <br>
        Seleccione Contrato:<input name="file" type="file" ><br>
        Seleccione cliente:<select id="cliente" name="cliente">
            <option value="0">Seleccione</option>
            <?php
                $consultaCliente = "SELECT idcliente, CONCAT_WS(' ', nombre, apellidos) AS nombre FROM CLIENTE";
                $result = mysqli_query($conexion,$consultaCliente);
                while ($mostrar = mysqli_fetch_array($result)){
                    echo '<option value="'.$mostrar[idcliente].'">'.$mostrar[nombre].'</option>';
                }
            ?>
            </select><br>
        <!--Div para mostrar los clientes de acuerdo a la obra-->
        <div id= "seleccioneObra"></div>
        
        <p><input type="submit" value="Registrar" /></p>
    </form>
    
</body>
</html>

<script type = "text/javascript">
    $(document).ready(function(){
        recargarLista();
        $('#cliente').change(function(){
            recargarLista();
        });
    });
</script>

<script type = "text/javascript">
    function recargarLista(){
        $.ajax({
            type: "POST",
            url: "/s_obra/php/contrato.php",
            data: "clientes="+$('#cliente').val(),
            success:function(r){
                $('#seleccioneObra').html(r);
                console.log("hola");
            }
        });
    }
</script>