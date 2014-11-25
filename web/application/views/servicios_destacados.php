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
                <p class="lead"><a href=" <?php echo site_url(generarLinkServicio($servicio['id'], $servicio['titulo'])); ?> " class="btn btn-default">Más info</a></p>
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
   
  
  </div><!--/center-->