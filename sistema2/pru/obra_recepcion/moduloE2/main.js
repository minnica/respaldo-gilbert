$(document).ready(function() {
    var id_tabla, opcion;
    opcion = 4;

    tablaUsuarios = $('#tablaUsuarios').DataTable({

        createdRow: function(row, data) {
            if (data["recibido"] == 'SI' && data["montaje"] == 'SI' && data["cancelados"] === null) {
                $("td", row).closest('tr').css('background-color', '#00E700');
            } else if (data["recibido"] == null && data["montaje"] == null && data["cancelados"] === null) {
                $("td", row).closest('tr').css('background-color', '#FF0000');
                $("td", row).closest('tr').css('color', 'white');
                $("td", row).closest('tr').find('button').css('color', 'white');
            }
            else if (data["cancelados"] == 'SI'){
                $("td", row).closest('tr').css('background-color', '#0000FF');
                $("td", row).closest('tr').css('color', 'white');
                $("td", row).closest('tr').css('text-decoration', 'line-through');
                $("td", row).closest('tr').find('button').css('color', 'white');
                $("td", row).closest('tr').find('button').prop("disabled", true);
            }
            else {
                 $("td", row).closest('tr').css('background-color', '#FFFF00'); 
            }
        },
        dom: 'lr<"tablaUsuarios">tip',
        initComplete: function(settings) {
                    var api = new $.fn.dataTable.Api(settings);
                    $('#table-filter select').on('change', function() {
                        table
                            .columns(9)
                            .search(this.value)
                            .draw();
                    });
                },

        /*dom: 'lr<"table-filter-container">tip',
        initComplete: function(settings) {
            var api = new $.fn.dataTable.Api(settings);
            $('.table-filter-container', api.table().container()).append(
                $('#table-filter').detach().show()
            );

            $('#table-filter select').on('change', function() {
                table.search(this.value).draw();
            });
        },*/

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
        }, {
            "data": "status2"
        }, {
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-dark btn-sm btnEditar'>Editar</button><button class='btn btn-outline-dark btn-sm btnBorrar'>Borrar</button></div></div>"
        }]
    });

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

    $("#btnNuevo").click(function() {
        opcion = 1; //alta           
        id_tabla = null;
        $("#formUsuarios").trigger("reset");
        $(".modal-header").addClass("bg-dark text-white");
        $(".modal-title").text("Registro nuevo");
        $('#modalCRUD').modal('show');
    });

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

        $(".modal-header").addClass("bg-dark text-white");
        $(".modal-title").text("Editar");
        $('#modalCRUD').modal('show');
    });

    var table = $('#tablaUsuarios').DataTable();

    $('#tablaUsuarios tfoot td').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" class="form-control form-control-sm bg-light" style="width:100%;" placeholder="Buscar"/>');
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
                success: function(data) {
                    tablaUsuarios.ajax.reload(null, false);
                }
            });
        }
    });

    $("#color_me").change(function() {
        var color = $("option:selected", this).attr("class");
        $("#color_me").attr("class", color).addClass('btn');
    });
});