<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>TABLA GENERAL</title>
    <link rel="shortcut icon" href="../logo.ico">
    <!-- estilo bootstrap4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- estilo de datatable con bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">   
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body class="bg-light"> 
    <nav class="navbar navbar-expand-md bg-light navbar-light">
        <a class="navbar-brand" href="#">Grupo <span class="text-danger">G</span>ilbert&#174;</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../areas.php">MENÚ ÁREAS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">MENÚ MÓDULOS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="../../logout.php">CERRAR SESIÓN</a>
                </li>
            </ul>
        </div>
    </nav>

    <header align="center">
        <h4 class="text-dark">TABLA GENERAL</h4>
       
    </header>


    <div class="container-fluid bg-light">  
        <br>
        <div class="table-responsive rounded bg-transparent">
            <table id="tablaUsuarios" class="table rounded table-light table-striped table-bordered table-hover table-sm" style="width:100%">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                            <th>MODU</th>
                            <th>TALLER</th>
                            <th>REV</th>
                            <th>MARCA</th>
                            <th>CANT</th>
                            <th>NOMBRE</th>                            
                            <th>P.U</th>                            
                            <th>LIB</th>
                            <th>CONTRA</th>
                            <th>ARM</th>
                            <th>SOL</th>
                            <th>LIMP</th>
                            <th>PINT</th>
                            <th>STATUS</th>
                            <th>ENVIADO</th>
                            <th>REMISION</th>
                            <th>RECIBIDO</th>
                            <th>MONTAJE</th>  
                            <th>STATUS</th>
                            <th>CAN</th>                             
                    </tr>
                </thead>
               
               
            </table>   
        </div>
    </div> 
    
    <!-- scripts bootstrap4 -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <!-- scripts datatables -->
    
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <!-- scripts ejemplo datatable con bootstrap -->
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    
     <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>  
      
    <script>
        $(document).ready(function(){
           $("#tablaUsuarios").DataTable({
              "processing": true,
              "serverSide": true,
              "sAjaxSource": "ServerSide/serversideUsuarios.php",
              "columnDefs":[{
                  "data":null
              }]   
           }); 
        });
    </script>  
      


</body>
</html>
