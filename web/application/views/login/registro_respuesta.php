<div class="container">
  <div class="jumbotron col-md-12">
  <h1>Registro de usuario en Servix</h1>
   
   <?php 
	if (isset($data['correcto'])){

   		if(isset($data['mailenviado'])){
	?>

			<p>Tu usuario ha sido creado.</p>
			<p>Te enviamos un mensaje a tu casilla de Email, para que confirmes tu usuario.</p>
			<p>Gracias por sumarte a Servix</p>

	<?php
   		}
   		else
   		{
	?>

			<p>Tu usuario ha sido creado.</p>
			<p>Gracias por sumarte a Servix</p>

   	<?php
   		}
   else
	{
	?>

		<p>No hemos podido registrar tu usuario.</p>
		<p>Por favor volve a intentar en unos minutos</p>

	<?php
	}
   	?>
	
	<a href="<?php echo site_url('');?>">Volver al inicio</a>


  </div>
</div>
