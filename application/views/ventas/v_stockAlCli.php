
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
       Productos en  Stock 
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="stocks_alcli" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Código</th>
                                    <th>Productos</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($stock)): ?>
                                     
                                    <?php

                                     foreach($stock as $stocks):
                                        ?>
                                        <tr>
                                           <td><?php echo $stocks->nombre_cli;?></td>
                                           <td><?php echo $stocks->items;?></td>
                                            <td><?php echo $stocks->nombre_producto;?></td>
                                            <td><?php echo $stocks->stock;?></td>
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




