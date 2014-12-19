<h1>Mis opiniones</h1>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-12"><p>Cantidad de opiniones: <?php echo $cantidad; ?></p></div>
  </div>
<?php
  if(!empty($comentarios))
  {
    foreach ($comentarios as $comen)
    {
    ?>
    <a href="<?php echo site_url($comen['link']); ?>" class="list-group-item">
      <strong><span><?php echo ucfirst($comen['titulo']); ?></span></strong>
    <div class="ratyAVG" data-avg="<?php echo $comen['puntos'] ;?>"></div>
    <p class="list-group-item-text"><?php echo ucfirst($comen['comentario']); ?></p>
     <p class="pull-right">
          <span class="label label-default"><?php echo ucfirst($comen['categoria']); ?></span>
          <span class="label label-default"><?php echo ucfirst($comen['localidad']); ?></span>
          <span class="label label-default"><?php echo ucfirst($comen['provincia']); ?></span>
        </p>
    <p>Realizado el <?php echo fechaEs(strtotime($comen['fecha_votacion']));?> </p>
    </a>
    <?php
    }
      echo "<div class='paginacion'>" . $paginacion . "</div>";
  }
  else
  {
  ?>
    <h4>No tienes opiniones</h4>
    <p>Todabía no has realizado ninguna opinión en los servicios ofrecidos.</p>
  <?php
  }
?>
</div>