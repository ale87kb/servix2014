
<div class="col-md-6 panel-info">

	<div class="panel-heading">
		<h3 class="panel-title">Mis servicios solicitados</h3>
	</div>

	<div class="panel-body">
		<div class="row">

						
       <?php
          if(!empty($sSolicitados)){
            foreach ($sSolicitados as $ssol) {
            ?>
          <div class="panel panel-default">
          	<div class="panel-heading"><?php echo ucfirst( $ssol['categoria']); ?> en <?php echo $ssol['localidad']." ". $ssol['provincia']; ?></div>
        	<div class="panel-body">
              	<p>
                	<?php echo $ssol['busqueda']; ?>
              	</p>
           		<a href="<?php echo site_url($ssol['link']); ?>" class="btn btn-sm btn-default pull-right">Ver solicitud</a>
        	</div>
        	<div class="panel-footer">
          		Fecha de publicación: <?php echo $ssol['fecha']; ?>
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