<section class="ficha">

	<div class="row">
		<div class="col-md-12">
			<h1>Ficha del servicio</h1>
		</div>
		<div class="col-md-12">
			<div class="col-md-3">
				
				<div class="row  text-center">
					<p>
						<img src="http://placehold.it/200x200" class="img-rounded" alt="">
					</p>
					<div class="col-md-10 col-md-offset-1">
						<p>
						
					
	  						<a href="#modalRecomendar" class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#modalRecomendar" >Recomendar a un amigo</a>
	  						<?php 
		  						 if(isset($usuario)){ 

		  						 	?>
		  						 		<form action="<?php echo site_url('set_favorito'); ?>" method="POST" id="favoritosForm">
		  						 			<div class="checkbox">
										        <label>
												 <input type="hidden" name="id_servicio" value="<?php echo $id; ?>">	
										          <input type="checkbox" name="favorito" <?php if($favorito){echo "checked";} ?> id="favorito"><?php 
										          	if($favorito){
										          		echo "<span>Agregado a favoritos</span>";
										          	}else{
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
				 if(empty($comentario) and empty($puntos)){
				 		
				?>

						<?php if(isset($usuario)){
						?>
						 <a href="#modalOpinion" class="btn btn-primary"  data-toggle="modal" data-target="#modalOpinion">Quiero opinar</a>

						 
						<?php
						}else{
							?>

							<a data-toggle="modal" href="#loginModal" data-seccion="ficha"  data-target="#loginModal" rel=""  class="btn btn-primary affterOpenLogin">Quiero opinar</a>


							
						<?php
						} ?>
					
				<?php 
				}
				?>
				</div>
			</div>
			<div class="col-md-6">
				<h2>
					<?php echo $titulo; ?>
				</h2>
				<p>
					<?php echo  $descripcion; ?>
				</p>
				<br>
				<h4>Datos de contacto</h4>
				
				<p>
						

					<?php if(isset($usuario)){
						?>


							<strong>Teléfono: </strong><?php echo $telefono; ?><br>
							<strong>Dirección: </strong><?php echo $direccion; ?><br>
						
							<strong>Sitio web: </strong><a href="<?php echo $url_web; ?>" title="<?php echo $titulo; ?>"><?php echo $url_web; ?></a><br>
							<strong>Titular: </strong><br />
						<?php
					}else{
						?>
						<strong>Nombre: </strong><?php echo $nombre; ?><br>
						<strong>Tel: </strong><?php echo $telefono; ?><br>
						
						<?php
					} ?>

				</p>

					
				<div class="clearfix"><br></div>
				<div class="alert hidden alert-dismissible" id="mensaje" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button></div>
				<form action="<?php echo site_url('enviar/comentario-servicio'); ?>" method="post" id="formCServ">
					<div class="form-group">
						<label for="comentario">Consultar sobre este servicio</label>
						<textarea class="form-control" name="comentario" id="comentario" rows="3" requerid="" placeholder="Mensaje"></textarea>

					</div>
					
					
					 <?php if(isset($usuario)){
						?>
						 <input type="hidden" value="<?php echo $id; ?>" name="id_servicio" />
						 <input type="hidden" value="<?php echo $titulo; ?>" name="nombre_servicio" />
						 <input type="hidden" value="<?php echo $nombre; ?>" name="nombre" />
						 <input type="hidden" value="<?php echo $email; ?>" name="email" />
						 <button type="submit" class="btn btn-info pull-right">Contactar</button>
						<?php
					}else{
						?>
						<a data-toggle="modal" href="#loginModal" data-target="#loginModal" rel=""  class="btn btn-info pull-right">Contactar
						</a>

						
						<?php
					} ?>
				</form>
			</div>
			<div class="col-md-3">
				<p>
					
				 <?php 
			         if(isset($map)){
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

		 if(!empty($opiniones)){

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
			 <?php if(isset($usuario)){
					?>
				<a href="#modalOpinion" class="btn btn-primary"  data-toggle="modal" data-target="#modalOpinion">Quiero opinar</a>
				<?php
					}else{
					?>
				<a data-toggle="modal" href="#loginModal"   data-target="#loginModal" rel=""  class="btn btn-primary affterOpenLogin ">Quiero opinar</a>
					<?php
					} ?>
			</div>
		</div>
		<div class="col-md-10" id="opiniones">
		<?php $this->load->view('listar_opiniones'); ?>
		</div>
	<?php
		} 
	?>
	</div>
	</div>

</section>