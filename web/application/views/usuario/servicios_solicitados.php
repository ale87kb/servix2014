<h1>Mis servicios solicitados</h1>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-12"><p>Cantidad de servicios solicitados: <?php echo $cantidad; ?></p></div>
  </div>
  <?php
    if(!empty($sSolicitados))
    {
      $i=0;
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
           <p >
              <span class="label label-<?php echo $vencido[$i]['vencido_css'] ?> pull-left" ><?php echo $vencido[$i]['vencido']; ?></span> 
      
            <a href="<?php echo site_url('mi-perfil/servicios-solicitados#'); ?>" class="btn btn-sm btn-default pull-right">Editar</a>
            <?php 
              if($ssol['vencido']){
                ?>

                  <form action="<?php echo site_url('reactivar-servicio-solicitado') ?>" method="post" >
                       <button type="submit" class="btn btn-default  btn-sm pull-right " name="id_busqueda_temp" value="<?php echo $ssol['id']; ?>">Volver a solicitar</button>
                  </form>
                <?php
              }
             ?>
             </p>
        </div>
        <div class="panel-footer">
           <p>
              <span class="text-left">Fecha de publicación: <?php echo $ssol['fecha']; ?></span>
              <span class="pull-right">Fecha de vencimiento: <?php echo $vencido[$i]['vence_el']; ?></span>

           </p>
        </div>
        </div>

      <?php
        $i++;
      }
      echo "<div class='paginacion'>" . $paginacion . "</div>";
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