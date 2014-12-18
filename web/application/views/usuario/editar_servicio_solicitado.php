<div class="container" id="main">
<div class="row">
	<div class="jumbotron col-md-12">
		<div class="row">
			<div class="col-md-12">
				<h1>Editar servicio solicitado</h1>
				<p>Puedes editar el servicio solicitado publicado</p>
			</div>

			<div class="col-md-6 from-box">
				<h3>Formulario de solicitud</h3>
				<?php 
				$msj = $this->session->flashdata('mensaje_e');
				if(!empty($msj))
				{
					$clase = ($msj['error'] == 0) ? 'alert-success' : 'alert-warning';
				?>
					<div class="alert <php echo $clase; ?>" id="mensaje_e" role="alert"><?php echo $msj['mensaje_e']; ?></div>
				<?php
				}
			 ?>
				
				<form action="<?php echo site_url('validar-editar-solicitud-servicio'); ?>" method="post" id="formulario-solicitud">
					  <div class="form-group">
		                <label for="busqueda-servicio">¿En que categoría lo estas buscando?</label>
		                <input type="text" class="form-control typeaheadOnlyCat" id="busqueda-servicio" value="<?php echo $post['categoria']?>" name="categoria" autocomplete="off" required="" placeholder="¿Qué buscas?">
		              </div>
		               <div class="form-group">
		                <label for="busqueda-localidad">¿En que localidad lo estas solicitando?</label>

		                <select id="ajax-select" class="form-control selectpicker with-ajax" name="localidad" placeholder="Buscar" data-live-search="true" >
                       	<?php 
                       	if(isset($post['id_localidad']))
                       	{
                   		?>
            			<option value="<?php echo $post['id_localidad']; ?>"><?php echo $post['localidad'] .", ".$post['provincia']; ?></option>
               			<?php
                       	}
                       	?>
                       </select>

		              </div>
					  <div class="form-group">
		                <label for="fecha_fin">¿Para cuando lo necesitas?</label>
		                <div class='input-group date' id='datetimepicker2'>
		                    <input type='text' class="form-control" name="fecha_fin" id="fecha_fin" placeholder="Fecha y hora" data-date-format="DD/MM/YYYY HH:mm" value="<?php echo $post['fecha_fin']?>" />
		                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		                </div>
		              </div>
		               <div class="form-group">
		                <label for="comentario">Comentanos un poco que andas solicitando</label>
		                <textarea name="comentario" class="form-control" id="comentario" cols="3" rows="6" placeholder="Tu comentario"><?php echo $post['busqueda']?></textarea>
		              </div>
		               <div class="form-group">
		                <p class="text-right">
		                	<a role="button" class="btn btn-default pull-left" href="<?php echo site_url('mi-perfil/servicios-solicitados'); ?>">Volver a Mis servicios solicitados</a>
		                	 <input type="hidden" name="serSoliid" value="<?php echo $post['id'];?>">
		                	<button type="submit" class="btn btn-success">Enviar solicitud</button>
		                </p>
		              </div>
				</form>
			</div>

			<div class="col-md-6 guia-uso">
				<h3>Guia para solicitar un servicio</h3>
				<ul>
					<li>
						<p>Busca tu categoria, en la cual solicitas el servicio,
							Si no aparece en el listado, será asignada a la categoria de "<strong>Otros</strong>".
						</p>
					</li>
					<li>
						<p>Busca tu localidad y provincia, en el campo de localidad.</p>
					</li>
					<li>
						<p>Completa tu fecha para cuando necesitas este servicio.</p>
					</li>
					<li>
						<p>Déjanos una breve descripción de lo que estas buscando</p>
					</li>
					<li>
						<p>Tu publicación estará  activa durante una semana , luego será pausada , para darle el lugar a otras publicaciones.
						Si quieres reactivar la solicitud , solo debes entrar a tu <a href="#">perfil</a> y reactivarla.
						</p>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
</div>