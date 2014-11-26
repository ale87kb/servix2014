  <div class="jumbotron col-md-12">
  <h1>Edicion de usuario</h1>
   
   <?php 
	if (isset($edditUser) && $edditUser){

		if (isset($newEmail) && $newEmail){

   			if(isset($envioNuevoMail) && $envioNuevoMail){
	?>
			<p>Tu e-mail de usuario ha sido modificado correctamente.</p>
			<p>Te enviamos un mensaje a tu casilla de e-mail, para que confirmes tu usuario.</p>

	<?php
	   		}
	   		else
	   		{
	?>
			<p>No hemos podido editar tu e-mail de usuario. Por favor vuelve a intentar en unos minutos</p>

   	<?php
   			}
   		}
   		if(isset($newClave) && $newClave){
   			if(isset($envioEditClave) && $envioEditClave){
	?>
			<p>Tu clave ha sido modificada correctamente.</p>

	<?php
	   		}
	   		else
	   		{
	?>
			<p>No hemos podido editar tu clave. Por favor vuelve a intentar en unos minutos</p>

   	<?php
   			}
   		}
	?>
   		<p>Tus datos de usuario han sido modificados correctamente.</p>
	<?php 
   	}
   	else
	{
	?>

		<p>No hemos podido editar tu datos de usuario. Por favor vuelve a intentar en unos minutos</p>

	<?php
	}
   	?>
	
	<a href="<?php echo site_url('');?>">Volver al inicio</a>
	<a href="<?php echo site_url('mi-perfil');?>">Volver a mi perfil</a>

  </div>
</div>
