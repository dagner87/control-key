
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Proveedores
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
                       
                        <a type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> Agregar Nueva</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                   
                                    <th>Proveedor</th>
                                    <th>Teléfono</th>
                                     <th>Tiempo Pago Facturas</th>
                                    <th>Dirección</th>
                                    <!--th>Opciones</th-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($proveedores)): ?>

                                    <?php
                                    $cont = 1;
                                     foreach($proveedores as $fila):?>
                                        <tr>
                                            <td><?php echo $fila->nombre_prove ;?></td>
                                            <td><?php echo $fila->telefono;?></td>
                                            <td><?php echo $fila->tiemp_pag_facts;?></td>
                                            <td><?php echo $fila->direccion_prove;?></td>
                                           
                                            <!---td>
                                                 <button type="button" class="btn btn-info btn-edit" value="<?php echo $fila->id_proveedor;?>" data-toggle="modal" data-target="#modal-editCategoria" title ="Editar Producto"><span class="fa fa-edit"></span></button-->
                                                  <!--button type="button" class="btn btn-danger btn-deleted" value="<?php echo $fila->id_proveedor;?>" data-toggle="modal" data-target="#deleteModal"><span class="fa fa-remove"></span></button>
                                            </td-->
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
        <h4 class="modal-title">Agregar Proveedor</h4>
      </div>
      <div class="modal-body">
        <div class="modal-body">
            <form id="insetProv_form" action="" role="form" method="post" class="form-horizontal">
              <div class="form-group">
                <div class="col-xs-12">
                  <label for="nombre_prove" class="label-control">Nombre:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'nombre_prove',
                      'id'    => 'nombre_prove',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
                <div class="col-xs-12">
                  <label for="telefono" class="label-control">Teléfono: <span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'telefono',
                      'id'    => 'telefono',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
                <!--Tiempo de pago-->
                <div class="col-xs-12">
                  <label for="tiemp_pag_facts" class="label-control">Tiempo Pago:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'tiemp_pag_facts',
                      'id'    => 'tiemp_pag_facts',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
              <!--Direccion-->
                <div class="col-xs-12">
                  <label for="direccion_prove" class="label-control">Dirección: <span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'direccion_prove',
                      'id'    => 'direccion_prove',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_textarea($data);
                   ?> 
                </div>
                <div class="col-xs-12">
                  <label for="comentario" class="label-control">Nota: <span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'comentario',
                      'id'    => 'comentario',
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
             <button type="submit" class="btn btn-primary" id="insert_prov"><span class=""> </span>Agregar</button>
         </div>
    </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Editar Categoría -->
<div class="modal fade" id="modal-editCategoria">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Categoría</h4>
      </div>
      <div class="modal-body">
         <div class="modal-body">
         <form id="edit_form" action="" role="form" method="post" class="form-horizontal">
              <?php 
               $data = array('id_categoria'=>'');
               echo form_hidden($data);
               ?>

          <div class="form-group">
              <div class="col-xs-12">
                <label for="nombre_categoria" class="label-control">Nombre Categoría:<span style="color:red">*</span></label>
                 <?php
                 $data = array(
                    'type'  => 'text',
                    'name'  => 'nombre_categoria',
                    'id'    => 'nombre_categoria',
                    'value' => '',
                    'class' => 'form-control',
                     'required'=>'true'
                      );
                  echo form_input($data);
                 ?> 
              </div>
             
          </div>

           
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" id="updateCat"><span class=""> </span>Actualizar</button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

  <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Confirmar eliminación</h4>
              </div>
              <?php 
               $data = array('id_categoria'=>'');
               echo form_hidden($data);
               ?>
              <div class="modal-body">
                     ¿Estas Seguro de que quieres borrar este registro...?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnDelete" class="btn btn-danger">Eliminar</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->  
