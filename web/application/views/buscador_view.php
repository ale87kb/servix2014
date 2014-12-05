<section id="search">
  <div class="container">
    <div class="jumbotron col-md-10 col-md-offset-1">
     <div class="row"> 
        <div class="search-box col-md-12"  >
          <form class="form" role="form" id="formulario-busqueda" action="<?php echo site_url('busqueda');?>" method="POST">
            <div class="row">
              <div class="col-md-5 col-xs-12">
                <div class="form-group input-group-lg">
                  <label class="sr-only" for="busqueda-servicio">¿Que buscas?</label>
                  <input type="text" class="form-control typeaheadCat" id="busqueda-servicio" value="<?php if(isset($servicio)){echo ucfirst($servicio);} ?>" name="servicio" autocomplete="off" required="" placeholder="¿Qué buscas?">
                </div>
              </div> 
              <div class="col-md-5 col-xs-12">
                <div class="form-group input-group-lg">
                  <label class="sr-only" for="busqueda-localidad">¿Donde lo buscas?</label>
                  <input type="text" class="form-control typeheadLoc2" id="busqueda-localidad" value="<?php if(isset($localidad)){echo ucwords( $localidad);} ?>" name="localidad" autocomplete="off" required="" placeholder="¿Dónde lo buscas?">
                </div>
              </div>
              <div class="col-md-2 col-xs-12">
                <button type="submit" class="btn btn-danger bg-red-degrade btn-lg btn-block">Buscar</button>
              </div>
            </div>
          </form>
      </div>
      <div class="col-md-5 col-xs-6">
        <h3>Solicitá un servicio</h3>
        <small><p>¿No encontrás lo que estás buscando?</p></small>
        <?php 
        if(isset($usuarioSession))
        {
        ?>
          <a href="<?php echo site_url('solicitar-servicio'); ?>" class="btn btn-warning bg-orange">Click Aquí</a>
        <?php
        }
        else
        {
        ?>
          <a data-toggle="modal" href="#loginModal" data-target="#loginModal" rel="" class="btn btn-warning  bg-orange gobusquedaTemp">Click Aquí</a>
        <?php
        }
        ?>
      </div>
      <div class="col-md-6 col-xs-6">
        <h3>Publicá un servicio</h3>
        <small><p>¿Querés ofrecer un servicio?</p></small>
        <?php 
        if(isset($usuarioSession))
        {
        ?>
          <a href="<?php echo site_url('ofrecer-servicio'); ?>" class="btn btn-warning bg-orange">Click Aquí</a>
        <?php
        }
        else
        {
        ?>
          <a data-toggle="modal" href="#loginModal" data-target="#loginModal" rel="" class="btn btn-warning  bg-orange goOfrecerServicio">Click Aquí</a>
        <?php
        }
        ?>
      </div>
     </div>

    </div>
  </div>
</section>