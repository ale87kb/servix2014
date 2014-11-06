<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión Servix</title>

    <!-- Bootstrap -->
    <link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/css/styles.css'); ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>



  <body>
<nav class="navbar navbar-default navbar-static-top navbar-servix" role="navigation">
  <!--<div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>-->
  </div>
</nav>


<div class="container">
  <div class="jumbotron col-md-12">
<h1>Login en Servix</h1>
   <?php echo validation_errors(); ?>

   <!--
   <?php echo validation_errors(); ?>
   <?php echo form_open('validar-login'); ?>
     <label for="usuario">Usuario:</label>
     <input type="text" size="20" id="usuario" name="usuario"/>
     <br/>
     <label for="clave">Clave:</label>
     <input type="password" size="20" id="clave" name="clave"/>
     <br/>
     <input type="submit" value="Login"/>
   </form>--> 


    <form class="form-horizontal" role="form" id="formulario-login" action="<?php echo site_url('validar_login');?>" method="POST">
    <div class="form-group">
      <label for="usuario" class="col-sm-2 control-label">Usuario</label>
      <div class="col-sm-7">
        <input type="email" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
      </div>
    </div>
    <div class="form-group">
      <label for="clave" class="col-sm-2 control-label">Clave</label>
      <div class="col-sm-7">
        <input type="password" class="form-control" id="Clave" name="clave" placeholder="Clave">
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox"> Seguir conectado
          </label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Iniciar Sesión</button>
      </div>
    </div>
  </form>




  </div>
 </div>
    <div class="navbar navbar-default navbar-static-bottom footer-servix">
      <div class="container">
        <span class="navbar-text">
        &copy; Servix 2014. Todos los derechos reservados.
        </span>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php  echo site_url('assets/js/bootstrap.min.js');?>"></script>
    <script src="<?php  echo site_url('assets/js/bootstrap-typeahead.js');?>"></script>
    <script>
      $site_url = "<?php echo site_url();?>";
    </script>
    <script src="<?php  echo site_url('assets/js/script.js');?>"></script>
  </body>
</html>




