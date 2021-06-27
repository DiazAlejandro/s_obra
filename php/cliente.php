<?php
    include ("conexion.php");
    //Datos de la dirección del cliente 
    $calle = $_POST['calle'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['municipio'];
    $estado = $_POST['estado'];
    $statusd = $_POST['statusd'];

    $sqlDireccion = "INSERT INTO data_entities(calle, colonia, municipio, estado, statusd)
                    VALUES('$calle','$colonia','$municipio','$estado','$statusd')";

    $executeSQLDireccion = mysqli_query($conexion,$sqlDireccion);

    if ($executeSQLDireccion == 1){
        //Datos propios del cliente
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $fecha_registro = $_POST['fecha'];
        $sexo = $_POST['sexo'];
        //RECUPERAR EL ÚLTIMO ID DE LAS DIRECCIONES AGREGADAS
        $id = null;
        $rs = mysqli_query($conexion, "SELECT MAX(iddata_entities) AS id FROM data_entities");
            if ($row = mysqli_fetch_row($rs)) {
                $id = trim($row[0]);
                $insertar = "INSERT INTO cliente(nombre, apellidos, telefono, correo_e, fecha_registro, sexo, iddata_entities) 
                VALUES ('$nombre','$apellidos','$telefono','$correo','$fecha_registro','$sexo','$id')";
                $executeSQLCliente =  mysqli_query($conexion,$insertar);
            }
        //Agregar a la base de datos     
        if ($executeSQLCliente == 1){
            $messaget = "REGISTRO AGREGADO CORRECTAMENTE";
            echo "<script type='text/javascript'>
                    alert('$messaget');
                    window.location.href = '../registro_cliente.php';
                </script>";
        }else{
            
            $messagec = "NO SE AGREGÓ EL CLIENTE";
            echo "<script type='text/javascript'>
                    alert('$messagec');
                    window.location.href = '../registro_cliente.php';
                </script>";
        }
    }else{
        $messagew = "NO SE GUARDO NINGÚN DATO";
        echo "<script type='text/javascript'>
                    alert('$messagew');
                    window.location.href = '../registro_cliente.php';
             </script>";
    } 
?>