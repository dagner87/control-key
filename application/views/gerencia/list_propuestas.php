
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Listado 
        <small>Propuestas</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url();?>gerencia/add_propuesta" class="btn btn-primary btn-flat"><span class="fa fa-plus"></span> Agregar Propuesta</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="propuestas" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No Propuesta</th>
                                    <th>Nombre Cliente</th>
                                    <th>Fecha Propuesta</th>
                                    <th>Fecha Caducidad</th>
                                    <th>Total</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($propuestas)): ?>
                                    <?php foreach($propuestas as $propuesta):
                                    $fecha_propuesta = $propuesta->fecha_propuesta;
                                    $dias = $propuesta->duracion;
                                    $duracion = date("Y-m-d", strtotime("$fecha_propuesta + $dias day"));
                                ?>
                                        <tr>
                                            <td><?php echo $propuesta->no_propuesta;?></td>
                                            <td><?php echo $propuesta->nombre_cli;?></td>
                                            <td><?php echo $propuesta->fecha_propuesta;?></td>
                                            <td><?php echo $duracion;?></td>
                                            <td><?php echo $propuesta->total;?></td>
                                            <td>
                                                <button type="button" class="btn btn-info btn-view-propuesta" value="<?php echo $propuesta->id_propuesta;?>" data-toggle="modal" data-target="#modal-default"><span class="fa fa-search"></span></button>
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
        <h4 class="modal-title">Detalle de la propuesta</h4>
      </div>
      <div class="modal-body">

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary btn-print-propuesta"><span class="fa fa-print"> </span>Imprimir</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
