
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Movimientos entre
        <small>entre almacenes</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                    <form action="<?php echo base_url();?>ventas/guardar_entradaAlmacen" method="POST" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="fecha">Fecha:</label>
                                    <input type="date" class="form-control" name="fecha" required>
                                </div>
                                <div class="col-md-6" >

                                    <label for="">Almacen de Destino:</label>
                                     <select class="form-control select2" style="" name="id_almacen" id="id_almacen" required="true">
                                    <option value='1'>Almacen Santa Cruz</option>
                                    <option value='2'>Almacen La Paz</option>
                                     </select>
                                </div> 
                            </div>
                           
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="id_producto_entrada"> Seleccione Producto:</label>
                                  
                                    <select class="form-control select2" style="" name="id_producto_entradAlmacen" id="id_producto_entradAlmacen" required="true">
                                    <option value=" ">Seleccionar Producto</option>
                                     <?php
                                      foreach ($productos as $fila) :
                                         $dataProducto = $fila->id_producto."*".$fila->codigo."*".$fila->nombre."*".$fila->stock;?>
                                      ?>
                                        <option value='<?= $dataProducto?>'><?php echo $fila->nombre ?></option>
                                         
                                     <?php
                                      endforeach;
                                      ?>
                                  </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-agregar-entradAlmacen" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                                </div>
                            </div>
                            <table id="tb-entradas" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Stock Actual</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>

                           <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                </div>
                                
                            </div>
                        </form>
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
                <h4 class="modal-title">Lita de Clientes</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($clientes)):?>
                            <?php foreach($clientes as $cliente):?>
                                <tr>
                                    <td><?php echo $cliente->id_cliente;?></td>
                                    <td><?php echo $cliente->nombre_cli;?></td>
                                    <td><?php echo $cliente->numero;?></td>
                                    <?php $datacliente = $cliente->id_cliente."*".$cliente->nombre_cli."*".$cliente->tipocliente."*".$cliente->tipodocumento."*".$cliente->numero."*".$cliente->telefono_cli;?>
                                    <td>
                                        <button type="button" class="btn btn-success btn-check" value="<?php echo $datacliente;?>"><span class="fa fa-check"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
