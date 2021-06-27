<?php
    include ("conexion.php");
    //Datos de la dirección del responsable 
    $calle = $_POST['calle'];
    $colonia = $_POST['colonia'];
    $municipio = $_POST['municipio'];
    $estado = $_POST['estado'];
    $statusd = $_POST['statusd'];

    $sqlDireccion = "INSERT INTO data_entities(calle, colonia, municipio, estado, statusd)
                    VALUES('$calle','$colonia','$municipio','$estado','$statusd')";

    $executeSQLDireccion = mysqli_query($conexion,$sqlDireccion);

    if ($executeSQLDireccion == 1){
        //Datos propios del responsbale
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        //RECUPERAR EL ÚLTIMO ID DE LAS DIRECCIONES AGREGADAS
        $id = null;
        $rs = mysqli_query($conexion, "SELECT MAX(iddata_entities) AS id FROM data_entities");
            if ($row = mysqli_fetch_row($rs)) {
                $id = trim($row[0]);
                $insertar = "INSERT INTO responsable(nombre, apellidos, telefono, correo_e, iddata_entities) 
                VALUES ('$nombre','$apellidos','$telefono','$correo','$id')";
                $executeSQLResponsable =  mysqli_query($conexion,$insertar);
            }
        //Agregar a la base de datos     
        if ($executeSQLResponsable == 1){
            $messaget = "REGISTRO AGREGADO CORRECTAMENTE";
            echo "<script type='text/javascript'>
                    alert('$messaget');
                    window.location.href = '../registro_responsable.php';
                </script>";
        }else{
            
            $messagec = "NO SE AGREGÓ EL RESPONSABLE";
            echo "<script type='text/javascript'>
                    alert('$messagec');
                    window.location.href = '../registro_responsable.php';
                </script>";
        }
    }else{
        $messagew = "NO SE GUARDO NINGÚN DATO";
        echo "<script type='text/javascript'>
                    alert('$messagew');
                    window.location.href = '../registro_responsable.php';
             </script>";
    } 
?>