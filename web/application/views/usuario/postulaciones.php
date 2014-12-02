<div class="col-md-6 panel-info">

	<div class="panel-heading">
		<h3 class="panel-title">Mis postulaciones</h3>
	</div>

	<div class="panel-body">
		<div class="row">
       
        <?php 
        if(!empty($postulaciones)){
  			foreach ($postulaciones as $postulacion) {
      		?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php
					if( $postulacion['categoria'] == 'Otros'){
					echo ucfirst( $postulacion['categoria'])." (".ucfirst($postulacion['otra_cat']).")";
					}else{
					echo ucfirst( $postulacion['categoria']);
					}
					?>
					en 
					<?php echo $postulacion['localidad']." ". $postulacion['provincia']; 
					if($postulacion['vencido'] == 1){
					?>
					<small class="pull-right"><span class="label label-danger">VENCIDO</span></small>
				<?php
				}
				?>
				</div>
				<div class="panel-body">
					<strong><small><?php echo ucfirst($postulacion['DuenioSolicitud'][0]['nombre']) ." ".ucfirst($postulacion['DuenioSolicitud'][0]['apellido']); ?>: </small></strong>
					<p>
					<?php echo $postulacion['busqueda']; ?>

					</p>
					
										<?php
					if($postulacion['postulado'] == 1){
					?>
						<small><span class="label label-success">Estás postulado</span></small>
					<?php
					}else{
					?>
					<small><span class="label label-default">Cancelaste esta postulación</span></small>

					<?php
					}
					?>
					<a href="<?php echo site_url($postulacion['link']); ?> " class="btn btn-sm btn-default pull-right">Ver solicitud</a>

				</div>

				<div class="panel-footer">
					<p>Fecha de publicación: <?php echo $postulacion['fecha']; ?></p>
					<p>Se necesita para: <?php echo $postulacion['fecha_fin']; ?></p>
				</div>
			</div>


        <?php

    		}
             
             
          
      	}
        
        ?>
  

		</div>
	</div>
</div>