<?php
    include 'conexion.php';
    $sql_insertarProveedor = "INSERT INTO material (rfc_proveedor, nombre, descripcion, unidad, precio)
                            VALUES ('".$_POST["rfc"]."',
                                '".$_POST["nombre"]."',
                                '".$_POST["descripcion"]."',
                                '".$_POST["unidad"]."',
                                '".$_POST["precio"]."')";
    $resultado = mysqli_query($conexion, $sql_insertarProveedor) 
                or die ('Error en la instrucción');
    mysqli_close($conexion);
?>