<?php
    include 'conexion.php';
    $sql_insertarAvamce = "INSERT INTO avance (avance, fecha, idobra, observaciones)
                            VALUES ('".$_POST["avance"]."',
                                '".$_POST["fecha"]."',
                                '".$_POST["idobra"]."',
                                '".$_POST["observaciones"]."')";
    $resultado = mysqli_query($conexion, $sql_insertarAvamce);
    if ($resultado == 1){
        $messaget = "AVANCE AGREGADO CORRECTAMENTE";
            echo "<script type='text/javascript'>
                    alert('$messaget');
                    window.location.href = '../registro_avance.php';
                </script>";
                mysqli_close($conexion);
    }else{
        $messagec = "NO SE AGREGÓ EL AVANCE";
        echo "<script type='text/javascript'>
                alert('$messagec');
                window.location.href = '../registro_avance.php';
            </script>";
            mysqli_close($conexion);
    }
?>