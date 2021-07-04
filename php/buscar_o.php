<?php
    include("conexion.php");
    $obra = $_POST['idobra'];
    $sql_consulta = "SELECT 
    obra.idobra, 
    obra.nombre_obra,
    obra.fecha_registro,
    obra.tipo_obra, 
    obra.fecha_inicio,
    obra.fecha_fin,
	CONCAT_WS(' ', d1.calle, d1.colonia, d1.municipio, d1.estado, d1.statusd) AS direccion_obra,
    CONCAT_WS(' ', cliente.nombre, cliente.apellidos) AS nombre_cliente,
    CONCAT_WS(' ', d2.calle, d2.colonia, d2.municipio, d2.estado, d2.statusd) AS direccion_cliente,
    cliente.telefono as telefono_c,
    cliente.correo_e as correo_c,
    cotizacion.tiempo_estimado,
    cotizacion.capital_humano,
    cotizacion.costo,
    cotizacion.documento_cotizacion,
    cotizacion.pago_acumulado,
    CONCAT_WS(' ',responsable.nombre, responsable.apellidos) AS nombre_responsable,
    responsable.correo_e as correo_r,
    responsable.telefono as telefono_r
    
	FROM obra 
    INNER JOIN cliente
        	ON obra.idcliente = cliente.idcliente
    	INNER JOIN data_entities as d1
        	ON obra.iddata_entities = d1.iddata_entities 
        INNER JOIN data_entities as d2
        	ON d2.iddata_entities = cliente.iddata_entities
        INNER JOIN cotizacion
        	ON cotizacion.idobra = obra.idobra
        INNER JOIN responsable
        	ON responsable.idresponsable = obra.idresponsable
        
            WHERE obra.idobra = '$obra'";
    $registros = mysqli_query($conexion, $sql_consulta) or die ("Error en consulta ");
    while($registro = mysqli_fetch_array($registros)){
        echo '<script src="buscar_obra.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
        <div id="content">
            <table>
                <tr>
                    <h3>DATOS GENERALES DE LA OBRA</h3>
                </tr>
                <tr>
                    <td HEIGHT="50">FOLIO DE REGISTRO:</td>
                    <td>'.$registro['idobra'].'</td>
                    <td>NOMBRE DE LA OBRA:</td>
                    <td>'.$registro['nombre_obra'].'</td>
                    
                </tr>
                <tr>
                    <td HEIGHT="50">TIPO DE OBRA:</td>
                    <td>'.$registro['tipo_obra'].'</td>
                    <td>FECHA REGISTRO:</td>
                    <td>'.$registro['fecha_registro'].'</td>
                </tr>
                <tr>
                    <td HEIGHT="50">FECHA INICIO:</td>
                    <td>'.$registro['fecha_inicio'].'</td>
                    <td>FECHA FIN:</td>
                    <td>'.$registro['fecha_fin'].'</td>
                </tr>
                <tr>
                    <td HEIGHT="60">DIRECCION OBRA:</td>
                    <td>'.$registro['direccion_obra'].'</td>
                </tr>
                <tr>
                    <td HEIGHT="30"><h4>DATOS CLIENTE</h4></td>
                </tr>
                <tr>
                    <td>NOMBRE CLIENTE:</td>
                    <td>'.$registro['nombre_cliente'].'</td>
                    <td>TELÉFONO::</td>
                    <td>'.$registro['telefono_c'].'</td>
                    
                </tr>
                <tr>
                    <td HEIGHT="60">DIRECCIÓN CLIENTE:</td>
                    <td>'.$registro['direccion_cliente'].'</td></td>
                    <td>CORREO ELECTRÓNICO:</td>
                    <td>'.$registro['correo_c'].'</td>
                </tr>
                <tr>
                    <td HEIGHT="30"><h4>COTIZACION</h4></td>
                </tr>
                <tr>
                    <td>DOCUMENTO COTIZACIÓN:</td>
                    <td>'.$registro['documento_cotizacion'].'</td>
                    <td>COSTO:</td>
                    <td>'.$registro['costo'].'</td>
                    
                </tr>
                <tr>
                    <td HEIGHT="50">TIEMPO ESTIMADO:</td>
                    <td>'.$registro['tiempo_estimado'].'</td>
                    <td>PAGO ACUMULADO:</td>
                    <td>'.$registro['pago_acumulado'].'</td>
                </tr>
                <tr>
                    <td HEIGHT="30"><h4>RESPONSABLE</h4></td>
                </tr>
                <tr>
                    <td>NOMBRE DEL RESPONSABLE:</td>
                    <td>'.$registro['nombre_responsable'].'</td>
                    <td>CORREO:</td>
                    <td>'.$registro['correo_r'].'</td>
                </tr>
                <tr>
                    <td HEIGHT="50">TELEFONO:</td>
                    <td>'.$registro['telefono_r'].'</td>
                </tr>
              </table>
        </div>
        <br>
              <button class="btn btn-primary" id="download" onclick="download()">DESCARGAR PDF</button>';
    }
?>

