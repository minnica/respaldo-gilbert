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
$armado = (isset($_POST['armado'])) ? $_POST['armado'] : '';
$peso_unitario = (isset($_POST['peso_unitario'])) ? $_POST['peso_unitario'] : '';
$soldadura = (isset($_POST['soldadura'])) ? $_POST['soldadura'] : '';
$limpieza = (isset($_POST['limpieza'])) ? $_POST['limpieza'] : '';
$pintura = (isset($_POST['pintura'])) ? $_POST['pintura'] : '';
$fecha_calidad = (isset($_POST['fecha_calidad'])) ? $_POST['fecha_calidad'] : '';
$status = (isset($_POST['status'])) ? $_POST['status'] : '';
$laboratorio = (isset($_POST['laboratorio'])) ? $_POST['laboratorio'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_tabla = (isset($_POST['id_tabla'])) ? $_POST['id_tabla'] : '';


if($tipo == 'calidad' || $tipo == 'Admin') {
    switch($opcion){ 
        case 2:        
        $consulta = "UPDATE tabla SET armado='$armado', soldadura='$soldadura', limpieza='$limpieza', pintura='$pintura',laboratorio='$laboratorio', fecha_calidad=NOW() WHERE id_tabla='$id_tabla' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        

        $consulta = "SELECT id_tabla, taller, revision, marca, cantidad, nombre, peso_unitario, armado, soldadura, limpieza, pintura, status, laboratorio FROM tabla WHERE id_tabla='$id_tabla' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 3:        
        $consulta = "UPDATE tabla SET armado = null, soldadura = null, limpieza = null, pintura = null, laboratorio = null, fecha_calidad = null WHERE id_tabla='$id_tabla' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
        case 4:    
        $consulta = "SELECT id_tabla, taller, revision, marca, cantidad, nombre, peso_unitario, armado, soldadura, limpieza, pintura, status, laboratorio FROM tabla WHERE modulo='G1' AND contratista!='' AND liberado='SI'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }
}else{
    switch($opcion){
        case 1:    
        $consulta = "SELECT id_tabla, taller, revision, marca, cantidad, nombre, peso_unitario, armado, soldadura, limpieza, pintura, status, laboratorio FROM tabla WHERE modulo='G1' AND contratista!='' AND liberado='SI'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;