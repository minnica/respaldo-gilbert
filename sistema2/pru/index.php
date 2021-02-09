<?php 
session_start();  
if(!isset($_SESSION['id'])){
  header("Location: index.php");
} 
$nombres = $_SESSION['nombres'];
$tipo = $_SESSION['tipo'];  
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content=""> 
  <title>NOTIFICACIONES</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/starter-template.css" rel="stylesheet">
  <link href="css/estilos.css" rel="stylesheet">
</head>
<body>    
  <div class="container caja">
      <a href="../areas.php" class="btn btn-danger">Regresar</a>
      <?php
  include("php/conexion.php");
  ?>                        
  <div class="demo-content">
    <div id="notification-header">
      <div style="position:relative">
        <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"><span id="notification-count"><?php if($count>0) { echo $count; } ?></span><img src="img/icono.png" width="40px" height="40px" /></button>
        <div id="notification-latest"></div>
      </div>          
    </div>
  </div>

  <?php if(isset($message)) { ?> <div class="error"><?php echo $message; ?></div> <?php } ?>
  <?php if(isset($success)) { ?> <div class="success"><?php echo $success;?></div> <?php } ?>
    <div class="starter-template">
      <h1>Notificar actividad </h1>
      <p class="lead">
        <form name="frmNotification" id="frmNotification" action="php/agregarnotificacion.php" method="post" >
          <div align="center">
          <div class="col-lg-6">
            <div class="form-group">
              <label for="autor">Área </label>
              <input type="text" class="form-control" name="autor" id="autor" placeholder="Ingresa Autor" required>
            </div>
          </div>
          <div class="col-lg-6">
          <div class="form-group">
            <label for="mensaje">Mensaje </label>
            <textarea class="form-control" name="mensaje" id="mensaje" rows="3" placeholder="Mensaje" required></textarea>
          </div>
        </div>
        </div>
          <div class="form-group">
            <input type="submit" name="add" id="btn-send" value="Enviar">
          </div>
        </form>            
      </p>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/ie10-viewport-bug-workaround.js"></script>
  <script type="text/javascript">
    function myFunction() {
      $.ajax({
        url: "php/notificaciones.php",
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
</body>
</html>
