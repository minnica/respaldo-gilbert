<?php
session_start();    
if(!isset($_SESSION['id'])){
    header("Location: index.php");
}   
$nombres = $_SESSION['nombres'];
$tipo = $_SESSION['tipo'];

$conexion=mysqli_connect('localhost','gilbertm_root','Grupogilbert2020','gilbertm_prueba');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../logo.ico">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>OBRA RECEPCIÓN</title>
    <link rel="stylesheet" href="main.css">
<!-- estilo bootstrap4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- estilo de datatable con bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">    

    <!-- FA ICONS -->
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
      <h4 class="text-dark">OBRA  RECEPCIÓN</h4>
        <h5 class="text-muted">M Ó D U L O  K</h5>
    </header>    
    <div class="container-xl bg-light">
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-60 bg-light">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">PESO TOTAL</div>
                                <?php
                                $sql="SELECT FORMAT(SUM(peso_unitario),2) from tabla WHERE modulo='K'";
                                $result=mysqli_query($conexion,$sql);
                                while($mostrar=mysqli_fetch_array($result)){
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $mostrar['FORMAT(SUM(peso_unitario),2)'] ?> Kg.</div>
                                <?php } ?>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-weight fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-60 bg-light">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">PESO TOTAL LIBERADO</div>
                                <?php
                                $sql2="SELECT FORMAT(SUM(peso_unitario),2) from tabla WHERE montaje='SI' AND modulo='K'";          
                                $result2=mysqli_query($conexion,$sql2);
                                while($mostrar2=mysqli_fetch_array($result2)){
                                    ?>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $mostrar2['FORMAT(SUM(peso_unitario),2)'] ?> Kg.</div>
                                <?php } ?>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck-loading fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-60 bg-light">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">PORCENTAJE</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <?php                                
                                        $sql3="SELECT FORMAT(SUM(peso_unitario)/(SELECT SUM(peso_unitario) FROM tabla WHERE modulo='K')*100,2) AS PORCENTAJE FROM tabla WHERE modulo='K' AND montaje='SI'";                                    
                                        $result3=mysqli_query($conexion,$sql3);
                                        while($mostrar3=mysqli_fetch_array($result3)){
                                            ?>
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $mostrar3['PORCENTAJE'] ?>%</div>
                                        <?php } ?>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <?php 
                                            $sql3="SELECT FORMAT(SUM(peso_unitario)/(SELECT SUM(peso_unitario) FROM tabla WHERE modulo='K')*100,2) AS PORCENTAJE FROM tabla WHERE modulo='K' AND montaje='SI'";                                    
                                            $result3=mysqli_query($conexion,$sql3);
                                            while($mostrar3=mysqli_fetch_array($result3)){
                                                ?>
                                                <div class="progress-bar bg-info" role="progressbar" style="width:<?php echo $mostrar3['PORCENTAJE'] ?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-percentage fa-3x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

           <center> <p id="table-filter">
                Filtrar: 
                <select id="color_me" class="btn btn-dark">
                    <option class="todo" value="">TODO</option>
                    <option class="pendiente text-white" value="PENDIENTE">PENDIENTE</option>            
                    <option class="terminado" value="TERMINADO">TERMINADO</option>
                    <option class="proceso" value="PROCESO">PROCESO</option>            
                </select>
            </p>  
            </center>
            <div class="table-responsive shadow">
                <table id="tablaUsuarios" class="table table-sm table-striped table-bordered" style="width:100%">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>TALLER</th>
                            <th>REVISIÓN</th>
                            <th>MARCA</th>
                            <th>CANTIDAD</th>
                            <th>NOMBRE</th> 
                            <th>PESO</th>                                
                            <th>RECIBIDO</th>                            
                            <th>MONTAJE</th>
                            <th>STATUS</th>
                            <?php if($tipo == 'obra' || $tipo == 'Admin') { ?>
                            <th>ACCIONES</th> 
                            <?php } ?>                            

                        </tr>
                    </thead>
                    <tbody>                           
                    </tbody>
                    <tfoot>
                        <tr>
                            <?php if($tipo == 'obra' || $tipo == 'Admin') { ?>
                            <td></td> 
                            <?php } ?>  
                            <td></td> 
                            <td></td>
                            <td></td>
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


    <!--=====================================
    =        INICIO MODAL REGISTRO         =
    ======================================--> 
    <?php if($tipo == 'obra' || $tipo == 'Admin') { ?>
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
                                        <input type="text" class="form-control" id="taller" disabled="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">REVISIÓN:</label>
                                        <input type="text" class="form-control" id="revision" disabled="">
                                    </div> 
                                </div>
                            </div>
                            <div class="row">    
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">MARCA:</label>
                                        <input type="text" class="form-control" id="marca" disabled="">                    
                                    </div>               
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">CANTIDAD:</label>
                                        <input type="text" class="form-control" id="cantidad" disabled="">
                                    </div>
                                </div>  
                            </div>   
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">NOMBRE:</label>
                                        <input type="text" class="form-control" id="nombre" disabled="">
                                    </div>
                                </div>    
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">PESO UNITARIO:</label>
                                        <input type="text" class="form-control" id="peso_unitario" disabled="">
                                    </div>               
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">RECIBIDO:</label>
                                        <select id="recibido" class="form-control">
                                            <option value="SI">SÍ</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>               
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">MONTAJE:</label>
                                        <select id="montaje" class="form-control">
                                            <option value="SI">SÍ</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>               
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">STATUS:</label>
                                        <input type="text" class="form-control" id="status2" disabled="">
                                    </div>               
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnGuardar" class="btn btn-primary" onClick="location.reload();">Guardar</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>  
    <?php } ?> 
    <!--====  FIN MODAL REGISTRO  ====-->

    <!-- scripts bootstrap4 -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <!-- scripts datatables -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <!-- scripts ejemplo datatable con bootstrap -->
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


    <?php if($tipo != 'obra' && $tipo != 'Admin') { ?>
        <script type="text/javascript" src="secondary.js"></script>
<?php } ?>

<?php if($tipo == 'obra' || $tipo == 'Admin') { ?>
    <script type="text/javascript" src="main.js"></script>
<?php } ?>   

</body>
</html>
