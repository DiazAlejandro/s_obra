<?php
    include 'conexion.php';
    $sql_insertarProveedor = "INSERT INTO material (rfc_proveedor, nombre, descripcion, unidad, precio)
                            VALUES ('".$_POST["rfc"]."',
                                '".$_POST["nombre"]."',
                                '".$_POST["descripcion"]."',
                                '".$_POST["unidad"]."',
                                '".$_POST["precio"]."')";
    $resultado = mysqli_query($conexion, $sql_insertarProveedor);
    if ($resultado == 1){
        $messaget = "REGISTRO AGREGADO CORRECTAMENTE";
            echo "<script type='text/javascript'>
                    alert('$messaget');
                    window.location.href = '../registro_material.php';
                </script>";
                mysqli_close($conexion);
    }else{
        $messagec = "NO SE AGREGÓ EL PROVEEDOR";
        echo "<script type='text/javascript'>
                alert('$messagec');
                window.location.href = '../registro_proveedor.php';
            </script>";
            mysqli_close($conexion);
    }

    
?>