$(document).ready(function() {
var id_chofer, opcion;
opcion = 4;
    
tablaUsuarios = $('#tablaUsuarios').DataTable({  
    scrollY: 400,
    scrollX: true,
    scrollCollapse: true,
    paging: false,
    autoFill: true,
    
    "language": {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Busqueda general:",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast":"Último",
            "sNext":"Siguiente",
            "sPrevious": "Anterior"
         },
         "sProcessing":"Procesando...",
    },
    
    
    
    "ajax":{            
        "url": "bd/crud.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
    
        {"data": "id_chofer"},
        {"data": "operador"},
        {"data": "dia"},
        {"data": "tipo"},
        {"data": "origen"},
        {"data": "destino"},
        {"data": "fecha_carga"},
        {"data": "hora_inicio_carga"},
        {"data": "fecha_salida"},
        {"data": "hora_salida"},
        {"data": "observaciones"},
        {"data": "status", render: function ( data, type, row ) {
            if (data=='REALIZADO') {
               return '<span class="badge badge-pill badge-success">'+ data + '</span>'; 
           }
           else if (data=='PROCESO') {
            return '<span class="badge badge-pill badge-warning">'+ data + '</span>'; 
           }
           else{
                return '<span class="badge badge-pill badge-danger">'+ data + '</span>';
           }
        
    }},
        {"data": "tipo2"},
        {"data": "origen2"},
        {"data": "destino2"},
        {"data": "fecha_carga2"},
        {"data": "hora_inicio_carga2"},
        {"data": "fecha_salida2"},
        {"data": "hora_salida2"},
        {"data": "observaciones2"},
         {"data": "status2", render: function ( data, type, row ) {
            if (data=='REALIZADO') {
               return '<span class="badge badge-pill badge-success">'+ data + '</span>'; 
           }
           else if (data=='PROCESO') {
            return '<span class="badge badge-pill badge-warning">'+ data + '</span>'; 
           }
           else{
                return '<span class="badge badge-pill badge-danger">'+ data + '</span>';
           }
        
    }},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-dark btn-sm btnEditar'>EDITAR</button><button class='btn btn-danger btn-sm btnBorrar'>BORRAR</button></div></div>"}
        
    ]
});     

var fila; //captura la fila, para editar o eliminar
//submit para el Alta y Actualización
$('#formUsuarios').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    operador = $.trim($('#operador').val());    
    dia = $.trim($('#dia').val());
    tipo = $.trim($('#tipo').val());    
    origen = $.trim($('#origen').val());    
    destino = $.trim($('#destino').val());
    fecha_carga = $.trim($('#fecha_carga').val());
    fecha_carga = $.trim($('#fecha_carga').val());
    hora_inicio_carga = $.trim($('#hora_inicio_carga').val());
    fecha_salida = $.trim($('#fecha_salida').val());
    hora_salida = $.trim($('#hora_salida').val());
    observaciones = $.trim($('#observaciones').val());
    status = $.trim($('#status').val());
    tipo2 = $.trim($('#tipo2').val());
    origen2 = $.trim($('#origen2').val());
    destino2 = $.trim($('#destino2').val());
    fecha_carga2 = $.trim($('#fecha_carga2').val());
    hora_inicio_carga2 = $.trim($('#hora_inicio_carga2').val());
    fecha_salida2 = $.trim($('#fecha_salida2').val());
    hora_salida2 = $.trim($('#hora_salida2').val());
    observaciones2 = $.trim($('#observaciones2').val());
    status2 = $.trim($('#status2').val());
    

        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {id_chofer:id_chofer, operador:operador, dia:dia, tipo:tipo, origen:origen, destino:destino ,fecha_carga:fecha_carga ,hora_inicio_carga:hora_inicio_carga , fecha_salida:fecha_salida ,hora_salida:hora_salida ,observaciones:observaciones,status:status ,tipo2:tipo2 ,origen2:origen2 ,destino2:destino2 ,fecha_carga2:fecha_carga2 ,hora_inicio_carga2:hora_inicio_carga2 ,fecha_salida2:fecha_salida2 ,hora_salida2:hora_salida2 ,observaciones2:observaciones2,status2:status2 ,opcion:opcion},    
          success: function(data) {
            tablaUsuarios.ajax.reload(null, false);
           }
        });			        
    $('#modalCRUD').modal('hide');											     			
});
        
 

//para limpiar los campos antes de dar de Alta una Persona
$("#btnNuevo").click(function(){
    opcion = 1; //alta           
    id_chofer=null;
    $("#formUsuarios").trigger("reset");
    $(".modal-header").css( "background-color", "black");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Registro nuevo");
    $('#modalCRUD').modal('show');	    
});

//Editar        
$(document).on("click", ".btnEditar", function(){		        
    opcion = 2;//editar
    fila = $(this).closest("tr");	        
    id_chofer = parseInt(fila.find('td:eq(0)').text()); //capturo el id_chofer		            
    operador = fila.find('td:eq(1)').text();
    dia = fila.find('td:eq(2)').text();
    tipo = fila.find('td:eq(3)').text();
    origen = fila.find('td:eq(4)').text();
    destino = fila.find('td:eq(5)').text();
    fecha_carga = fila.find('td:eq(6)').text();
    hora_inicio_carga = fila.find('td:eq(7)').text();
    fecha_salida = fila.find('td:eq(8)').text();
    hora_salida = fila.find('td:eq(9)').text();
    observaciones = fila.find('td:eq(10)').text();
    status = fila.find('td:eq(11)').text();
    tipo2 = fila.find('td:eq(12)').text();
    origen2 = fila.find('td:eq(13)').text();
    destino2 = fila.find('td:eq(14)').text();
    fecha_carga2 = fila.find('td:eq(15)').text();
    hora_inicio_carga2 = fila.find('td:eq(16)').text();
    fecha_salida2 = fila.find('td:eq(17)').text();
    hora_salida2 = fila.find('td:eq(18)').text();
    observaciones2 = fila.find('td:eq(19)').text();
    status2 = fila.find('td:eq(20)').text();

    $("#operador").val(operador);
    $("#dia").val(dia);
    $("#tipo").val(tipo);
    $("#origen").val(origen);
    $("#destino").val(destino);
    $("#fecha_carga").val(fecha_carga);
    $("#hora_inicio_carga").val(hora_inicio_carga);
    $("#fecha_salida").val(fecha_salida);
    $("#hora_salida").val(hora_salida);
    $("#observaciones").val(observaciones);
    $("#status").val(status);
    $("#tipo2").val(tipo2);
    $("#origen2").val(origen2);
    $("#destino2").val(destino2);
    $("#fecha_carga2").val(fecha_carga2);
    $("#hora_inicio_carga2").val(hora_inicio_carga2);
    $("#fecha_salida2").val(fecha_salida2);
    $("#hora_salida2").val(hora_salida2);
    $("#observaciones2").val(observaciones2);
    $("#status2").val(status2);
    
    $(".modal-header").css("background-color", "black");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Usuario");		
    $('#modalCRUD').modal('show');		   
});



var table = $('#tablaUsuarios').DataTable();

$('#tablaUsuarios tfoot td').each( function (){
var title = $(this).text();
$(this).html('<input type="text" class="input2" style="width:100%;" placeholder="Buscar"/>');
});

table.columns().every( function(){
    var that = this;
    $('input', this.footer() ).on('keyup change',function(){
        if( that.search() !==this.value ){
            that.search( this.value ).draw();
        }
    }); 
});
$('#tablaUsuarios tfoot tr').appendTo('#tablaUsuarios thead');




//Borrar
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);           
    id_chofer = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
    opcion = 3; //eliminar        
    var respuesta = confirm("¿Está seguro de borrar el registro "+id_chofer+"?");                
    if (respuesta) {            
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {opcion:opcion, id_chofer:id_chofer},    
          success: function() {
              tablaUsuarios.row(fila.parents('tr')).remove().draw();                  
           }
        });	
    }
 });
     
});    