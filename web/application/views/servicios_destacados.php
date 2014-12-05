  <!--center-->
  <div class="col-sm-12" id="destacados">
    <h1>Servicios Destacados</h1>
    <h4>Top 6 servicios destacados</h4>
            <div class="row paneles">
    <?php 
      if(!empty($destacados)){

        foreach ($destacados as $servicio) {
          ?>

              <div class="col-xs-4">
                <p><img src="http://placehold.it/350x100" alt="" class="img-responsive"></p>
                <!--<p><img src="<?php echo $servicio['foto_path']; ?>" alt="" class="img-responsive" width="350" height="100"></p>-->
                <h3><?php echo $servicio['titulo']; ?></h3>
                <p><?php echo recortar_texto($servicio['descripcion'],250); ?></p>
                <p class="lead text-right"><a href=" <?php echo site_url(generarLinkServicio($servicio['id'], $servicio['titulo'])); ?> " class="btn btn-warning bg-orange btn-sm">Más info</a></p>
                <p class="text-left">
                    <span class="label label-default"><?php echo ucfirst($servicio['categoria']); ?></span>
                    <span class="label label-default"><?php echo ucfirst($servicio['localidad']); ?></span>
                    <span class="label label-default"><?php echo ucfirst($servicio['provincia']); ?></span>
                    
                  </p>


                <ul class="list-inline"><li><span>Promedio </span><span class="ratyAVG" data-avg="<?php echo number_format($servicio['promedio'],2); ?>"></span> <?php echo number_format($servicio['promedio'],2); ?> Puntos
                  <br>
                  <span> 
                <?php 
                  if($servicio['cantPuntos']>1){
                    echo "Votado: ".$servicio['cantPuntos']." veces";
                  }else{
                    echo "Votado: ".$servicio['cantPuntos']." vez";
                  }
                 ?>
                </span></li></ul>
              </div>
          
          
          <?php
          
        }
      }else{
        ?>
            </div>
        <div class="row">
          <div class="col-xs-12">
            <p>Aún no tenemos ningun servicio destacado</p>
          </div>
        </div>
        <?php
      }
     ?>
   
  
  </div><!--/center-->
  </div><!--/center-->
