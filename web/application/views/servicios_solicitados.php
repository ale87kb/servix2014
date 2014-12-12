<!--right-->
<div class="col-sm-12" id="solicitados">
  <h1>Servicios Solicitados</h1>
  <h4>Servicios solicitados de los ultimos 7 dias</h4>
  <div class="paneles">
  <?php 
    if(!empty($solicitados))
    {
      $i = 0;
      ?>
        <div class="row">
    <?php
      foreach ($solicitados as $servicio)
      {
        if($i == 3 && $i != 0)
        {
          echo '</div><div class="row">';
        }
        $i++;

      ?>
          <div class="col-md-4">
            <div class="panel panel-default">
              <div class="panel-heading"><strong><small><?php echo ucfirst($servicio['nombre']) ." ".ucfirst($servicio['apellido']); ?>: </small></strong></div>
              <div class="panel-body">
                <h4>
                  <a href="<?php echo site_url(generarLinkServicio($servicio['id'],$servicio['categoria']."-en-".$servicio['localidad']."-".$servicio['provincia'],'servicio-solicitado')); ?> " class="btn-link ">
                  <?php
                  if( $servicio['categoria'] == 'Otros')
                  {
                    echo ucfirst( $servicio['categoria'])." (".ucfirst($servicio['otra_cat']).")";
                  }
                  else
                  {
                    echo ucfirst( $servicio['categoria']);
                  }
                  ?> 
                    en 
                  <?php 
                    echo $servicio['localidad']." ". $servicio['provincia'];
                  ?>
                  </a>
                </h4>
                <p><?php echo recortar_texto($servicio['busqueda'],130); ?></p>
              </div>
              <div class="panel-footer">
                <p><span>Fecha de publicación: <?php echo date('d-m-Y', strtotime($servicio['fecha_ini'])); ?></span>
                  <?php
                  if(isset($current_page))
                  {
                  ?>
                    <a href="<?php echo site_url(generarLinkServicio($servicio['id'],$servicio['categoria']."-en-".$servicio['localidad']."-".$servicio['provincia']."/".$current_page,'servicio-solicitado')); ?>" class=" btn-link pull-right link-orange">Ver solicitud</a>
                  <?php
                  }
                  else
                  {
                  ?>
                    <a href="<?php echo site_url(generarLinkServicio($servicio['id'],$servicio['categoria']."-en-".$servicio['localidad']."-".$servicio['provincia'],'servicio-solicitado')); ?>" class="btn-link pull-right link-orange">Ver solicitud</a>
                  <?php
                  }
                  ?>
                </p>
              </div>
            </div>
          </div>
      <?php
      }
      ?>
        </div><!--/row-->
    <?php
        echo "<div id='pagSolicitados col-md-12'>";
        echo $paginacion;
        echo "</div>";
    }
    else
    {
    ?>
      <div class="row">
        <div class="col-xs-12">
          <p>Aún no tenemos ningun servicio solicitado</p>
        </div>
      </div>
  <?php
    }
    ?>
  </div><!--/paneles-->
</div><!--solicitados-->
