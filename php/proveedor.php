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
        //Datos del proveedor
        $rfc = $_POST['rfc'];
        $razon_social = $_POST['razon_social'];
        $correo_e = $_POST['correo_e'];
        $telefono = $_POST['telefono'];
        //RECUPERAR EL ÚLTIMO ID DE LAS DIRECCIONES AGREGADAS
        $id = null;
        $rs = mysqli_query($conexion, "SELECT MAX(iddata_entities) AS id FROM data_entities");
            if ($row = mysqli_fetch_row($rs)) {
                $id = trim($row[0]);
                $insertar = "INSERT INTO proveedor_material(rfc_proveedor, razon_social, correo_e, telefono, iddata_entities) 
                VALUES ('$rfc','$razon_social','$correo_e','$telefono','$id')";
                $executeSQLCliente =  mysqli_query($conexion,$insertar);
            }

        //Agregar a la base de datos     
        if ($executeSQLCliente == 1){
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