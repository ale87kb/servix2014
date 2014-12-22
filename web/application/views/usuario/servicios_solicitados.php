<h1>Mis servicios solicitados</h1>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-12"><p>Cantidad de servicios solicitados: <?php echo $cantidad; ?></p></div>
  </div>
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
            <p>
              <span class="label label-<?php echo $ssol['vencido_css'] ?> pull-left" ><?php echo $ssol['vencido_text']; ?></span> 
              <?php 
                if($ssol['vencido'])
                {
              ?>
                  <a href="<?php echo $ssol['link_servicio']; ?>" class="btn btn-sm btn-default pull-right">Editar y volver a solicitar</a>
              <?php
                }
                else
                {
              ?>
                  <a href="<?php echo $ssol['link_servicio']; ?>" class="btn btn-sm btn-default pull-right">Editar</a>
              <?php
                }
               ?>
            </p>
          </div>
          <div class="panel-footer">
            <p>
              <span class="text-left">Fecha de publicación: <?php echo $ssol['fecha']; ?></span>
              <span class="pull-right">Fecha de vencimiento: <?php echo $ssol['vence_el']; ?></span>
            </p>
          </div>
        </div>
      <?php
      }
      echo "<div class='paginacion'>" . $paginacion . "</div>";
    }
    else
    {
    ?>
      <div class="list-group">
        <h4>No has solicitado ningún servicio</h4>
        <p>Todavía no has solicitado ningún servicio.</p>
      </div>
    <?php
    }
  ?>
</div>