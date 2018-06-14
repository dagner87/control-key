
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Movimientos <small>de productos por clientes</small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                     <form action="" method="GET" class="form-horizontal">
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
                                    <label for="">Clientes:</label>
                                    <select name="clientes" id="" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        <?php foreach($clientes as $fila):?> 
                                            <option value="<?php echo $fila->id_cliente;?>"><?php echo $fila->nombre_cli?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                             
                                <div class="col-md-3">
                                    <label for="">Mes:</label>
                                    <select name="mes" id="mes" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        <option value="1">Enero</option>
                                        <option value="2">Febrero</option>
                                        <option value="3">Marzo</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Mayo</option>
                                        <option value="6">Junio</option>
                                        <option value="7">Julio</option>
                                        <option value="8">Agosto</option>
                                        <option value="9">Septiembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Noviembre</option>
                                        <option value="12">Diciembre</option>
                                       
                                        
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-buscar" type="" class="btn btn-info btn-flat btn-block"><span class="fa fa-search"></span> Buscar</button>
                                </div>
                            </div>
                            </form> 
                            
                            <table id="movi_ent_sal" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <!--tr >
                                        <th bgcolor="#0099CC"colspan="4" ><div align="center"><p>Rollos 80x80</p></div></th>
                                       
                                    </tr-->
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Entrada</th>
                                        <th>Salida</th>
                                        <th>Destino</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                            </div>
                       
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
