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
    <title>Generar Cotizacion</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" 
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
    <form action="/s_obra/php/generar_c.php" method="POST" enctype="multipart/form-data" >
        <h2>Cotizacion</h2>
        Seleccione obra:<select name="obra">
            <option value="0">Seleccione</option>
            <?php
                $consultaObra = "SELECT 
                                    cotizacion.idcotizacion, 
                                    obra.nombre_obra
                                FROM cotizacion 
                                    INNER JOIN obra
                                        ON cotizacion.idobra = obra.idobra";
                $result = mysqli_query($conexion,$consultaObra);
                while ($mostrar = mysqli_fetch_array($result)){
                    echo '<option value="'.$mostrar[idcotizacion].'">'.$mostrar[nombre_obra].'</option>';
                }
            ?>
        </select><br>
        
        Obra Actual: <select name="obra_act" >
            <?php
                $consultaUltObra = "SELECT 
                                max(cotizacion_material.idcotizacion) as idcot,
                                obra.nombre_obra
                            FROM cotizacion_material 
                                INNER JOIN cotizacion
                                    ON cotizacion_material.idcotizacion = cotizacion.idcotizacion
                                INNER JOIN obra
                                    on obra.idobra = cotizacion.idobra";
                $result = mysqli_query($conexion, $consultaUltObra);
                while ($mostrar = mysqli_fetch_array($result)){
                    if ($mostrar[idcot] == null){
                        echo '<p>Sin registros todavía</p>';
                    }else{
                        echo '<option value="'.$mostrar[idcot].'">'.$mostrar[idcot].'</option>';
                        }
                }

            ?>
        </select><br>


        Seleccione Material:<select name="material" >
            <option value="0">Seleccione</option>
            <?php
                $consultaObra = "SELECT * FROM material";
                $result = mysqli_query($conexion,$consultaObra);
                while ($mostrar = mysqli_fetch_array($result)){
                    echo '<option value="'.$mostrar[idmaterial].'">'.$mostrar[nombre].'</option>';
                }
                
            ?>
        </select><br>
        
        
        
        Cantidad:<input name="cantidad" type="number" min = "0" require> <br>
        Costo:<input name="costo" type="number" min="0" require> <br>

        
        <p class="center"><input type="submit" value="Guardar Cotización"></p>
    </form>

    
    <table>
        <tr>
            <td>ID COTIZACION</td>
            <td>ID MATERIAL</td>
            <td>CANTIDAD</td>
            <td>COSTO</td>
        </tr>
        <div id= "tabla"></div>
        
    </table>

        <!--Div para mostrar los clientes de acuerdo a la obra-->
        
</body>
</html>

<script type = "text/javascript">
    $(document).ready(function(){
        recargarLista();
        $('#obra_act').change(function(){
            recargarLista();
        });
    });
</script>

<script type = "text/javascript">
    function recargarLista(){
        $.ajax({
            type: "POST",
            url: "/s_obra/php/tablactz.php",
            data: "clientes="+$('#obra_act').val(),
            success:function(r){
                $('#tabla').html(r);
            }
        });
    }
</script>