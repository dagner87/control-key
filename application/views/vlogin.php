<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?php echo base_url();?>plantillas/favicon.ico">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>/plantillas/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>/plantillas/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>/plantillas/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<?php 
if(isset($_POST['recordar']) && !empty($_POST['recordar'])){
setcookie("nombre_de_cookie", "valor_de_cookie", time()+3600, "/" , "sistema.keysolutios.com.bo"); 
} 
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url();?>"><b>Admin</b>KEY</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
        <?php
          $username = array('name' => 'username', 'placeholder' => 'Nombre de usuario','class' =>'form-control','type' => 'text');
          $password = array('name' => 'password', 'placeholder' => 'introduce tu password','class' =>'form-control');
          $submit = array('name' => 'submit', 'value' => 'Entrar', 'title' => 'Iniciar sesión','class' => 'btn btn-primary btn-block btn-flat');
          $attributes = array('class' => 'form-horizontal');
          ?>

    <!--form  action='<?php echo base_url()?>login/user_login' method='post' accept-charset='UTF-8'-->
      
      <?=form_open(base_url().'logusuario', $attributes)?> 
      
      <div class="form-group has-feedback">
       <?=form_input($username)?>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
       <p><?=form_error('username')?></p>
       

      </div>
      <div class="form-group has-feedback">
        <?=form_password($password)?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <p><?=form_error('password')?></p>
     </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="recordar"> Recordarme
            </label>
          </div>
        </div>

        
        <!-- /.col -->
        <div class="col-xs-4">
           <?=form_hidden('token',$token)?>
           <?=form_submit($submit)?>
        
        </div>
        <!-- /.col -->
      </div>
    </form>
  
    <!-- /.social-auth-links -->

    <!--a href="#">I forgot my password</a><br -->
 

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>/plantillas/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>/plantillas/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>/plantillas/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '40%' // optional
    });
  });
</script>
</body>
</html>
