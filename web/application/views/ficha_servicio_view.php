<div class="container" id="main">
<section class="ficha">
	<div class="row">
		<div class="col-md-12">
			<h1>Ficha del servicio</h1>
		</div>
		<div class="col-md-12">
			<div class="col-md-3">
				<div class="row  text-center">
					<figure>
						<img src="<?php echo $servicioRS->foto_path;?>" class="img-rounded img-responsive" alt="" style="margin: 0px auto 10px;">
					</figure>
					<div class="col-md-10 col-md-offset-1">
						<p>
  							<a href="#modalRecomendar" class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#modalRecomendar" >Recomendar a un amigo</a>
  						<?php 
							if(isset($usuarioSession))
							{ 
					 	?>
					 		<form action="<?php echo site_url('set_favorito'); ?>" method="POST" id="favoritosForm">
					 			<div class="checkbox">
							        <label>
										<input type="hidden" name="id_servicio" value="<?php echo $servicioRS->id; ?>">	
										<input type="checkbox" name="favorito" <?php if($favorito){echo "checked";} ?> id="favorito">
									<?php 
							          	if($favorito)
							          	{
							          		echo "<span>Agregado a favoritos</span>";
							          	}
							          	else
							          	{
							         		echo "<span>Agregar a favoritos</span>";
							          	}
						           ?>
							        </label>
								</div>
					 		</form>
					 	<?php
							}
  						?>
						</p>
					</div>	
		      <?php
				if(empty($comentario) and empty($puntos))
				{
					if(isset($usuarioSession))
					{
			?>
						<a href="#modalOpinion" class="btn btn-primary" data-toggle="modal" data-target="#modalOpinion">Quiero opinar</a>
			<?php
					}
					else
					{
			?>
						<a data-toggle="modal" href="#loginModal" data-seccion="ficha" data-target="#loginModal" rel="" class="btn btn-primary affterOpenLogin">Quiero opinar</a>
			<?php
					}

				}
			?>
				</div>
			</div>
			<div class="col-md-6">
                <div class="row">
                	<p class="pull-right">
	                	<span class="label label-default"><?php echo ucfirst($servicioRS->categoria); ?></span>
	                	<span class="label label-default"><?php echo ucfirst($servicioRS->localidad); ?></span>
	                	<span class="label label-default"><?php echo ucfirst($servicioRS->provincia); ?></span>
                	</p>
            	</div>

				<h2><?php echo $servicioRS->titulo; ?></h2>
				<p><?php echo  $servicioRS->descripcion; ?></p>
				<br>
				<h4>Datos de contacto</h4>
				<p>
					<strong>Teléfono: </strong><?php echo $servicioRS->telefono; ?><br>
				<?php 
					if(isset($usuarioSession))
					{
				?>
					<strong>Dirección: </strong><?php echo $servicioRS->direccion; ?><br>
				<?php
					}
				?>
					<strong>Sitio web: </strong><a href="<?php echo $servicioRS->url_web; ?>" title="<?php echo $servicioRS->titulo; ?>"><?php echo $servicioRS->url_web; ?></a><br>
					<strong>Titular: </strong><a href="<?php echo $servicioRS->link_user; ?>" title="Ver perfil"><?php echo $servicioRS->nombre . ' ' .  $servicioRS->apellido; ?></a><br />
			
				</p>
				<div class="clearfix"><br></div>
				<div class="alert hidden alert-dismissible" id="mensaje" role="alert">
					<button type="button" class="close" data-dismiss="alert">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
				<form action="<?php echo site_url('enviar/comentario-servicio'); ?>" method="post" id="formCServ">
					<div class="form-group">
						<label for="comentario">Consultar sobre este servicio</label>
						<textarea class="form-control" name="comentario" id="comentario" rows="3" requerid="" placeholder="Mensaje"></textarea>
					</div>
					
				<?php 
		 			if(isset($usuarioSession))
		 			{
				?>
						<input type="hidden" value="<?php echo $servicioRS->id; ?>" name="id_servicio" />
						<input type="hidden" value="<?php echo $servicioRS->titulo; ?>" name="nombre_servicio" />
						<input type="hidden" value="<?php echo $servicioRS->userID; ?>" name="userid" />
						<button type="submit" class="btn btn-info pull-right">Contactar</button>
				<?php
					}
					else
					{
				?>
						<a data-toggle="modal" href="#loginModal" data-target="#loginModal" rel="" class="btn btn-info pull-right">Contactar</a>
				<?php
					}
				?>
				</form>
			</div>
			<div class="col-md-3">
				<p>				
				 <?php 
			        if(isset($map))
			        {
			          echo $map['html'];
			        }
		        ?>
				</p>
			</div>
		</div>
		<div class="col-md-12">
			<hr>
			<p class="text-center"><small><?php echo APP_NAME;?> no vende este servicio y no participa en ninguna negociación. Sólo se limita a la publicación de anuncios de sus usuarios.</small></p>
		</div>
		
		<div class="clearfix"></div>
	<?php
		if(!empty($opiniones))
		{
	?>

		<div class="col-md-12">
			<h3>Opiniones:</h3>
			<hr>
		</div>
		<div class="col-md-2">
			<div class=" text-right">
				<h2> <?php echo $puntos; ?> <small> Votos </small></h2>
				<div class="ratyAVG" data-avg="<?php echo number_format($promedio,2); ?>"></div>
				<p class="">Promedio <?php echo number_format($promedio,1); ?> </p>
			<?php
				if(isset($usuarioSession))
				{
			?>
				<a href="#modalOpinion" class="btn btn-primary"  data-toggle="modal" data-target="#modalOpinion">Quiero opinar</a>
			<?php
				}
				else
				{
			?>
				<a data-toggle="modal" href="#loginModal"   data-target="#loginModal" rel=""  class="btn btn-primary affterOpenLogin ">Quiero opinar</a>
			<?php
				}
			?>
			</div>
		</div>
		<div class="col-md-10" id="opiniones">
			<?php $this->load->view('listar_opiniones'); ?>
		</div>
	<?php
		} 
	?>
	</div>
</section>
</div>