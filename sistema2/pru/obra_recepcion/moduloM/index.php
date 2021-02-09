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
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">  
    <link rel="stylesheet" type="text/css" href="../../assets/datatables/datatables.min.css"/>
    <link rel="stylesheet"  type="text/css" href="../../assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">  
</head>
<body> 
    <header>
        <div class="container">        
            <div style="text-align: left;">
                <img src="logo.png" width="300" height="155">
            </div>
            <font color="black" size="6" face="Elephant" > <center>MÓDULO M</center></font>
            <font color="darkgray" size="5" face="Bell MT" > <center>OBRA  RECEPCIÓN</center></font>
            <div style="text-align: left">
                <a href="../../areas.php" align="left" class="btn btn-outline-dark">MENÚ ÁREAS</a>
                <a href="../index.php" align="left" class="btn btn-outline-dark">MENÚ MÓDULOS</a>
                  <a href="../../logout.php" class="btn btn-outline-danger">Cerrar Sesión</a>
            </div>

        </div>
    </header>    
    <br>
    <div class="container">
        <div align="right">
            <table cellspacing="40" cellpadding="1" border="1">
                <thead style="background:#b8b8b8">
                    <tr>
                        <th style="text-align: center">PESO TOTAL   </th>
                        <th style="text-align: center">  PESO TOTAL MONTADO</th>
                        <th style="text-align: center">PORCENTAJE MONTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql="SELECT FORMAT(SUM(peso_unitario),2) from tabla WHERE modulo='M' AND cancelados is null";
                    $sql2="SELECT FORMAT(SUM(peso_unitario),2) from tabla WHERE montaje='SI' AND modulo='M' AND cancelados is null";
                    $sql3="SELECT FORMAT(SUM(peso_unitario)/(SELECT SUM(peso_unitario) FROM tabla WHERE modulo='M' AND cancelados is null)*100,2) AS PORCENTAJE FROM tabla WHERE modulo='M' AND montaje='SI' AND cancelados is null";
                    $result=mysqli_query($conexion,$sql);
                    $result2=mysqli_query($conexion,$sql2);
                    $result3=mysqli_query($conexion,$sql3);
                    while($mostrar=mysqli_fetch_array($result)){
                        ?>
                        <tr>
                            <td style="text-align: center"><?php echo $mostrar['FORMAT(SUM(peso_unitario),2)'] ?></td>

                            <?php
                        }
                        while($mostrar2=mysqli_fetch_array($result2)){
                            ?>
                            <td style="text-align: center"><?php echo $mostrar2['FORMAT(SUM(peso_unitario),2)'] ?></td>
                        <?php
                    }
                    while($mostrar3=mysqli_fetch_array($result3)){
                    ?>
                    <td style="text-align: center"><?php echo $mostrar3['PORCENTAJE'] ?> %</td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    


    <div class="container caja">
        <p id="table-filter">
        Filtrar: 
        <select id="color_me">
            <option class="todo" value="">TODO</option>
            <option class="pendiente" value="PENDIENTE">PENDIENTE</option>            
            <option class="terminado" value="TERMINADO">TERMINADO</option>
            <option class="proceso" value="PROCESO">PROCESO</option>            
        </select>
    </p>  
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">        
                    <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed" style="width:100%" >
                        <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>TALLER</th>
                                <th>REVI-<br/>SIÓN</th>
                                <th>MARCA</th>
                                <th>CANTI-<br/>DAD</th>
                                <th>NOMBRE</th> 
                                <th>PESO UNITARIO</th>                                
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

    <script src="../../assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../assets/popper/popper.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../assets/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="main.js"></script>


    <!--=====================================
    =  INICICIO SCRIPT NO INGENIERIA        =
    ======================================-->  
    <?php if($tipo != 'obra' && $tipo != 'Admin') { ?>
        <script type="text/javascript">
    $(document).ready(function() {
        var id_tabla, opcion;
        opcion = 1;

        tablaUsuarios = $('#tablaUsuarios').DataTable({

            createdRow: function(row, data) {               
                if (data["recibido"] == 'SI' && data["montaje"] == 'SI') {
                    $("td", row).css('background-color', '#B2F75B');
                } else if (data["recibido"] == null && data["montaje"] == null) {
                    $("td", row).css('background-color', '#F55861');
                } else {
                    $("td", row).css('background-color', '#FBF461');
                }
            },
            dom: 'lr<"table-filter-container">tip',
            initComplete: function(settings) {
                var api = new $.fn.dataTable.Api(settings);
                $('.table-filter-container', api.table().container()).append(
                    $('#table-filter').detach().show()
                );

                $('#table-filter select').on('change', function() {
                    table.search(this.value).draw();
                });
            },

            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Busqueda general:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },

            "ajax": {
                "url": "bd/crud.php",
                "method": 'POST',
                "data": {
                    opcion: opcion
                },
                "dataSrc": ""
            },
            "columns": [{
                "data": "id_tabla"
            }, {
                "data": "taller"
            }, {
                "data": "revision"
            }, {
                "data": "marca"
            }, {
                "data": "cantidad"
            }, {
                "data": "nombre"
            }, {
                "data": "peso_unitario"
            }, {
                "data": "recibido"
            }, {
                "data": "montaje"
            },{
                "data": "status2"
            }
            ]
        });
        
        var table = $('#tablaUsuarios').DataTable();
        $('#tablaUsuarios tfoot td').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" style="width:100%;" placeholder="Buscar"/>');
        });
        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
        $('#tablaUsuarios tfoot tr').appendTo('#tablaUsuarios thead');
        $("#color_me").change(function() {
            var color = $("option:selected", this).attr("class");
            $("#color_me").attr("class", color);
        });

    });
</script>
<?php } ?>
<!--====  FIN SCRIPT NO INGENIERÍA  ====-->


<!--=====================================
    =    INICIO SCRIPT INGENIERIA           =
======================================-->  
<?php if($tipo == 'obra' || $tipo == 'Admin') { ?>
    <script type="text/javascript">  

    $(document).ready(function() {
        var id_tabla, opcion;
        opcion = 4;

        tablaUsuarios = $('#tablaUsuarios').DataTable({

            createdRow: function(row, data) {                
                if (data["recibido"] == 'SI' && data["montaje"] == 'SI') {
                    $("td", row).css('background-color', '#B2F75B');
                } else if (data["recibido"] == null && data["montaje"] == null) {
                    $("td", row).css('background-color', '#F55861');
                } else {
                    $("td", row).css('background-color', '#FBF461');
                }
            },
            dom: 'lr<"table-filter-container">tip',
            initComplete: function(settings) {
                var api = new $.fn.dataTable.Api(settings);
                $('.table-filter-container', api.table().container()).append(
                    $('#table-filter').detach().show()
                );

                $('#table-filter select').on('change', function() {
                    table.search(this.value).draw();
                });
            },

            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Busqueda general:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },

            "ajax": {
                "url": "bd/crud.php",
                "method": 'POST', 
                "data": {
                    opcion: opcion
                },
                "dataSrc": ""
            },
            "columns": [{
                "data": "id_tabla"
            }, {
                "data": "taller"
            }, {
                "data": "revision"
            }, {
                "data": "marca"
            }, {
                "data": "cantidad"
            }, {
                "data": "nombre"
            }, {
                "data": "peso_unitario"
            }, {
                "data": "recibido"
            }, {
                "data": "montaje"
            },{
                "data": "status2"
            },{
                "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'>Editar</button><button class='btn btn-danger btn-sm btnBorrar'>Borrar</button></div></div>"
            }]
        });

        /*=============================================
        =            AGREGAR REGISTRO            =
        =============================================*/ 
        var fila;
        $('#formUsuarios').submit(function(e) {
            e.preventDefault();
            taller = $.trim($('#taller').val());
            revision = $.trim($('#revision').val());
            marca = $.trim($('#marca').val());
            cantidad = $.trim($('#cantidad').val());
            nombre = $.trim($('#nombre').val());
            peso_unitario = $.trim($('#peso_unitario').val());
            recibido = $.trim($('#recibido').val());
            montaje = $.trim($('#montaje').val());
            status2 = $.trim($('#status2').val());
            $.ajax({
                url: "bd/crud.php",
                type: "POST",
                datatype: "json",
                data: {
                    id_tabla: id_tabla,
                    taller: taller,
                    revision: revision,
                    marca: marca,
                    cantidad: cantidad,
                    nombre: nombre,
                    peso_unitario: peso_unitario,
                    recibido: recibido,
                    montaje: montaje,
                    status2: status2,
                    opcion: opcion
                },
                success: function(data) {
                    tablaUsuarios.ajax.reload(null, false);
                }
            });
            $('#modalCRUD').modal('hide');
        });
        /*=====  FIN DE AGREGAR REGISTRO  ======*/



        /*=============================================
        = RESETEAR CAMPOS ANTES DE REGISTRO           =
        =============================================*/  
        $("#btnNuevo").click(function() {
            opcion = 1; //alta           
            id_tabla = null;
            $("#formUsuarios").trigger("reset");
            $(".modal-header").css("background-color", "#6eadff");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Registro nuevo");
            $('#modalCRUD').modal('show');
        });
        /*=====  End of Section comment block  ======*/


        /*=============================================
        =            EDITAR REGISTROS            =
        =============================================*/     
        $(document).on("click", ".btnEditar", function() {
            opcion = 2; //editar
            fila = $(this).closest("tr");
            id_tabla = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
            taller = fila.find('td:eq(1)').text();
            revision = fila.find('td:eq(2)').text();
            marca = fila.find('td:eq(3)').text();
            cantidad = fila.find('td:eq(4)').text();
            nombre = fila.find('td:eq(5)').text();
            peso_unitario = fila.find('td:eq(6)').text();
            recibido = fila.find('td:eq(7)').text();
            montaje = fila.find('td:eq(8)').text();
            status2 = fila.find('td:eq(9)').text();

            $("#taller").val(taller);
            $("#revision").val(revision);
            $("#marca").val(marca);
            $("#cantidad").val(cantidad);
            $("#nombre").val(nombre);
            $("#peso_unitario").val(peso_unitario);
            $("#recibido").val(recibido);
            $("#montaje").val(montaje);
            $("#status2").val(status2);

            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color", "white");
            $(".modal-title").text("Editar");
            $('#modalCRUD').modal('show');
        });
        /*=====  FIN EDITAR REGISTROS  ======*/


        /*=============================================
        =            FILTROS ENCABEZADO           =
        =============================================*/ 
        var table = $('#tablaUsuarios').DataTable();

        $('#tablaUsuarios tfoot td').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" style="width:100%;" placeholder="Buscar"/>');
        });

        table.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
        $('#tablaUsuarios tfoot tr').appendTo('#tablaUsuarios thead');
        /*=====  FIN ENCABEZADO  ======*/


        /*=============================================
        =            BORRAR REGISTRO           =
        =============================================*/  
        $(document).on("click", ".btnBorrar", function() {
            fila = $(this);
            id_tabla = parseInt($(this).closest('tr').find('td:eq(0)').text());
            opcion = 3; //eliminar        
            var respuesta = confirm("¿Está seguro de borrar los campos RECIBIDO y MONTAJE del registro " + id_tabla + "?");
            if (respuesta) {
                $.ajax({
                    url: "bd/crud.php",
                    type: "POST",
                    datatype: "json",
                    data: {
                        opcion: opcion,
                        id_tabla: id_tabla
                    },
                    success: function() {
                        location.reload();
                    }
                });
            }
        });
        /*=====  FIN BORRAR REGISTRO  ======*/

        $("#color_me").change(function() {
        var color = $("option:selected", this).attr("class");
        $("#color_me").attr("class", color);
    });
    });

</script>
<?php } ?>   

<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
</body>
</html>
