<div class="container" id="main">
	<div class="col-md-12">
		  <h1>Verificación de Usuario</h1>
		   
	  <?php 
   		if(isset($mailenviado)){
	?>
				<p>Te enviamos un mensaje a tu casilla de e-mail, con tu código de verificación para que confirmes tu usuario.</p>
				<p>Gracias por sumarte a Servix</p>
		<?php
   		}
   		else if (isset($mailnoenviado))
   		{
	?>
				<p>Ups.. tenemos un problema.</p>
				<p>No pudimos enviarte un mensaje con tu código de verificación.</p>
				<p>Por favor intenta mas tarde.</p>
				<p>Gracias, Servix</p>
	   	<?php
	   		}
	   	?>
			<a href="<?php echo site_url('');?>">Volver al inicio</a>
	</div>
</div>