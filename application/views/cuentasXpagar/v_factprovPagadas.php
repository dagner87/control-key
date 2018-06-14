
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        Dashboard
          <small>Panel de Control</small>
        </h1>
        
        <ol class="breadcrumb">
                    <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard">Incio</i></a></li>
                   <li class="active">Facturas de Proveedores</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <div class="row">
            <!--Factuas por pagar-->
           <div class="col-xs-12">
            <div class="box box-success">
              <div class="box-header">
                <h3 class="box-title"><strong>Facturas de Proveedores Pagadas</strong>&nbsp;</h3>
                 <a class="btn btn-default" href='<?php echo site_url('comprador/facturas_proveedores')?>' title='Facturas de Proveedores'><i class="fa fa-reply"> </i> Atrás </a>
                
                
                 <button type="button" name="btnprint" id="btnprint" onclick="printDiv('areaImprimir')" class="btn btn-info pull-right" style="margin-right: 5px;">
              <i class="fa fa-print"> </i>  Imprimir
              </div>
              <!-- /.box-header -->
              <div class="box-body" id="areaImprimir">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                 
                    <th>Proveedor</th>
                    <th>No. Fatura</th>
                     <th>Producto</th>
                    <th>Imp.Factura $</th>
                    <th>Fecha Pagada</th>
                   <?php 
                  if ($this->uri->segment(2)=='facturas_proveedoresPagadas') {
                      echo "<th>Observacion</th>";
                     }
                      ?>
                    <th>Estado</th>
                  </thead>
                  <tbody>

                   <?php  
                    if (empty($arraypedidosKey)!="false")
                    {
                      $arraypaq =[];
                      $productos=null;
                      $costo_total=0;
                      $tren['vagon_datosTrasito'] = NULL;    
                    foreach($arraypedidosKey as $item):
                    ?>
                      <tr>
                      <?php  
                       $result_datospaquete = $this->modelogeneral->listar_paquete_pedidos($item->id_paquete);

                        foreach($result_datospaquete as $paq_ped):
                          $datos_producto = $this->modelogeneral->tomar_producto($paq_ped->id_pedido_prov);
                          $datos_proveedor = $this->modelogeneral->datos_proveedor($datos_producto->id_proveedor);
                          $productos.= $datos_producto->nombre_producto."<br>";
                          $costo_total+= $datos_producto->costo_total;
                         endforeach;
                      ?> 
                      <td><?= $datos_proveedor->nombre_prove;?></td>
                     
                        <?php if ($item->factura_doc != null) {?>
                      <td ><a  class="fact" target='_blank' title="Ver factura adjunta" href='<?= base_url('assets/uploads/respaldos').'/'. $item->factura_doc ?>'><?= $item->no_factura;?></a></td>    
                        <?php }else {?>
                           <td ><?= $item->no_factura;?></td>  

                       <?php } ?>
                       
                      <td><?=  $productos."<br>" ;?></td>
                      <td><?= "$ ".$costo_total;?></td>
                     
                      <?php
                        $fecha_actual = date('Y-m-d');
                         
                       ?>
                        <td><span style='font-size: 1em;' class=""><?= $item->fecha_pago_fact;?></span></td>
                      <?php if ($item->estado_pagado==1){ ?>
                        <td><?= $item->observacion;?></td> 
                        <td>
                          <div class=''><span class="label label-success" style='font-size: 1em;'>FACTURA PAGADA</span></div></td> 
                       
                       <?php  }else{echo " <td><div class=''><span class='label label-danger' style='font-size: 1em;'>NO SE HA PAGADO</span></div></td>";}?>
                       </td>
                  
                  <?php 
                  $productos=null;
                  $costo_total=0;
                  endforeach; 
                           }?>
                  </tr>
                  </tbody>
                  
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
           </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
  </div>
  <div id="agregar_fechapagoFat" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header box box-info">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class='row'>
          <div class='col-md-4'>
          
          </div>
          <div class='col-md-8'>
           <h4 class="modal-title" id="aereo">Pago de Factura</h4>
          </div>
        </div>
        
      </div>
      <div class="modal-body">
       
          <form id="agregar_fechapagoFat_form" action="" method="post" class="form-horizontal">
            <div class="form-group">
              <?php 
                 $data = array('id_paquete'=>'');
                 echo form_hidden($data);

              ?>
              <label for="fecha_pago_fact" class="label-control col-md-4">Fecha de Pago de Factura</label>
              <div class="col-md-8">
               <?php
               $data = array(
                  'type'  => 'date',
                  'name'  => 'fecha_pago_fact',
                  'id'    => 'fecha_pago_fact',
                  'value' => '',
                  'class' => 'form-control'
                    );
                echo form_input($data);
               ?> 
             </div>
            </div>

            <div class="form-group">
               <div class="col-xs-12">
                 <label for="observacion" class="label-control">Observación:<span style="color:red">*</span></label>
                  <?php                 
                      $data = array(
                                    'type'  => 'text',
                                    'name'  => 'observacion',
                                    'id'    => 'observacion',
                                    'value' => '',
                                    'class' => 'form-control',
                                    'required'=>'true'
                                   );
                      echo form_textarea($data);
                  ?> 
               </div>
            </div>
            

          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnSave_factura" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
 
<!-- page script -->
<script>
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



  function agregar_costos(id_paquete)
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
      var observacion  = $('input[name=observacion]');
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


    function printDiv(nombreDiv) {

     $('#example1_filter').addClass('hidden');
     $('.fact').each(function() {
      $(this).data('href', $(this).attr('href')).removeAttr('href');
     });
    
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
</script>
