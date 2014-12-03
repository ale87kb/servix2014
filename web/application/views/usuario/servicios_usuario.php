<h1>Mis servicios</h1>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-12"><p>Cantidad de Servicios: <?php echo $cantidad; ?></p></div>
  </div>
  <?php
    if(!empty($serviciosPropios))
    {
      foreach ($serviciosPropios as $ser)
      {
  ?>
    <div class="row">
      <div class="col-md-10">
        <figure>
          <img src="<?php echo site_url($ser['foto_path']); ?>" alt="<?php echo ucfirst($ser['titulo']); ?>" class="pull-left img-responsive thumb margin10 img-thumbnail">
        </figure>
          <h3 class="list-group-item-text"><a href="<?php echo site_url($ser['link']); ?>"><?php echo ucfirst($ser['titulo']); ?></a></h3>
          <p class="list-group-item-text"><?php echo ucfirst($ser['descripcion']); ?></p>
          <p class="pull-right">
            <span class="label label-default"><?php echo ucfirst($ser['categoria']); ?></span>
            <span class="label label-default"><?php echo ucfirst($ser['localidad']); ?></span>
            <span class="label label-default"><?php echo ucfirst($ser['provincia']); ?></span>
          </p>
      </div>
      <div class="col-md-2">
        <form action="<?php echo site_url('elimiar-servicio'); ?>" method="post" id="form_del_servicio" class="pull-left">
          <button class="btn btn-link" value="<?php echo $ser['id']; ?>" id="borrar_servicio" name="id_servicio">Eliminar Servicio</button>
        </form>
        <p class="text-right"> <a href="<?php echo site_url(generarLinkServicio($ser['id'],$ser['titulo'],'mi-perfil/servicios/editar')); ?>">Editar servicio</a></p>
      </div>
    </div>
    <hr/>
      <?php
      }
      if(count($serviciosPropios) > 4)
      {
      ?>
        <a href="#">Ver mas..</a>
  <?php
      }
    }
    else
    {
    ?>
      <h4>No tiene servicios ofrecidos.</h4>
      <p>Todabía no has completado ningún servicio para ofrecer.</p>
    <?php
    }
  ?>
</div>