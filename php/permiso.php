<?php
    include 'conexion.php';

    $directorio = "../archivos/permisos/";
    $nombreDoc = trim($_FILES["file"]["name"]);
    $nombreDoc = str_replace(" ","_",$nombreDoc);
    $archivo = $directorio.basename($nombreDoc);
    
    //Extención del archivo
    $tipoArchivo  = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
    $archivo_size = $_FILES["file"]["size"];

    if ($archivo_size > 5120000){
        $messagec = "EL ARCHIVO TIENE QUE SER MENOR A 5MB";
                    echo "<script type='text/javascript'>
                            alert('$messagec');
                            window.location.href = '../registro_permiso.php';
                        </script>";
                        mysqli_close($conexion);
    }else{
        if ($tipoArchivo == "pdf"){
            if(move_uploaded_file($_FILES["file"]["tmp_name"],$archivo)){
                //echo "El archivo se subió correctamente";
                $query = "INSERT INTO permiso (documento_permiso, idobra, fecha_inicio, fecha_vencimiento)
                          VALUES ('$archivo',
                                  '".$_POST["obra"]."',
                                  '".$_POST["fecha_i"]."',
                                  '".$_POST["fecha_f"]."')";
                                  //'".$_POST["nocot"]."')";
                $resultado = mysqli_query($conexion,$query);

                if ($resultado == 1){
                    $messaget = "REGISTRO AGREGADO CORRECTAMENTE";
                        echo "<script type='text/javascript'>
                                alert('$messaget');
                                window.location.href = '../registro_permiso.php';
                            </script>";
                            mysqli_close($conexion);
                }else{
                    $messagec = "NO SE AGREGÓ EL PERMISO";
                    echo "<script type='text/javascript'>
                            alert('$messagec');
                            window.location.href = '../registro_permiso.php';
                        </script>";
                        mysqli_close($conexion);
                }
                //echo "El documento de pago se ha subido con exito";
             
            }else{
                $messagec = "ERROR AL SUBIR EL ARCHIVO";
                    echo "<script type='text/javascript'>
                            alert('$messagec');
                            window.location.href = '../registro_permiso.php';
                        </script>";
                        mysqli_close($conexion);
            }
        }else{
            $messagec = "SOLO SE ADMITEN FORMATOS PDF";
                    echo "<script type='text/javascript'>
                            alert('$messagec');
                            window.location.href = '../registro_permiso.php';
                        </script>";
                        mysqli_close($conexion);
        }
    }
?>