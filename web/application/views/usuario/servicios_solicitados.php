<h1>Mis servicios solicitados</h1>
<div class="col-md-12">
  <?php
    if(!empty($sSolicitados))
    {
      foreach ($sSolicitados as $ssol)
      {
  ?>
        <div class="panel panel-default">
          <div class="panel-heading">
              <a href="<?php echo site_url($ssol['link']); ?>" class="btn btn-link ">
            <?php
             echo ucfirst( $ssol['categoria']); ?> en <?php echo $ssol['localidad']." ". $ssol['provincia']; ?>
             </a>
              <form action="<?php echo site_url('eliminar-servicio-solicitado') ?>" method="post" class="pull-right" id="form_del_servicio_solicitado" >
                 <button type="submit" class="btn btn-default  btn-sm " id="borrar_s_solicitado" name="id_busqueda_temp" value="<?php echo $ssol['id']; ?>">x</button>
              </form>
          </div>
        <div class="panel-body">
              <p>
                <?php echo $ssol['busqueda']; ?>
              </p>
           
            <a href="<?php echo site_url('mi-perfil/servicios-solicitados#'); ?>" class="btn btn-sm btn-default pull-right">Editar</a>
        </div>
        <div class="panel-footer">
            Fecha de publicación: <?php echo $ssol['fecha']; ?>
        </div>
        </div>

      <?php
      }
      if(count($sSolicitados) > 4)
      {
      ?>
        <a href="#">Ver mas..</a>
      <?php
      }
    }
    else
    {
    ?>
      <div class="list-group">
        <h4>No has solicitado ningún servicio</h4>
        <p>Todabía no has solicitado ningún servicio.</p>
      </div>
    <?php
    }
  ?>
</div>