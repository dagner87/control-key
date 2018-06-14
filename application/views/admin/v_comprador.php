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
<?php 
foreach($css_files as $file): ?>
  <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
  <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
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
          </li>
          <!--En aduana-->
          <li class="dropdown messages-menu">
            <a href='' class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-institution "></i>
              <span class="label label-info"><?= $count_enaduana ;?></span>
            </a>
          </li>
          <!-- Pedidos Pendientes -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger"><?= $count_pendientes; ?></span>
            </a>
            
          </li>

          <!-- Pedidos completados -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-success"><?= $count_completado ;?></span>
            </a>
            
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
          <ul class="treeview-menu ">
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
              <i class="fa fa-flag"></i> <span>Despachos Locales</span>
              </a>
            </li>
          </ul>
        </li>
         <!-- Administracion -->
           <li class="treeview 
                 <?php if($this->uri->segment(2)=='mercaderia_key' || $this->uri->segment(2)=='mercaderia_aprobada'|| $this->uri->segment(2)=='facturas_proveedores'|| $this->uri->segment(2)=='facturas_transpExt'|| $this->uri->segment(2)=='facturas_aduanaPeru'|| $this->uri->segment(2)=='facturas_aduanaBol'|| $this->uri->segment(2)=='facturas_transpInt'){echo 'active';}?>">
                 <a href="#">
                  <i class="fa fa-laptop"></i> <span>Administración</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
              <ul class="treeview-menu">
                <li>
                  <a href='<?php echo site_url('comprador/mercaderia_key')?>'>
                    <i class="fa fa-circle-o text-aqua"></i> <span>PVP neto</span>
                   
                  </a>
                </li>
                <li>
                  <a href='<?php echo site_url('comprador/mercaderia_aprobada')?>'>
                  <i class="fa fa-circle-o text-aqua"></i> <span>PVP neto Aprobado</span>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
     <?php echo $breadcrum_actual; ?>
      </h1>
      
      <ol class="breadcrumb">
         <?php
                if($output != NULL && $breadcrum != NULL)
                   {
                foreach($breadcrum as $item=>$valor)
                  {?>
                  <li><a href="<?php echo site_url("comprador/".$item); ?>"><i class="fa fa-dashboard"></i><?php echo $valor ; ?></a></li>
                  
                  <?php
                  }
                   
                ?>
                 <li class="active"><?php if($breadcrum_actual != NULL){ echo $breadcrum_actual;} } ?></li>
      </ol>

    </section>

    <!-- Main content -->
    <section class="content">

     <?php
      if ($widgets == '') { ?>
            <!-- Info boxes -->
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
       <?php } ?>
      <!-- /.row -->

      <section class="col-md-6">

      <!-- SELECT2 EXAMPLE -->
      <div class="box box-success" id="form_costo_terrestre"  style="display:none">
        <div class="box-header with-border">
          <h3 class="box-title">Costos de Transporte </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
          <form action="<?php echo base_url();?>comprador/updatecosto_terrestre" method="POST" enctype="multipart/form-data">
            <div class="col-xs-6">
              <div class="form-group">
                <label>Fecha llegada Key:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <?php
                   $data = array('id_paq'=>'');
                   echo form_hidden($data);
                     $data = array(
                            'type'          => 'date',
                            'id'            => 'fecha_key',
                            'name'          => 'fecha_key',
                            'class'         => 'form-control',
                            'required'      => 'true'
                    );
                  echo form_input($data); ?>
                 </div>
              </div>
              <div class="form-group">
                <label>Flete:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                  <?php
                     $data = array(
                            'type'          => 'text',
                            'id'            => 'costo_transp_ext',
                            'name'          => 'costo_transp_ext',
                            'class'         => 'form-control',
                            'required'      => 'true'
                    );
                  echo form_input($data); ?>
                 </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Aduana Perú:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                   <?php
                     $data = array(
                            'type'          => 'text',
                            'id'            => 'costo_aduana_ext',
                            'name'          => 'costo_aduana_ext',
                            'class'         => 'form-control',
                            'value'      => '100',
                            'required'      => 'true'

                    );
                  echo form_input($data); ?>
                  </div>
              </div>
              <div class="form-group">
                <label>SRT:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class=" fa fa-cloud-upload"></i>
                  </div>
                  <?php
                     $data = array(
                            'type'          => 'file',
                            'id'            => 'srt',
                            'name'          => 'srt',
                            'class'         => 'form-control',
                            'required'      => 'true'
                    );

                  echo form_upload($data); ?> 
                 </div>
              </div>
              <div class="form-group">
                <label>DUI:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-cloud-upload"></i>
                  </div>
                  <?php
                     $data = array(
                            'type'          => 'file',
                            'id'            => 'dui',
                            'name'          => 'dui',
                            'class'         => 'form-control',
                            'required'      => 'true'
                    );

                  echo form_upload($data); ?> 
                </div>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.Primera columna -->

            <div class="col-xs-6">
              <div class="form-group">
                <label>Aduana-Bolivia:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                   <?php
                     $data = array(
                            'type'          => 'text',
                            'id'            => 'costo_aduana_bol',
                            'name'          => 'costo_aduana_bol',
                            'class'         => 'form-control',
                            'required'      => 'true'
                    );

                  echo form_input($data); ?> 
                </div>
              </div>
              <div class="form-group">
                <label>Transporte-Bolivia:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <?php
                     $data = array(
                            'type'          => 'text',
                            'id'            => 'costo_transporte_bol',
                            'name'          => 'costo_transporte_bol',
                            'class'         => 'form-control',
                            'required'      => 'true'
                    );
                  echo form_input($data); ?> 
                </div>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>No.Poliza:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                  <?php
                     $data = array(
                            'type'          => 'text',
                            'id'            => 'no_poliza',
                            'name'          => 'no_poliza',
                            'class'         => 'form-control',
                            'required'      => 'true'
                    );

                  echo form_input($data); ?> 
                 </div>
            </div>
             <div class="form-group">
                <label>Monto:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                  <?php
                     $data = array(
                            'type'          => 'text',
                            'id'            => 'monto_poliza',
                            'name'          => 'monto_poliza',
                            'class'         => 'form-control',
                            'required'      => 'true'
                    );

                  echo form_input($data); ?> 
                  
                </div>
            </div>
             <div class="form-group">
                <label>Respaldo de Poliza:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class=" fa fa-cloud-upload"></i>
                  </div>
                   <?php
                     $data = array(
                            'type'          => 'file',
                            'id'            => 'respaldo_poliza',
                            'name'          => 'respaldo_poliza',
                            'class'         => 'form-control',
                            'required'      => 'true'
                    );

                  echo form_upload($data); ?> 
                 
                </div>
              </div><!-- /.Segunda columna -->
            <div class="col-xs-6">
              <div class="form-group">
                <input type="submit" class="btn btn-block btn-default" value="Cerrar">    
                
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
               
                <input type="submit" class="btn btn-block btn-primary" value="Guardar">
              </div>
            </div>

          </div><!-- /.row -->
          </form>
        </div>
        <!-- /.box-body -->
        
      </div>
    </section>

      <div class="row">
        <?php
         if($this->uri->segment(2)=='transporte'){ 

          $rowCont= $this->modelogeneral->contar_mercad_factProveedor();

          ?>
       
        <div class="col-md-12">
            <!-- /.box-header -->
            <div class="box-body">
              <?php if ($rowCont == 0) { ?>
                     <div class="alert alert-info alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa  fa-bell-o"></i> Información!</h4>
                       No hay  facturas  disponibles para asignar a transporte.
                    </div>
              <?php  }else{ ?>
                             <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-warning"></i> Alerta!</h4>
                                 Hay <?php echo $rowCont ; ?> facturas disponibles para asignar a transporte. 
                                 <button class='btn btn-default btn-sm' onclick='mostrar_detalleFacturaTransporte()' title='Ver Facturas'><i class='fa fa-eye'></i>
                           </button> 
                             </div>
                    <?php } ?>
          <!-- /.box -->
           </div>
        </div>
        <?php } ?>
    
        <div class="col-xs-12">
          <div id="output_grocery" class="col-xs-12 box-body">
            <?php echo $output; ?>
          </div>
        </div>
        
        <div id="vista_previa" class="col-xs-12" style="display:none">
          <?php 
          // $remision ="e460f-guia-remision.pdf";
          /*< ?= base_url('assets/uploads/respaldos').'/'. $remision ? >*/
           ?>
            <iframe src=""
                  width="1100" height="450">
                 
            </iframe>
        </div>
    </div>
      
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

<!-- Dividir pedido -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
          <form id="myForm" action="" method="post" class="form-horizontal">
            <input type="hidden" name="id_pedido_prov" value="0">
            <div class="form-group">
              <label for="address" class="label-control col-md-4">Cantidad a confirmar</label>
              <div class="col-md-8">
                <input type="text" name="cantidad_solicitada" class="form-control">
                
                 <?php 
                 $data = array(
                     'no_pedido' => '',
                     'fecha_pedido'=> '',
                     'fecha_entrega'=> '',
                     'id_proveedor'=> '',
                     'id_producto'=> '',
                     'nombre_producto'=> '',
                     'cantidad_solicitada_resto'=> '',
                     'costo_total'=> '',
                     //'destino'=> '',
                     'precio_unitario'=> '',
                     'id_almacen'=> ''
                  );

                 echo form_hidden($data);

                  ?>
     

              </div>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnSave" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- formulario agregar costos terrestres -->
<div id="costo_transporteModal" class="modal fade " tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-transporte">
      <div class="modal-header box box-success">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class='row'>
          <div class='col-md-4'>
          <img style="width:30 px; height: 50px" src="<?php echo base_url();?>plantillas/dist/img/transporte.png">
          </div>
          <div class='col-md-8'>
           <h4 class="modal-title">Costos de Transporte</h4>
          </div>
        </div>
      </div>
      <div class="modal-body">
          <form id="costo_transporte_form" action="" method="post" class="form-horizontal">
            <div class="form-group">
              <?php 
                 $data = array('id_paquete'=>'');
                 echo form_hidden($data);
              ?>
              
            </div>
            <div class="form-group">
              <div class="col-xs-6">
                 <label for="fecha_key" class="label-control">Fecha llegada Key:</label>
                 <?php
                 $data = array(
                    'type'  => 'date',
                    'name'  => 'fecha_key',
                    'id'    => 'fecha_key',
                    'value' => '',
                    'class' => 'form-control'
                      );
                  echo form_input($data);
                 ?> 
              </div>
               <div class="col-xs-6">
                    <label for="costo_transp_ext" class="label-control">Flete</label>
                     <?php
                     $data = array(
                        'type'  => 'text',
                        'name'  => 'costo_transp_ext',
                        'id'    => 'costo_transp_ext',
                        'value' => '',
                        'class' => 'form-control',
                        'required'=>'true'
                          );
                      echo form_input($data);
                     ?> 
                  </div>
            </div>
             <!-- Flete-->
            <div class="form-group">
              <div class="box-body">
                <div class="row">
                  <div class="col-xs-4">
                   <label for="costo_aduana_ext" class="label-control">Aduana Per&uacute;:</label>
                    <?php
                     $data = array(
                                  'type'  => 'text',
                                  'name'  => 'costo_aduana_ext',
                                  'id'    => 'costo_aduana_ext',
                                  'value' => '100',
                                  'class' => 'form-control'
                                  );
                      echo form_input($data);
                    ?>
                  </div>
                  <div class="col-xs-4">
                   <label for="costo_transporte_bol" class="label-control">Transp-Bolivia:</label>
                    <?php
                      $data = array(
                                    'type'  => 'text',
                                    'name'  => 'costo_transporte_bol',
                                    'id'    => 'costo_transporte_bol',
                                    'value' => '',
                                    'class' => 'form-control'

                                    );
                      echo form_input($data);
                    ?>
                  </div>
                  <div class="col-xs-4">
                   <label for="costo_aduana_bol" class="label-control">Aduana-Bolivia:</label>
                    <?php
                      $data = array(
                                    'type'  => 'text',
                                    'name'  => 'costo_aduana_bol',
                                    'id'    => 'costo_aduana_bol',
                                    'value' => '',
                                    'class' => 'form-control'

                                    );
                      echo form_input($data);
                    ?>
                  </div> 
                </div>
              </div>
            </div>
          <!-- Detalle de gastos-->
            <div class="form-group">
              <div class="box-body">
                <div class="row">
                 <!--  No.Poliza:s-->
                  <div class="col-xs-4">
                   <label for="no_poliza" class="label-control">No.Poliza:</label>
                   <?php
                     $data = array(
                        'type'  => 'text',
                        'name'  => 'no_poliza',
                        'id'    => 'no_poliza',
                        'value' => '',
                        'class' => 'form-control'
                          );
                      echo form_input($data);
                    ?>
                  </div>
                    <!--  Respaldo de flete-->
                  <div class="col-xs-4">
                     <label for="respaldo_flete" class="label-control">Respaldo de flete:</label>
                      <?php
                        $data = array(
                        'type'  => 'file',
                        'name'  => 'respaldo_flete',
                        'id'    => 'respaldo_flete',
                        'value' => '',
                        'class' => 'form-control'
                          );
                        echo form_input($data);
                      ?> 
                  </div>
                   <!-- Otros Gastos-->
                  <div class="col-xs-4">
                   <label for="costo_trans_bol_int" class="label-control">Otros Gastos:</label>
                      <div class="input-group">
                         <?php
                         $data = array(
                            'type'  => 'text',
                            'name'  => 'costo_trans_bol_int',
                            'id'    => 'costo_trans_bol_int',
                            'value' => '',
                            'class' => 'form-control'
                            
                              );
                        echo form_input($data);
                       ?>
                      </div>
                  </div>
                </div>
              </div>
            </div>
           
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnSave_terrestre" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Mostrar detalles de las facturas -->
<div id="mostrar_detallesFact" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content  box box-solid box-info">
      <div class="modal-header box-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="box-title" align="center" id="aereo">Detalles de factura</h4>
      </div>
      <div class="box-group" id="accordion">
                <!-- aqui salen los acordeones dinamicos con sus productos -->
        
    </div>
      <div class="modal-body">
        <table class='table table-responsive table-bordered'>
         <thead>
       
        <tbody id="lista">

        </tbody>
      </table>
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Mostrar detalles de las facturas para el transporte -->
<div id="mostrar_detallesFactTransporte" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content  box box-solid box-info">
      <div class="modal-header box-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="box-title" align="center" id="">Detalles de factura</h4>
      </div>
      <div class="modal-body">
        <!-- /.box-header -->
            <div class="box-body">
              <div class="box-group" id="accordion_fatPend">
                <!-- aqui salen los acordeones dinamicos con sus productos -->
               
              </div>
            </div>
            <!-- /.box-body -->
          <!-- /.box -->
      </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- formulario modificar fecha entrega del pedido -->
<div id="modfecha_PedidoModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content  box box-solid box-info">
      <div class="modal-header box-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="box-title" id="aereo">Modificar Fecha entrega</h4>
      </div>
      <div class="modal-body">
       
          <form id="modfecha_Pedido_form" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
              <?php 
               $data = array('id_pedido_prov'=>'');
               echo form_hidden($data);
               ?>

          <div class="form-group">
              <div class="col-xs-12">
                <label for="fecha_key" class="label-control">Fecha de Entrega:<span style="color:red">*</span></label>
                 <?php
                 $data = array(
                    'type'  => 'date',
                    'name'  => 'fecha_entrega',
                    'id'    => 'field-fecha_entrega',
                    'value' => '',
                    'class' => 'form-control',
                     'required'=>'true'
                      );
                  echo form_input($data);
                 ?> 
              </div>
             
          </div>

            <div class="form-group">
               <div class="col-xs-12">
                 <label for="costo_aereo" class="label-control">Observación:<span style="color:red">*</span></label>
                  <?php                 
                      $data = array(
                                    'type'  => 'text',
                                    'name'  => 'observacion',
                                    'id'    => 'observacion',
                                    'value' => '',
                                    'class' => 'form-control',
                                    'required'=>'true'
                                   );
                      echo form_textarea($data);
                  ?> 
               </div>
            </div>
            
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnSave_FechaPedido" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- formulario modificar fecha llegada Aduana -->
<div id="modfecha_Trasporte" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content  box box-solid box-info">
      <div class="modal-header box-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="box-title" id="aereo">Modificar Fecha Aduana</h4>
      </div>
      <div class="modal-body">
       
          <form id="modfecha_Transporte_form" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
              <?php 
               $data = array('id_transporte_ext'=>'');
               echo form_hidden($data);
               ?>

          <div class="form-group">
              <div class="col-xs-12">
                <label for="fecha_key" class="label-control">Fecha de llegada:<span style="color:red">*</span></label>
                 <?php
                 $data = array(
                    'type'  => 'date',
                    'name'  => 'fecha_salida_transporte',
                    'id'    => 'field-fecha_salida_transporte',
                    'value' => '',
                    'class' => 'form-control',
                     'required'=>'true'
                      );
                  echo form_input($data);
                 ?> 
              </div>
             
          </div>
          <div class="form-group">
              <div class="col-xs-12">
                <label for="fecha_key" class="label-control">Fecha de Salida:<span style="color:red">*</span></label>
                 <?php
                 $data = array(
                    'type'  => 'date',
                    'name'  => 'fecha_llegada_aduana',
                    'id'    => 'field-fecha_llegada_aduana',
                    'value' => '',
                    'class' => 'form-control',
                     'required'=>'true'
                      );
                  echo form_input($data);
                 ?> 
              </div>
             
          </div>

            <div class="form-group">
               <div class="col-xs-12">
                 <label for="costo_aereo" class="label-control">Observación:<span style="color:red">*</span></label>
                  <?php                 
                      $data = array(
                                    'type'  => 'text',
                                    'name'  => 'observacion_aduana',
                                    'id'    => 'observacion_aduana',
                                    'value' => '',
                                    'class' => 'form-control',
                                    'required'=>'true'
                                   );
                      echo form_textarea($data);
                  ?> 
               </div>
            </div>
            
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnSave_actTranspore" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- formulario modificar fecha entrega del pedido -->
<div id="addfecha_PedAereoModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog " role="document">
    <div class="modal-content  box box-solid box-info">
      <div class="modal-header box-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="box-title" id="aereo">Agregar Fechas de  Aduana</h4>
      </div>
      <div class="modal-body">
       
          <form id="addfecha_PedAereo_form" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
              <?php 
               $data = array('id_paquete'=>'','id_transporte_ext'=>'');
               echo form_hidden($data);
               ?>

          <div class="form-group" id="fech_llegada_ad">
              <div class="col-xs-12">
                <label for="fecha_llegadaAd" class="label-control">Fecha de Llegada Aduana:</label>
                 <?php
                 $data = array(
                    'type'  => 'date',
                    'name'  => 'fecha_llegadaAd',
                    'id'    => 'field-fecha_llegadaAd',
                    'value' => '',
                    'class' => 'datepicker-input form-control hasDatepicker'
                      );
                  echo form_input($data);
                 ?> 
              </div>
             
          </div>

            <div class="form-group">
              <div class="col-xs-12">
                <label for="fecha_salidaAd" class="label-control">Fecha de Salida Aduana:</label>
                 <?php
                 $data = array(
                    'type'  => 'date',
                    'name'  => 'fecha_salidaAd',
                    'id'    => 'field-fecha_salidaAd',
                    'value' => '',
                    'class' => 'datepicker-input form-control hasDatepicker'
                      );
                  echo form_input($data);
                 ?> 
              </div>
             
          </div>
            
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnSave_FechaPedidoAereo" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- formulario agregar costos aereos -->
<div id="costo_transporte_aereoModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header box box-info ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class='row'>
          <div class='col-md-4'>
          <img style="width:30 px; height: 50px" src="<?php echo base_url();?>plantillas/dist/img/transporte_aereo.png">
          </div>
          <div class='col-md-8'>
           <h4 class="modal-title" id="aereo">Costos de transporte Aereo</h4>
          </div>
        </div>
        
      </div>
      <div class="modal-body">
       
          <form id="costo_transporte_aereo_form" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
              <?php 
               $data = array('id_paquete'=>'');
               echo form_hidden($data);
               ?>
            <div class="form-group">
              <div class="col-xs-6">
                 <label for="fecha_key" class="label-control">Fecha llegada Key:</label>
                 <?php
                 $data = array(
                    'type'  => 'date',
                    'name'  => 'fecha_key',
                    'id'    => 'fecha_key',
                    'value' => '',
                    'class' => 'form-control'
                      );
                  echo form_input($data);
                 ?> 
              </div>
              <div class="col-xs-6">
                 <label for="costo_aereo" class="label-control">Costo Aereo:</label>
                  <?php                 
                      $data = array(
                                    'type'  => 'text',
                                    'name'  => 'costo_aereo',
                                    'id'    => 'costo_aereo',
                                    'value' => '',
                                    'class' => 'form-control'
                                   );
                      echo form_input($data);
                  ?> 
              </div>
            
            </div>
            <div class="form-group">
              <div class="">
                <div class="">
                 <!--  No.Poliza:s-->
                  <div class="col-xs-4">
                   <label for="no_poliza" class="label-control">No.Poliza:</label>
                   <?php
                     $data = array(
                        'type'  => 'text',
                        'name'  => 'no_poliza',
                        'id'    => 'no_poliza',
                        'value' => '',
                        'class' => 'form-control'
                          );
                      echo form_input($data);
                    ?>
                  </div>
                    <!--  Respaldo de flete-->
                  <div class="col-xs-4">
                     <label for="respaldo_flete" class="label-control">Respaldo de flete:</label>
                      <?php
                        $data = array(
                        'type'  => 'file',
                        'name'  => 'respaldo_flete',
                        'id'    => 'respaldo_flete',
                        'value' => '',
                        'class' => 'form-control'
                          );
                        echo form_input($data);
                        echo $error = "";
                      ?> 

                  </div>
                   <!-- Otros Gastos-->
                  <div class="col-xs-4">
                   <label for="costo_trans_bol_int" class="label-control">Otros Gastos:</label>
                      <div class="input-group">
                         <?php
                         $data = array(
                            'type'  => 'text',
                            'name'  => 'costo_trans_bol_int',
                            'id'    => 'costo_trans_bol_int',
                            'value' => '',
                            'class' => 'form-control'
                            
                              );
                        echo form_input($data);
                       ?>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            

          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btnSave_aereo" class="btn btn-primary">Guardar cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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
    <?php
    $host= $_SERVER["HTTP_HOST"];
    $amigable= $_SERVER["REQUEST_URI"];
    $http="http://";
    $url= $http.$host.$amigable;
    
    $src= site_url('comprador');
                
   if($url==$src)
    {
    ?>
    <script src='<?php echo base_url();?>plantillas/plugins/jQuery/jquery-2.2.3.min.js'></script>
  <?php  
   } 
   ?>



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

    

  $(document).ready(function(){

    $("#example1").DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_registros por página",
            "zeroRecords": "No se encontró nada - lo siento",
            "info": "Mostrando la página_PAGE_ of _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ Total de registros)"
          }

      });

     /*$('#datepicker').datepicker({
      autoclose: true
    });*/


         $("select[name=id_producto]").change(function(){
            //alert($('select[name=id_producto]').val());
           var id_producto = $('select[name=id_producto]').val();
           // $('input[name=costo]').val($(this).val());
            
            $.ajax({
              type: 'ajax',
              method: 'get',
              url: '<?php echo base_url() ?>comprador/datosproducto',
              data: {id_producto: id_producto},
              async: false,
              dataType: 'json',
              success: function(data){
                              
                 $('#descripcion').html(" Precio unitario: <strong>( "+data.precio_unitario+" USD )<strong> ");
                 $('#descripcion').addClass('label label-success');
                
                 $("input[name=cantidad_solicitada]").change(function(){
                   var precio_unitario = parseFloat(data.precio_unitario);
                   var cantidad_solicitada = parseFloat($('input:text[name=cantidad_solicitada]').val());
                   $('input[name=precio_unitario]').val(precio_unitario);
                   var resultado = parseFloat(precio_unitario*cantidad_solicitada).toFixed(2);
                   $('input[name=costo_total]').val(resultado);
                  });
 
              },
             error: function(){
                 alert('No hay datos q mostrar');
              }
            });

            });

        var value = $("input[name=via_transporte]").val();
       if(value == "terrestre") {
          
          $('#lista_pedido_field_box').attr("style", "display:none");
          $('#costo_aereo_field_box').attr("style", "display:none");
          $('#respaldo_costoaereo_field_box').attr("style", "display:none");
         }else if(value == "aereo") {

                $('#lista_pedido_field_box').attr("style", "display:none");
                $('#costo_aduana_ext_field_box').attr("style", "display:none");
               
                $('#no_factura_traext_field_box').attr("style", "display:none");
                $('#costo_transp_ext_field_box').attr("style", "display:none");
                $('#factura_transporte_ext_field_box').attr("style", "display:none");
                
                $('#no_recibo_adext_field_box').attr("style", "display:none");
               
                
                $('#no_factura_traint_field_box').attr("style", "display:none");
                $('#costo_transporte_bol_field_box').attr("style", "display:none");
                $('#factura_transporte_int_field_box').attr("style","display:none");

               }
        else if(value == "local") {

                $('#lista_pedido_field_box').attr("style", "display:none");
                $('#costo_aereo_field_box').attr("style", "display:none");
                $('#respaldo_costoaereo_field_box').attr("style", "display:none");
                
                $('#costo_aduana_ext_field_box').attr("style", "display:none");
                
                $('#no_factura_traext_field_box').attr("style", "display:none");
                $('#costo_transp_ext_field_box').attr("style", "display:none");
                $('#factura_transporte_ext_field_box').attr("style", "display:none");
                
                $('#no_recibo_adext_field_box').attr("style", "display:none");
                $('#dui_field_box').attr("style", "display:none");

                $('#no_poliza_field_box').attr("style", "display:none");
                $('#monto_poliza_field_box').attr("style", "display:none");
                $('#respaldo_poliza_field_box').attr("style", "display:none");
                
                $('#no_factura_traint_field_box').attr("style", "display:none");
                $('#costo_transporte_bol_field_box').attr("style", "display:none");
                $('#factura_transporte_int_field_box').attr("style","display:none");
                
               
               }       


       /* $( "input[name=destino]" ).on("click", function() {
            
            var destino = $( "input:checked").val();

           if (destino== 1) {
              
              $('#id_almacen_display_as_box').addClass('hidden');
              $('#id_almacen_input_box').addClass('hidden');
              $('#id_cliente_display_as_box').removeClass('hidden');
              $('#id_cliente_input_box').removeClass('hidden');

              $('#form-button-save').on("click", function() {
                 var value;
                 var mensaje ='<p> Debe Seleccionar un Cliente</p>';
                         
                 if($("select[name=id_cliente]").val() == 0) {

                      $('#report-error').show(); // show Warning 
                      $("select#field-id_cliente").focus();  // Focus the select box      
                      $('#field-id_cliente').addClass("required");
                      $('#report-error').html(mensaje);
                      value=false

              }
               return value;
              });

              $('#save-and-go-back-button').on("click", function() {
                 var value;
                 var mensaje ='<p> Debe Seleccionar un Cliente</p>';
                         
                 if($("select[name=id_cliente]").val() == 0) {

                      $('#report-error').show(); // show Warning 
                      $("select#field-id_cliente").focus();  // Focus the select box      
                      $('#field-id_cliente').addClass("required");
                      $('#report-error').html(mensaje);
                      value= false;
              }
              return value;
              });
              
            }else {
              
              $('#lid_cliente_display_as_box').addClass('hidden');
              $('#id_cliente_input_box').addClass('hidden');
              $('#id_almacen_display_as_box').removeClass('hidden');
              $('#id_almacen_input_box').removeClass('hidden');
              $('#field-id_almacen').attr("required", "true");

              $('#form-button-save').on("click", function() {
                 var value;
                 var mensaje ='<p> Debe Seleccionar un Almacen </p>';
                         
                 if($("select[name=id_almacen]").val() == 0) {

                      $('#report-error').show(); // show Warning 
                      $('select#field-id_almacen').focus();  // Focus the select box      
                      $('#field-id_almacen').addClass("required");
                      $('#report-error').html(mensaje);
                
                      value = false;
                   }

              return value;

              });


            };

            
          });*/
 
        });//--------fin de funcion onready

       function mostrar_formulario_costo($id_paquete)
          {
            $('#output_grocery').addClass('hidden');
            $('#form_costo_terrestre').show();
            $('input[name=id_paq]').val(id_paquete);
            $('#vista_previa').hide();


          }

        function mostrar_reporte()
          {
            $('#output_grocery').addClass('hidden');
            $('#reporte_previa').show(); 
            $('#vista_previa').hide();


          }
        
         function mostrar_vistaprevia()
          {
            $('#output_grocery').addClass('hidden');
            $('#vista_previa').show();           
          }



 
   function mostrar_detalle(id_transporte_ext)
     {
      $('#mostrar_detallesFact').modal('show');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/showtranp',
        data: {id_transporte_ext: id_transporte_ext},
        async: false,
        dataType: 'json',
        success: function(data){
           //$('#lista').html(data);
           $('#accordion').html(data);
           },
        error: function(){
          alert('No se ha podido editar');
        }
      });

    }

    /*------------mostrar detalle de factura aprobada--------------*/

       function mostrar_detalleFactAprob(id_transporte_ext)
     {
      $('#mostrar_detallesFact').modal('show');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/Detalles_factAprob',
        data: {id_transporte_ext: id_transporte_ext},
        async: false,
        dataType: 'json',
        success: function(data){
           $('#lista').html(data);
           },
        error: function(){
          alert('No se ha podido editar');
        }
      });

    }

    

    /*----------------mostrar detalle de factura para el transporte----------------*/
      function mostrar_detalleFacturaTransporte()
     {
      $('#mostrar_detallesFactTransporte').modal('show');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/mostrar_detalleFacturaTransporte',
        data: {},
        async: false,
        dataType: 'json',
        success: function(data){
          console.log(data);
          $('#accordion_fatPend').html(data);
        // $('#accordion_fatPend').empty();// se usa  para limpiar las capas y no se llenen doble
         /* $.each( data, function( key, value ) {
            var collapse = "collapse"+data[key].id_paquete;
           $('#accordion_fatPend').append("<div class='panel box box-primary'>"+
                                    "<div class='box-header with-border'>"+
                                      "<h4 class='box-title'>"+
                                      "<a data-toggle='collapse' data-parent='#accordion' href='#"+collapse+"' >"
                                      +data[key].no_factura+
                                     "</a>"+
                                      "</h4>"+
                                    "</div>"+
                                    "<div id='"+collapse+"' class='panel-collapse collapse '>"+
                                      "<div class='box-body'>"+
                                         "<ul>"+
                                           "<li><strong>Producto :"+data[key].nombre_producto+"</strong> </li>"+
                                           "<li><strong>Cantidad :"+data[key].cantidad_solicitada+"</strong></li>"+

                                         "</ul>"+
                                       "</div>"+
                                     "</div>"+
                                  "</div>");
          });*/
         
           },
        error: function(){
          alert('No se ha podido editar');
        }
      });

      

    }


 
    
//-------------------------------
    function div_pedido(id_pedido_prov)
     {
      $('#myModal').modal('show');
      $('#myForm').attr('action','<?php echo base_url() ?>comprador/updatePedido_prove');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/editpedido_prove',
        data: {id_pedido_prov: id_pedido_prov},
        async: false,
        dataType: 'json',
        success: function(data){

          $('h4.modal-title').text('Dividir Pedido: ' +data.no_pedido);
          $('input[name=cantidad_solicitada]').val(parseInt(data.cantidad_solicitada));
          $('input[name=id_pedido_prov]').val(data.id_pedido_prov);
          $('input[name=no_pedido]').val(data.no_pedido);
          $('input[name=fecha_pedido]').val(data.fecha_pedido);
          $('input[name=fecha_entrega]').val(data.fecha_entrega);
          $('input[name=id_proveedor]').val(data.id_proveedor);
          $('input[name=id_producto]').val(data.id_producto);
          $('input[name=nombre_producto]').val(data.nombre_producto);
          $('input[name=costo_total]').val(data.costo_total);
          $('input[name=id_almacen]').val(data.id_almacen);
          $('input[name=precio_unitario]').val(data.precio_unitario);
          $('input[name=cantidad_solicitada]').on('keyup', function(){
            var cantidad_restar = $(this).val();
            var cantidad_solicitada = parseInt(data.cantidad_solicitada);
            var resultado = parseInt(cantidad_solicitada - cantidad_restar);
            $('input[name=cantidad_solicitada_resto]').val(resultado);
           });
        
        },
        error: function(){
          alert('No se ha podido editar');
        }
      });

    }

   $('#btnSave').click(function(){
      var url = $('#myForm').attr('action');
      var data = $('#myForm').serialize();
      //validate form
      var cantidad_solicitada = $('input[name=cantidad_solicitada]');
      var result = '';
      if(cantidad_solicitada.val()==''){
        cantidad_solicitada.parent().parent().addClass('has-error');
      }else{
        cantidad_solicitada.parent().parent().removeClass('has-error');
        result +='1';
      }

      if(result=='1'){
        $.ajax({
          type: 'ajax',
          method: 'post',
          url: url,
          data: data,
          async: false,
          dataType: 'json',
          success: function(response){
            if(response.success){
              $('#myModal').modal('hide');
              $('#myForm')[0].reset();
              if(response.type=='update'){
                var type ="actualizado"
              }
              $('#list-report-success').html('<p>Pedido '+type+'</p>').fadeIn().delay(5000).fadeOut('slow');
               location.reload();
              
            }else{
              alert('No se puede actualizar');
            }
          },
          error: function(){
          }
        
        });
      }
    });

    //-------funcion modificar fecha entrega pedido------


    function modif_fechapedido(id_pedido_prov)
     {
      $('#modfecha_PedidoModal').modal('show');
      $('#modfecha_Pedido_form').attr('action','<?php echo base_url() ?>comprador/updateFechaPedido_prove');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/editpedido_prove',
        data: {id_pedido_prov: id_pedido_prov},
        async: false,
        dataType: 'json',
        success: function(data){
          $('input[name=id_pedido_prov]').val(data.id_pedido_prov);
          $('input[name=fecha_entrega]').val(data.fecha_entrega);
          $('textarea[name=observacion]').val(data.observacion);
        },
        error: function(){
          alert('No se ha podido editar');
        }
      });

    }

     $('#btnSave_FechaPedido').click(function(){
      var url = $('#modfecha_Pedido_form').attr('action');
      var data = $('#modfecha_Pedido_form').serialize();
      //validate form
      var id_pedido_prov   = $('input[name=id_pedido_prov]');
      var fecha_entrega    = $('input[name=fecha_entrega]');
      var observacion      = $('input[name=observacion]');
      
      var result = '';
      if(fecha_entrega.val()==''){
        fecha_entrega.parent().parent().addClass('has-error');
      }else{
        fecha_entrega.parent().parent().removeClass('has-error');
        result +='1';
      }
      if(observacion.val()==''){
        observacion.parent().parent().addClass('has-error');
      }else{
        observacion.parent().parent().removeClass('has-error');
        result +='2';
      }
      
      if(result=='12'){
        $.ajax({
          type: 'ajax',
          method: 'post',

          url: url,
          data: data,
          async: false,
          dataType: 'json',
          success: function(response){
            if(response.success){
              $('#modfecha_PedidoModal').modal('hide');
              $('#modfecha_Pedido_form')[0].reset();
              
              if(response.type=='update'){
                var type = 'actualizado'
              }
              $('#list-report-success').html('<p> Datos  '+type+'  exitosamente </p>').fadeIn().delay(4000).fadeOut('slow');
               location.reload();
            }else{
              alert('Error');
            }
          },
          error: function(){
            alert('No se han podido actualizar los datos');
          }
        });
      }
    });



 
 /*--------modificar fecha de salida Trasnporte terrestre---------------------------*/ 

    function modif_fechaTransporte(id_transporte_ext)
     {
      $('#modfecha_Trasporte').modal('show');
      $('#modfecha_Transporte_form').attr('action','<?php echo base_url() ?>comprador/updateFechaTransporte');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/editTransporte',
        data: {id_transporte_ext: id_transporte_ext},
        async: false,
        dataType: 'json',
        success: function(data){
          $('input[name=id_transporte_ext]').val(data.id_transporte_ext);
          $('input[name=fecha_salida_transporte]').val(data.fecha_salida_transporte);
          $('input[name=fecha_llegada_aduana]').val(data.fecha_llegada_aduana);
          $('textarea[name=observacion_aduana]').val(data.observacion_aduana);
        },
        error: function(){
          alert('No se ha podido editar');
        }
      });

    }  


  $('#btnSave_actTranspore').click(function(){

      var url = $('#modfecha_Transporte_form').attr('action');
      var data = $('#modfecha_Transporte_form').serialize();
      //validate form
     
      var fecha_salida_transporte = $('input[name=fecha_salida_transporte]');
      var fecha_llegada_aduana    = $('input[name=fecha_llegada_aduana]');
      var observacion_aduana      = $('textarea[name=observacion_aduana]');

      var result = '';
      if(fecha_salida_transporte.val()==''){
        fecha_salida_transporte.parent().parent().addClass('has-error');
      }else{
        fecha_salida_transporte.parent().parent().removeClass('has-error');
        result +='1';
      }
      if(fecha_llegada_aduana.val()==''){
        fecha_llegada_aduana.parent().parent().addClass('has-error');
      }else{
        fecha_llegada_aduana.parent().parent().removeClass('has-error');
        result +='2';
      }
      if(observacion_aduana.val()==''){
        observacion_aduana.parent().parent().addClass('has-error');
      }else{
        observacion_aduana.parent().parent().removeClass('has-error');
        result +='3';
      }
      
      if(result=='123'){
        $.ajax({
          type: 'ajax',
          method: 'post',

          url: url,
          data: data,
          async: false,
          dataType: 'json',

          success: function(response){
           
            if(response.success){
              
              $('#modfecha_Trasporte').modal('hide');
              $('#modfecha_Transporte_form')[0].reset();
              
              if(response.type=='update'){
                 var type = 'actualizado'
                 $('#list-report-success').html('<p> Datos  '+type+'  exitosamente </p>').fadeIn().delay(4000).fadeOut('slow');
                 location.reload();
                }
             
            }else{
              alert('Error');
            }
          },
          error: function(){
            alert('No se han podido actualizar los datos');
          }
        });
      }
    });
   

//--------------agregar_fechapedidoTerrestre-------------

    function agregar_fechapedidoTerrestre(id_transporte_ext)
    {
      $('#addfecha_PedAereoModal').modal('show');
      $('#fech_llegada_ad').attr("style", "display:none");
      $('#addfecha_PedAereo_form').attr('action','<?php echo base_url() ?>comprador/updateFechaPedidoTerrestre');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/editpedido_terrestre',
        data: {id_transporte_ext: id_transporte_ext},
        async: false,
        dataType: 'json',
        success: function(data){
          $('input[name=id_transporte_ext]').val(data.id_transporte_ext);
          $('input[name=fecha_llegadaAd]').val(data.fecha_llegada_aduana);
          $('input[name=fecha_salidaAd]').val(data.fecha_salidaAd);
        },
        error: function(){
          alert('No se ha podido editar');
        }
      });

    }

     //------------ Confirmar Aduana Transporte terrestre---------

    function confirmar_aduanaTraspTerrestre(id_paquete)
    {
      $('#addfecha_PedAereoModal').modal('show');
      $('#addfecha_PedAereo_form').attr('action','<?php echo base_url() ?>comprador/updateFechaPedidoAereo');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/editpedido_aereo',
        data: {id_paquete: id_paquete},
        async: false,
        dataType: 'json',
        success: function(data){
          $('input[name=id_paquete]').val(data.id_paquete);
          $('input[name=fecha_llegadaAd]').val(data.fecha_llegadaAd);
          $('input[name=fecha_salidaAd]').val(data.fecha_salidaAd);
        },
        error: function(){
          alert('No se ha podido editar');
        }
      });

    }



    //------------ agregar fecha a pedido aereo---------

    function agregar_fechapedidoAereo(id_paquete)
    {
      $('#addfecha_PedAereoModal').modal('show');
      $('#addfecha_PedAereo_form').attr('action','<?php echo base_url() ?>comprador/updateFechaPedidoAereo');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/editpedido_aereo',
        data: {id_paquete: id_paquete},
        async: false,
        dataType: 'json',
        success: function(data){
          $('input[name=id_paquete]').val(data.id_paquete);
          $('input[name=fecha_llegadaAd]').val(data.fecha_llegadaAd);
          $('input[name=fecha_salidaAd]').val(data.fecha_salidaAd);
        },
        error: function(){
          alert('No se ha podido editar');
        }
      });

    }

    $('#btnSave_FechaPedidoAereo').click(function(){
      var url = $('#addfecha_PedAereo_form').attr('action');
      var data = $('#addfecha_PedAereo_form').serialize();
      //validate form
      var id_transporte_ext = $('input[name=id_transporte_ext]');
      var id_paquete      = $('input[name=id_paquete]');
      
      var fecha_llegadaAd = $('input[name=fecha_llegadaAd]');
      var fecha_salidaAd  = $('input[name=fecha_salidaAd]');
      
      
      
      var result = '';
      if(fecha_llegadaAd.val()==''){
        fecha_llegadaAd.parent().parent().addClass('has-error');
      }else{
        fecha_llegadaAd.parent().parent().removeClass('has-error');
        result +='1';
      }
      if(fecha_salidaAd.val()==''){
        fecha_salidaAd.parent().parent().addClass('has-error');
      }else{
        fecha_salidaAd.parent().parent().removeClass('has-error');
        result +='2';
      }
      
      if(result=='12'){
        $.ajax({
          type: 'ajax',
          method: 'post',

          url: url,
          data: data,
          async: false,
          dataType: 'json',
          success: function(response){
            if(response.success){
              $('#addfecha_PedAereoModal').modal('hide');
              $('#addfecha_PedAereo_form')[0].reset();
              
              if(response.type=='update'){
                var type = 'actualizado'
              }
              $('#list-report-success').html('<p> Datos  '+type+'  exitosamente </p>').fadeIn().delay(4000).fadeOut('slow');
               location.reload();
            }else{
              alert('Error');
            }
          },
          error: function(){
            alert('No se han podido actualizar los datos');
          }
        });
      }
    });


    //---------funcion editar costos aereos------- 
    function editar_costos_aereos(id_paquete)
     {
       $('#costo_transporte_aereoModal').modal('show');
       $('#costo_transporte_aereo_form').attr('action','<?php echo base_url()?>comprador/updatecosto_aereo');
       $('input[name=id_paquete]').val(id_paquete);
       $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/editcosto_aereo',
        data: {id_paquete: id_paquete},
        async: false,
        dataType: 'json',
        success: function(data){
          
          $('input[name=fecha_key').val(data.fecha_key);
          $('input[name=costo_aereo]').val(data.costo_aereo);
          $('input[name=id_paquete]').val(data.id_paquete);
          $('input[name=respaldo_flete').val(data.respaldo_flete);
          $('input[name=no_poliza').val(data.no_poliza);
          $('input[name=costo_trans_bol_int]').val(data.costo_trans_bol_int);
          },
        error: function(){
          alert('No se ha podido editar');
        }
      });

    }

    $('#btnSave_aereo').click(function(){
      var url = $('#costo_transporte_aereo_form').attr('action');
      var data = $('#costo_transporte_aereo_form').serialize();
      //validate form
      var id_paquete           = $('input[name=id_paquete]');
      var fecha_key            = $('input[name=fecha_key]');
      var no_poliza            = $('input[name=no_poliza]');
      var respaldo_flete       = $('input[name=respaldo_flete]');
      var costo_aereo          = $('input[name=costo_aereo]');
      var costo_trans_bol_int  = $('input[name=costo_trans_bol_int]');
      
      var result = '';
      if(costo_aereo.val()==''){
        costo_aereo.parent().parent().addClass('has-error');
      }else{
        costo_aereo.parent().parent().removeClass('has-error');
        result +='1';
      }
      
      if(result=='1'){
        $.ajax({
          type: 'ajax',
          method: 'post',

          url: url,
          data: data,
          async: false,
          dataType: 'json',
          success: function(response){
            if(response.success){
              $('#costo_transporte_aereoModal').modal('hide');
              $('#costo_transporte_aereo_form')[0].reset();
              if(response.type=='add'){
                var type = 'agregados'
              }
              if(response.type=='update'){
                var type = 'actualizado'
              }
              $('#list-report-success').html('<p> Costos  '+type+'  exitosamente </p>').fadeIn().delay(4000).fadeOut('slow');
               location.reload();
            }else{
              alert('Error');
            }
          },
          error: function(){
            alert('No se han podido agregar datos');
          }
        });
      }
    });


    //------------------editar costos terrestres------
      function editar_costos_terrestres(id_paquete)
     {
       $('#costo_transporteModal').modal('show');
       $('.modal-transporte').css('height','auto','width','100%');
       $('.modal-transporte').css('margin', '100px auto 100px auto');
       $('#costo_transporte_form').attr('action','<?php echo base_url() ?>comprador/updatecosto_terrestre');
       $('input[name=id_paquete]').val(id_paquete);
       $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>comprador/editcosto_aereo',
        data: {id_paquete: id_paquete},
        async: false,
        dataType: 'json',
        success: function(data){
          console.log(data);
          $('input[name=id_paquete]').val(data.id_paquete);
          $('input[name=costo_transp_ext]').val(data.costo_transp_ext);
          $('input[name=costo_aduana_ext]').val(100);      
          $('input[name=costo_aduana_bol]').val(data.costo_aduana_bol);
          $('input[name=costo_transporte_bol]').val(data.costo_transporte_bol);
          $('input[name=costo_trans_bol_int]').val(data.costo_trans_bol_int);
          
          $('input[name=fecha_key').val(data.fecha_key);
          $('input[name=respaldo_flete').val(data.respaldo_flete);
          $('input[name=no_poliza').val(data.no_poliza);
          },
          error: function(){
            alert('No se ha podido editar');
          }
       });

     }

      $('#btnSave_terrestre').click(function(){
      var url = $('#costo_transporte_form').attr('action');
      var data = $('#costo_transporte_form').serialize();
      //validate form
      var id_paquete           = $('input[name=id_paquete]');
      var costo_transp_ext     = $('input[name=costo_transp_ext]');
      var costo_aduana_ext     = $('input[name=costo_aduana_ext]');      
      var costo_aduana_bol     = $('input[name=costo_aduana_bol]');
      var costo_transporte_bol = $('input[name=costo_transporte_bol]');
      var costo_trans_bol_int  = $('input[name=costo_trans_bol_int]');
      var respaldo_flete       = $('input[name=respaldo_flete]');
      
      var result = '';

      if(costo_transp_ext.val()==''){
        costo_transp_ext.parent().parent().addClass('has-error');
      }else{
        costo_transp_ext.parent().parent().removeClass('has-error');
        result +='1';
      }

      if(costo_aduana_ext.val()==''){
        costo_aduana_ext.parent().parent().addClass('has-error');
      }else{
        costo_aduana_ext.parent().parent().removeClass('has-error');
        result +='2';
      }

      
      if(result=='12'){
        $.ajax({
          type: 'ajax',
          method: 'post',
          contentType:false,
          url: url,
          data: data,
          async: false,
          dataType: 'json',
          success: function(response){
            if(response.success){
              $('#costo_transporteModal').modal('hide');
              $('#costo_transporte_form')[0].reset();
              if(response.type=='add'){
                var type = 'agregados'
              }
              if(response.type=='update'){
                var type = 'actualizado'
              }
              $('#list-report-success').html('<p> Costos  '+type+'  exitosamente </p>').fadeIn().delay(15000).fadeOut('slow');
               location.reload();

            }else{
              alert('Error');
            }
          },
          error: function(){
            alert('No se han podido agregar datos');
          }
        });
      }
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


//funcion agregar costos de transporte aereo
   function agregar_costos_aereos(id_paquete)
     {
       $('#costo_transporte_aereoModal').modal('show');
       $('#costo_transporte_aereo_form').attr('action','<?php echo base_url() ?>comprador/addcosto_aereo');
       $('input[name=id_paquete]').val(id_paquete);
     }

    /* function restar_credito_fiscal(e,nom_input)
     {
       if
       var creditofiscal=  parseFloat($('input:text[name='+nom_input']').val());
       alert('el valor creditofiscal es:' +creditofiscal);
       


      }*/

      /****Gastos con facturas  *******/
    
      $('input[name=camara_check]').on('click', function(){
       if($(this).is(':checked')){
       var valor=parseFloat($('input:text[name=camara_comercio]').val());
       var credito_fiscal =parseFloat((valor * 13)/100);

          // Hacer algo si el checkbox ha sido seleccionado
            alert("Valor de crédito fiscal: " +credito_fiscal);
        }
       $('input[name=camara_check]').val(credito_fiscal);
     });

      //-------------------------------------------------
      $('input[name=costo_trans_bol_int_check]').on('click', function(){
       if($(this).is(':checked')){
       var valor=parseFloat($('input:text[name=costo_trans_bol_int]').val());
       var credito_fiscal =parseFloat((valor * 13)/100);

          // Hacer algo si el checkbox ha sido seleccionado
            alert("Valor de crédito fiscal: " +credito_fiscal);
        }
       $('input[name=costo_trans_bol_int_check]').val(credito_fiscal);
     });

     
</script>
</body>
</html>
