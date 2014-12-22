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
      <div class="media">

        <a class="media-left " href="<?php echo $ser->link_servicio; ?>">
       
           <img src="<?php echo $ser->foto_path; ?>" alt="<?php echo ucfirst($ser->titulo); ?>" class=""  > 
      </a>
      <div class="media-body mservicios">
          <h3 class="list-group-item-text media-heading" ><a href="<?php echo $ser->link_servicio; ?>"><?php echo ucfirst($ser->titulo); ?></a></h3>
           <p class="list-group-item-text"><?php echo ucfirst($ser->descripcion); ?></p>
          <p class="pull-right">
            <span class="label label-default"><?php echo ucfirst($ser->categoria); ?></span>
            <span class="label label-default"><?php echo ucfirst($ser->localidad); ?></span>
            <span class="label label-default"><?php echo ucfirst($ser->provincia); ?></span>
          </p>
      </div>
      <div class="media-right" href="#">
        <form action="<?php echo site_url('elimiar-servicio'); ?>" method="post" id="form_del_servicio" class="pull-left">
          <div class="form-group">
            <a class="btn btn-info btn-block btn-sm " href="<?php echo site_url(generarLinkServicio($ser->id, $ser->titulo,'mi-perfil/servicios/editar')); ?>"><i class="fa fa-cog"></i> Editar servicio</a>
          </div>
          <div class="form-group">
              <button class="btn btn-danger btn-block  btn-sm" value="<?php echo $ser->id; ?>" id="borrar_servicio" name="id_servicio"><i class="fa fa-times"></i> Eliminar Servicio </button>
          </div>
        </form>
      </div>
    </div>
    </div>
    <hr/>
      <?php
      }
        echo "<div>" . $paginacion . "</div>";
    }
    else
    {
    ?>
      <h4>No tiene servicios ofrecidos.</h4>
      <p>Todavía no has completado ningún servicio para ofrecer.</p>
    <?php
    }
  ?>
</div>