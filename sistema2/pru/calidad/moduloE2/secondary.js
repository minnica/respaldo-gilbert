  $(document).ready(function() {
        var id_tabla, opcion;
        opcion = 1;

        tablaUsuarios = $('#tablaUsuarios').DataTable({

            createdRow: function(row, data) {
            if (data["armado"] == 'SI' && data["soldadura"] == 'SI' && data["limpieza"] == 'SI' && data["pintura"] == 'SI' && data["laboratorio"] == 'SI' && data["cancelados"] === null) {
                $("td", row).closest('tr').css('background-color', '#00E700');
                $("td", row).closest('tr').css('color', 'black');
            } else if (data["armado"] === null && data["soldadura"] === null && data["limpieza"] === null && data["pintura"] === null && data["laboratorio"] === null && data["cancelados"] === null) {
                $("td", row).closest('tr').css('background-color', '#FF0000');
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
            }
            ]
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
        
        $("#color_me").change(function(){
    var color = $("option:selected", this).attr("class");
    $("#color_me").attr("class", color);
});

    });