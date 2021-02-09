<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>PRESUPUESTOS</title>
    <link rel="shortcut icon" href="../logo.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">   
    
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
                    <a class="nav-link text-danger" href="../../logout.php">CERRAR SESIÓN</a>
                </li>
            </ul>
        </div>
    </nav>

    <header align="center">
        <h4 class="text-dark">PRESUPUESTOS</h4>

    </header>
    <div style="text-align: center">
        <button id="btnNuevo" type="button" class="btn btn-outline-dark" data-toggle="modal">Agregar</button>   
    </div>               



    <br>
    <div class="container bg-light">
        <div class="table-responsive rounded bg-transparent">
            <div class="col-lg-12">
                <div class="table-responsive">        
                    <table id="tablaUsuarios" class="table rounded table-light table-striped table-bordered table-hover table-sm" style="width:100%" >
                        <thead class="thead-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>OTA</th>
                                <th>PROYECTO</th>
                                <th>DIRECCION</th>
                                <th>CLIENTE</th>
                                <th>PESO PRE</th>                                
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>                           
                        </tbody>
                        <tfoot>
                            <tr>                             
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
        </div>  
    </div>
    <!--=====================================
    =        INICIO MODAL REGISTRO         =
    ======================================-->   

    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formUsuarios">    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">OTA:</label>
                                    <input type="text" class="form-control" id="ota" name="ota">        
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">PROYECTO:</label>
                                    <input type="text" class="form-control" id="nom_pro" name="nom_pro">
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">                    
                                    <label for="" class="col-form-label">DIRECCIÓN:</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion">
                                </div> 
                            </div>    
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">CLIENTE:</label>
                                    <input type="text" class="form-control" id="cliente" name="cliente">                    
                                </div>               
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="col-form-label">PESO:</label>
                                    <input type="text" class="form-control" id="peso_pre" name="peso_pre">
                                </div>               
                            </div> 
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>    
            </div>
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

    <script type="text/javascript" src="main.js"></script>


</body>
</html>
