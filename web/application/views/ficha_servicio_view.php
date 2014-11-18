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
					<p><a href="#" class="btn btn-link">Recomendar a un amigo</a></p>
			      <?php
				 if(empty($comentario) and empty($puntos)){
				 		
				?>

						<?php if(isset($usuario)){
						?>
						 <a href="#modalOpinion" class="btn btn-primary"  data-toggle="modal" data-target="#modalOpinion">Quiero opinar</a>
						<?php
						}else{
							?>
						<a data-toggle="modal" href="#loginModal" data-target="#loginModal" rel=""  class="btn btn-primary ">Quiero opinar
						</a>

						
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
							<strong>Tel:</strong>:<?php echo $telefono; ?><br>
						
							<strong>Sitio web:</strong>:<a href="#" title=""><?php echo $url_web; ?></a><br>
						<?php
					}else{
						?>
						<strong>Nombre:</strong>:<?php echo $nombre; ?><br>
						<strong>Tel:</strong>:<?php echo $telefono; ?><br>
						
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
			<p class="text-center"><small>Servix no vende este servicio y no participa en ninguna negociación. Sólo se limita a la publicación de anuncios de sus usuarios.</small></p>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="modalOpinion" tabindex="-1" role="dialog" aria-labelledby="modalOpinion-1" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 class="modal-title" id="modalOpinion-1">Dejanos tu opinion sobre el servicio</h4>
		      </div>
					<form class="form-horizontal" role="form" id="form_votacion">
		      <div class="modal-body">
		       <div class="votacion">
			
					
					
					  <div class="form-group">
					    <label for="puntos" class="col-sm-5 control-label">¿Como Calificarias este servicio?</label>
					    <div class="col-sm-7">
					    		  <div id="stars" class="starrr " name="puntos2" ></div>
					    		  <input type="hidden" value="" id="puntos" name="puntos" required>
					    </div>
					  </div>
					  <div class="form-group">
					    <label for="fecha" class="col-sm-5 control-label">¿Cuando usaste el servicio?</label>
					    <div class="col-sm-6">
					    		<input class="form-control" type="date" name="fecha" id="fecha" required>
					    </div>
					  </div>
					  <div class="form-group">
					  	<div class="alert  alert-warning" role="alert">
					  		<p class="text-center">Por favor, sé fiel a los hechos y evita hacer comentarios inapropiados.</p>
					  	</div>
					    <label for="comentario" class="col-sm-5 control-label">Cuentanos tu experiencia</label>
					    <div class="col-sm-6">
					    		  	<textarea class="form-control"  name="comentario" rows="3" required></textarea>
					    </div>
					  </div>
					 
					 
					
					
				</div> 
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        <button type="submit" class="btn btn-primary">Enviar</button>
		      </div>
					</form>
		    </div>
		  </div>
		</div>
		<div class="clearfix"></div>
		<?php
		 if(!empty($comentario) and !empty($puntos)){

		?>

		<div class="col-md-12">


			<h3>Opiniones:</h3>
			<hr>
		</div>
		<div class="col-md-2">
			<div class=" text-right">
					<h2> 240 <small> Votos </small></h2>
					<p class="startt">
						<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>
						<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>
						<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>
						<span class="glyphicon .glyphicon-star-empty glyphicon-star"></span>
						<span class="glyphicon .glyphicon-star-empty glyphicon-star-empty"></span>
					</p>
					 <p class="">Promedio de<br> votos 4 Estrellas</p>
			       <a href="#modalOpinion" class="btn btn-primary"  data-toggle="modal" data-target="#modalOpinion">Quiero opinar</a>
				</div>
		</div>
		<div class="col-md-10">

	
				
                <div class="col-md-12">
                    <h4 class=""> Mira la del barrio</h4>
                    <p class=""> Qui diam libris ei, vidisse incorrupte at mel. His euismod salutandi dissentiunt eu. Habeo offendit ea mea. Nostro blandit sea ea, viris timeam molestiae an has. At nisl platonem eum. 
                       
                    </p>
                </div>
                <div class="col-md-12">
                    <h4 class=""> Mira la del barrio</h4>
                    <p class=""> Qui diam libris ei, vidisse incorrupte at mel. His euismod salutandi dissentiunt eu. Habeo offendit ea mea. Nostro blandit sea ea, viris timeam molestiae an has. At nisl platonem eum. 
                       
                    </p>
                </div>
                <div class="col-md-12">
                    <h4 class=""> Mira la del barrio</h4>
                    <p class=""> Qui diam libris ei, vidisse incorrupte at mel. His euismod salutandi dissentiunt eu. Habeo offendit ea mea. Nostro blandit sea ea, viris timeam molestiae an has. At nisl platonem eum. 
                       
                    </p>
                </div>
		</div>
			<?php
		} ?>
	</div>

</section>