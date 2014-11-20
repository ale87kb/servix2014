  <!--center-->

    <h1>Resultado de busqueda</h1>
    <?php 
      if(isset($result)){
        if(!empty($result)){
          ?>
          <div class="col-sm-8">
          <?php
        foreach ($result as $r) {
      ?>

       <div class="row">
          <div class="col-xs-12">
            <h3><?php echo ucfirst($r['titulo']); ?></h3>
            <p><?php echo recortar_texto($r['descripcion'],100); ?></p>
            <!--<p class="lead"><a href="<?php echo site_url('ficha/'.$r['id'].'-'.normaliza($r['titulo'])) ?>" class="btn btn-default">Ver Más</a></p>-->
            <p class="lead"><a href="<?php echo site_url($r['linkServicio']); ?>" class="btn btn-default">Ver Más</a></p>
            
            <p class="pull-right">
              <span class="label label-default"><?php echo ucfirst($r['categoria']); ?></span> 
              <span class="label label-default"><?php echo ucfirst($r['provincia']); ?></span>
              <span class="label label-default"><?php echo ucfirst($r['localidad']); ?></span>
             </p>
            
          </div>
        </div>
        <hr>




      <?php
        }
          echo $this->pagination->create_links();  
        ?>

        </div><!--/center-->
        <div class="col-md-4">
         <?php 
         if(isset($map)){
          echo $map['html'];
        }
        ?>
        </div>
        <?php
      }else{
        ?>

         <div class="row">
          <div class="col-xs-12">
            <h3>No tenemos resultados para esta busqueda</h3>
            <p>Si no encontras lo que estas buscando, Solicitalo<a href="#" class="btn btn-link">Acá</a></p>
          </div>
        </div>
       
        <?php
      }

      }else{
        ?>
         <div class="row">
          <div class="col-xs-12">
            <h3>Por favor ingrese una busqueda</h3>
            <p>Si no encontras lo que estas buscando, Solicitalo  <a href="#" class="btn btn-link"> Aquí</a></p>
          </div>
        </div>
        <?php
      }
     ?>
   

  </div><!--/container-fluid-->

