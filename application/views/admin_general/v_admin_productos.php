
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Productos
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
                       
                        <a type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-producto"><span class="fa fa-plus"></span> Agregar Nueva</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">Código</th>
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>P/U</th>
                                    <th>Peso</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($productos)): ?>

                                    <?php
                                    $cont = 1;
                                     foreach($productos as $fila):?>
                                        <tr>
                                            <td><?php echo $fila->items;?></td>
                                            <td><?php echo $fila->nombre_producto ;?></td>
                                            <td><?php echo $fila->nombre_producto ;?></td>
                                             <td><?php echo $fila->precio_unitario ;?></td>
                                             <td><?php echo $fila->peso_neto ;?></td>
                                            <!---td>
                                                 <button type="button" class="btn btn-info btn-edit" value="<?php echo $fila->id_producto;?>" data-toggle="modal" data-target="#modal-editCategoria" title ="Editar Producto"><span class="fa fa-edit"></span></button>
                                                  <!--button type="button" class="btn btn-danger btn-deleted" value="<?php echo $fila->id_producto;?>" data-toggle="modal" data-target="#deleteModal"><span class="fa fa-remove"></span></button>
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

<div class="modal fade" id="modal-producto">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Producto</h4>
      </div>
      <div class="modal-body">
        <div class="modal-body">
            <form id="insetProd_form" action="" role="form" method="post" class="form-horizontal">
              <div class="form-group">
                <!--proveedor-->
                <div class="col-xs-12">
                  <label for="numero" class="label-control">Proveedor:<span style="color:red">*</span></label>
                  <select class="form-control select2" style="" name="id_proveedor" id="id_proveedor" required="true">
                    <option value="">Seleccionar Proveedor</option>
                     <?php
                      foreach ($proveedores as $fila) :
                         
                      ?>
                        <option value='<?= $fila->id_proveedor ?>'><?= $fila->nombre_prove ?></option>
                     <?php
                      endforeach;
                      ?>
                  </select> 
                </div>
                <!--id_categoria-->
                <div class="col-xs-12">
                  <label for="id_categoria" class="label-control">Categoría:<span style="color:red">*</span></label>
                  <select class="form-control select2" style="" name="id_categoria" id="id_categoria" required="true">
                    <option value="">Seleccionar Categoría</option>
                     <?php
                      foreach ($categorias as $fila) :
                      ?>
                        <option value='<?= $fila->id_categoria ?>'><?= $fila->nombre_categoria ?></option>
                     <?php
                      endforeach;
                      ?>
                  </select> 
                </div>
                <!--nombre_producto-->
                <div class="col-xs-12">
                  <label for="nombre_producto" class="label-control">Nombre:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'nombre_producto',
                      'id'    => 'nombre_producto',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
                <!--items-->
                <div class="col-xs-12">
                  <label for="items" class="label-control">Código:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'items',
                      'id'    => 'items',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
                <!--precio_unitario-->
                <div class="col-xs-12">
                  <label for="precio_unitario" class="label-control">Precio Unitario:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'precio_unitario',
                      'id'    => 'precio_unitario',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
                <!--peso_neto-->
                <div class="col-xs-12">
                  <label for="peso_neto" class="label-control">Peso Kg:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'peso_neto',
                      'id'    => 'peso_neto',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
                <!--description-->
                <div class="col-xs-12">
                  <label for="description" class="label-control">Descripción:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'description',
                      'id'    => 'description',
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
             <button type="submit" class="btn btn-primary" id="insert_prod"><span class=""> </span>Agregar</button>
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
