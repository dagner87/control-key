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
      <?php if ($this->session->userdata('perfil')=='comprador') : ?> 
       <!-- Pedido a Proveedores -->
        <li class="treeview <?php if($this->uri->segment(2)=='paquete'||$this->uri->segment(2)=='pedido_proveedor'){echo 'active';}?>">
          <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>Pedido a Proveedores</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href='<?php echo site_url('comprador/pedido_proveedor/add')?>'><i class="fa fa-file-text-o text-aqua"></i> Nuevo Pedido</a></li>
            <li><a href='<?php echo site_url('comprador/pedido_proveedor')?>'><i class="fa fa-circle-o text-red"></i> Listar Pedido</a></li>
            <li><a href='<?php echo site_url('comprador/paquete/add')?>'><i class="fa fa-cart-plus text-aqua"></i> Armar Facturas de Envio</a></li>
            <li><a href='<?php echo site_url('comprador/paquete')?>'><i class="fa fa-circle-o text-red"></i> Listar Facturas</a></li>
          </ul>
        </li>
        <!-- Administrar Transporte -->
          <li class="treeview 
             <?php if($this->uri->segment(2)=='transporte_aduana' || $this->uri->segment(2)=='transporte'){echo 'active';}?>">
             <a href="#">
              <i class="fa fa-truck"></i> <span>Administrar Transporte</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
          <ul class="treeview-menu">
            <li>
              <a href="#"><i class="fa fa-truck text-aqua"></i> Terrestre
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li>
                    <a href='<?php echo site_url('comprador/transporte/add')?>'>
                      <i class="fa fa-circle-o text-aqua"></i>Asignar Transporte</a></li>
                  <li>
                    <a href='<?php echo site_url('comprador/transporte')?>'>
                      <i class="fa fa-circle-o text-aqua"></i> Listar Transporte    
                      <span class="label pull-right bg-yellow"><?= $count_entransito ;?></span></a> 
                  </li>
                  <li><a href='<?php echo site_url('comprador/transporte_aduana')?>'>
                    <i class="fa fa-circle-o text-aqua"></i> Aduana 
                    <span class="label pull-right bg-blue"><?= $count_enaduana ;?></span></a>
                  </li>
              </ul>
            </li>
             <li>
              <a href="#"><i class="fa fa-plane text-yellow"></i> Aereo
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href='<?php echo site_url('comprador/transporte_aereo')?>'>
                      <i class="fa fa-circle-o text-yellow"></i>Despachos Aereo</a>
                    </li>
              </ul>
            </li>
            <li>
              <a href='<?php echo site_url('comprador/mercaderia_local')?>'>
              <i class="fa fa-flag"></i> <span> Despachos Locales</span>
              </a>
            </li>
          </ul>
        </li>
         <!-- Administracion -->
           <li class="treeview 
                 <?php if($this->uri->segment(2)=='mercaderia_key' || $this->uri->segment(2)=='mercaderia_aprobada'){echo 'active';}?>">
                 <a href="#">
                  <i class="fa fa-laptop"></i> <span>Administración</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
              <ul class="treeview-menu">
                <li>
                  <a href='<?php echo site_url('comprador/mercaderia_key')?>'>
                    <i class="fa fa-circle-o text-aqua"></i> <span>Costos Totales</span>
                   
                  </a>
                </li>
                <li>
                  <a href='<?php echo site_url('comprador/mercaderia_aprobada')?>'>
                  <i class="fa fa-circle-o text-aqua"></i> <span>Facturas Aprobadas</span>
                  </a>
                </li>
              </ul>
            </li>
             <?php endif; 
              if ($this->session->userdata('perfil')=='gerencia') : ?>  
                <!-- Propuestas -->
                <li class="treeview <?php if($this->uri->segment(2)=='listar_propuestas'||$this->uri->segment(2)=='add_propuesta'){echo 'active';}?>">
                  <a href="#">
                    <i class="fa fa-star-o text-yellow"></i>
                    <span>Propuestas</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href='<?php echo site_url('gerencia/add_propuesta')?>'><i class="fa fa-file-text-o text-aqua"></i>Nueva Propuesta</a></li>
                    <li><a href='<?php echo site_url('gerencia/listar_propuestas')?>'><i class="fa fa-circle-o text-red"></i> Listar Propuestas</a></li>
                  </ul>
                </li>
               <!-- Propuestas -->
             <?php endif; ?>  
          <li class="treeview  <?php if($this->uri->segment(2)=='facturas_proveedores'|| $this->uri->segment(2)=='facturas_proveedoresPagadas'|| $this->uri->segment(2)=='facturas_transpExt'|| $this->uri->segment(2)=='facturas_aduanaPeru'  || $this->uri->segment(2)=='facturas_aduanaPeruPagadas'|| $this->uri->segment(2)=='facturas_aduanaBol'|| $this->uri->segment(2)=='facturas_transpInt'  || $this->uri->segment(2)=='facturas_PagasTransBol'|| $this->uri->segment(2)=='facturas_PagasaduanaBol' || $this->uri->segment(2)=='facturas_transpExtPagadas' ){echo 'active';}?>">
              <a href="#" id="">
                <i class="fa fa-clipboard"></i>
                <span>Cuentas x Pagar</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
              </a>
              <ul class="treeview-menu">
                <li><a href='<?php echo site_url('comprador/facturas_proveedores')?>' id="" onClick="">
                <i class="fa fa-file-text"></i>Proveedores </a></li>
               
                <li><a href='<?php echo site_url('comprador/facturas_transpExt')?>' id="" onClick="">
                <i class="fa fa-file-text"></i>Transporte Ext</a></li>
               
                <li><a href='<?php echo site_url('comprador/facturas_aduanaPeru')?>' id="" onClick="">
                <i class="fa fa-file-text"></i>Aduana Perú</a></li>

                <li><a href='<?php echo site_url('comprador/facturas_aduanaBol')?>' id="" onClick="">
                <i class="fa fa-file-text"></i>Aduana Bolivia</a></li>
               
                <li><a href='<?php echo site_url('comprador/facturas_transpInt')?>' id="" onClick="">
                <i class="fa fa-file-text"></i>Transporte Int </a></li>
              </ul>
           </li>

         

           <li class="treeview <?php if($this->uri->segment(2)=='reporte'){echo 'active';}?>">
              <a href="#">
                <i class="fa fa-bar-chart-o"></i>
                <span>Reportes</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
              </a>
              <ul class="treeview-menu">

                <li><a href='<?php echo site_url('comprador/reportes')?>' id="ver_reporte" onClick=""><i class="fa fa-circle-o"></i>Reporte</a></li>

                <li><a href='<?php echo site_url('comprador/reportes_generales')?>' id="ver_reporte_general" onClick=""><i class="fa fa-circle-o"></i>Reporte de Tiempos</a></li>
             
              </ul>
           </li>
           <!-- Configuracion General -->
            <li class="treeview <?php if($this->uri->segment(2)=='proveedor'|| $this->uri->segment(2)=='clientes'|| $this->uri->segment(2)=='categorias'|| $this->uri->segment(2)=='productos'){echo 'active';}?>">
              <a href="#">
                <i class="fa fa-gear"></i>
                <span>Configuración General</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
              </a>
              <ul class="treeview-menu">
                <li><a href='<?php echo site_url('comprador/categorias')?>'><i class="fa fa-tags text-yellow"></i> Categorias</a></li>
                <li><a href='<?php echo site_url('comprador/productos')?>'><i class="fa fa-plus text-yellow"></i> Productos</a></li>
                <li><a href='<?php echo site_url('comprador/proveedor')?>'><i class="fa fa-industry text-yellow"></i> Proveedores</a></li>
                <li><a href='<?php echo site_url('comprador/clientes')?>'><i class="fa fa-user-plus text-yellow"></i> Clientes</a></li>
              </ul>
            </li>
              <!-- Salir -->
            <li>
              <a href="<?php echo base_url();?>salir">
                <i class="glyphicon glyphicon-log-out text-red"></i> <span>Salir</span>
               
              </a>
            </li>
      </ul>
     
    </section>
    <!-- /.sidebar -->
  </aside>

        <!-- =============================================== -->