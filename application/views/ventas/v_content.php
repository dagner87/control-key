
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Stock 
        <small>Listado</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url();?>ventas/add_venta" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Acción</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="stocks" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Stock</th>
                                    <th>Fecha entrada</th>
                                     <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($stock)): ?>
                                    <?php
                                    $cont = 1;
                                     foreach($stock as $stocks):?>
                                        <tr>
                                            <td><?php echo $cont++;?></td>
                                            <td><?php echo $stocks->nombre_producto;?></td>
                                            <td><?php echo $stocks->cantidad_solicitada;?></td>

                                            <td>
                                              <?php 
                                              echo $stocks->fecha_key;
                                             //echo $fecha_key = date("d/m/Y", strtotime("$stocks->fecha_key"));
                                              ?></td>
                                              <td>
                                               <?php 
                                               if ($stocks->estado_pagado == 0) { ?>
                                                 <span style='font-size: 1em;' class="label label-warning">NO FACTURADO</span>

                                              <?php }else {?>
                                               <span style='font-size: 1em;' class="label label-success">FACTURADO</span>
                                               <?php }?>
                                            </td>
                                              
                                            <td>
                                               <button type="button" class="btn btn-success btn-view-venta"  title="Ver Detalles" value="<?php echo $stocks->id_pedido_prov;?>" data-toggle="modal" data-target="#modal-default"><span class="fa fa-eye"></span></button>
                                               
                                                <button type="button" class="btn btn-info btn-view-venta"  title="Ajustes" value="<?php echo $stocks->id_pedido_prov;?>" data-toggle="modal" data-target="#modal-default"><span class="fa fa-edit"></span></button>

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

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Informacion de la venta</h4>
      </div>
      <div class="modal-body">

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print"><span class="fa fa-print"> </span>Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


