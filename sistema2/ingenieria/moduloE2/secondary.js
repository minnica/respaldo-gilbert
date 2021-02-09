$(document).ready(function() {
                var id_tabla, opcion;
                opcion = 4;
                tablaUsuarios = $('#tablaUsuarios').DataTable({
                    createdRow: function(row, data) {
                    if (data["cancelados"] == 'SI') {
                        $("td", row).closest('tr').css('background-color', '#0000FF');
                        $("td", row).closest('tr').css('color', 'white');
                        $("td", row).closest('tr').css('text-decoration', 'line-through');
                        $("td", row).closest('tr').find('button').css('color', 'white');
                    }},
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
        }]
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
            });