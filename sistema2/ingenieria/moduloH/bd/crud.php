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
$modulo = (isset($_POST['modulo'])) ? $_POST['modulo'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_tabla = (isset($_POST['id_tabla'])) ? $_POST['id_tabla'] : '';

if($tipo == 'ingenieria' || $tipo == 'Admin') {
    switch($opcion){
        case 1:
        $consulta = "INSERT INTO tabla (modulo, taller, revision, marca, cantidad, nombre, peso_unitario, fecha_ingenieria) VALUES('H', '$taller', '$revision', '$marca', '$cantidad', '$nombre', '$peso_unitario', NOW())";            
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT id_tabla, taller, revision, marca, cantidad, nombre, peso_unitario FROM tabla ORDER BY id_tabla DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
        case 2:        
        $consulta = "UPDATE tabla SET taller='$taller', revision='$revision', marca='$marca', cantidad='$cantidad', nombre='$nombre', peso_unitario='$peso_unitario' WHERE id_tabla='$id_tabla' ";      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id_tabla, taller, revision, marca, cantidad, nombre, peso_unitario FROM tabla WHERE id_tabla='$id_tabla' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 3:        
        $consulta = "DELETE FROM tabla WHERE id_tabla='$id_tabla' ";        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
        case 4:    
        $consulta = "SELECT * FROM tabla WHERE modulo='H'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 5:    
        $consulta = "UPDATE tabla SET cancelados='SI' WHERE id_tabla='$id_tabla'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        break;
        case 6:    
        $consulta = "UPDATE tabla SET cancelados= null WHERE id_tabla='$id_tabla'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        break;
    }

}else{
    switch($opcion){
        case 4:    
        $consulta = "SELECT * FROM tabla WHERE modulo='H'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }    

}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;