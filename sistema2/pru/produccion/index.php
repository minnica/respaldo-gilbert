<?php 
session_start();  
if(!isset($_SESSION['id'])){
  header("Location: index.php");
} 
$nombres = $_SESSION['nombres'];
$tipo = $_SESSION['tipo'];  
?>
<!DOCTYPE html>
<html lang="es" >
<head>
  <meta charset="UTF-8">
  <title>Módulos</title>
  <link rel="shortcut icon" href="logo.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="./style.css">

</head>
<body>
  <div align="center">
    <ul  style= "overflow: auto";>
      <li><a href="../areas.php" style="text-decoration: none; color:#000"><span>MENÚ    ÁREAS</span></a></li>
      <li><a href="moduloE2/index.php" style="text-decoration: none; color:#000"><span>M Ó D U L O  E2</span></a></li>
      <li><a href="moduloE3/index.php" style="text-decoration: none; color:#000"><span>M Ó D U L O  E3</span></a></li>
      <li><a href="moduloE4/index.php" style="text-decoration: none; color:#000"><span>M Ó D U L O  E4</span></a></li>
      <li><a href="moduloF/index.php" style="text-decoration: none; color:#000"><span>M Ó D U L O  F</span></a></li>
      <li><a href="moduloG1/index.php" style="text-decoration: none; color:#000"><span>M Ó D U L O  G1</span></a></li>
      <li><a href="moduloG2/index.php" style="text-decoration: none; color:#000"><span>M Ó D U L O  G2</span></a></li>
      <li><a href="moduloH/index.php" style="text-decoration: none; color:#000"><span>M Ó D U L O  H</span></a></li>
      <li><a href="moduloJ/index.php" style="text-decoration: none; color:#000"><span>M Ó D U L O  J</span></a></li>
      <li><a href="moduloK/index.php" style="text-decoration: none; color:#000"><span>M Ó D U L O  K</span></a></li>
      <li><a href="moduloM/index.php" style="text-decoration: none; color:#000"><span>M Ó D U L O  M</span></a></li>
      <li><a href="moduloN/index.php" style="text-decoration: none; color:#000"><span>M Ó D U L O  N</span></a></li>
    </ul>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script><script  src="./script.js"></script>

</body>
</html>
