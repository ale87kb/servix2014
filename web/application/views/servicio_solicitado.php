
<div class="container">
	<div class="col-md-7">
		<h1>Solicitud de servicio</h1>

		<div class="media">
			<a class="media-left" href="#">
		        <img data-src="holder.js/64x64" alt="Foto de perfil" src="<?php echo site_url($solicitado['foto_path']); ?>" data-holder-rendered="true" style="width: 100px; height: 100px;">
			</a>
			<div class="media-body">
				<div class="col-md-12">

					<h4 class="media-heading">
						<a href="<?php echo $solicitado['link_user']; ?>">
						<?php 
						echo ucfirst($solicitado['nombre'] )." ". ucfirst($solicitado['apellido']);
						?>
						</a>
						<small>
						<?php 
						if( $solicitado['categoria'] == 'Otros'){
							echo ucfirst( $solicitado['categoria'])." (".ucfirst($solicitado['otra_cat']).")";
						}else{
							echo ucfirst( $solicitado['categoria']);
						}
	
						echo" en ".$solicitado['localidad']." ".$solicitado['provincia']; ?>
						
						</small>
					</h4>
					<p><strong>Comentario:</strong><?php echo ucfirst( $solicitado['busqueda']); ?></p>
					<p>Publicado el <?php echo  fechaEs(strtotime($solicitado['fecha_ini'])); ?></p>
					<p>Lo solicita para el: <?php echo  fechaEs(strtotime($solicitado['fecha_fin'])); ?></p>
				</div>
			</div>
	    </div>
	    <p class="text-right">
			<!-- <a href="#" class="btn btn-success btn-sm"> Quiero postularme!</a> -->
		<?php if(isset($usuario)){
				if($solicitado['userID'] != $id_usuario){
					if(isset($user_postulado) &&( $user_postulado == 1)){
		?>
					<form action="<?php echo site_url('unset_postulacion'); ?>" method="post"  id="formCancelPostu">
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
						<input type="hidden" name="id_user_publicacion"  value="<?php echo $solicitado['userID'];  ?>">
					<?php
						if(isset($user_postulado) && $user_postulado == 0){
					?>
						<p class="text-right">
				 			<button type="submit" class="btn btn-success btn-sm " ><i class="fa fa-check"></i> Volver a postularme</button>
				 		</p>
					<?php
						}else{
					?>
						<p class="text-right">
				 			<button type="submit" class="btn btn-success btn-sm " ><i class="fa fa-check"></i> Quiero postularme</button>
				 		</p>
					<?php
						}
					?>
					</form>
				<?php
					}
				}else{
			?>
				<span class="label label-default">Mi servicio solicitado</span>
				<?php
				}
			}else{
		?>
			<a data-toggle="modal" href="#loginModal"  data-target="#loginModal" rel=""  class="btn  btn-success btn-sm"><i class="fa fa-check"></i> Quiero postularme</a>
		<?php
			} ?>
		</p>
	    <hr>

		<?php 
		if(isset($usuario))
		{
			if (!empty($userPostu)) 
			{
	    		foreach ($userPostu as $value) 
	    		{
			?>
				<div class="col-md-6 box-postulaciones">
			   	   	<div class="media">
						<span class="media-left" href="">
					        <img data-src="holder.js/64x64" alt="Foto de perfil" src="<?php echo site_url($value['foto_path']); ?>" data-holder-rendered="true" style="width: 60px; height: 60px;">
						</span>
						<div class="media-body">
							<h4 class="media-heading">
								<a href="<?php echo $value['link_user'] ;?>">
						        	<?php echo ucfirst( $value['nombre']) ." ".ucfirst($value['apellido']); ?>
								</a>
					        </h4>
					        <h5>
				        	<?php 
	        				if($value['postulado'] == 1)
	        				{ 
	        				?>
	        					<small><span class="label label-success">Se postulo para esta publicación</span></small>
	        				<?php
	        				}
	        				else
	        				{
	        				?>
								<small>Se postulo para esta publicación,<br>
									<span class="label label-default">Cancelo la postulación</span>
								</small>
	        				<?php
	        				}
							?>
							</h5>
				   		</div>
					</div>
			   	</div> 

			<?php
	    		}	
			}
			else
			{
		     	echo "<p>Aún no hay postulaciones para esta solicitud</p>";
			}
		}
		else
		{
	 	 	if (!empty($userPostu))
	 	 	{ 
	 	 		$c= 0;
	 	 		foreach ($userPostu as $value)
	 	 		{
	 	 			if($value['postulado'] == 1)
	 	 			{ 
	 	 				$c++;
	 	 			}
	 	 		}
	 	 		if( $c >1)
	 	 		{
					$userCant = $c." usuarios postulados, ";
				}
				else
				{
					$userCant = $c." usuario postulado, ";
				}  
 	 			?> 
	 	 		<p class="text-center">Esta solicitud tiene <?php echo $userCant; ?> para más información 
	 	 			<a data-toggle="modal" href="#loginModal" data-target="#loginModal" rel="">Ingresa al sitio</a>
 	 			</p>
 	 		<?php
	 		}
	 		else
	 		{
	 	 		echo "<p>Aún no hay postulaciones para esta solicitud</p>";
	 	 	}
		}
      ?>
	</div>
		<?php $this->load->view('servicios_solicitados'); ?>
</div>