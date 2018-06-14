
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Nueva Salida 
        <small>de Productos Almacen Cliente</small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        
                     <form action="<?php echo base_url();?>ventas/salida_almacenCli" method="POST" class="form-horizontal">
                            <div class="form-group">
                              
                                <div class="col-md-3">
                                    <label for=""></label>
                                    <input type="text" class="form-control" style="" id="comp" name="comp" readonly>
                                    <input type="hidden" id="idcomprobante" name="idcomprobante">
                                    <input type="hidden" id="igv">
                                    <input type="hidden" id="valor" value="g">

                                </div>
                                <div class="col-md-3">
                                    <label for="">Serie:</label>
                                    <input type="text" class="form-control" id="serie" name="serie" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="">Numero:</label>
                                    <input type="text" class="form-control" id="numero" name="numero" readonly>
                                </div>
                                 
                            </div>
                            <div class="form-group"  >
                                <div class="col-md-6" >
                                    <label for="">Cliente:</label>
                                    <div class="input-group">
                                        <input type="hidden" name="idcliente" id="idcliente">
                                        <input type="text" class="form-control" disabled="disabled" id="cliente">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#modal-default" ><span class="fa fa-search"></span> Buscar</button>
                                        </span>
                                    </div><!-- /input-group -->
                                </div> 
                                <div class="col-md-3">
                                    <label for="">Fecha:</label>
                                    <input type="date" class="form-control" name="fecha" required>
                                </div>
                            </div>
                            <div class="form-group">
                               <div class="col-md-6" id="">
                                
                                    <label for="">Seleccione Agencia:</label>
                                    <select name="agencia" id="agencia" class="form-control" required>
                                        <option value="">Seleccione...</option>
                                        
                                    </select>
                             <br>
                                <label>Nombre Contacto:</label>
                                 <input type="text" name="contacto" id="contacto" class ="form-control" value="" placeholder="Nombre contacto" required>
                                 <br>
                                <label>Teléfono:</label>
                                <input type="text" name="telf_contacto" id="telf_contacto" class ="form-control" 
                                value="" placeholder="Teléfono contacto" required>
                               </div>

                               <div class="col-md-3">
                                    <label for="">Dirección de despacho:</label>
                                  <textarea style="margin: 0px -3.75px 0px 0px; width: 386px; height: 92px;" type="text" name="destino" id="destino" class ="form-control" value="" placeholder="Dirección de despacho" required ></textarea>
                                </div>  
                            </div>    
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Selecione Producto:</label>
                                    <select class="form-control select2" style="" name="id_producto_alcl" id="id_producto_alcl" required>
                                  </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="">&nbsp;</label>
                                    <button id="btn-agregar_alcli" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                                </div>
                            </div>
                            <table id="tbsalidaAlcli" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Stock Actual.</th>
                                        <th>Cantidad</th>
                                        <th></th>
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
