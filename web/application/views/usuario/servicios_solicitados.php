
<div class="col-md-6 panel-info">

	<div class="panel-heading">
		<h3 class="panel-title">Mis servicios solicitados</h3>
	</div>

	<div class="panel-body">
		<div class="row">

						
       <?php
          if(!empty($sSolicitados)){
            foreach ($sSolicitados as $c) {
            ?>
          <div class="panel panel-default">
          	<div class="panel-heading"><?php echo ucfirst( $c['categoria']); ?> en <?php echo $c['localidad']." ". $c['provincia']; ?></div>
        	<div class="panel-body">
              	<p>
                	<?php echo $c['busqueda']; ?>
              	</p>
           		<a href="<?php echo site_url($c['link']); ?>" class="btn btn-sm btn-default pull-right">Ver solicitud</a>
        	</div>
        	<div class="panel-footer">
          		Fecha de publicación: <?php echo $c['fecha']; ?>
        	</div>
        	</div>

            <?php
            }
            if(count($sSolicitados) > 4){
            ?>
              <a href="#">Ver mas..</a>
            <?php
            }
          }
          else{
          ?>
			<div class="list-group">

            <h4>No has solicitado ningún servicio</h4>
            <p>Todabía no has solicitado ningún servicio.</p>
        	</div>

          <?php
          }
        ?>

		</div>
	</div>
</div>