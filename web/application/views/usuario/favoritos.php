<h1>Mis favoritos</h1>
<div class="col-md-12">
  <div class="row">
    <div class="col-md-12"><p>Cantidad de Favoritos: <?php echo $cantidad; ?></p></div>
  </div>

        <?php
          if(!empty($favoritos))
          {
            foreach ($favoritos as $fav)
            {

            ?>
  <div class="row">


  <div class="media">

        <a class="media-left " href="<?php echo $fav->link_servicio; ?>">
       
           <img src="<?php echo $fav->foto_path; ?>" alt="<?php echo ucfirst($fav->titulo); ?>" >
      </a>
      <div class="media-body">
          <h3 class="list-group-item-text media-heading" ><a href="<?php echo $fav->link_servicio; ?>"><?php echo ucfirst($fav->titulo); ?></a></h3>
          
            <p class="">
            <span class="label label-default"><?php echo ucfirst($fav->categoria); ?></span>
            <span class="label label-default"><?php echo ucfirst($fav->localidad); ?></span>
            <span class="label label-default"><?php echo ucfirst($fav->provincia); ?></span>
          </p>
      </div>
      
    </div>


    
    </div>
    <hr/>
            <?php
            }
              echo "<div class='paginacion'>" . $paginacion . "</div>";
          }
          else
          {
          ?>

            <h4>No tienes favoritos</h4>
            <p>Todabía no has agregado ningún servicio a tu lista de favoritos.</p>

          <?php
          }
        ?>

</div>