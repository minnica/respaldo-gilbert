<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>CONTROL VIAJES</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  


    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">    

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">  


    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">  

</head>

<body class="bg-light"> 

<div class="container">
    <font color="black" size="5" face="Bell MT" > <center>V I A J E S</center></font>
            <div style="text-align: center">
                <button id="btnNuevo" type="button" class="btn btn-dark" data-toggle="modal">AGREGAR</button>   
            </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="thead-dark">
                        <tr>

                            <th>NO.</th>
                            <th>OPERADOR</th>
                            <th>DÍA</th>                                
                            <th>TIPO</th>  
                            <th>ORIGEN</th>
                            <th>DESTINO</th>
                            <th>FECHADE  CARGA</th>
                            <th>HORA INICIO CARGA</th>
                            <th>FECHADE SALIDA</th>
                            <th>HORA SALIDA</th>
                            <th>OBSERVACIONES</th>
                            <th>STATUS IDA</th>
                            <th>TIPO</th>
                            <th>ORIGEN</th>
                            <th>DESTINO</th>
                            <th>FECHADE CARGA</th>
                            <th>HORA INICIO CARGA</th>
                            <th>FECHADE SALIDA</th>
                            <th>HORA SALIDA</th>
                            <th>OBSERVACIONES</th>
                            <th>STATUS VUELTA</th>
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

<!--Modal para CRUD-->
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
                    <h5><center>IDA</center></h5>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="" class="col-form-label">OPERADOR:</label>
                                <input type="text" class="form-control" id="operador">
                            </div>
                        </div>
                    </div>
                    <div class="row">    
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">DÍA:</label>
                                <select id="dia" class="form-control">
                                    <option value="">SELECCIONA DÍA</option>
                                    <option value="LUNES">LUNES</option>
                                    <option value="MARTES">MARTES</option>
                                    <option value="MIERCOLES">MIERCOLES</option>
                                    <option value="JUEVES">JUEVES</option>
                                    <option value="VIERNES">VIERNES</option>
                                    <option value="SABADO">SABADO</option>
                                </select>
                            </div>               
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">TIPO:</label>
                                <select id="tipo" class="form-control">
                                    <option value="">SELECCIONA TIPO</option>
                                    <option value="SENCILLO">SENCILLO</option>
                                    <option value="FULL">FULL</option>
                                    <option value="EXTENDIBLE">EXTENDIBLE</option>
                                    <option value="CAMIONETA">CAMIONETA</option>
                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">ORIGEN:</label>
                                <input type="text" class="form-control" id="origen">
                            </div>
                        </div>    
                        <div class="col-lg-6">    
                            <div class="form-group">
                                <label for="" class="col-form-label">DESTINO</label>
                                <input type="text" class="form-control" id="destino">
                            </div>            
                        </div>    
                    </div>
                    <div class="row">    
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">FECHA DE CARGA:</label>
                                <input type="date" class="form-control" id="fecha_carga">
                            </div>               
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">HORA INICIO CARGA:</label>
                                <input type="time" class="form-control" id="hora_inicio_carga">
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">FECHA DE SALIDA:</label>
                                <input type="date" class="form-control" id="fecha_salida">
                            </div>
                        </div>    
                        <div class="col-lg-6">    
                            <div class="form-group">
                                <label for="" class="col-form-label">HORA DE SALIDA</label>
                                <input type="time" class="form-control" id="hora_salida">
                            </div>            
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="" class="col-form-label">OBSERVACIONES:</label>
                                <input type="text" class="form-control" id="observaciones">
                            </div>
                        </div>       
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">STATUS:</label>
                                <select id="status" class="form-control">
                                    <option value="">SELECCIONE STATUS</option>
                                    <option value="REALIZADO">REALIZADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                </select>
                            </div>
                        </div>       
                    </div>
                    <br />

                    <h5><center>REGRESO</center></h5>
                    <div class="row">    
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">TIPO:</label>
                                <select id="tipo2" class="form-control">
                                    <option value="">SELECCIONA TIPO</option>
                                    <option value="SENCILLO">SENCILLO</option>
                                    <option value="FULL">FULL</option>
                                    <option value="EXTENDIBLE">EXTENDIBLE</option>
                                    <option value="CAMIONETA">CAMIONETA</option>
                                </select>
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">ORIGEN:</label>
                                <input type="text" class="form-control" id="origen2">
                            </div>
                        </div>    
                        <div class="col-lg-6">    
                            <div class="form-group">
                                <label for="" class="col-form-label">DESTINO</label>
                                <input type="text" class="form-control" id="destino2">
                            </div>            
                        </div>    
                    </div>
                    <div class="row">    
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">FECHA DE CARGA:</label>
                                <input type="date" class="form-control" id="fecha_carga2">
                            </div>               
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">HORA INICIO CARGA:</label>
                                <input type="time" class="form-control" id="hora_inicio_carga2">
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">FECHA DE SALIDA:</label>
                                <input type="date" class="form-control" id="fecha_salida2">
                            </div>
                        </div>    
                        <div class="col-lg-6">    
                            <div class="form-group">
                                <label for="" class="col-form-label">HORA DE SALIDA</label>
                                <input type="time" class="form-control" id="hora_salida2">
                            </div>            
                        </div>    
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="" class="col-form-label">OBSERVACIONES:</label>
                                <input type="text" class="form-control" id="observaciones2">
                            </div>
                        </div>       
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="col-form-label">STATUS:</label>
                                <select id="status2" class="form-control">
                                    <option value="">SELECCIONE STATUS</option>
                                    <option value="REALIZADO">REALIZADO</option>
                                    <option value="PROCESO">PROCESO</option>
                                    <option value="PENDIENTE">PENDIENTE</option>
                                </select>
                            </div>
                        </div>       
                    </div>
                      
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                </div>
            </form>    
        </div>
    </div>
</div>  

<!-- jQuery, Popper.js, Bootstrap JS -->
<script src="assets/jquery/jquery-3.3.1.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

<!-- datatables JS -->
<script type="text/javascript" src="assets/datatables/datatables.min.js"></script>    

<script type="text/javascript" src="main.js"></script>  

<!-- PDF, EXCEL E IMPRIMIR -->
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>




</body>
</html>
