<div class="container">
		<div class="col-md-7">
				<h1>Solicitud de servicio</h1>



				<div class="media">
			      <a class="media-left" href="#">
			        <img data-src="holder.js/64x64" alt="64x64" src="http://placehold.it/100x100" data-holder-rendered="true" style="width: 100px; height: 100px;">
			      </a>
			      <div class="media-body">
			       	<div class="col-md-12">
			       		
			       		 <h4 class="media-heading">
			        	
			        	<?php 
						
						echo ucfirst($solicitado['nombre'] )." ". ucfirst($solicitado['apellido']);
					
						?>
						
						<small>
							<?php echo ucfirst($solicitado['categoria'])." en ".$solicitado['localidad']." ".$solicitado['provincia']; ?>
						</small>
			        </h4>
			        	<p><strong>Comentario:</strong><?php echo ucfirst( $solicitado['busqueda']); ?></p>
					<p>
						
						Publicado el <?php echo  fechaEs(strtotime($solicitado['fecha_ini'])); ?>
						
					</p>
					<p>
						
						Lo solicita para el: <?php echo  fechaEs(strtotime($solicitado['fecha_fin'])); ?>
						
					</p>
					
			       	</div>

						
			      </div>
			    </div>
			    <p class="text-right">
						<!-- <a href="#" class="btn btn-success btn-sm"> Quiero postularme!</a> -->
						<?php if(isset($usuario)){

							if($solicitado['userID'] != $id_usuario){
								if(isset($user_postulado)){
									?>
									<form action="<?php echo site_url('unset_postulacion'); ?>" method="post" >
										<input type="hidden" name="id_busqueda_temp"  value="<?php echo $solicitado['id']; ?>">
									 	<p class="text-right">
									 		<button type="submit" id="cancelar_postulacion" class="btn btn-danger btn-sm " ><i class="fa fa-times"></i> Cancelar Postulación</button>
									 	</p>
									</form>
									<?php
								}else{
									?>
									<form action="<?php echo site_url('set_postulacion'); ?>" method="post" >
										<input type="hidden" name="id_busqueda_temp"  value="<?php echo $solicitado['id']; ?>">
									 	<p class="text-right">
									 		<button type="submit" class="btn btn-success btn-sm " ><i class="fa fa-check"></i> Quiero postularme</button>
									 	</p>
									</form>
									<?php
								}
						?>

						

						 
						<?php
							}
						}else{
							?>

							<a data-toggle="modal" href="#loginModal"  data-target="#loginModal" rel=""  class="btn  btn-success btn-sm"> Quiero postularme!</a>


							
						<?php
						} ?>
					</p>
			    <hr>

			    <?php 

			    if (!empty($userPostu)) {
			    	foreach ($userPostu as $value) {
			    			?>

			    			 <div class="col-md-6">
							   	   	<div class="media">
							      <a class="media-left" href="#">
							        <img data-src="holder.js/64x64" alt="64x64" src="http://placehold.it/100x100" data-holder-rendered="true" style="width: 50px; height: 50px;">
							      </a>
							      <div class="media-body">
							        <h4 class="media-heading">
							        	
							        	<?php echo ucfirst( $value['nombre']) ." ".ucfirst($value['apellido']); ?>
										
							        </h4>
							        <h5>
										<small>
											se postulo para esta publicación
										</small>
									</h5>
							   		</div>
									</div>
							   </div> 

			    			<?php
			    		}	
			    	?>
					
			    	<?php
			     }else{
			     	echo "<p>Aún no hay postulaciones para esta solicitud</p>";
			     } ?>
			 

				
			</div>
			<?php $this->load->view('servicios_solicitados'); ?>
</div>