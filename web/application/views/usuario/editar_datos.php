<div class="container" id="main">
<div class="edit_usuario">

	<div class="row">
		<div class="col-md-12">
			<div class="row">

<div id="box_edicionUser" class="col-md-12">
   

<h1>Editar perfil</h1>

<form id="form_edit_user" class="form-horizontal" role="form" name="form_reg" action="<?php echo site_url('mi-perfil/validar_editar_datos');?>" method="post" enctype="application/x-www-form-urlencoded">
  
  <legend>Datos del usuario</legend>
  <div class="form-group">

    <div class="col-md-10 col-md-offset-1">

      <div class="col-xs-12 col-sm-3 text-center">      
        <figure>
          <img id="user_foto" src="<?php echo site_url($usuarioSession['foto_125_path']);?>" alt="Foto de perfil" width="125" />
          <figcaption><a id="editPhoto" href="#editar_foto" data-toggle="modal" data-target="#edit_photo">Editar Foto</a></figcaption>
        </figure>
      </div>

      <div class="col-md-9 col-sm-9">

        <div class="form-group">
          <label for="usuario" class="col-md-4 control-label">* E-mail</label>
          <div class="col-md-7">
            <p class="form-control-static input-hide-email" id="eTusuario"><?php echo $usuarioSession['email']; ?>&nbsp;<span>(<a href="#editarEmail" id="cImail">Cambiar</a>)</span></p>
            <input style="display:none;" type="email" class="form-control input-hidden-email" id="eIusuario" name="usuario" placeholder="E-mail de usuario" value="<?php echo $usuarioSession['email']; ?>">
          </div>
        </div>
        <div class='errorusername' style="color:red;">
          <?php echo form_error('usuario'); ?>
        </div>

        <div class="form-group">
          <p class="col-md-offset-4 col-md-7"><a href="#cambiarClave" id="cClaveT">Cambiar contraseña</a></p>
        </div>

        <div id="nuevaClaveBox" class="" style="display:none;">
          <div class="form-group">
            <div id="cClaveB">
              <label for="clave" class="col-md-4 control-label">* Contraseña Actual</label>
              <div class="col-md-7">
                <input style="display:none;" type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña">
              </div>
            </div>
          </div>
          <div class='errorpassword' style="color:red;">
            <?php echo form_error('clave'); ?>
          </div>
          
          <div class="form-group">
            <label for="nclave" class="col-md-4 control-label">* Nueva Contraseña</label>
            <div class="col-md-7">
              <input style="display:none;" type="password" class="form-control" id="nclave" name="nclave" placeholder="Nueva Contraseña">
            </div>
          </div>
          <div class='errorpassword' style="color:red;">
            <?php echo form_error('nclave'); ?>
          </div>

          <div class="form-group">
            <label for="rclave" class="col-md-4 control-label">* Repetir Nueva Contraseña</label>
            <div class="col-md-7">
              <input style="display:none;" type="password" class="form-control" id="rclave" name="rclave" placeholder="Repetir Nueva Contraseña">
            </div>
          </div>
          <div class='errorpasswordr' style="color:red;">
            <?php echo form_error('rclave'); ?>
          </div>
        </div><!--/nuevaClaveBox-->
      </div>
    </div>

  </div>

  <legend>Datos personales</legend>

  <div class="form-group">
    <div class="col-xs-9 col-md-offset-3">

    <div class="form-group">
      <label for="nombre" class="col-md-2 control-label">* Nombre/s</label>
      <div class="col-md-6">
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre/s" value="<?php echo $usuarioSession['nombre']; ?>">
      </div>
    </div>
    <div class='errornombre' style="color:red;">
      <?php echo form_error('nombre'); ?>
    </div>

    <div class="form-group">
      <label for="apellido" class="col-md-2 control-label">* Apellido/s</label>
      <div class="col-md-6">
        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido/s" value="<?php echo $usuarioSession['apellido']; ?>">
      </div>
    </div>
    <div class='errorapellido' style="color:red;">
      <?php echo form_error('apellido'); ?>
    </div>

    <div class="form-group">
      <label for="clave" class="col-md-2 control-label">Dirección</label>
      <div class="col-md-6">
        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Tu Dirección" value="<?php echo $usuarioSession['direccion']; ?>">
      </div>
    </div>
    <div class='errordireccion' style="color:red;">
      <?php echo form_error('direccion'); ?>
    </div>

    <div class="form-group">
      <label for="rclave" class="col-md-2 control-label">Teléfono</label>
      <div class="col-md-6">
        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tu Teléfono" value="<?php echo $usuarioSession['telefono']; ?>">
      </div>
    </div>
    <div class='errortelefono' style="color:red;">
      <?php echo form_error('telefono'); ?>
    </div>
  </div>
</div>

  <div class="col-md-8 col-md-offset-3">
    <p class="text-center"><small>Los campos con * son obligatorios</small></p>
  </div>

  <div class="form-group">
    <div class="col-md-offset-4 col-md-5">
      <button type="submit" name="registro_submit" class="btn btn-success">Guardar</button>
      <a href="<?php echo site_url('mi-perfil');?>" class="btn btn-default pull-right" role="button">Volver a Mi Perfil</a>
      <input type="hidden" name="grabar" value="si" />
      <input type="hidden" name="user" value="<?php echo $usuarioSession['id']; ?>" />
    </div>
  </div>
</form>

</div><!--/box_edicionUser-->
			</div><!--/row-->
		</div>
	</div>
</div>
</div><!--/container-fluid-->