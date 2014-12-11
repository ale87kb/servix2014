  <!--center-->
  <div class="col-sm-12" id="destacados">
    <h1>Servicios Destacados</h1>
    <?php 
      if(!empty($destacados))
      {
        $val = 0;
        ?>
        <h4>Top 6 servicios destacados</h4>
        <div class="row paneles">
            
  <?php
        foreach ($destacados as $servicio)
        {
          ?>
              <div class="col-sm-4 col-xs-12">
                <div class="destc">
                  <p><a href="<?php echo $servicio->link_servicio; ?>"><img src="<?php echo $servicio->foto_path; ?>" alt="<?php echo $servicio->titulo; ?>" class="img-responsive"></a></p>
                  <h3><a class="nodeco" href="<?php echo $servicio->link_servicio; ?>"><?php echo $servicio->titulo;?></a></h3>
                  <!--<p><?php echo recortar_texto($servicio->descripcion,120); ?></p>-->
                  <p class="text-left">
                    <span class="label label-default"><?php echo ucfirst($servicio->categoria); ?></span>
                    <span class="label label-default"><?php echo ucfirst($servicio->localidad); ?></span>
                    <span class="label label-default"><?php echo ucfirst($servicio->provincia); ?></span>
                  </p>

                  <div class="col-sm-7 col-xs-6">
                    <ul class="list-inline">
                      <li>
                        <span class="hidden">Promedio </span>
                        <span class="ratyAVG" data-avg="<?php echo number_format($servicio->promedio,2); ?>"></span><br>
                        <span><?php echo number_format($servicio->promedio,2); ?> Puntos</span><br>
                        <span>
                      <?php 
                        if($servicio->cantPuntos>1){
                          echo "Votado: ".$servicio->cantPuntos." veces";
                        }else{
                          echo "Votado: ".$servicio->cantPuntos." vez";
                        }
                       ?>
                        </span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-sm-5 col-xs-6 text-right">
                    <a href="<?php echo $servicio->link_servicio; ?>" class="btn btn-warning bg-orange btn-sm btm-masInf">Más info</a>
                  </div>
                </div>
              </div>
    <?php
        }
        ?>
        </div><!--/row paneles-->
  <?php
      }
      else
      {
    ?>
        <div class="row">
          <div class="col-sm-12">
            <p>Aún no tenemos ningun servicio destacado</p>
          </div>
        </div>
    <?php
      }
     ?>
  </div><!--/destacados-->
