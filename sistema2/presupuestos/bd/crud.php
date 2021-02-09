<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$ota = (isset($_POST['ota'])) ? $_POST['ota'] : '';
$nom_pro = (isset($_POST['nom_pro'])) ? $_POST['nom_pro'] : '';
$direccion = (isset($_POST['direccion'])) ? $_POST['direccion'] : '';
$cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : '';
$peso_pre = (isset($_POST['peso_pre'])) ? $_POST['peso_pre'] : '';



$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_tabla = (isset($_POST['id_tabla'])) ? $_POST['id_tabla'] : '';

    switch($opcion){
        case 1:
        $consulta = "INSERT INTO presupuestos (ota, nom_pro, direccion, cliente, peso_pre) VALUES('$ota', '$nom_pro', '$direccion', '$cliente', '$peso_pre')";            
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT id_tabla, ota, nom_pro, direccion, cliente, peso_pre FROM presupuestos ORDER BY id_tabla DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
        case 2:        
        $consulta = "UPDATE presupuestos SET ota='$ota', nom_pro='$nom_pro', direccion='$direccion', cliente='$cliente', peso_pre='$peso_pre' WHERE id_tabla='$id_tabla' ";      
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id_tabla, ota, nom_pro, direccion, cliente, peso_pre FROM presupuestos WHERE id_tabla='$id_tabla' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
        case 3:        
        $consulta = "DELETE FROM presupuestos WHERE id_tabla='$id_tabla' ";        
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
        case 4:    
        $consulta = "SELECT * FROM presupuestos";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    }

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;