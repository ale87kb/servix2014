<div class="container" id="main">
	<div class="row">
		<div class="jumbotron col-md-12">
			<div class="row">
				<div class="col-md-12">
				<?php 
				if($error)
				{
				?>
					<h2>Ups.. tenemos un problema</h2>
					<p>Su servicio no pudo ser procesado en este momento, por favor intente nuevamente mas tarde.</p>
					<p>Disculpe las molestias.</p>
					<p><a href="<?php echo site_url(''); ?>">Volver al inicio</a></p>
				<?php
				}
				else
				{
				?>
					<h2>Servicio publicado exitosamente</h2>
					<p>Su servicio ahora está publicado en nuestro sitio, este puede aparecer en las busquedas,
					o en el top 5 de servicios destacados en el caso que sea uno de los más puntuados.
					</p>
					<p>Gracias por confiar en Servix.</p>
					<p><a href="<?php echo site_url(''); ?>">Volver al inicio</a></p>
				<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
</div>

