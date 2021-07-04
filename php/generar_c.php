<?php
    include 'conexion.php';
    $o1 = $_POST['obra'];
    $o2 = $_POST['obra_act'];
    echo $o1;
    echo $o2;
    if ($o1 == "0"){
        $sql_insertarProveedor = "INSERT INTO cotizacion_material (idcotizacion, idmaterial, cantidad, costo)
        VALUES ('".$_POST["obra_act"]."',
            '".$_POST["material"]."',
            '".$_POST["cantidad"]."',
            '".$_POST["costo"]."')";
        $resultado = mysqli_query($conexion, $sql_insertarProveedor);
    }
    if ($o1 > 0){
        $sql_insertarProveedor = "INSERT INTO cotizacion_material (idcotizacion, idmaterial, cantidad, costo)
        VALUES ('".$_POST["obra"]."',
            '".$_POST["material"]."',
            '".$_POST["cantidad"]."',
            '".$_POST["costo"]."')";
        $resultado = mysqli_query($conexion, $sql_insertarProveedor);
    }
    
    
    if ($resultado == 1){
        $messaget = " ✅ REGISTRO AGREGADO CORRECTAMENTE ✅ ";
            echo "<script type='text/javascript'>
                    alert('$messaget');
                    window.location.href = '../generarCotizacion.php';
                </script>";
                mysqli_close($conexion);
    }else{
        $messagec = " ❌ NO SE AGREGÓ EL PRODUCTO A LA COTIZACION ❌";
        echo "<script type='text/javascript'>
                alert('$messagec');
                window.location.href = '../generarCotizacion.php';
            </script>";
            mysqli_close($conexion);
    }
?>