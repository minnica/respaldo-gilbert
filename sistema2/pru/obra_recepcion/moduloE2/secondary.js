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