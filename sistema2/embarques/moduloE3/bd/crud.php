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
$enviado = (isset($_POST['enviado'])) ? $_POST['enviado'] : '';
$peso_unitario = (isset($_POST['peso_unitario'])) ? $_POST['peso_unitario'] : '';
$fecha_enviado = (isset($_POST['fecha_enviado'])) ? $_POST['fecha_enviado'] : '';
$remision = (isset($_POST['remision'])) ? $_POST['remision'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_tabla = (isset($_POST['id_tabla'])) ? $_POST['id_tabla'] : '';

if($tipo == 'embarques' || $tipo == 'Admin') {
    switch($opcion){
        case 2:        
        $consulta = "UPDATE tabla SET enviado='$enviado', fecha_enviado=NOW(), remision='$remision' WHERE id_tabla='$id_tabla' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        

        $consulta = "SELECT id_tabla, taller, revision, marca, cantidad, nombre, peso_unitario, enviado, remision FROM tabla WHERE id_tabla='$id_tabla' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 3:        
        $consulta = "UPDATE tabla SET enviado = null, fecha_enviado = null, remision = null WHERE id_tabla='$id_tabla' ";     
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
        case 4:    
        $consulta = "SELECT * FROM tabla WHERE modulo='E3' AND armado='SI' AND soldadura='SI' AND limpieza='SI' AND pintura='SI' AND liberado='SI' ORDER BY enviado asc, remision asc ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }
}else{

    switch($opcion){
        case 1:    
        $consulta = "SELECT * FROM tabla WHERE modulo='E3' AND armado='SI' AND soldadura='SI' AND limpieza='SI' AND pintura='SI' AND liberado='SI'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;