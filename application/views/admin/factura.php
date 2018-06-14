<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>facturas</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>plantillas/plugins/select2/select2.min.css">
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
<body class=""><!--hold-transition skin-blue sidebar-mini-->
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="">
   
    <!-- Main content -->
    <section class="content">

        <!-- /.box-header -->
        <div class="box-body">
         <div class="row">
           
            <form role="form" action="<?php  echo base_url() ?>controlpanel/validar_datos" method="post" >
              

            <div class="panel panel-primary ">
             <div class="panel-heading ">FORMULARIO DE INSCRIPCION</div>
              <div class="panel-body">
                <div class="form-group ">
                
                 <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre" name='nombre'value="<?php echo set_value('nombre'); ?>"required>
                <label> Apellidos </label>
                  <input type="text" class="form-control" placeholder="Apellidos" name='apellidos'value="<?php echo set_value('apellidos'); ?>"required>
                  <label> Cuit </label>
                  <input type="text" class="form-control" placeholder="Cuit" name='cuit'value="<?php echo set_value('cuit'); ?>"required>
                  <label> Empresa </label>
                  <input type="text" class="form-control" placeholder="empresa" name='empresa'value="<?php echo set_value('empresa'); ?>"required>
                 <label>DNI: </label>
                 <input type="text" class="form-control" placeholder="DNI" name='dni'value="<?php echo set_value('dni'); ?>" required>
               
                 <label>Correo:</label>
                 <div class="input-group">
                   <span class="input-group-addon">@</span>
                   <input type="email" class="form-control" placeholder="Correo" name='email' value="<?php echo set_value('email'); ?>"required>
                 </div>

                 <div class="form-group">
                  <label>Telefono:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input type="text" class="form-control"   name='telefono' value="<?php echo set_value('telefono'); ?>" required>
                  </div>
                </div>
                             <!-- Direccion -->
                <div class="form-group">
                  <label>Direcci&oacute;n</label>
                  <textarea class="form-control" rows="3" placeholder="Direcci&oacute;n"  name='direccion' value="<?php echo set_value('direccion'); ?>" required></textarea>
                </div>
              
            </div>
            <?php $fecha_ingreso  = date('d-m-y'); ?>
              <input  type="hidden" value= "<?php echo $fecha_ingreso ;?>"   name = "fecha_ingreso"/>
              <input  type="hidden" value= "1"       name = "id_categoria"/>
              <input  type="hidden" value= "3"       name = "id_curso"/>
              <input  type="hidden" value= "4"       name = "id_aula"/>
               
         
                        
            
              <div class="box-footer">
                <div class="col-md-6">
                  <button type="submit" class="btn btn-default" onclic="reset()">Limpiar</button>
                  <button type="submit" class="btn btn-info pull-right">Generar Boleta PDF</button>
                </div>
             </div>

          </form>

           <?php if (validation_errors()): ?>
               
                <div class="alert alert-error">
                  <?php echo validation_errors(); ?>
                </div>
              <?php endif; ?>

         
         
          <!-- /.row -->
          
        </div>
        <!-- /.box-body -->
        
      </div>
    </section>
    <!-- /.content -->
  </div>

  

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>plantillas/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>plantillas/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>plantillas/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url();?>plantillas/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>plantillas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>plantillas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url();?>plantillas/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url();?>plantillas/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url();?>plantillas/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url();?>plantillas/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url();?>plantillas/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url();?>plantillas/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>plantillas/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>plantillas/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>plantillas/dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

  
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
</body>
</html>
