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
                 <li class="active">Facturas de Transporte Bolivia </li>
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
               <button type="button" name="btnprint" id="btnprint" onclick="printDiv('areaImprimir')" class="btn btn-info pull-right" style="margin-right: 5px;">
            <i class="fa fa-print"> </i>  Imprimir
            </div>
             <!-- /.box-header -->
            <div class="box-body" id="areaImprimir">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Factura Transporte</th>
                  <th>Monto</th>
                  <th>Fecha Pagada</th>
                  <th>Observacion</th>
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
                   <td><?= $item->fecha_pago ?></td>
                   <td><?= $item->observacion;?></td> 
                   <td><div class=''><span class="label label-success" style='font-size: 1em;'>FACTURA PAGADA</span></div></td>
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
</body>
</html>
