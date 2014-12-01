
<div class="col-md-6 panel-info">

	<div class="panel-heading">
		<h3 class="panel-title">Mis opiniones</h3>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="list-group">
        <?php
          if(!empty($comentarios)){
            foreach ($comentarios as $comen) {
            ?>

            <a href="<?php echo $comen['link']; ?>" class="list-group-item">
              <strong><span><?php echo ucfirst($comen['titulo']); ?></span></strong>
            <div class="ratyAVG" data-avg="<?php echo $comen['puntos'] ;?>"></div>
            <p class="list-group-item-text"><?php echo ucfirst($comen['comentario']); ?></p>

            <p>Realizado el <?php echo fechaEs(strtotime($comen['fecha_votacion']));?> </p>
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

            <h4>No tienes opiniones</h4>
            <p>Todabía no has realizado ninguna opinión en los servicios ofrecidos.</p>

          <?php
          }
        ?>

        </div>

			</div>
		</div>
	</div>
</div>