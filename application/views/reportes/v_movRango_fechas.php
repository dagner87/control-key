
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Rango de Movimientos 
        <small>de Productos Almacen Cliente</small></h1> 
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        
                    <form action="<?php echo current_url();?>" method="post" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="">Selecione Producto:</label>
                                    <select name="id_producto" id="" class="form-control select2" required>
                                        <option value="">Seleccione...</option>
                                        <?php foreach($productos as $fila):?> 
                                            <option value="<?php echo $fila->id_producto;?>"><?php echo $fila->nombre_producto?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                 <label for="" class="col-md-1 control-label">Desde:</label>
                                  <input type="date" class="form-control" name="fechainicio" value="<?php echo !empty($fechainicio) ? $fechainicio:'';?>">
                                 </div>
                           
                                <div class="col-md-3">
                                    <label for="" class="col-md-1 control-label">Hasta:</label>
                                    <input type="date" class="form-control" name="fechafin" value="<?php  echo !empty($fechafin) ? $fechafin:'';?>">
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                     <input type="submit" name="buscar" value="Buscar" class="form-control btn btn-primary">
                                </div>
                             </div>
                           </form>   
                            <table id="movi_ent_sal" class="table table-bordered table-striped table-hover">
                                <thead>
                                    
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Entrada</th>
                                        <th>Salida</th>
                                         <th>Saldo</th>
                                        <th>Destino</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($movimientos)): ?>
                                    <?php 
                                    $saldo = 0;
                                    foreach($movimientos as $mov):?>
                                        <tr>
                                            <td><?= $mov->fecha;?></td>
                                            <td><?= $mov->cantidad_entrada;?></td>
                                            <td><?= $mov->cantidad_salida;?></td>
                                            <td><?= $mov->saldo;?></td>
                                            <td><?= $mov->direccion; ?></td>
                                           
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
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lista de Clientes</h4>
            </div>
            <div class="modal-body">
                 <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($clientes)):?>
                            <?php foreach($clientes as $cliente):?>
                                <tr>
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
