$(function () {
    $("#example1").DataTable({
      "language": {
            "lengthMenu": "Mostrar _MENU_registros por página",
            "zeroRecords": "No se encontró nada - lo siento",
            "info": "Mostrando la página_PAGE_ of _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ Total de registros)"
          }
    });
    
  });


  function pagar_fact(id_transporte_ext)
     {
      $('#agregar_fechapagoFat').modal('show');
      $('#agregar_fechapagoFat_form').attr('action','<?php echo base_url() ?>gerencia/update_fact');
      $('input[name=id_paquete]').val(id_paquete);
     }
  
  $('#btnSave_factura').click(function(){
      var url = $('#agregar_fechapagoFat_form').attr('action');
      var data = $('#agregar_fechapagoFat_form').serialize();
      //validate form
      var id_paquete   = $('input[name=id_paquete]');
      var fecha_pago_fact  = $('input[name=fecha_pago_fact]');
      var result = '';
      if(fecha_pago_fact.val()==''){
        fecha_pago_fact.parent().parent().addClass('has-error');
      }else{
        fecha_pago_fact.parent().parent().removeClass('has-error');
        result +='1';
      }
      if(result=='1'){
        $.ajax({
          type: 'ajax',
          method: 'post',
          url: url,
          data: data,
          async: false,
          dataType: 'json',
          success: function(response){
            if(response.success){
              $('#agregar_fechapagoFat').modal('hide');
              $('#agregar_fechapagoFat_form')[0].reset();
              if(response.type=='add'){
                var type = 'agregados'
              }
              if(response.type=='update'){
                var type = 'actualizada'
              }
              $('#list-report-success').html('<p> Fecha  '+type+'  exitosamente </p>').fadeIn().delay(4000).fadeOut('slow');
              location.reload();
            }else{
              alert('Error');
            }
          },
          error: function(){
            alert('No se han podido agregar datos');
          }
        });
      }
    });

  