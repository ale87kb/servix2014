<div class="container">
  <div class="col-md-12">
  <h1>Recuperar clave de usuario</h1>
   
   <?php 
	if (isset($correcto)){

   		if(isset($mailenviado)){
	?>

			<p>Tu clave ha sido modificada.</p>
			<p>Te enviamos un mensaje a tu casilla de e-mail, con tu nueva clave, para que puedas iniciar sesión.</p>
			<p>Te recomendamos que luego de iniciar sesión modifiques tu clave.</p>
			<p>Servix</p>

	<?php
   		}
   		else if (isset($mailnoenviado))
   		{
	?>

			<p>Tu clave ha sido modificada.</p>
			<p>No pudimos enviarte un mensaje a tu casilla de e-mail con tu nueva clave.</p>
			<p>Por favor comunicate con nuestros sistemas de contacto para que te facilitemos tu nueva clave.</p>
			<p>Servix</p>

   	<?php
   		}
   	}else
	{
	?>

		<p>No hemos podido modificar tu clave.</p>
		<p>Por favor vuelve a intentar en unos minutos.</p>
		<p>Servix</p>

	<?php
	}
   	?>
	
	<a href="<?php echo site_url('');?>">Volver al inicio</a>


  </div>
</div>
