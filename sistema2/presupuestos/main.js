$(document).ready(function() {
    var id_tabla, opcion;
    opcion = 4;
    tablaUsuarios = $('#tablaUsuarios').DataTable({

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
            "data": "ota"
        }, {
            "data": "nom_pro"
        }, {
            "data": "direccion"
        }, {
            "data": "cliente"
        }, {
            "data": "peso_pre"
        }, {
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-outline-dark btn-sm btnEditar'>Editar</button><button class='btn btn-outline-dark btn-sm btnBorrar'>Borrar</button></div></div>"
        }]
    });


    var fila;
    $('#formUsuarios').submit(function(e) {
        e.preventDefault();
        ota = $.trim($('#ota').val());
        nom_pro = $.trim($('#nom_pro').val());
        direccion = $.trim($('#direccion').val());
        cliente = $.trim($('#cliente').val());
        peso_pre = $.trim($('#peso_pre').val());
        
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            datatype: "json",
            data: {
                id_tabla: id_tabla,
                ota: ota,
                nom_pro: nom_pro,
                direccion: direccion,
                cliente: cliente,
                peso_pre: peso_pre,
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
        opcion = 2;
        fila = $(this).closest("tr");
        id_tabla = parseInt(fila.find('td:eq(0)').text());
        ota = fila.find('td:eq(1)').text();
        nom_pro = fila.find('td:eq(2)').text();
        direccion = fila.find('td:eq(3)').text();
        cliente = fila.find('td:eq(4)').text();
        peso_pre = fila.find('td:eq(5)').text();
       

        $("#ota").val(ota);
        $("#nom_pro").val(nom_pro);
        $("#direccion").val(direccion);
        $("#cliente").val(cliente);
        $("#peso_pre").val(peso_pre);
  

        $(".modal-header").css("background-color", "#007bff");
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
        opcion = 3;      
        var respuesta = confirm("¿Está seguro de borrar el registro " + id_tabla + "?");
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
                    tablaUsuarios.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });


});