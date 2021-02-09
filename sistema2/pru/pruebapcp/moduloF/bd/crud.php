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

$taller = (isset($_POST['taller'])) ? $_POST['taller'] : '';
$revision = (isset($_POST['revision'])) ? $_POST['revision'] : '';
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$peso_unitario = (isset($_POST['peso_unitario'])) ? $_POST['peso_unitario'] : '';
$liberado = (isset($_POST['liberado'])) ? $_POST['liberado'] : '';
$fecha_liberado = (isset($_POST['fecha_liberado'])) ? $_POST['fecha_liberado'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_tabla = (isset($_POST['id_tabla'])) ? $_POST['id_tabla'] : '';

if($tipo == 'pcp' || $tipo == 'Admin') {
    switch($opcion){   
        case 2:        
        $consulta = "UPDATE tabla SET liberado='$liberado', fecha_liberado= NOW() WHERE id_tabla='$id_tabla' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        

        $consulta = "SELECT id_tabla, taller, revision, marca, cantidad, nombre, peso_unitario, liberado FROM tabla WHERE id_tabla='$id_tabla' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 3:        
        $consulta = "UPDATE tabla SET liberado = null, fecha_liberado = null WHERE id_tabla='$id_tabla' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
        case 4:    
        $consulta = "SELECT id_tabla, taller, revision, marca, cantidad, nombre, peso_unitario, liberado FROM tabla WHERE modulo='F'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }
}else{

    switch($opcion){
        case 1:    
        $consulta = "SELECT id_tabla, taller,revision, marca, cantidad, nombre, peso_unitario, liberado FROM tabla WHERE modulo='F'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;