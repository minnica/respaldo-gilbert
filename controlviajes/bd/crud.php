<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$operador = (isset($_POST['operador'])) ? $_POST['operador'] : '';
$dia = (isset($_POST['dia'])) ? $_POST['dia'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$origen = (isset($_POST['origen'])) ? $_POST['origen'] : '';
$destino = (isset($_POST['destino'])) ? $_POST['destino'] : '';
$fecha_carga = (isset($_POST['fecha_carga'])) ? $_POST['fecha_carga'] : '';
$hora_inicio_carga = (isset($_POST['hora_inicio_carga'])) ? $_POST['hora_inicio_carga'] : '';
$fecha_salida = (isset($_POST['fecha_salida'])) ? $_POST['fecha_salida'] : '';
$hora_salida = (isset($_POST['hora_salida'])) ? $_POST['hora_salida'] : '';
$observaciones = (isset($_POST['observaciones'])) ? $_POST['observaciones'] : '';
$status = (isset($_POST['status'])) ? $_POST['status'] : '';

$tipo2 = (isset($_POST['tipo2'])) ? $_POST['tipo2'] : '';
$origen2 = (isset($_POST['origen2'])) ? $_POST['origen2'] : '';
$destino2 = (isset($_POST['destino2'])) ? $_POST['destino2'] : '';
$fecha_carga2 = (isset($_POST['fecha_carga2'])) ? $_POST['fecha_carga2'] : '';
$hora_inicio_carga2 = (isset($_POST['hora_inicio_carga2'])) ? $_POST['hora_inicio_carga2'] : '';
$fecha_salida2 = (isset($_POST['fecha_salida2'])) ? $_POST['fecha_salida2'] : '';
$hora_salida2 = (isset($_POST['hora_salida2'])) ? $_POST['hora_salida2'] : '';
$observaciones2 = (isset($_POST['observaciones2'])) ? $_POST['observaciones2'] : '';
$status2 = (isset($_POST['status2'])) ? $_POST['status2'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_chofer = (isset($_POST['id_chofer'])) ? $_POST['id_chofer'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO chofer (operador, dia, tipo, origen, destino, fecha_carga, hora_inicio_carga, fecha_salida, hora_salida, observaciones, status, tipo2, origen2, destino2,fecha_carga2, hora_inicio_carga2, fecha_salida2, hora_salida2, observaciones2, status2) VALUES('$operador', '$dia', '$tipo', '$origen', '$destino', '$fecha_carga', '$hora_inicio_carga', '$fecha_salida', '$hora_salida', '$observaciones', '$status', '$tipo2', '$origen2', '$destino2', '$fecha_carga2', '$hora_inicio_carga2', '$fecha_salida2', '$hora_salida2', '$observaciones2', '$status2') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM chofer ORDER BY id_chofer DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE chofer SET operador='$operador', dia='$dia', tipo='$tipo', origen='$origen', destino='$destino', fecha_carga='$fecha_carga', hora_inicio_carga='$hora_inicio_carga', fecha_salida='$fecha_salida', hora_salida='$hora_salida', observaciones='$observaciones', status='$status', tipo2='$tipo2', origen2='$origen2', destino2='$destino2', fecha_carga2='$fecha_carga2', hora_inicio_carga2='$hora_inicio_carga2', fecha_salida2='$fecha_salida2', hora_salida2='$hora_salida2', observaciones2='$observaciones2', status2='$status2' WHERE id_chofer='$id_chofer' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM chofer WHERE id_chofer='$id_chofer' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM chofer WHERE id_chofer='$id_chofer' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM chofer";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;