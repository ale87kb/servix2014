<div id="solicitados">
  
  
  <!--right-->
  <div class="col-sm-5">
        <h1>Servicios Solicitados</h1>
        <h4>Servicios solicitados de los ultimos 7 dias</h4>
        <?php 
        if(!empty($solicitados)){
          foreach ($solicitados as $servicio) {
          ?>
          <div class="panel panel-default">
            <div class="panel-heading"><?php echo ucfirst( $servicio['categoria']); ?> en <?php echo $servicio['localidad']." ". $servicio['provincia']; ?></div>
            <div class="panel-body">
              <strong><small><?php echo ucfirst($servicio['nombre']) ." ".ucfirst($servicio['apellido']); ?>: </small></strong>
              <p>
                <?php echo $servicio['busqueda']; ?>

              </p>
              <?php
               if(isset($current_page)){
                 
                ?>
                  <a href="<?php echo site_url(generarLinkServicio($servicio['id'],$servicio['categoria']."-en-".$servicio['localidad']."-".$servicio['provincia']."/".$current_page,'servicio-solicitado')); ?> " class="btn btn-sm btn-default pull-right">Ver solicitud</a>
                <?php
               } else{
                ?>
                  <a href="<?php echo site_url(generarLinkServicio($servicio['id'],$servicio['categoria']."-en-".$servicio['localidad']."-".$servicio['provincia'],'servicio-solicitado')); ?> " class="btn btn-sm btn-default pull-right">Ver solicitud</a>

                <?php

               }
              ?>
             
            </div>
            <div class="panel-footer">
              fecha de publicación: <?php echo date('d-m-Y' ,strtotime($servicio['fecha_ini'])); ?>
            </div>
          </div>
          <hr>
          <?php
          }
          echo "<div id='pagSolicitados'>";
          echo $paginacion;
          echo "</div>";
        }else{
        ?>
        <div class="row">
          <div class="col-xs-12">
            <p>Aún no tenemos ningun servicio solicitado</p>
          </div>
        </div>
        <?php
        } ?>
      
  </div><!--/right-->
</div>