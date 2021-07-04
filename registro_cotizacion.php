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
    <title>Cotización</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" 
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>  
    <form action="/s_obra/php/cotizacionr.php" method="POST" enctype="multipart/form-data">
        <h2>Cotizacion</h2>
        Tiempo Estimado:<input name="tiempo_estimado" type="text" size="70" maxlength="70"> <br>
        Capital Humano:<input name="capital_humano" type="text" size="70" maxlength="70"> <br>
        Costo:<input name="costo" type="text" size="70" maxlength="70" > <br>
        Documento Cotización: <input name="file" type="file" ><br>
        Pago Acumulado: <input name="pago_acumulado" value = 0 type="text" size="70" maxlength="70" readonly> <br>

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


        <p class="center"><input type="submit" value="Guardar Cotización"></p>
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
            url: "/s_obra/php/cotizacion.php",
            data: "clientes="+$('#cliente').val(),
            success:function(r){
                $('#seleccioneObra').html(r);
                console.log("hola");
            }
        });
    }
</script>