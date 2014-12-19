<div class="container" id="main">
  <div class="jumbotron col-md-12">
  <h1>Inicio de sesión en Servix</h1>
  <p>Inicia sesión con tu e-mail de usuario</p>
   
   <?php echo validation_errors(); ?>

    <form class="form-horizontal" role="form" id="formulario-login" action="<?php echo site_url('validar_login_ajax');?>" method="POST">
    <div class="form-group">
      <label for="usuario" class="col-sm-2 control-label">Usuario</label>
      <div class="col-sm-7">
        <input type="email" class="form-control" id="usuario" name="usuario" placeholder="E-mail de usuario">
      </div>
    </div>
    <div class='errorusername'></div>
    
    <div class="form-group">
      <label for="clave" class="col-sm-2 control-label">Clave</label>
      <div class="col-sm-7">
        <input type="password" class="form-control" id="clave" name="clave" placeholder="Clave">
      </div>
    </div>
    <div class='errorpassword'></div>
    
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label>
            <input type="checkbox" value="recordar" name="recordar" id="recordar">Seguir conectado
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

  </div><!--/container-fluid-->
