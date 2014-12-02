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
            <form action="<?php echo site_url('elimiar-servicio'); ?>" method="post" id="form_del_servicio" class="pull-left">
  
                <button class="btn btn-link" value="<?php echo $ser['id']; ?>" id="borrar_servicio" name="id_servicio">Eliminar Servicio</button>
            </form>
             <p class="text-right"> <a href="<?php echo site_url(generarLinkServicio($ser['id'],$ser['titulo'],'mi-perfil/servicios/editar')); ?>">Editar servicio</a></p>
          
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