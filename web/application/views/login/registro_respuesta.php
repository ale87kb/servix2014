  <div class="jumbotron col-md-12">
  <h1>Registro de usuario en Servix</h1>
   
   <?php 
	if (isset($adduser) && $adduser){

   		if(isset($mailenviado) && $mailenviado){
	?>
			<p>Tu usuario ha sido creado.</p>
			<p>Te enviamos un mensaje a tu casilla de Email, para que confirmes tu usuario.</p>
			<p>Gracias por sumarte a Servix</p>

	<?php
   		}
   		else if (isset($mailenviado) && !$mailenviado)
   		{
	?>
			<p>Tu usuario ha sido creado.</p>
			<p>No se pudimos enviarte un mensaje a tu casilla de Email para que confirmes tu usuario, la proxima vez que inicies sesión se te pedirá verifiar tu usuario.</p>
			<p>Gracias por sumarte a Servix</p>

   	<?php
   		}
   	}
   	else
	{
	?>

		<p>No hemos podido registrar tu usuario.</p>
		<p>Por favor vuelve a intentar en unos minutos</p>

	<?php
	}
   	?>
	
	<a href="<?php echo site_url('');?>">Volver al inicio</a>


  </div>
</div>
