
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Entradas 
        <small></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url();?>ventas/add_entrada" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Nueva Entrada</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="l_entrada" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha entrada</th>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($entradas)): ?>
                                    <?php
                                    $cont = 1;
                                     foreach($entradas as $entrada):?>
                                        <tr>
                                            <td><?php echo $entrada->fecha_entrada;?></td>
                                            <td><?php echo $entrada->items;?></td>
                                            <td><?php echo $entrada->nombre_producto;?></td>
                                            <td><?php echo $entrada->cantidad;?></td>
                                            <td>
                                              <button type="button" class="btn btn-info btn-view-venta"  title="Ajustes" value="<?php echo $entrada->id_entrada;?>" data-toggle="modal" data-target="#modal-ajustes"><span class="fa fa-edit"></span></button>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>  
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-ajustes">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ajustes de entrada</h4>
      </div>
      <div class="modal-body">
         <form id="modfecha_Pedido_form" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
              <?php 
               $data = array('id_pedido_prov'=>'');
               echo form_hidden($data);
               ?>

          <div class="form-group">
              <div class="col-xs-12">
                <label for="fecha_key" class="label-control">Cantidad:<span style="color:red">*</span></label>
                 <?php
                 $data = array(
                    'type'  => 'text',
                    'name'  => 'cantidad',
                    'id'    => 'cantidad',
                    'value' => '',
                    'class' => 'form-control',
                     'required'=>'true'
                      );
                  echo form_input($data);
                 ?> 
              </div>
             
          </div>

            <div class="form-group">
               <div class="col-xs-12">
                 <label for="costo_aereo" class="label-control">Observación:<span style="color:red">*</span></label>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary"><span class=""> </span>Actualizar</button>
      </div>
        </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


