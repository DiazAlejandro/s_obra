<?php
    include 'conexion.php';

    $directorio = "../archivos/entrega/";
    $nombreDoc = trim($_FILES["file"]["name"]);
    $nombreDoc = str_replace(" ","_",$nombreDoc);
    $archivo = $directorio.basename($nombreDoc);
    
    //Extención del archivo
    $tipoArchivo  = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
    $archivo_size = $_FILES["file"]["size"];

    if ($archivo_size > 5120000){
        echo "El archivo tiene que ser menor a 5MB";
    }else{
        if ($tipoArchivo == "pdf"){
            if(move_uploaded_file($_FILES["file"]["tmp_name"],$archivo)){
                //echo "El archivo se subió correctamente";
                $query = "INSERT INTO entrega (fecha, observaciones,documento_entrega ,idobra ,idresponsable)
                          VALUES ('".$_POST["fecha"]."',
                                  '".$_POST["observaciones"]."',
                                  '".$archivo."',
                                  '".$_POST["obra"]."',
                                  '".$_POST["responsable"]."')";
                $resultado = mysqli_query($conexion,$query);
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
            }else{
                $messagec = "ERROR AL SUBIR EL ARCHIVO";
                echo "<script type='text/javascript'>
                    alert('$messagec');
                    window.location.href = '../registro_entregas.php';
                </script>";
                mysqli_close($conexion);
            }
        }else{
            $messagec = "SOLO SE ADMITEN FORMATOS EN PDF";
            echo "<script type='text/javascript'>
                alert('$messagec');
                window.location.href = '../registro_entregas.php';
            </script>";
            mysqli_close($conexion);
        }
    }
?>