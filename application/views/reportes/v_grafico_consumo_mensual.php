
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
    Dashboard
    <small>Panel Control </small>
    </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <!-- /.row -->
    <div class="row">
    <div class="col-md-12">
    <div class="box">
    <div class="box-header with-border">
    <h3 class="box-title">Gráfico estadístico Consumo Mensual</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    <div class="row">
    <div class="col-md-12">
    <form action="<?php echo current_url();?>" method="post" class="form-horizontal">
    <div class="form-group">
    <div class="col-md-3">
    <label for="">Selecione Producto:</label>
    <select name="id_producto" id="id_producto" class="form-control select2" required>
    <option value="">Seleccione...</option>
    <?php foreach($productos as $fila):?> 
    <option value="<?php echo $fila->id_producto;?>"><?php echo $fila->nombre_producto?></option>
    <?php endforeach;?>
    </select>
    </div>
    <div class="col-md-3">
    <label for="">Selecione Año:</label>
    <select name="year" id="year" class="form-control">
    <?php foreach($years as $year):?>
    <option value="<?php echo $year->year;?>"><?php echo $year->year;?></option>
    <?php endforeach;?>
    </select>
    </div>
    <div class="col-md-2">
    <label for="">&nbsp;</label>
    <input type="submit" name="buscar" id="buscar_consumo" value="Buscar" class="form-control btn btn-primary">
    </div>
    </div>
    </form> 
    </div>  
    <div class="col-md-12">
    <div id="grafico_consumo" style="min-width: 310px; height: 400px;margin: 0 auto"></div>
    </div>
    </div>
    <!-- /.row -->
    </div>
    <!-- ./box-body -->
    </div>
    <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
