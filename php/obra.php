<?php
    include ("conexion.php");

    //Datos de la dirección del proveedor
    $calle = $_POST['calle'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['municipio'];
    $estado = $_POST['estado'];
    $statusd = $_POST['statusd'];

    $sqlDireccion = "INSERT INTO data_entities(calle, colonia, municipio, estado, statusd)
                    VALUES('$calle','$colonia','$municipio','$estado','$statusd')";

    $executeSQLDireccion = mysqli_query($conexion,$sqlDireccion);

    if ($executeSQLDireccion == 1){
        //Datos de la obra
        $nombre_obra = $_POST['nombre_obra'];
        $fecha_registro = $_POST['fecha'];
        $avance = 0;
        $tipo_obra = $_POST['tipo'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $idcliente = $_POST['cliente'];
        $idresponsable = $_POST['responsable'];
        //RECUPERAR EL ÚLTIMO ID DE LAS DIRECCIONES AGREGADAS
        $id = null;
        $rs = mysqli_query($conexion, "SELECT MAX(iddata_entities) AS id FROM data_entities");
            if ($row = mysqli_fetch_row($rs)) {
                $id = trim($row[0]);
                $insertar = "INSERT INTO obra(nombre_obra, fecha_registro, avance, tipo_obra, 
                                fecha_inicio, fecha_fin, idcliente, idresponsable, iddata_entities) 
                            VALUES ('$nombre_obra','$fecha_registro','$avance','$tipo_obra',
                                '$fecha_inicio','$fecha_fin','$idcliente','$idresponsable','$id')";
                            $executeSQL =  mysqli_query($conexion,$insertar);
            }

        //Agregar a la base de datos     
        if ($executeSQL == 1){
            $messaget = "REGISTRO AGREGADO CORRECTAMENTE";
            echo "<script type='text/javascript'>
                    alert('$messaget');
                    window.location.href = '../registro_proveedor.php';
                </script>";
        }else{
            
            $messagec = "NO SE AGREGÓ EL PROVEEDOR";
            echo "<script type='text/javascript'>
                    alert('$messagec');
                    window.location.href = '../registro_proveedor.php';
                </script>";
        }

    }else{
        $messagew = "NO SE GUARDO NINGÚN DATO";
        echo "<script type='text/javascript'>
                    alert('$messagew');
                    window.location.href = '../registro_proveedor.php';
             </script>";

    }
?>