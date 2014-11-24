
<div class="col-md-6 panel-info">

	<div class="panel-heading">
		<h3 class="panel-title">Servicios Contactados</h3>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="list-group">
						
        <?php
          if(!empty($sContactados)){
            foreach ($sContactados as $c) {
            ?>
              <a href="<?php echo $c['link']; ?>" class="list-group-item">
                <p class="list-group-item-text"><?php echo ucfirst($c['titulo']); ?></p>
                <p class="list-group-item-text"><?php echo ucfirst($c['consulta']); ?></p>
                <p>Realizado el <?php echo $c['fecha'];?></p>
              </a>

            <?php
            }
            if(count($sContactados) > 4){
            ?>
              <a href="#">Ver mas..</a>
            <?php
            }
          }
          else{
          ?>

            <h4>No has contactado ningún servicio</h4>
            <p>Todabía no has contactado ningún servicio.</p>

          <?php
          }
        ?>

        </div>

			</div>
		</div>
	</div>
</div>