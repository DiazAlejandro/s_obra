<?php
    include 'conexion.php';

    $directorio = "../archivos/contratos/";
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
                            window.location.href = '../registro_cotizacion.php';
                        </script>";
                        mysqli_close($conexion);
    }else{
        if ($tipoArchivo == "pdf"){
            if(move_uploaded_file($_FILES["file"]["tmp_name"],$archivo)){
                echo "El archivo se subió correctamente";
                $query = "INSERT INTO contrato (fecha, costo, descripcion, derechos, 
                    obligaciones, documento_contrato, idcliente, idobra, idcotizacion)
                          VALUES ('".$_POST["fecha"]."',
                                  '".$_POST["precio"]."',
                                  '".$_POST["descripcion"]."',
                                  '".$_POST["derechos"]."',
                                  '".$_POST["obligaciones"]."',
                                  '$archivo',
                                  '".$_POST["cliente"]."',
                                  '".$_POST["obra"]."')";
                                  //'".$_POST["nocot"]."')";
                $resultado = mysqli_query($conexion,$query);

                if ($resultado == 1){
                    $messaget = "REGISTRO AGREGADO CORRECTAMENTE";
                        echo "<script type='text/javascript'>
                                alert('$messaget');
                                window.location.href = '../registro_contrato.php';
                            </script>";
                            mysqli_close($conexion);
                }else{
                    $messagec = "NO SE AGREGÓ EL CONTRATO";
                    echo "<script type='text/javascript'>
                            alert('$messagec');
                            window.location.href = '../registro_contrato.php';
                        </script>";
                        mysqli_close($conexion);
                }
                //echo "El documento de pago se ha subido con exito";
             
            }else{
                $messagec = "ERROR AL SUBIR EL ARCHIVO";
                    echo "<script type='text/javascript'>
                            alert('$messagec');
                            window.location.href = '../registro_contrato.php';
                        </script>";
                        mysqli_close($conexion);
            }
        }else{
            $messagec = "SOLO SE ADMITEN FORMATOS PDF";
                    echo "<script type='text/javascript'>
                            alert('$messagec');
                            window.location.href = '../registro_contrato.php';
                        </script>";
                        mysqli_close($conexion);
        }
    }
?>