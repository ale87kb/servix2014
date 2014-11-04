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
            <h3><?php echo ucwords($r['titulo']); ?></h3>
            <p><?php echo $r['descripcion']; ?></p>
            <p class="lead"><a href="#" class="btn btn-default">Ver Más</a></p>
            <p class="pull-right">
              <span class="label label-default">keyword</span> 
              <span class="label label-default">tag</span>
              <span class="label label-default">post</span>
             </p>
            <ul class="list-inline">
              <li><a href="#">2 Days Ago</a></li>
              <li><a href="#"><i class="glyphicon glyphicon-comment"></i> 2 Comments</a></li>
              
            </ul>
          </div>
        </div>
        <hr>
      <?php
        }
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
