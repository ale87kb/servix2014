  <!--center-->
  <div class="col-sm-7">
    <h1>Servicios Destacados</h1>
    <h4>Top 5 servicios destacados</h4>
    <?php 
      if(!empty($destacados)){

        foreach ($destacados as $servicio) {
          ?>

            <div class="row">
              <div class="col-xs-12">
                <h3><?php echo $servicio['titulo']; ?></h3>
                <p><?php echo recortar_texto($servicio['descripcion'],250); ?></p>
                <p class="lead"><a href=" <?php echo generarLinkServicio($servicio['id'], $servicio['titulo']); ?> " class="btn btn-default">Más info</a></p>
                <p class="pull-right"><span class="label label-default"><?php echo ucfirst( $servicio['categoria']); ?></span> <span class="label label-default"><?php echo $servicio['provincia']; ?></span> <span class="label label-default"><?php echo $servicio['localidad']; ?></span></p>


                <ul class="list-inline"><li><span>Promedio </span><span class="ratyAVG" data-avg="<?php echo number_format($servicio['promedio'],2); ?>"></span> <?php echo number_format($servicio['promedio'],2); ?> Puntos<span> 
                <?php 
                  if($servicio['cantPuntos']>1){
                    echo ", Votado: ".$servicio['cantPuntos']." veces";
                  }else{
                    echo ", Votado: ".$servicio['cantPuntos']." vez";
                  }
                 ?>
                </span></li></ul>
              </div>
            </div>
            <hr>
          
          <?php
          
        }
      }else{
        ?>
        <div class="row">
          <div class="col-xs-12">
            <p>Aún no tenemos ningun servicio destacado</p>
          </div>
        </div>
        <?php
      }
     ?>
   
    <hr>
  </div><!--/center-->

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
               <a href="# " class="btn btn-sm btn-default pull-right">Ver solicitud</a>
            </div>
            <div class="panel-footer">
              fecha de publicación: <?php echo date('d-m-Y' ,strtotime($servicio['fecha_ini'])); ?>
            </div>
          </div>
          <hr>
          <?php
          }
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
  <hr>
</div><!--/container-fluid-->
