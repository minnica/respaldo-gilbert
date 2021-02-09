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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>ÁREAS</title>
    <link rel="shortcut icon" href="./assets/logo.ico">
    <link href="assets/img/ico.png" rel="icon">
    <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css"/>
    <link rel="stylesheet"  type="text/css" href="assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="style2.css">

</head>
<body>
<div class="btn-group-sm">
    <a href="logout.php" class="btn btn-outline-danger">Cerrar Sesión</a>
    <?php if($tipo == 'ingenieria' || $tipo == 'Admin') { ?> 
        <a href="pru/index.php" class="btn btn-outline-dark">Crear Notificación</a>
    <?php } ?>
    <a href="manejador/index.php" class="btn btn-outline-info">Subir Archivos</a>
</div>

<!--=====================================
=            NOTIFICACIONES            =
======================================-->
<?php
include("pru/php/conexion.php");
?> 

<div class="demo-content">
  <div id="notification-header">      
    <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"><span id="notification-count"><?php if($count>0) { echo $count; } ?></span><img src="icono.png" width="40px" height="40px" /></button>
   
    <div id="notification-latest"></div> 
       
  </div>
 
</div>



<?php if(isset($message)) { ?> <div class="error"><?php echo $message; ?></div> <?php } ?>
<?php if(isset($success)) { ?> <div class="success"><?php echo $success;?></div> <?php } ?>
<!--====  FIN DE NOTIFICACIONES  ====-->

<div align="center">
    <img src="logo.png" width="50%">
</div>

<!-- ==============================
    CARPETA SUBIR ARCHIVOS
<div align="right"> 
    <a href="/archivos"><img src="subir.png" width="5%"></a>
</div>
-->
<nav class="navigation" id="main-navigation">
  <ul class="menu">
    <li><a href="presupuestos/index.php">PRESUPUESTOS</a></li>
    <li><a href="ingenieria/index.php">INGENIERÍA</a></li>
    <li><a href="pcp/index.php">PCP</a></li>
    <li><a href="produccion/index.php">PRODUCCIÓN</a></li>
    <li><a href="calidad/index.php">CALIDAD</a></li>
    <li><a href="embarques/index.php">EMBARQUES</a></li>
    <li><a href="obra_recepcion/index.php">OBRA RECEPCIÓN</a></li>          
    <!-- <li><a href=#>COMPRAS</a></li>   --> 
    <li><a href="general/index.php">TABLA GENERAL</a></li>
    <li><a href="reportes/index.php">REPORTES</a></li>
  </ul>
</nav>

<!--=====================================
=     SCRIPTS NOTIFICACIONES            =
======================================-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>   
<script src="js/ie10-viewport-bug-workaround.js"></script>
<script type="text/javascript">
  function myFunction() {
    $.ajax({
      url: "pru/php/notificaciones.php",
      type: "POST",
      processData:false,
      success: function(data){
        $("#notification-count").remove();                  
        $("#notification-latest").show();$("#notification-latest").html(data);
      },
      error: function(){}           
    });
  }                                 
  $(document).ready(function() {
    $('body').click(function(e){
      if ( e.target.id != 'notification-icon'){
        $("#notification-latest").hide();
      }
    });
  });                                     
</script>
<!--====  FIN SCRIPTS NOTIFICACIONES ====-->  

</body>
</html>