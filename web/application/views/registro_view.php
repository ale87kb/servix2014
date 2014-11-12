<div class="container">
  <div class="jumbotron col-md-12">
   

<h1>Registrar Usuario</h1>
	<h3>Datos del usuario</h3>
	<p>Datos requeridos para poder iniciar sesión</p>
<form class="form-horizontal" role="form" name="form_reg" action="<?php echo site_url('validar_nuevo_usuario');?>" method="post" enctype="multipart/form-data">
  
	<div class="form-group">
      <label for="usuario" class="col-sm-2 control-label">* Email</label>
      <div class="col-sm-7">
        <input type="email" class="form-control" id="usuario" name="usuario" placeholder="Email de usuario" value="<?php echo set_value('usuario') ?>">
      </div>
    </div>
    <div class='errorusername' style="color:red;">
      <?php echo form_error('usuario'); ?>
    </div>

    <div class="form-group">
      <label for="clave" class="col-sm-2 control-label">* Contraseña</label>
      <div class="col-sm-7">
        <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña">
      </div>
    </div>
    <div class='errorpassword' style="color:red;">
      <?php echo form_error('clave'); ?>
    </div>

    <div class="form-group">
      <label for="rclave" class="col-sm-2 control-label">* Repetir Contraseña</label>
      <div class="col-sm-7">
        <input type="password" class="form-control" id="rclave" name="rclave" placeholder="Repetir Contraseña">
      </div>
    </div>
    <div class='errorpasswordr' style="color:red;">
      <?php echo form_error('rclave'); ?>
    </div>

  <h3>Datos personales</h3>
  <p>Datos requeridos para conocerte un poco mas</p>

  <div class="form-group">
      <label for="nombre" class="col-sm-2 control-label">* Nombre/s</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre/s" value="<?php echo set_value('nombre') ?>">
      </div>
    </div>
    <div class='errornombre' style="color:red;">
      <?php echo form_error('nombre'); ?>
    </div>

    <div class="form-group">
      <label for="apellido" class="col-sm-2 control-label">* Apellido/s</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido/s" value="<?php echo set_value('apellido') ?>">
      </div>
    </div>
    <div class='errorapellido' style="color:red;">
      <?php echo form_error('apellido'); ?>
    </div>

  <div class="form-group">
      <label for="usuario" class="col-sm-2 control-label">* DNI</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" id="dni" name="dni" placeholder="Documento de Identidad" value="<?php echo set_value('dni') ?>">
      </div>
    </div>
    <div class='errordni' style="color:red;">
      <?php echo form_error('dni'); ?>
    </div>

    <div class="form-group">
      <label for="clave" class="col-sm-2 control-label">Dirección</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Tu Dirección" value="<?php echo set_value('direccion') ?>">
      </div>
    </div>
    <div class='errordireccion' style="color:red;">
      <?php echo form_error('direccion'); ?>
    </div>

    <div class="form-group">
      <label for="rclave" class="col-sm-2 control-label">Teléfono</label>
      <div class="col-sm-7">
        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tu Teléfono" value="<?php echo set_value('telefono') ?>">
      </div>
    </div>
    <div class='errortelefono' style="color:red;">
      <?php echo form_error('telefono'); ?>
    </div>
    
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <p>Al hacer clic en Registrarse, aceptas las <a href="#">Condiciones</a> y que has leído la <a href="#">Política de uso de datos</a>, incluido el <a href="#">Uso de cookies</a>.</p>
      </div>
    </div> 

 <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="registro_submit" class="btn btn-default">Registrarse</button>
        <input type="hidden" name="grabar" value="si" />
      </div>
    </div>

</form>

  </div>
</div>
