		<?php 
			
				foreach ($opiniones as $opinion) {
					$fechaUsoServicio =  strtotime($opinion['fecha_uso_servicio']);

					 // date( 'Y-m-d',  );
				?>
				<div class="col-md-12">
                    <h4 class="">

                    	<?php echo $opinion['nombre']; ?>
                    </h4>
                    <div class="ratyAVG" data-avg="<?php echo $opinion['puntos']?>"></div>
                    <p class=""> <?php echo ucfirst($opinion['comentario'] );?>
                    </p>
                    <p ><small><?php echo $opinion['nombre']; ?> usó el servicio el  <?php echo fechaEs($fechaUsoServicio); ?></small></p>
                    <hr>
                </div>

				<div id="pagination">
					
				<?php
				}

				echo $this->pagination->create_links();  
				 ?>
				</div>
                