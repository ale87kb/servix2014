<div class="col-md-6 panel-info">

	<div class="panel-heading">
		<h3 class="panel-title">Mis favoritos</h3>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="list-group">

        <?php
          if(!empty($favoritos)){
            foreach ($favoritos as $fav) {

            ?>
              <a href="<?php echo $fav['link']; ?>" class="list-group-item">
                <div class="row">
                  
                  <div class="col-md-4">
                    <figure><img src="<?php echo site_url($fav['foto_path']); ?>" alt=""></figure>
                  </div>
                  <div class="col-dm-8">
                    
                    <h4 class="list-group-item-heading"><?php echo ucfirst($fav['titulo']); ?></h4>
                    <p class="list-group-item-text"><?php echo ucfirst($fav['descripcion']); ?></p>
                  </div>
                </div>
              </a>

            <?php
            }
            if(count($comentarios) > 4){
            ?>
              <a href="#">Ver mas..</a>
            <?php
            }
          }
          else{
          ?>

            <h4>No tienes favoritos</h4>
            <p>Todabía no has agregado ningún servicio a tu lista de favoritos.</p>

          <?php
          }
        ?>
				</div>

			</div>
		</div>
	</div>
</div>