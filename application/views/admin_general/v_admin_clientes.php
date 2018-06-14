
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Listado de Clientes
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                       
                        <a type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-insertCli"><span class="fa fa-plus"></span> Agregar Nueva</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table id="l_clientes" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                   
                                    <th>Clientes</th>
                                    <th>NIT</th>
                                    <th>Teléfono</th>
                                    <th>Correo</th>
                                    <th>Contacto</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($clientes)): ?>

                                    <?php
                                   
                                     foreach($clientes as $fila):?>
                                        <tr>
                                            <td><?php echo $fila->nombre_cli ;?></td>
                                             <td><?php echo $fila->numero;?></td>
                                             <td><?php echo $fila->telefono_cli;?></td>
                                              <td><?php echo $fila->correo;?></td>
                                               <td><?php echo $fila->contacto;?></td>
                                            <!--td>
                                                 <button type="button" class="btn btn-info btn-edit-cli" value="<?php echo $fila->id_cliente;?>" data-toggle="modal" data-target="#modal-editCli" title ="Editar Producto"><span class="fa fa-eye"></span></button-->
                                                 <!--button type="button" class="btn btn-info btn-edit-cli" value="<?php echo $fila->id_cliente;?>" data-toggle="modal" data-target="#modal-editCli" title ="Editar Producto"><span class="fa fa-edit"></span></button>
                                                  <!--button type="button" class="btn btn-danger btn-deleted" value="<?php echo $fila->id_cliente;?>" data-toggle="modal" data-target="#deleteModal"><span class="fa fa-remove"></span></button-->
                                            <!--/td-->
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



<!-- Insertar Cliente -->
<div class="modal fade" id="modal-insertCli">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar nuevo Cliente</h4>
      </div>
      <div class="modal-body">
         <div class="modal-body">
            <form id="clientesinset_form" action="" role="form" method="post" class="form-horizontal">
              <?php 
               $data = array('id_cliente'=>'');
               echo form_hidden($data);
               ?>
             <div class="form-group">
                <div class="col-xs-12">
                  <label for="numero" class="label-control">Tipo de Cliente:<span style="color:red">*</span></label>
                  <select class="form-control select2" style="" name="tipo_cliente_id" id="tipo_cliente_id" required="true">
                    <option value=" ">Seleccionar Tipo de Cliente</option>
                     <?php
                      foreach ($tipo_cliente as $fila) :
                         
                      ?>
                        <option value='<?= $fila->id ?>'><?= $fila->nombre ?></option>
                     <?php
                      endforeach;
                      ?>
                  </select> 
                </div>
                <div class="col-xs-12">
                  <label for="nombre_cli" class="label-control">Empresa:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'nombre_cli',
                      'id'    => 'nombre_cli',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
                <div class="col-xs-12">
                  <label for="numero" class="label-control">Tipo de Identificación:<span style="color:red">*</span></label>
                  <select class="form-control select2" style="" name="tipo_documento_id" id="tipo_documento_id" required="true">
                                      <option value=" ">Seleccionar Tipo de documento</option>
                                       <?php
                                        foreach ($tipo_documento as $fila) :
                                           $datatipo = $fila->id;?>
                                        ?>
                                          <option value='<?= $datatipo ?>'><?php echo $fila->nombre ?></option>
                                           
                                       <?php
                                        endforeach;
                                        ?>
                                    </select> 
                </div>
                <div class="col-xs-12">
                  <label for="numero" class="label-control">Numero: <span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'numero_cli',
                      'id'    => 'numero_cli',
                      'value' => '',
                      'maxlength'=> '9',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
                <div class="col-xs-12">
                  <label for="telefono_cli" class="label-control">Teléfono:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'telefono_cli',
                      'id'    => 'telefono_cli',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
                <div class="col-xs-12">
                  <label for="correo" class="label-control">Correo:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'email',
                      'name'  => 'correo',
                      'id'    => 'correo',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
                <div class="col-xs-12">
                  <label for="contacto" class="label-control">Contacto:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'contacto',
                      'id'    => 'contacto',
                      'value' => '',
                      'class' => 'form-control',
                       'required'=>'true'
                        );
                    echo form_input($data);
                   ?> 
                </div>
                <div class="col-xs-12">
                  <label for="direccion_cli" class="label-control">Dirección:<span style="color:red">*</span></label>
                   <?php
                   $data = array(
                      'type'  => 'text',
                      'name'  => 'direccion_cli',
                      'id'    => 'direccion_cli',
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
             <button type="submit" class="btn btn-primary" id="insert_cli"><span class=""> </span>Agregar</button>
         </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- Editar Categoría -->
<div class="modal fade" id="modal-editCli">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Datos Cliente</h4>
      </div>
      <div class="modal-body">
         <div class="modal-body">
         <form id="clientes_form" action="" role="form" method="post" class="form-horizontal">
              <?php 
               $data = array('id_cliente'=>'');
               echo form_hidden($data);
               ?>

          <div class="form-group">
              <div class="col-xs-12">
                <label for="nombre_cli" class="label-control">Nombre:<span style="color:red">*</span></label>
                 <?php
                 $data = array(
                    'type'  => 'text',
                    'name'  => 'nombre_cli',
                    'id'    => 'nombre_cli',
                    'value' => '',
                    'class' => 'form-control',
                     'required'=>'true'
                      );
                  echo form_input($data);
                 ?> 
              </div>
              
               <div class="col-xs-12">
                <label for="numero" class="label-control">NIT:<span style="color:red">*</span></label>
                 <?php
                 $data = array(
                    'type'  => 'text',
                    'name'  => 'numero',
                    'id'    => 'numero',
                    'value' => '',
                    'maxlength'=> '9',
                    'class' => 'form-control',
                     'required'=>'true'
                      );
                  echo form_input($data);
                 ?> 
              </div>
              <div class="col-xs-12">
                <label for="telefono_cli" class="label-control">Teléfono:<span style="color:red">*</span></label>
                 <?php
                 $data = array(
                    'type'  => 'text',
                    'name'  => 'telefono_cli',
                    'id'    => 'telefono_cli',
                    'value' => '',
                    'class' => 'form-control',
                     'required'=>'true'
                      );
                  echo form_input($data);
                 ?> 
              </div>
                <div class="col-xs-12">
                <label for="correo" class="label-control">Correo:<span style="color:red">*</span></label>
                 <?php
                 $data = array(
                    'type'  => 'email',
                    'name'  => 'correo',
                    'id'    => 'correo',
                    'value' => '',
                    'class' => 'form-control',
                     'required'=>'true'
                      );
                  echo form_input($data);
                 ?> 
              </div>
                <div class="col-xs-12">
                <label for="contacto" class="label-control">Contacto:<span style="color:red">*</span></label>
                 <?php
                 $data = array(
                    'type'  => 'text',
                    'name'  => 'contacto',
                    'id'    => 'contacto',
                    'value' => '',
                    'class' => 'form-control',
                     'required'=>'true'
                      );
                  echo form_input($data);
                 ?> 
              </div>
              
              
              <div class="col-xs-12">
                <label for="direccion_cli" class="label-control">Dirección:<span style="color:red">*</span></label>
                 <?php
                 $data = array(
                    'type'  => 'text',
                    'name'  => 'direccion_cli',
                    'id'    => 'direccion_cli',
                    'value' => '',
                    'class' => 'form-control',
                     'required'=>'true'
                      );
                  echo form_textarea($data);
                 ?> 
              </div>
              
             
          </div>

           
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" id="updateCli"><span class=""> </span>Actualizar</button>
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
