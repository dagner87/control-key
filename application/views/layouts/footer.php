        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2017-2018 <a href="<?php echo base_url();?>">Key Solutions SRL</a>.</strong> All rights
            reserved.
        </footer>
    </div> 
    <!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
<!-- Highcharts -->
<script src="<?php echo base_url();?>assets/template/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>assets/template/highcharts/exporting.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery-print/jquery.print.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery-ui/jquery-ui.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/template/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- DataTables Export -->
<script src="<?php echo base_url();?>assets/template/datatables-export/js/datatables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables-export/js/buttons.print.min.js"></script> 
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/template/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/template/dist/js/demo.js"></script>
 <!-- PNotify -->
    <script src="<?php echo base_url();?>assets/template/pnotify/dist/pnotify.js"></script>
    <script src="<?php echo base_url();?>assets/template/pnotify/dist/pnotify.buttons.js"></script>
    <script src="<?php echo base_url();?>assets/template/pnotify/dist/pnotify.nonblock.js"></script>

<script>
$(document).ready(function () {
    var base_url= "<?php echo base_url();?>";
    var year = (new Date).getFullYear();
    datagrafico(base_url,year);

    $("#year").on("change",function(){
        yearselect = $(this).val();
        datagrafico(base_url,yearselect);
    });

    $("#buscar_consumo").on("click",function(e){
          e.preventDefault();
        yearselect  = $(this).val();
        year        = $("select[name=year]").val();
        id_producto = $("select[name=id_producto]").val();
        datagrafico_consumo(base_url,year,id_producto);
    });

    

    $(".btn-remove").on("click", function(e){
        e.preventDefault();
        var ruta = $(this).attr("href");
        //alert(ruta);
        $.ajax({
            url: ruta,
            type:"POST",
            success:function(resp){
                //http://localhost/ventas_ci/mantenimiento/productos
                window.location.href = base_url + resp;
            }
        });
    });
    $(".btn-view-producto").on("click", function(){
        var producto = $(this).val(); 
        //alert(cliente);
        var infoproducto = producto.split("*");
        html = "<p><strong>Codigo:</strong>"+infoproducto[1]+"</p>"
        html += "<p><strong>Nombre:</strong>"+infoproducto[2]+"</p>"
        html += "<p><strong>Descripcion:</strong>"+infoproducto[3]+"</p>"
        html += "<p><strong>Precio:</strong>"+infoproducto[4]+"</p>"
        html += "<p><strong>Stock:</strong>"+infoproducto[5]+"</p>"
        html += "<p><strong>Categoria:</strong>"+infoproducto[6]+"</p>";
        $("#modal-default .modal-body").html(html);
    });
  
    $(".btn-view-cliente").on("click", function(){
        var cliente = $(this).val(); 
        //alert(cliente);
        var infocliente = cliente.split("*");
        html = "<p><strong>Nombre:</strong>"+infocliente[1]+"</p>"
        html += "<p><strong>Tipo de Cliente:</strong>"+infocliente[2]+"</p>"
        html += "<p><strong>Tipo de Documento:</strong>"+infocliente[3]+"</p>"
        html += "<p><strong>Numero  de Documento:</strong>"+infocliente[4]+"</p>"
        html += "<p><strong>Telefono:</strong>"+infocliente[5]+"</p>"
        html += "<p><strong>Direccion:</strong>"+infocliente[6]+"</p>"
        $("#modal-default .modal-body").html(html);
    });
    $(".btn-view").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "mantenimiento/categorias/view/" + id,
            type:"POST",
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });
    $(".btn-view-usuario").on("click", function(){
        var id = $(this).val();
        $.ajax({
            url: base_url + "administrador/usuarios/view",
            type:"POST",
            data:{idusuario:id},
            success:function(resp){
                $("#modal-default .modal-body").html(resp);
                //alert(resp);
            }

        });

    });
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Listado de Ventas",
                exportOptions: {
                    columns: [ 0, 1,2, 3, 4, 5 ]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Listado de Ventas",
                exportOptions: {
                    columns: [ 0, 1,2, 3, 4, 5 ]
                }
                
            }
        ],

        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    /*-----------------movimentos entrada_salidas---------------------*/
    
    $('#movi_ent_sal').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Listado de Entradas y Salidas",
                exportOptions: {
                    columns: [ 0,1,2,3,4]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Listado de Entradas y Salidas",
                exportOptions: {
                    columns: [ 0,1,2,3,4]

                }
                
            }     
        ],
        searching: false,
        ordering: false,
        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });



    /*-----------------movimentos entrada_salidas---------------------*/


    /*---------------stocks-------------------*/

    $('#stocks').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Productos en stock",
                exportOptions: {
                    columns: [ 0,1,2]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Productos en stock",
                exportOptions: {
                    columns: [ 0,1,2]
                }
                
            }
        ],

        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });


    $('#stocks_alcli').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Productos en stock",
                exportOptions: {
                    columns: [0,1,2,3]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Productos en stock",
                exportOptions: {
                    columns: [0,1,2,3]
                }
                
            }
        ],

        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });




    /*----------------fin stock-------------------*/

    /*------lista de entrada------------*/
    
    $('#l_entrada').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Lista de entradas",
                exportOptions: {
                    columns: [ 0, 1,2,3]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Lista de entradas",
                exportOptions: {
                    columns: [ 0, 1,2,3]
                }
                
            }
        ],

        language: {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

       $("#id_producto_entrada").on("change",function(){
       var option = $(this).val();
       $("#btn-agregar-entrada").val(option);
       var option = $(this).find(':selected')[0];
        $(option).attr('disabled', 'disabled');
    });

   $("#btn-agregar-entrada").on("click",function(){
        data = $(this).val();
        if (data !='') {
            infoproducto = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
            html += "<td>"+infoproducto[2]+"</td>";
            html += "<td><input type='text' name='cantidades[]' value='' class='cantidades' required='true'></td>";
            html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
            html += "</tr>";
            $("#tb-entradas tbody").append(html);
            sumar_pro();
            $("#btn-agregar-entrada").val(null);
           
        }else{
            alert("seleccione un producto...");
        }
    });

   /*-----------movimientos entre almacen---------*/
      $("#id_producto_entradAlmacen").on("change",function(){
       var option = $(this).val();
       $("#btn-agregar-entradAlmacen").val(option);
       var option = $(this).find(':selected')[0];//obtiene el producto seleccionado
        $(option).attr('disabled', 'disabled'); // y lo desabilita para no volverlo a seleccionar
    });


   $("#btn-agregar-entradAlmacen").on("click",function(){
        data = $(this).val();
        if (data !='') {
            infoproducto = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
            html += "<td>"+infoproducto[2]+"</td>";
            html += "<td>"+infoproducto[3]+"</td>";
            html += "<td><input type='text' name='cantidades[]' value='' class='cantidades' required='true'></td>";
            html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
            html += "</tr>";
            $("#tb-entradas tbody").append(html);
            sumar_pro();
            $("#btn-agregar-entradAlmacen").val(null);
           
        }else{
            alert("seleccione un producto...");
        }
    });


    /*----fin lista de entrada----*/
 
	$('#example1').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });
    

	$('.sidebar-menu').tree();

    mostrar_guia ();


    /*$("#comprobantes").on("change",function(){
        option = $(this).val();

        if (option != "") {
            infocomprobante = option.split("*");
          

            $("#idcomprobante").val(infocomprobante[0]);
            $("#igv").val(infocomprobante[2]);
            $("#serie").val(infocomprobante[3]);
            $("#numero").val(generarnumero(infocomprobante[1]));
        }
        else{
            $("#idcomprobante").val(null);
            $("#igv").val(null);
            $("#serie").val(null);
            $("#numero").val(null);
        }
        sumar();
    }) */

    $(document).on("click",".btn-check",function(){
        cliente = $(this).val();
        infocliente = cliente.split("*");
        $("#idcliente").val(infocliente[0]);
        $("#cliente").val(infocliente[1]);
        $("#modal-default").modal("hide");

        $.ajax({
              type: 'ajax',
              method: 'get',
              url: '<?php echo base_url() ?>ventas/getStockAlcli',
              data: {id_cliente:infocliente[0]},
              async: false,
              dataType: 'json',
            success: function(data){
                var html = '';
                var i;
                var dataProducto ='';
                html +='<option value="" style="color:red" disabled selected>Seleccione..  *</option >';
                for(i=0; i<data.length; i++){
                   dataProducto = data[i].id_producto+"*"+data[i].items+"*"+data[i].nombre_producto+"*"+data[i].stock;
                    html +='<option value="'+dataProducto+'"</option>'+data[i].nombre_producto+'</option>';
                  }
                $('#id_producto_alcl').html(html);
            },
            error: function(){
                 alert('No hay datos q mostrar');
              }
        });

        $.ajax({
              type: 'ajax',
              method: 'get',
              url: '<?php echo base_url() ?>ventas/getAgencias_cli',
              data: {id_cliente:infocliente[0]},
              async: false,
              dataType: 'json',
            success: function(data){
                var html = '';
                var i;
                var dataAgencia ='';
                html +='<option value="" style="color:red" disabled selected>Seleccione..  *</option >';
                for(i=0; i<data.length; i++){
                   dataAgencia = data[i].id_agencia+"*"+data[i].encargado+"*"+data[i].telefono_age+"*"+data[i].direccion;
                    html +='<option value="'+dataAgencia+'"</option>'+data[i].nombre_agencia+'</option>';
                  }
                   $('#agencia').html(html);
                   
            },
            error: function(){
                 alert('No hay datos q mostrar');
              }
        });

    });


    $("#agencia").on("change",function(){
        id_cliente = $(this).val();
        dataAgencia = id_cliente.split("*");
       $("#contacto").val(dataAgencia[1]);
       $("#telf_contacto").val(dataAgencia[2]);
       $("#destino").val(dataAgencia[3]);
    });

  
   /*------inicio de Modulo propuesta--------*/

   $('#propuestas').DataTable({
     dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Listado de Propuestas",
                exportOptions: {
                    columns: [ 0,1,2,3,4 ]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Listado de Propuestas",
                exportOptions: {
                    columns: [ 0,1,2,3,4 ]
                }
                
            }
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

   $("#id_producto_prop").on("change",function(){
       var option = $(this).val();
       $("#btn-agregar_prop").val(option);
    });

   $("#btn-agregar_prop").on("click",function(){
        data = $(this).val();
        if (data !='') {
            infoproducto = data.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
            html += "<td>"+infoproducto[2]+"</td>";
            html += "<td><input type='text' name='cantidades[]' value='' class='cantidades' required='true'></td>";
            html += "<td><input type='text' name='precios[]' value='' class='precios' required='true'></td>";
            html += "<td><input type='hidden' name='importes[]' value=''><p></p></td>";
            html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
            html += "</tr>";
            $("#tbvpropuestas tbody").append(html);
            sumar_pro();
            $("#btn-agregar_prop").val(null);
           
        }else{
            alert("seleccione un producto...");
        }
    });

      $(document).on("keyup","#tbvpropuestas input.precios", function(){
        precio = $(this).val();
        cantidad = $(this).closest("tr").find("td:eq(2)").children("input").val();
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(4)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(4)").children("input").val(importe.toFixed(2));
        sumar_pro();
    });

  function sumar_pro(){
        total = 0;
        $("#tbvpropuestas tbody tr").each(function(){
            total = total + Number($(this).find("td:eq(4)").text());
        });
        $("input[name=total]").val(total.toFixed(2));
   }                

 $(document).on("click",".btn-view-propuesta",function(){
        valor_idpropuesta = $(this).val();
        //alert(valor_id);
        $.ajax({
            url: base_url + "gerencia/detalle_propuesta",
            type:"POST",
            dataType:"html",
            data:{id:valor_idpropuesta},
            success:function(data){
                $("#modal-default .modal-body").html(data);
            }
        });
    });

     $(document).on("click",".btn-print-propuesta",function(){
        $("#modal-default .modal-body").print({
            title:"Comprobante de Propuesta"
        });
    });   


   /*------ fin propuesta--------*/ 

   /*--------categoria---------*/

   $('.btn-edit').on('click', function(){
     // var id = $(this).attr('data');
       var id = $(this).val();
       $('input[name=id_categoria]').val(id);

      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>config_general/editar_cat',
        data: {id: id},
        async: false,
        dataType: 'json',
        success: function(data){
          $('input[name=nombre_categoria]').val(data.nombre_categoria);
        },
        error: function(){
          alert('No se pudo editar');
        }
      });
    });
   //update categoria

    $('#updateCat').click(function(){
            var url = '<?php echo base_url() ?>config_general/udpdateCat';
            var data = $('form').serialize();
            //validate form
          
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                       
                        if(response.success){
                           $('#modal-editCategoria').modal('hide');
                           }else{
                            alert('Error');
                        }
                    },
                    error: function(){
                        alert('No se pudo editar los datos');
                    }
                });
     });
  //eliminar categoria


   $('.btn-deleted').on('click', function(){
     // var id = $(this).attr('data');
       var id = $(this).val();
       $('input[name=id_categoria]').val(id);

      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>config_general/eliminar_cat',
        data: {id: id},
        async: false,
        dataType: 'json',
        success: function(data){
          $('input[name=nombre_categoria]').val(data.nombre_categoria);
        },
        error: function(){
          alert('No se pudo editar');
        }
      });
    });

   /*---------Update Cliente-----------*/

   $('#l_clientes').DataTable({
     dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "Listado de Clientes",
                exportOptions: {
                    columns: [ 0,1,2,3,4 ]
                },
            },
            {
                extend: 'pdfHtml5',
                title: "Listado de Clientes",
                exportOptions: {
                    columns: [ 0,1,2,3,4 ]
                }
                
            }
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
        }
    });

    $('.btn-edit-cli').on('click', function(){
     // var id = $(this).attr('data');
       var id = $(this).val();
       $('input[name=id_cliente]').val(id);

      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>config_general/editar_cli',
        data: {id: id},
        async: false,
        dataType: 'json',
        success: function(data){
          $('input[name=nombre_cli]').val(data.nombre_cli);
          $('input[name=numero]').val(data.numero);
          $('input[name=contacto]').val(data.contacto);
          $('input[name=telefono_cli]').val(data.telefono_cli);
          $('input[name=correo]').val(data.correo); 
          $('textarea[name=direccion_cli]').val(data.direccion_cli); 
          
          
        },
        error: function(){
          alert('No se pudo editar');
        }
      });
    });
   //update clientes
$('#updateCli').click(function(){
            var url = '<?php echo base_url() ?>config_general/udpdateCli';
            var data = $('form').serialize();
                  
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                       
                        if(response.success){

                          $("#clientes_form")[0].reset();
                          new PNotify({
                                  title: 'Exito',
                                  text: 'Datos Actalizados',
                                  type: 'success',
                                  hide: true,
                                  styling: 'bootstrap3'
                              });
                           $('#modal-editCli').modal('hide');
                           setTimeout('document.location.reload()',2000);
                           }else{
                            alert('Error');
                        }
                    },
                    error: function(){
                        alert('No se pudo editar los datos');
                    }
                });
     });

    /*----insertar cliente---------*/
    

    $('#insert_cli').click(function(e){
        e.preventDefault();
            var url = '<?php echo base_url() ?>config_general/insert_cli';
            var data = $('#clientesinset_form').serialize();
                  
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                       
                        if(response.comprobador){

                          $("#clientesinset_form")[0].reset();
                          new PNotify({
                                  title: 'Exito',
                                  text: 'Datos Insertados',
                                  type: 'success',
                                  hide: true,
                                  styling: 'bootstrap3'
                              });
                           $('#modal-insertCli').modal('hide');
                           setTimeout('document.location.reload()',2000);
                           }else{
                            new PNotify({
                                  title: 'Exito',
                                  text: 'Error al insertar',
                                  type: 'error',
                                  hide: true,
                                  styling: 'bootstrap3'
                              });
                        }
                    },
                    error: function(){
                        alert('No se pudo editar los datos');
                    }
                });
     });

    /*insert prov*/

    $('#insert_prov').click(function(e){
        e.preventDefault();
            var url = '<?php echo base_url() ?>config_general/insert_prov';
            var data = $('#insetProv_form').serialize();
                  
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                        if(response.comprobador){

                          $("#insetProv_form")[0].reset();
                          new PNotify({
                                  title: 'Exito',
                                  text: 'Datos Insertados',
                                  type: 'success',
                                  hide: true,
                                  styling: 'bootstrap3'
                              });
                           $('#modal-default').modal('hide');
                           setTimeout('document.location.reload()',2000);
                           }else{
                            new PNotify({
                                  title: 'Exito',
                                  text: 'Error al insertar',
                                  type: 'error',
                                  hide: true,
                                  styling: 'bootstrap3'
                              });
                        }
                    },
                    error: function(){
                        alert('No se pudo editar los datos');
                    }
                });
     });

    /*-----insertar categoria----*/

     $('#insert_cat').click(function(e){
        e.preventDefault();
            var url = '<?php echo base_url() ?>config_general/insert_cat';
            var data = $('#insetCat_form').serialize();
                  
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                        if(response.comprobador){
                          $("#insetCat_form")[0].reset();
                          new PNotify({
                                  title: 'Exito',
                                  text: 'Datos Insertados',
                                  type: 'success',
                                  hide: true,
                                  styling: 'bootstrap3'
                              });
                           $('#modal-categoria').modal('hide');
                           setTimeout('document.location.reload()',2000);
                           }else{
                            new PNotify({
                                  title: 'Exito',
                                  text: 'Error al insertar',
                                  type: 'error',
                                  hide: true,
                                  styling: 'bootstrap3'
                              });
                        }
                    },
                    error: function(){
                        alert('No se pudo editar los datos');
                    }
                });
     });


     /*------insertar productos-----*/

     $('#insert_prod').click(function(e){
        e.preventDefault();
            var url = '<?php echo base_url() ?>config_general/insert_prod';
            var data = $('#insetProd_form').serialize();
                  
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                        if(response.comprobador){
                          $("#insetProd_form")[0].reset();
                          new PNotify({
                                  title: 'Exito',
                                  text: 'Datos Insertados',
                                  type: 'success',
                                  hide: true,
                                  styling: 'bootstrap3'
                              });
                           $('#modal-producto').modal('hide');
                           setTimeout('document.location.reload()',2000);
                           }else{
                            new PNotify({
                                  title: 'Exito',
                                  text: 'Error al insertar',
                                  type: 'error',
                                  hide: true,
                                  styling: 'bootstrap3'
                              });
                        }
                    },
                    error: function(){
                        alert('No se pudo editar los datos');
                    }
                });
     });




    
   /*-----------------salida almacen clientes----------------*/

    $("#id_producto_alcl").on("change",function(){
       var option = $(this).val();
       $("#btn-agregar_alcli").val(option);
    });

    $('#btn-agregar_alcli').click(function () {
        data = $(this).val();
        if (data !='') {
            infoproducto = data.split("*");
            html = "<tr>";

            html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
            html += "<td>"+infoproducto[2]+"</td>";
            html += "<td>"+infoproducto[3]+"</td>";
            html += "<td><input type='text' name='cantidades[]' value='' class='cantidades' required='true'></td>";
            html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
            html += "</tr>";
            $("#tbsalidaAlcli tbody").append(html);
            sumar_pro();
            $("#btn-agregar_alcli").val(null);
           
        }else{
            alert("seleccione un producto...");
        }
    });

    /*-----------agregar cliente----------*/

    
   



  
  /*-------------venta-----------------*/

    $("#id_producto").on("change",function(){
       var option = $(this).val();
       $("#btn-agregar").val(option);
    });

    $('#btn-agregar').click(function () {
        datos = $(this).val();
        if (datos !='') {
            infoproducto = datos.split("*");
            var id_cliente = $('input[name=idcliente]').val();
               
            $.ajax({
                url: base_url + "ventas/getPrecioCliente",
                type:"GET",
                data:{id_cliente:id_cliente,id_producto:infoproducto[0]},

                success:function(data){
                    var obj = jQuery.parseJSON(data);
                    if (obj == false){
                        mostrar_precio(0);
                    }else{
                         mostrar_precio(obj.precio_cli);
                         }
                   
                    }               
               })
        }else{
            alert("seleccione un producto...");
        }
    });

     function mostrar_precio(precio){
        var cantidad = infoproducto[4];
        var importe = cantidad * precio;
        var html = '';
        html = "<tr>";
        html += "<td><input type='hidden' name='idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
        html += "<td>"+infoproducto[2]+"</td>";
        html += "<td>"+infoproducto[4]+"</td>";
        html += "<td><input type='text' name='cantidades[]' value='"+infoproducto[4]+"' class='cantidades'></td>";
        html += "<td><input type='text' name='precios[]' value='"+precio+"' class='precios' required='true'></td>";
        html += "<td><input type='hidden' name='importes[]' value='"+importe+"'><p>"+importe+"</p></td>";
        html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span></button></td>";
        html += "</tr>";

        $("#tbventas tbody").append(html);
         sumar_venta();
        $("#btn-agregar").val(null);
     }


    $(document).on("keyup","#tbventas input.precios", function(){
        precio = $(this).val();
        cantidad = $(this).closest("tr").find("td:eq(3)").children("input").val();
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
        sumar_venta();
    });

    $(document).on("keyup","#tbventas input.cantidades", function(){
        cantidad = $(this).val();
        precio = $(this).closest("tr").find("td:eq(4)").children("input").val();
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
        sumar_venta();
    });

    $(document).on("click",".btn-remove-producto", function(){
        $(this).closest("tr").remove();
        sumar();
    });
    
    $(document).on("click",".btn-view-venta",function(){
        valor_id = $(this).val();
        //alert(valor_id);
        $.ajax({
            url: base_url + "ventas/view",
            type:"POST",
            dataType:"html",
            data:{id:valor_id},
            success:function(data){
                $("#modal-default .modal-body").html(data);
            }
        });
    });

    $(document).on("click",".btn-view-guia",function(){
        valor_id = $(this).val();
        //alert(valor_id);
        $.ajax({
            url: base_url + "ventas/view_guia",
            type:"POST",
            dataType:"html",
            data:{id:valor_id},
            success:function(data){
                $("#modal-default .modal-body").html(data);
            }
        });
    });

    $(document).on("click",".btn-print",function(){
        $("#modal-default .modal-body").print({
            title:"Comprobante de Venta"
        });
    });
})

 function sumar_venta(){
        total = 0;
        $("#tbventas tbody tr").each(function(){
            total = total + Number($(this).find("td:eq(5)").text());
        });
        $("input[name=total]").val(total.toFixed(2));
   }        

function generarnumero(numero){
    if (numero>= 99999 && numero< 999999) {
        return Number(numero)+1;
    }
    if (numero>= 9999 && numero< 99999) {
        return "0" + (Number(numero)+1);
    }
    if (numero>= 999 && numero< 9999) {
        return "00" + (Number(numero)+1);
    }
    if (numero>= 99 && numero< 999) {
        return "000" + (Number(numero)+1);
    }
    if (numero>= 9 && numero< 99) {
        return "0000" + (Number(numero)+1);
    }
    if (numero < 9 ){
        return "00000" + (Number(numero)+1);
    }
}

 /*----------fin venta-----------*/ 

 /*-----------movimientos entrada_salida----------*/




function mostrar_mov(data){
        
     var html = '';
    $.each(data,function(key, value){    
        html = "<tr>";
        html += "<td>"+value.fecha+"</td>";
        html += "<td>"+value.cantidad_entrada+"</td>";
        html += "<td>"+value.cantidad_salida+"</td>";
        html += "</tr>";
    });    
        $("#movi_ent_sal tbody").html(html);
     }

 

  

 /*----------fin movimientos entrada_salida----------*/

function datagrafico(base_url,year){
    namesMonth= ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"];
    $.ajax({
        url: base_url + "dashboard/getData",
        type:"POST",
        data:{year: year},
        dataType:"json",
        success:function(data){
            var meses = new Array();
            var montos = new Array();
            $.each(data,function(key, value){
                meses.push(namesMonth[value.mes - 1]);
                valor = Number(value.monto);
                montos.push(valor);
            });
            graficar(meses,montos,year);
        }
    });
}

function graficar(meses,montos,year){
    Highcharts.chart('grafico', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Monto acumulado por las ventas de los meses'
    },
    subtitle: {
        text: 'Año:' + year
    },
    xAxis: {
        categories: meses,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Monto Acumulado ( Bolivianos )'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
            '<td style="padding:0"><b>{point.y:.2f} Bs</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series:{
            dataLabels:{
                enabled:true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,2)
                }

            }
        }
    },
    series: [{
        name: 'Meses',
        data: montos

    }]
});
}

/*grafico de comsumo mensual*/

function datagrafico_consumo(base_url,year,id_producto){
    namesMonth= ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Set","Oct","Nov","Dic"];
    $.ajax({
        url: base_url + "dashboard/getDataConsumo",
        type:"POST",
        data:{year: year,id_producto:id_producto},
        dataType:"json",
        success:function(data){
            var meses = new Array();
            var montos = new Array();
            $.each(data,function(key, value){
                meses.push(namesMonth[value.mes - 1]);
                valor = Number(value.monto);
                montos.push(valor);
            });
            graficar_consumo(meses,montos,year);
        }
    });
}

function graficar_consumo(meses,montos,year){
    Highcharts.chart('grafico_consumo', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Monto acumulado consumo mesual'
    },
    subtitle: {
        text: 'Año:' + year
    },
    xAxis: {
        categories: meses,
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Monto Acumulado'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">Cantidad: </td>' +
            '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        },
        series:{
            dataLabels:{
                enabled:true,
                formatter:function(){
                    return Highcharts.numberFormat(this.y,2)
                }

            }
        }
    },
    series: [{
        name: 'Meses',
        data: montos

    }]
});
}

function mostrar_guia(){

   var parametro = $('#valor').val();
   var base_url= "<?php echo base_url();?>";
   $.ajax({
    url: base_url + "ventas/getguia/"+parametro,
    success: function(data) {
        //console.log(data);
       var obj = JSON.parse(data);
            $('#comp').val(obj.nombre);   
            $("#idcomprobante").val(obj.id);
            $("#igv").val(obj.igv);
            $("#serie").val(obj.serie);
            $("#numero").val(generarnumero(obj.cantidad));
           
    },
    error: function() {
        console.log("No se ha podido obtener la información");
    }
});

}

/* -------------------------- */
</script>
</body>
</html>
