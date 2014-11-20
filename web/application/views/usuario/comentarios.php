
<div class="col-md-6 panel-info">

	<div class="panel-heading">
		<h3 class="panel-title">Comentarios</h3>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 ">
				<div class="list-group">
        <?php
          if(!empty($comentarios)){
           foreach ($comentarios as $c) {

          ?>
            <a href="<?php echo $c['link']; ?>" class="list-group-item">
              <p class="list-group-item-text"><?php echo ucfirst($c['comentario']); ?></p>
              <p>Realizado en: <span><?php echo ucfirst($c['titulo']); ?></span></p>
            </a>

          <?php
            }
          }
          else{
          ?>
          
          <h4>No tienes comentarios</h4>
          <p>Todabía no has realizado ningún comentario en los servicios ofrecidos.</p>

          <?php
          }
          ?>

        </div>

			</div>
		</div>
	</div>
</div>



