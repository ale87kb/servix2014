<div class="container" id="main">
  <div class="col-md-12">
  <h1>Recuperar clave</h1>
  <p>Rellena el siguiente campo con tu e-mail registrado, y te enviaremos un mensaje con una nueva contraseña.</p>
  <p>Te recomendamos que luego de iniciar sesión, cambies tu contraseña.</p>
   
   <?php echo validation_errors(); ?>

    <form class="form-horizontal" role="form" id="recuperar-clave" action="<?php echo site_url('validar_recuperar_clave');?>" method="POST">
    <div class="form-group">
      <label for="usuario" class="col-sm-2 control-label">Usuario</label>
      <div class="col-sm-7">
        <input type="email" class="form-control" id="usuario" name="usuario" placeholder="E-mail de usuario">
      </div>
    </div>
    <div class='errorusername'></div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Recuperar Clave</button>
         <input type="hidden" name="grabar" value="si" />
      </div>
    </div>
  </form>

  </div>
</div>
