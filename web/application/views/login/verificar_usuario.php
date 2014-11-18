<div class="container">
<?php
	if(!$error)
	{
?>
	<p><?php echo $mensaje; ?></p>

	<p>Te invitamos a iniciar sesión para empezar a disfrutar de Servix.</p>


<?php
	}
	else
	{

		switch ($estado) {
			case 1:
?>
				<p><?php echo $mensaje; ?></p>
<?php
				break;
			case 2:
?>
				<p><?php echo $mensaje; ?></p>

				<p>Comunicate con nosotros para que te asesoremos.</p>
<?php
				break;
			
			default:
?>
				<p><?php echo $mensaje; ?></p>

				<p>Verificá el código que aparece en el email que te enviamos cuando te registraste.</p>
<?php
				break;
		}

	}
?>




</div>