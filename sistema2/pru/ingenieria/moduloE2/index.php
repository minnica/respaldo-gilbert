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
    <link rel="shortcut icon" href="#" />  
    <title>INGENIERÍA</title>
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
        <h4 class="text-dark">I N G E N I E R Í A</h4>
        <h5 class="text-muted">M Ó D U L O E2</h5>
    </header>


    <div class="container bg-light">  
        <br>
        <div class="table-responsive rounded bg-transparent">
                    <table id="tablaUsuarios" class="table rounded table-light table-striped table-bordered table-hover" style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>TALLER</th>
                                <th>REVISIÓN</th>
                                <th>MARCA</th>
                                <th>CANTIDAD</th>
                                <th>NOMBRE</th>
                                <th>PESO UNITARIO</th>
                                <?php if($tipo == 'ingenieria' || $tipo == 'Admin') { ?>
                                    <th>ACCIONES</th>
                                    <th>CAN</th>
                                <?php } ?>                                 
                            </tr>
                        </thead>
                        <tbody>                           
                        </tbody>
                        <tfoot>
                            <tr>
                                <?php if($tipo == 'ingenieria' || $tipo == 'Admin') { ?>
                                    <td></td>
                                    <td></td>   
                                <?php } ?> 
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>   
                </div>
            </div> 
            
            <?php if($tipo == 'ingenieria' || $tipo == 'Admin') { ?>        
        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formUsuarios">    
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">TALLER:</label>
                                        <input type="text" class="form-control" id="taller">        
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">REVISIÓN:</label>
                                        <input type="text" class="form-control" id="revision">
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">                    
                                        <label for="" class="col-form-label">MARCA:</label>
                                        <input type="text" class="form-control" id="marca">
                                    </div> 
                                </div>    
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">CANTIDAD:</label>
                                        <input type="text" class="form-control" id="cantidad">                    
                                    </div>               
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">NOMBRE:</label>
                                        <input type="text" class="form-control" id="nombre">
                                    </div>               
                                </div> 
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">PESO UNITARIO:</label>
                                        <input type="text" class="form-control" id="peso_unitario">
                                    </div>               
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>                               
    <?php } ?> 
    
    <!-- scripts bootstrap4 -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <!-- scripts datatables -->
    
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <!-- scripts ejemplo datatable con bootstrap -->
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    
              
    <?php if($tipo != 'ingenieria' && $tipo != 'Admin') { ?>
        <script type="text/javascript" src="secondary.js"></script>
    <?php } ?>


    <!--=====================================
    =    INICIO SCRIPT INGENIERIA           =
    ======================================-->                 
    <?php if($tipo == 'ingenieria' || $tipo == 'Admin') { ?>
        <script type="text/javascript" src="main.js"></script>
    <?php } ?>
<!--====  FIN SCRIPT INGENIERÍA  ====-->


</body>
</html>
