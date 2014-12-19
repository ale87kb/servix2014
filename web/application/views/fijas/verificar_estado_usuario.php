<div class="container" id="main">
  <div class="col-md-12">
  	<h1>Verificación de Usuario</h1>
  	<h3>Tu usuario no ha sido verificado</h3>
  	<p>Tu usuario no ha sido verificado todavía. Cuando te registraste en el sitio, te enviamos un e-mail, con un código para verificar tu usuario.</p>
    <p>Para poder ingresar al sitio debemos confirmar que eres una persona y no un robot.</p>
  	<p>Por favor, ingresa en tu casilla de e-mail para poder verificar tu usuario.</p>
  	<p>A veces los provedores de servicio de mensajería electrónica cometen el error de colocar e-mails en la carpeta de Correo No Deseado o Spam.<br/>
  		No olvides revisar en la carpeta de Correo No Deseado o Spam.</p>
  	<h3>Pedir nuevo código de verificación</h3>
  	<p>Si no logras encontrar tu código de verificación, puedes pedir uno nuevo.</p>
  	<p>Completa con tu e-mail:</p>

      <form class="form-horizontal" role="form" id="recuperar-clave" action="<?php echo site_url('validar_usuario_newCodigo');?>" method="POST">
      <div class="form-group">
        <label for="usuario" class="col-sm-2 control-label">Usuario</label>
        <div class="col-sm-7">
          <input type="email" class="form-control" id="usuario" name="usuario" placeholder="E-mail de usuario">
        </div>
      </div>
  	<?php echo validation_errors(); ?>
      <div class='errorusername'></div>

      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Pedir nuevo código</button>
           <input type="hidden" name="grabar" value="si" />
        </div>
      </div>
    </form>
  </div>
</div>