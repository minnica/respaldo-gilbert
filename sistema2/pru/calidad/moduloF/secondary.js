  $(document).ready(function() {
        var id_tabla, opcion;
        opcion = 1;

        tablaUsuarios = $('#tablaUsuarios').DataTable({

            createdRow: function(row, data) {

                if (data["armado"] == 'SI' && data["soldadura"] == 'SI' && data["limpieza"] == 'SI' && data["pintura"] == 'SI' && data["laboratorio"] == 'SI') {
                    $("td", row).css('background-color', '#B2F75B');
                } else if (data["armado"] == null && data["soldadura"] == null && data["limpieza"] == null && data["pintura"] == null && data["laboratorio"] == null) {
                    $("td", row).css('background-color', '#F55861');
                } else {
                    $("td", row).css('background-color', '#FBF461');
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
        
        $("#color_me").change(function(){
    var color = $("option:selected", this).attr("class");
    $("#color_me").attr("class", color);
});

    });