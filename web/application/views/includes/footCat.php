</div>
<section class="bg-gray" id="secCat">
	

<div class="container ">
	
<div class="row">
		<div class="col-md-12">
				<h3>Categorias</h3>
				<?php 
				$groups = ceil(count($categorias)/4);
				$categorias = (array_chunk($categorias,$groups ,true));

				foreach ($categorias as  $categoria) {
					?>
					<div class="col-md-3">
						<ul>
							
						<?php 
							foreach ($categoria  as $val) {
								?>
								<li>
									
									<a href="<?php echo site_url('resultado-de-busqueda/'.normaliza(strtolower($val['categoria'])).'-en-argentina'); ?>" class="btn btn-link"><?php echo ucfirst($val['categoria']); ?></a>
								</li>
								<?php
							}
						 ?>
						</ul>
					</div>
					<?php
				}
				
				?>
		</div>
</div>
</div>
</section>