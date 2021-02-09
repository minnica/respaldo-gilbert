<?php
session_start();	
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}	
$nombres = $_SESSION['nombres'];
$tipo = $_SESSION['tipo'];	

include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$recibido = (isset($_POST['recibido'])) ? $_POST['recibido'] : '';
$peso_unitario = (isset($_POST['peso_unitario'])) ? $_POST['peso_unitario'] : '';
$fecha_recepcion = (isset($_POST['fecha_recepcion'])) ? $_POST['fecha_recepcion'] : '';
$montaje = (isset($_POST['montaje'])) ? $_POST['montaje'] : '';
$fecha_montaje = (isset($_POST['fecha_montaje'])) ? $_POST['fecha_montaje'] : '';
$status2 = (isset($_POST['status2'])) ? $_POST['status2'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_tabla = (isset($_POST['id_tabla'])) ? $_POST['id_tabla'] : '';


if($tipo == 'obra' || $tipo == 'Admin') {
    switch($opcion){   
        case 2:        
        $consulta = "UPDATE tabla SET recibido='$recibido', fecha_recepcion=NOW(), montaje='$montaje', fecha_montaje=NOW() WHERE id_tabla='$id_tabla' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        

        $consulta = "SELECT id_tabla, taller, revision, marca, cantidad, nombre, peso_unitario, recibido, montaje, status2 FROM tabla WHERE id_tabla='$id_tabla' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 3:        
        $consulta = "UPDATE tabla SET recibido = null, fecha_recepcion = null, montaje = null, fecha_montaje = null WHERE id_tabla='$id_tabla' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
        case 4:    
        $consulta = "SELECT * FROM tabla WHERE modulo='J' AND enviado='SI' AND liberado='SI'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }
}else{

    switch($opcion){
        case 1:    
        $consulta = "SELECT * FROM tabla WHERE modulo='J' AND enviado='SI' AND liberado='SI'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;