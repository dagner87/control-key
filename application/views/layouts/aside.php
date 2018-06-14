        <!-- =============================================== -->

         <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src='<?= base_url('assets/uploads/files').'/'. $this->session->userdata('img') ?>' class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('nombre');?> </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar MENU: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENÚ</li>
         <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i> <span>Inicio</span></a></li>

          <li class="treeview <?php if($this->uri->segment(2)=='stock' || $this->uri->segment(2)=='add_entrada' || $this->uri->segment(2)=='entrada_almacen' || $this->uri->segment(2)=='movimientos_internos' ){echo 'active';}?>">
          <a href="#">
              <i class="fa fa-university"></i> <span>Almacen</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <?php $id_almacen = $this->session->userdata('almacen');?>
            
          <li><a href='<?php echo site_url('ventas/add_entrada')?>'><i class="fa fa-circle-o text-yellow"></i>Nueva entrada</a></li>   
          <li><a href='<?php echo site_url('ventas/entrada_almacen/'.$id_almacen.'')?>'><i class="fa fa-circle-o text-yellow"></i>Lista de entradas</a></li>
          <li><a href='<?php echo site_url('ventas/stock/'.$id_almacen.'')?>'><i class="fa fa-circle-o text-yellow"></i> Productos en Stock</a></li>
          <li><a href='<?php echo site_url('ventas/movimientos_internos')?>'><i class="fa fa-circle-o text-yellow"></i>Mover a otro Almacen</a></li>       

          </ul>
        </li>
     
        <li class="treeview  <?php if($this->uri->segment(2)=='add_venta' || $this->uri->segment(2)=='listar'){echo 'active';}?>">
          <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Ventas</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href='<?php echo site_url('ventas/add_venta')?>'><i class="fa fa-circle-o text-aqua"></i>Nueva Venta</a></li>
            <li><a href='<?php echo site_url('ventas/listar')?>'><i class="fa fa-circle-o text-aqua"></i> Listar Ventas</a></li>
           
          </ul>
        </li>
        <li class="treeview   <?php if($this->uri->segment(2)=='add_salida_prodcliente'||$this->uri->segment(2)=='stock_clientes'||$this->uri->segment(2)=='listar_guias' ){echo 'active';}?> ">
          <a href="#">
            <i class="fa fa-database"></i>
            <span>Almacen Clientes</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href='<?php echo site_url('ventas/add_salida_prodcliente')?>'><i class="fa fa-circle-o text-yellow"></i>Nueva Salida</a></li>
            <li><a href='<?php echo site_url('ventas/stock_clientes')?>'><i class="fa fa-circle-o text-yellow"></i>Lista de Stock</a></li>
             <li><a href='<?php echo site_url('ventas/listar_guias')?>'><i class="fa fa-circle-o text-yellow"></i>Lista de Salidas</a></li>
          </ul>
        </li>
       <li class="treeview   <?php if($this->uri->segment(2)=='mov_entrada_salida'||$this->uri->segment(2)=='reporte_rango_fechas'||$this->uri->segment(2)=='consumo_mensual_productos'){echo 'active';}?> ">
          <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>Reportes</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
              <li><a href='<?php echo site_url('ventas/mov_entrada_salida')?>'><i class="fa fa-circle-o text-aqua"></i>Movimientos Mensuales</a></li>
              <li><a href='<?php echo site_url('ventas/reporte_rango_fechas')?>'><i class="fa fa-circle-o text-aqua"></i>Rango de Fechas </a></li>
              <li><a href='<?php echo site_url('ventas/consumo_mensual_productos')?>'><i class="fa fa-circle-o text-aqua"></i>Consumo Mensual</a></li>
          </ul>
        </li>

          <!-- Configuracion General -->
            <li class="treeview <?php if($this->uri->segment(2)=='proveedores'|| $this->uri->segment(2)=='clientes'|| $this->uri->segment(2)=='categorias'|| $this->uri->segment(2)=='productos'){echo 'active';}?>">
              <a href="#">
                <i class="fa fa-gear"></i>
                <span>Configuración General</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
              </a>
              <ul class="treeview-menu">
                <li><a href='<?php echo site_url('config_general/categorias')?>'><i class="fa fa-tags text-yellow"></i> Categorías</a></li>
                <li><a href='<?php echo site_url('config_general/productos')?>'><i class="fa fa-plus text-yellow"></i> Productos</a></li>
                <li><a href='<?php echo site_url('config_general/proveedores')?>'><i class="fa fa-industry text-yellow"></i> Proveedores</a></li>
                <li><a href='<?php echo site_url('config_general/clientes')?>'><i class="fa fa-user-plus text-yellow"></i> Clientes</a></li>
              </ul>
            </li>
            <!-- fin Configuracion General -->

        <li>
          <a href="<?php echo base_url();?>salir">
            <i class="glyphicon glyphicon-log-out text-red"></i> <span>Salir</span>
           
          </a>
        </li>
     
    </section>
    <!-- /.sidebar -->
  </aside>

        <!-- =============================================== -->