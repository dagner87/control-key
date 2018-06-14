<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panel de Pedidos Key</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?php echo base_url();?>plantillas/favicon.ico">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
 
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>comprador" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Key</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Key Solutions</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

     <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Pedidos en transito-->          
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-truck"></i>
              <span class="label label-warning"><?= $count_entransito ;?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>plantillas/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>plantillas/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Admin
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>plantillas/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>plantillas/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>plantillas/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!--En aduana-->
          <li class="dropdown messages-menu">
            <a href='' class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-institution "></i>
              <span class="label label-info"><?= $count_enaduana ;?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>plantillas/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>plantillas/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Admin
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>plantillas/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>plantillas/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>plantillas/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
        
          <!-- Pedidos Pendientes -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger"><?= $count_pendientes; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>

                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>

          <!-- Pedidos completados -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-success"><?= $count_completado ;?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src='<?= base_url('assets/uploads/files').'/'. $this->session->userdata('img') ?>' class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $this->session->userdata('nombre');?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src='<?= base_url('assets/uploads/files').'/'. $this->session->userdata('img') ?>' class="img-circle" alt="User Image">

                <p>
                  <?= $this->session->userdata('username');?> - <?= $this->session->userdata('description');?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <!--div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div-->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url();?>salir" class="btn btn-default btn-flat">
                  <i class="glyphicon glyphicon-log-out text-red"></i> <span>Salir</span>
                  </a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!--li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li-->
        </ul>
      </div>
    </nav> 
  </header>
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
        <li class="header">MAIN NAVIGATION</li>
       <?php if ($this->session->userdata('perfil') == 'comprador'): ?>
        <li class="treeview <?php if($this->uri->segment(2)=='proveedor'|| $this->uri->segment(2)=='clientes'|| $this->uri->segment(2)=='categorias'|| $this->uri->segment(2)=='productos'){echo 'active';}?>">
          <a href="#">
            <i class="fa fa-folder-open text-aqua"></i>
            <span>Proveedores</span>
            
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href='<?php echo site_url('comprador/categorias')?>'><i class="fa fa-tags text-red"></i> Categorias</a></li>
            <li><a href='<?php echo site_url('comprador/productos')?>'><i class="fa fa-plus text-yellow"></i> Productos</a></li>
            <li><a href='<?php echo site_url('comprador/proveedor')?>'><i class="fa fa-circle-o text-yellow"></i> Proveedores</a></li>
            <li><a href='<?php echo site_url('comprador/clientes')?>'><i class="fa fa-user-plus text-yellow"></i> Clientes</a></li>
          </ul>
        </li>

        <li class="treeview <?php if($this->uri->segment(2)=='paquete'||$this->uri->segment(2)=='pedido_proveedor'){echo 'active';}?>">
          <a href="#">
            <i class="fa fa-industry"></i>
            <span>Pedido</span>
            
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href='<?php echo site_url('comprador/pedido_proveedor/add')?>'><i class="fa fa-file-text-o text-aqua"></i> Nuevo Pedido</a></li>
            <li><a href='<?php echo site_url('comprador/pedido_proveedor')?>'><i class="fa fa-circle-o text-red"></i> Listar Pedido</a></li>
            <li><a href='<?php echo site_url('comprador/paquete/add')?>'><i class="fa fa-cart-plus text-aqua"></i> Armar Paquete de Envio</a></li>
            <li><a href='<?php echo site_url('comprador/paquete')?>'><i class="fa fa-circle-o text-red"></i> Listar Paquetes</a></li>
          </ul>
        </li>

        <li class="treeview <?php if($this->uri->segment(2)=='transporte_aduana' || $this->uri->segment(2)=='transporte'){echo 'active';}?>">
          <a href="#">
            <i class="fa fa-truck text-aqua"></i>
            <span>Terrestre</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
             <li><a href='<?php echo site_url('comprador/transporte/add')?>'><i class="fa fa-circle-o text-aqua"></i>Asignar Transporte</a></li>
              <li><a href='<?php echo site_url('comprador/transporte')?>'><i class="fa fa-circle-o text-aqua"></i> Listar Transporte    <span class="label pull-right bg-yellow"><?= $count_entransito ;?></span></a> 
              </li>
              <li><a href='<?php echo site_url('comprador/transporte_aduana')?>'><i class="fa fa-circle-o text-aqua"></i> Aduana <span class="label pull-right bg-blue"><?= $count_enaduana ;?></span></a></li>
            </ul> 
          
        </li>
        <li class="treeview <?php if($this->uri->segment(2)=='transporte_aereo'){echo 'active';}?>">
           <a href="#">
            <i class="fa fa-plane text-yellow"></i>
            <span>Aereo</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href='<?php echo site_url('comprador/transporte_aereo')?>'><i class="fa fa-circle-o text-yellow"></i>Transito Aereo</a></li>
          </ul>
        </li>
        <li>
          <a href='<?php echo site_url('comprador/mercaderia_key')?>'>
            <i class="fa fa-laptop text-aqua"></i> <span>Pedidos Key</span>
           
          </a>
        </li>
       <?php endif; ?>

        <li class="treeview  <?php if($this->uri->segment(2)=='facturas_proveedores'|| $this->uri->segment(2)=='facturas_transpExt'|| $this->uri->segment(2)=='facturas_aduanaPeru'|| $this->uri->segment(2)=='facturas_aduanaBol'|| $this->uri->segment(2)=='facturas_transpInt'){echo 'active';}?>">
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

        
        <!--li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Gr&aacute;ficas</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            
            <li><a href="<?php //echo base_url();?>plantillas/pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="<?php //echo base_url();?>plantillas/pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="<?php //echo base_url();?>plantillas/pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
        </li -->
        <li>
          <a href="<?php echo base_url();?>salir">
            <i class="glyphicon glyphicon-log-out text-red"></i> <span>Salir</span>
           
          </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Dashboard
        <small>Panel de Control</small>
      </h1>
      
      <ol class="breadcrumb">
                  <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard">Incio</i></a></li>
                 <li class="active">Facturas de Proveedores</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
                <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-time"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pedidos Pendientes</span>
              <span class="info-box-number"><?= $count_pendientes; ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-truck"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pedidos en transito</span>
              <span class="info-box-number"><?= $count_entransito ;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="glyphicon glyphicon-transfer"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Pedidos en Aduana</span>
              <span class="info-box-number"><?= $count_enaduana ;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Completados</span>
              <span class="info-box-number"><?= $count_completado ;?><small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
    </div>


      <div class="row">

        <div class="col-xs-12">
          <div class="box box-solid box-primary btn-block">
            <div class="box-header ">
              <h3 class="box-title "><i class="fa fa-search" aria-hidden="true"></i> Buscar facturas</h3>
               
            </div>
              <div class="container content-search">
                  <div class="row">
                      <div class="col-md-12 text-center">
                        <br>
                         
                      </div>
                  </div>
                  <div class="row">
                      <form  id="formBuscar" class="form-horizontal form-search" action="<?php echo base_url(); ?>comprador/search" method="GET"   >
                          <div class="form-group">
                              <div class="col-md-3">

                                  <select class="form-control" name="proveedor" id="proveedor">
                                      <option value="">Seleccione Proveedor...</option>
                                      <?php foreach ($datosproveedor as $fila): ?>
                                          <?php if ($this->session->flashdata('proveedor_flas') && $this->session->flashdata('proveedor_flas') == $fila->id_proveedor): ?>
                                              <option value="<?php echo $fila->id_proveedor;?>" selected="selected">
                                                <?php echo $fila->nombre_prove; ?></option>
                                          <?php else: ?>
                                              <option value="<?php echo $fila->id_proveedor; ?>">
                                                <?php echo $fila->nombre_prove; ?></option>
                                          <?php endif;?>
                                      <?php endforeach;?>
                                   </select>
                              </div>
                              <div class="col-md-3">
                                  <input type="text" name="factura" class="form-control" value="<?php echo $this->session->flashdata("factura_flas") == true ? $this->session->flashdata("factura_flas") : '' ?>" placeholder="Introduzca No. Factura">
                              </div>
                              
                              <div class="col-md-2">
                                  <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
                              </div>
                              <div class="col-md-2">
                                  <a id="miboton"  href="" class="btn btn-danger btn-block"><i class=" fa fa-refresh" aria-hidden="true"></i> Refrescar</a>
                              </div>
                          </div>
                      </form>
                  </div>
                 
              </div>
         </div>
       </div>
             <?php if (!empty($pedidos_entregados)): 

                          $no_factura="";
                          $productos="";
                          $cantidad_solicitada = 0;
                          $importe_fact= 0;
                         // transporte peru
                          $no_facturaText="";
                          $monto_transpoext = 0;
                         // aduana peru
                          $no_recibo_adext=" ";
                          $costo_aduana_ext = 0;
                          //aduana bolivia
                          $no_poliza= 0;
                          $monto_poliza=0;
                         // transporte bolivia
                          $no_factura_traint="";
                          $costo_transporte_bol= 0;
                          $costo_total= 0;
                          $fecha_entrega="";


                   foreach ($pedidos_entregados as $reporte): 

                          // listar paq_ped_prov
                       $resultado = $this->modelogeneral->listar_paquete_pedidos($reporte->id_pedido_prov);
                      
                      foreach ($resultado as $paq_ped):
                            // devuelve un row de paquetes
                        
                         $rowpaquete = $this->modelogeneral->tomar_pedido($paq_ped->id_paquete); 
                         $rowtranExt = $this->modelogeneral->TranExt($rowpaquete->id_paquete); 

                       endforeach;

                    ?>
   
       <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Resultado</h3>
               <button type="button" name="btnprint" id="btnprint" onclick="printDiv('areaImprimir');" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-print"> </i>  Imprimir
          </button>
            </div>

            
            <!-- /.box-header -->
            <div class="box-body " id="areaImprimir">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                   <tr>
                    <th colspan="3"><div align="center">No.Factura: &nbsp; 
                      <!--?= $no_factura=$rowpaquete->no_factura;?-->
                      </div></th>
                    <th colspan="" ><div align="center">No.FLETE:&nbsp;<!--?= $no_facturaText =$rowpaquete->no_facturaText ?--></div></th>
                    <th colspan="" ><div align="center">ADUANA FRONTERA:&nbsp;<!--?= $no_poliza =$rowpaquete->no_poliza; ?--></div></th>
                    <th colspan="" ><div align="center">ADUANA BOLIVIA:&nbsp;<!--?= $no_recibo_adext =$rowpaquete->no_recibo_adext;?--></div></th>
                     <th colspan="" ><div align="center">No. FACTURA BOLIVIA:&nbsp;<!--?= $no_factura_traint =$rowpaquete->no_factura_traint;?--></div></th>
                   </tr>
                   <tr>
                     <th width="">ARTICULOS</th>
                     <th width="">CANTIDAD</th>  
                     <th width="">IMPORTE.</th>  
                     <th width="">TRANSPORTE EXT</th> 
                     <th width="">MONTO ADUANA</th>   
                     <th width="">MONTO ADUANA BOL</th> 
                     <th width="">BOLIVIA TRANSP. INT</th> 
                     <th width="">COSTO TOTAL</th> 
                     <th width="">COSTO UNITARIO DE ALMECEN</th>
                   </tr>
                </thead>
                <tbody>
                        <tr>
                        <td><?= $reporte->nombre_producto;?></td>
                        <td><?= $cantidad_solicitada=$reporte->cantidad_solicitada;?></td> 
                        <!--IMPORTE FACTURA-->
                        <td><?= "$ ".$importe_fact=$reporte->costo_total;?></td>
                        <!--TRANSPORTE EXT--> 
                      <?php 
                       if (isset($rowtranExt->monto_transpoext)!= null) { ?>
                           <td><?= "$ ".$monto_transpoext= $rowtranExt->monto_transpoext;?></td>
                      <?php  } else { ?>
                                    <td>--</td>
                                   <?php
                                     }
                        
                       if (isset($rowpaquete->costo_aduana_ext)!= null) { ?>
                        <!--ADUANA EXT--> 
                        <td><?= "$ ".$costo_aduana_ext= $rowpaquete->costo_aduana_ext;?></td>
                      <?php  } else { ?>
                                    <td>--</td>
                                   <?php
                                     }
                      if (isset($rowpaquete->monto_poliza)!= null) { ?>
                         
                       <!--ADUANA BOL-->
                        <td><?= "$ ".$monto_poliza= $rowpaquete->monto_poliza;?></td>
                      <?php  } else { ?>
                                    <td>--</td>
                                   <?php
                                     }
                      
                      if (isset($rowpaquete->costo_transporte_bol)!= null) { ?>
                         
                     <!--Transporte BOL-->
                        <td><?= "$ ".$costo_transporte_bol= $rowpaquete->costo_transporte_bol;?></td>
                       
                      <?php  } else { ?>
                                    <td>--</td>
                                   <?php
                                     }
                         $costo_total= $importe_fact+$monto_transpoext+$costo_aduana_ext+$monto_poliza+$costo_transporte_bol; 
                         $costo_almacen= $costo_total/$cantidad_solicitada ;
                         ?>

                        <td><?= "$ ".$costo_total;?></td>
                        <td style="color: red;"><?= "$ ".$costo_almacen;?></td>

                       </tr> 
               
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
       </div>

         <?php
          endforeach;
      endif;
      ?>
                 
      
      </div> <!-- /.row -->
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <footer class="main-footer">
    <div class="pull-right hidden-xs">

      <b>Version</b> 2.3.7
    </div>
    
    <strong>Copyright &copy; 2017-2018 <a href="http://www.sistema.keysolutions.com.bo" target="_blank">Key Solutions S.R.L</a>.</strong> All rights 
    reserved.  
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>plantillas/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>plantillas/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>plantillas/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>plantillas/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>plantillas/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>plantillas/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>plantillas/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>plantillas/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "language": {
            "lengthMenu": "Mostrar _MENU_registros por página",
            "zeroRecords": "No se encontró nada - lo siento",
            "info": "Mostrando la página_PAGE_ of _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ Total de registros)"
          }
      
    });

   
     $("#miboton").click(function(event) {
     $("#formBuscar")[0].reset();
   });
   
  });
  

   //--------area a imprimir-------------

    function printDiv(nombreDiv) {

     $('#example1_filter').addClass('hidden');

     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;

     document.body.innerHTML = contenido;

     window.print();

     document.body.innerHTML = contenidoOriginal;
}
  

    
</script>
</body>
</html>
