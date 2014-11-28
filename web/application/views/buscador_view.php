<div class="jumbotron col-md-12">
 <div class="row">
    <div class="search-box col-md-12"  >
    <form class="form" role="form" id="formulario-busqueda" action="<?php echo site_url('busqueda');?>" method="POST">
       <div class="row">
         <div class="col-md-5">
         <div class="form-group input-group-lg">
            <label class="sr-only" for="busqueda-servicio">¿Que buscas?</label>
            <input type="text" class="form-control typeaheadCat" id="busqueda-servicio" value="<?php if(isset($servicio)){echo $servicio;} ?>" name="servicio" autocomplete="off" required="" placeholder="¿Qué buscas?">
          </div>
       </div> 
       <div class="col-md-5">
         <div class="form-group input-group-lg">
            <label class="sr-only" for="busqueda-localidad">¿Donde lo buscas?</label>
            <input type="text" class="form-control typeheadLoc2" id="busqueda-localidad" value="<?php if(isset($localidad)){echo $localidad;} ?>"  name="localidad" autocomplete="off"  required="" placeholder="¿Dónde lo buscas?">
          </div>
       </div>
       <div class="col-md-2">
         <button type="submit" class="btn btn-success btn-lg">Buscar</button>
       </div>
       </div>
    </form>

  </div>
  <div class="col-md-5">
    <h3>Solicitá un servicio</h3>
      <small><p>¿No encontrás lo que estás buscando?</p></small>
            <?php if(isset($usuario)){
            ?>
           
               <a href="<?php echo site_url('solicitar-servicio'); ?>" class="btn btn-warning">Click Aquí</a>
            <?php
            }else{
              ?>

              <a data-toggle="modal" href="#loginModal"  data-target="#loginModal" rel=""  class="btn btn-warning gobusquedaTemp">Click Aquí</a>
             

              
            <?php
            } ?>
  
  
  </div>
  <div class="col-md-6">
    <h3>Publicá un servicio</h3>
    <small><p>¿Querés ofrecer un servicio?</p></small>
    <a href="#" class="btn btn-warning">Click Aquí</a>
  </div>
 </div>

</div>