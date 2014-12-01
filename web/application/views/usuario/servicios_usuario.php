<div class="col-md-6 panel-info">

  <div class="panel-heading">
    <h3 class="panel-title">Mis servicios ofrecidos</h3>
  </div>

  <div class="panel-body">
    <div class="row">
      <div class="col-md-12 ">
        <div class="list-group">
          <p>Cantidad de Servicios: <?php echo $cantidad;?></p>
            
        <?php
          if(!empty($serviciosPropios)){

            foreach ($serviciosPropios as $ser) {
            ?>
              <a href="<?php echo site_url($ser['link']); ?>" class="list-group-item">
                <p class="list-group-item-text"><?php echo ucfirst($ser['titulo']); ?></p>
                <p class="list-group-item-text"><?php echo ucfirst($ser['descripcion']); ?></p>
                <p class="list-group-item-text">Categoria: <?php echo ucfirst($ser['categoria']) ?></p>
                <p class="list-group-item-text"><?php echo ucfirst($ser['localidad']) . " " . ucfirst($ser['provincia']);?></p>
              </a>

            <?php
            }
            if(count($serviciosPropios) > 4){
            ?>
              <a href="#">Ver mas..</a>
            <?php
            }
          }
          else{
          ?>

            <h4>No tiene servicios ofrecidos.</h4>
            <p>Todabía no has completado ningún servicio para ofrecer.</p>

          <?php
          }
        ?>

        </div>

      </div>
    </div>
  </div>
</div>