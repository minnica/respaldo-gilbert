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
$contratista = (isset($_POST['contratista'])) ? $_POST['contratista'] : '';
$peso_unitario = (isset($_POST['peso_unitario'])) ? $_POST['peso_unitario'] : '';
$fecha_produccion = (isset($_POST['fecha_produccion'])) ? $_POST['fecha_produccion'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_tabla = (isset($_POST['id_tabla'])) ? $_POST['id_tabla'] : '';

if($tipo == 'produccion' || $tipo == 'Admin') {
	switch($opcion){ 
		case 2:        
		$consulta = "UPDATE tabla SET contratista='$contratista', fecha_produccion=DATE_SUB(NOW(), INTERVAL 5 HOUR) WHERE id_tabla='$id_tabla' ";		
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();        

		$consulta = "SELECT id_tabla, taller, revision, marca, cantidad, nombre, peso_unitario, contratista FROM tabla WHERE id_tabla='$id_tabla' ";       
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		break;
		case 3:        
		$consulta = "UPDATE tabla SET contratista = null, fecha_produccion = null WHERE id_tabla='$id_tabla' ";		
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();                           
		break;
		case 4:    
		$consulta = "SELECT * FROM tabla WHERE modulo='K' AND liberado='SI' ORDER BY contratista, cancelados ASC";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		break;
	}
}else{
	switch($opcion){
		case 1:    
		$consulta = "SELECT * FROM tabla WHERE modulo='K' AND liberado='SI' ORDER BY contratista, cancelados ASC";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		break;
	}
}
print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;