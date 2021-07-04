<?php
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
    <title>Constructora - Soiuchi</title>
</head>
<body>
    <h2>Pantalla principal del Sistema</h2>
    <a href="registro_cliente.php">Registrar Cliente</a><br>
    <a href="registro_responsable.php">Registrar Responsable</a><br>
    <a href="registro_proveedor.php">Registrar Proveedor</a><br>
    <a href="registro_material.php">Registrar Material</a><br>
    <a href="registro_obra.php">Registrar Obra</a><br>
    <a href="registro_plano.php">Registrar Plano</a><br>
    <a href="registro_cotizacion.php">Registrar Cotización</a><br>
    <a href="registro_contrato.php">Registrar Contrato</a><br>
    <a href="registro_pago.php">Registrar Pago</a><br>
    <a href="registro_entregas.php">Registrar Entregas</a><br>
    
</body>
</html>