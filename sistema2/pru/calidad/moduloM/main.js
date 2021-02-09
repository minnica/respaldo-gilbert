$(document).ready(function() {
        var id_tabla, opcion;
    opcion = 4;
    tablaUsuarios = $('#tablaUsuarios').DataTable({

        createdRow: function(row, data) {
            if (data["armado"] == 'SI' && data["soldadura"] == 'SI' && data["limpieza"] == 'SI' && data["pintura"] == 'SI' && data["laboratorio"] == 'SI' && data["cancelados"] == null) {
                $("td", row).closest('tr').css('background-color', '#00E700');
                $("td", row).closest('tr').css('color', 'black');
            } else if (data["armado"] == null && data["soldadura"] == null && data["limpieza"] == null && data["pintura"] == null && data["laboratorio"] == null && data["cancelados"] == null) {
                $("td", row).closest('tr').css('background-color', '#FF0000');
            } 
            else if (data["cancelados"] == 'SI'){
                $("td", row).closest('tr').css('background-color', '#0000FF');
                $("td", row).closest('tr').css('text-decoration', 'line-through');
            }

            else {
                $("td", row).closest('tr').css('background-color', '#FFFF00'); 
                $("td", row).closest('tr').css('color', 'black');
            }
        },
                dom: 'lr<"tablaUsuarios">tip',
       initComplete: function(settings){
          var api = new $.fn.dataTable.Api( settings );
          $('#table-filter select').on('change', function(){
             table
                .columns(12)
                .search( this.value )
                .draw(); 
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
                "data": "armado"
            }, {
                "data": "soldadura"
            }, {
                "data": "limpieza"
            }, {
                "data": "pintura"
            },{
                "data": "laboratorio"
            },{
                "data": "status"
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
            armado = $.trim($('#armado').val());
            soldadura = $.trim($('#soldadura').val());
            limpieza = $.trim($('#limpieza').val());
            pintura = $.trim($('#pintura').val());
            laboratorio = $.trim($('#laboratorio').val());
            status = $.trim($('#status').val());
            
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
                    armado: armado,
                    soldadura: soldadura,
                    limpieza: limpieza,
                    pintura: pintura,
                    laboratorio: laboratorio,
                    status: status,
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
        /*=====  FIN RESETEO  ======*/


        /*=============================================
        =            EDITAR REGISTROS            =
        =============================================*/          
        $(document).on("click", ".btnEditar", function() {
            opcion = 2;
            fila = $(this).closest("tr");
            id_tabla = parseInt(fila.find('td:eq(0)').text());               
            taller = fila.find('td:eq(1)').text();
            revision = fila.find('td:eq(2)').text();
            marca = fila.find('td:eq(3)').text();
            cantidad = fila.find('td:eq(4)').text();
            nombre = fila.find('td:eq(5)').text();
            peso_unitario = fila.find('td:eq(6)').text();
            armado = fila.find('td:eq(7)').text();
            soldadura = fila.find('td:eq(8)').text();
            limpieza = fila.find('td:eq(9)').text();
            pintura = fila.find('td:eq(10)').text();
            laboratorio = fila.find('td:eq(11)').text();
            status = fila.find('td:eq(12)').text();
            

            $("#taller").val(taller);
            $("#revision").val(revision);
            $("#marca").val(marca);
            $("#cantidad").val(cantidad);
            $("#nombre").val(nombre);
            $("#peso_unitario").val(peso_unitario);
            $("#armado").val(armado);
            $("#soldadura").val(soldadura);
            $("#limpieza").val(limpieza);
            $("#pintura").val(pintura);
            $("#laboratorio").val(laboratorio);
            $("#status").val(status);
            

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
            opcion = 3;      
            var respuesta = confirm("¿Está seguro de borrar los campos ARMADO, SOLDADURA, LIMPIEZA y PINTURA del registro " + id_tabla + "?");
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
        
        $("#color_me").change(function(){
    var color = $("option:selected", this).attr("class");
    $("#color_me").attr("class", color);
});
        
        
    });