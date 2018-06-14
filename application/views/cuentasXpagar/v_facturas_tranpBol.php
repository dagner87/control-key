 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Dashboard
        <small>Panel de Control</small>
      </h1>
      
      <ol class="breadcrumb">
                  <li><a href="<?php echo site_url(); ?>"> <i class="fa fa-dashboard"> Incio</i></a></li>
                 <li class="active">Facturas de Aduana Perú</li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="alert alert-success" style="display: none;" id="list-report-success"></div>
        
          <!--Factuas por pagar-->
     <div class="col-xs-12">
          <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title"><strong>Facturas de Transporte Bolivia </strong> &nbsp;</h3>
               <a class="btn btn-success" href='<?php echo site_url('comprador/facturas_PagasTransBol')?>' title='Ver Facturas Pagadas'><i class="fa fa-inbox"> </i> Facturas Pagadas </a>
              
               <button type="button" name="btnprint" id="btnprint" onclick="printDiv('areaImprimir')" class="btn btn-info pull-right" style="margin-right: 5px;">
            <i class="fa fa-print"> </i>  Imprimir
            </div>
             <!-- /.box-header -->
            <div class="box-body" id="areaImprimir">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <tr>
                  <td></td>
                  <th>Factura Transporte</th>
                  <th>Monto</th>
                  <th>Fecha Tope de Pago</th>
                  <th>Fecha Pagada</th>
                  <?php   

                   if ($this->uri->segment(2)=='facturas_PagasTransBol') {
                    echo "<th>Observacion</th>";
                   }
                  ?>

                  <th>Estado</th>
                </thead>
                <tbody>
                 <?php  
                  if (empty($arrayFactTransBol)!="false")
                  {
                   
                    $tren['vagon_datosTrasito'] = NULL; 
                    $parametro ="pago_aduana_bol";
                    $fecha_entrega =NUll;

                  foreach($arrayFactTransBol as $item):
                   $row['parametro'] = $this->modelogeneral->tomar_datosPaquete($item->id_paquete);
                  
                  $fecha_entrega = $row['parametro']->fecha_salidaAd;
                    
                  ?>
                    <tr>
                      
                       <?php 
                         if ($item->estado_pago==1) {
                         echo "<td>&nbsp;&nbsp;</td>";
                       }else{ 
                            echo "<td>";
                            echo" <button id='pagarfact' class='btn btn-block btn-info btn-sm' onclick='pagar_facturaTransBol(".$item->id_mercatransbol.")' title='Confirmar Pago'><i class='fa fa-dollar'> Pagar</i></button>";
                            echo"</td>";
                           }
                      
                    ?> 
                    <td>
                      <div class='row'>
                        <div class='col-md-8'>
                       <span style='font-size: 1em;' class=''><strong><?= $item->no_factura_traint;?></strong></span>
                         </div> 
                        <div class='col-md-4'>
                          <?php 
                          echo"<button class='btn btn-default eye' id='verfact' onclick='mostrar_detalle(".$item->id_paquete.")' title='Ver detalles'><i class='fa fa-eye'></i>
                           </button>";
                            ?>
                         </div>    
                      </div> 
                   </td>
                   <td><?= $item->costo_transporte_bol ?></td>
                    <?php
                      $fecha_actual = date('Y-m-d');
                    
                      $dia_alerta['parametro']= $this->modelogeneral->valor_configuracion($parametro);
                      $dia = $dia_alerta['parametro']->valor;
                     
                      $fecha_top_pago = date("Y-m-d", strtotime("$fecha_entrega + $dia day"));

                       if ($fecha_actual > $fecha_top_pago &&  $item->estado_pago == 0){ ?>
                           <td><span style='font-size: 1em;' class="label label-warning"><?= $fecha_top_pago;?></span></td>

                        <?php  }elseif ($item->estado_pago == 1) { ?>
                           <td><span style='font-size: 1em;' class=""><?= $fecha_top_pago;?></span></td>
                           <?php  }
                        elseif ($fecha_actual <= $fecha_top_pago) {  ?>
                           <td><span style='font-size: 1em;' class=""><?= $fecha_top_pago;?></span></td>
                           <?php  }  ?>
                     
                      <td><span style='font-size: 1em;' class=""><?= $item->fecha_pago;?></span></td>
                      
                      <?php if ($item->estado_pago==1){ ?>
                        <td><?= $item->observacion_transpBol;?></td> 
                        <td><div class=''><span class="label label-success" style='font-size: 1em;'>FACTURA PAGADA</span></div></td>
                       
                     <?php  }else{echo "<td><div class=''><span class='label label-danger' style='font-size: 1em;'>NO SE HA PAGADO</span></div></td>";}?>
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
                 $data = array('id_mercatransbol'=>'');
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
  <!-- Mostrar de talles de las facturas -->
  <div id="mostrar_detallesFact" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content  box box-solid box-info">
      <div class="modal-header box-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="box-title" align="center" id="aereo">Detalle de factura</h4>
      </div>
      <div class="modal-body">
        <table class='table table-responsive table-bordered'>
         <thead>
        <tr>
          <th colspan=''><strong>Factura Proveedor</strong></th>
          <th colspan=''><strong>Respaldo</strong></th>
           
        </tr>
        </thead>
        <tbody id="lista">

        </tbody>
      </table>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<script>
 
   

  function pagar_facturaTransBol(id_mercatransbol)
     {
      $('#agregar_fechapagoFat').modal('show');
      $('#agregar_fechapagoFat_form').attr('action','<?php echo base_url() ?>comprador/update_PagofacTransBol');
      $('input[name=id_mercatransbol]').val(id_mercatransbol);
     }
  
  $('#btnSave_factura').click(function(){
      var url = $('#agregar_fechapagoFat_form').attr('action');
      var data = $('#agregar_fechapagoFat_form').serialize();
      //validate form
      var id_mercatransbol = $('input[name=id_mercatransbol]');
      var fecha_pago_fact  = $('input[name=fecha_pago_fact]');
      var observacion      = $('input[name=observacion]');

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

    function mostrar_detalle(id_paquete)
     {
      $('#mostrar_detallesFact').modal('show');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/showdatosfact',
        data: {id_paquete: id_paquete},
        async: false,
        dataType: 'json',
        success: function(data){
           $('#lista').html(data);
           },
        error: function(){
          alert('No se ha podido editar');
        }
      });

    }


    function printDiv(nombreDiv) {

     $('#example1_filter').addClass('hidden');
     $('.eye').addClass('hidden');
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}

    
</script>

