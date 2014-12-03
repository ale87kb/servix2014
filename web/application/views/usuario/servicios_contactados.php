<h1>Servicios contactados</h1>
<div class="col-md-12">
  <?php
    if(!empty($sContactados))
    {
      foreach ($sContactados as $scont)
      {
      ?>
        <a href="<?php echo site_url($scont['link']); ?>" class="list-group-item">
          <h3 class="list-group-item-text"><?php echo ucfirst($scont['titulo']); ?></h3>
          <span><strong>Mensaje: </strong></span><p class="list-group-item-text"><?php echo ucfirst($scont['consulta']); ?></p>
          <p class="pull-right">
          <span class="label label-default"><?php echo ucfirst($scont['categoria']); ?></span>
          <span class="label label-default"><?php echo ucfirst($scont['localidad']); ?></span>
          <span class="label label-default"><?php echo ucfirst($scont['provincia']); ?></span>
        </p>
          <p>Realizado el <?php echo $scont['fecha'];?></p>
        </a>
      <?php
      }
      if(count($sContactados) > 4)
      {
      ?>
        <a href="#">Ver mas..</a>
      <?php
      }
        echo "<div>" . $paginacion . "</div>";
    }
    else
    {
    ?>
      <h4>No has contactado ningún servicio</h4>
      <p>Todabía no has contactado ningún servicio.</p>
    <?php
    }
  ?>
</div>