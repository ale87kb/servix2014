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
            foreach ($favoritos as $f) {

            ?>
              <a href="<?php echo $f['link']; ?>" class="list-group-item">
                <h4 class="list-group-item-heading"><?php echo ucfirst($f['titulo']); ?></h4>
                <p class="list-group-item-text"><?php echo ucfirst($f['descripcion']); ?></p>
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