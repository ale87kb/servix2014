  <!--center-->
  <div class="col-sm-8">
    <h1>Servicios Destacados</h1>

    <?php 
      if(!empty($destacados)){

        foreach ($destacados as $servicio) {
          ?>

            <div class="row">
              <div class="col-xs-12">
                <h3><?php echo $servicio['titulo']; ?></h3>
                <p><?php echo $servicio['descripcion']; ?></p>
                <p class="lead"><a href=" <?php echo generarLinkServicio($servicio['id'], $servicio['titulo']); ?> " class="btn btn-default">Más info</a></p>
                <p class="pull-right"><span class="label label-default"><?php echo ucfirst( $servicio['categoria']); ?></span> <span class="label label-default"><?php echo $servicio['provincia']; ?></span> <span class="label label-default"><?php echo $servicio['localidad']; ?></span></p>


                <ul class="list-inline"><li><span>Promedio </span><span class="ratyAVG" data-avg="<?php echo number_format($servicio['promedio'],2); ?>"></span> <?php echo number_format($servicio['promedio'],2); ?> Puntos<span> 
                <?php 
                  if($servicio['cantPuntos']>1){
                    echo ", Votado: ".$servicio['cantPuntos']." veces";
                  }else{
                    echo ", Votado: ".$servicio['cantPuntos']." vez";
                  }
                 ?>
                </span></li></ul>
              </div>
            </div>
            <hr>
          
          <?php
          
        }
      }else{
        ?>
        <div class="row">
          <div class="col-xs-12">
            <p>Aún no tenemos ningun servicio destacado</p>
          </div>
        </div>
        <?php
      }
     ?>
   <!--  <div class="row">
      <div class="col-xs-12">
        <h3>Article Heading</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
          Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
          dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
          Aliquam in felis sit amet augue.</p>
        <p class="lead"><button class="btn btn-default">Read More</button></p>
        <p class="pull-right"><span class="label label-default">keyword</span> <span class="label label-default">tag</span> <span class="label label-default">post</span></p>
        <ul class="list-inline"><li><a href="#">2 Days Ago</a></li><li><a href="#"><i class="glyphicon glyphicon-comment"></i> 2 Comments</a></li><li><a href="#"><i class="glyphicon glyphicon-share"></i> 14 Shares</a></li></ul>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-12">
        <h3>Article Heading</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
          Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
          dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
          Aliquam in felis sit amet augue.</p>
        <p class="lead"><button class="btn btn-default">Read More</button></p>
        <p class="pull-right"><span class="label label-default">keyword</span> <span class="label label-default">tag</span> <span class="label label-default">post</span></p>
        <ul class="list-inline"><li><a href="#">4 Days Ago</a></li><li><a href="#"><i class="glyphicon glyphicon-comment"></i> 7 Comments</a></li><li><a href="#"><i class="glyphicon glyphicon-share"></i> 56 Shares</a></li></ul>
      </div>
    </div>
    <hr>      
    <div class="row">
      <div class="col-xs-12">
        <h3>Article Heading</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
          Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
          dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
          Aliquam in felis sit amet augue.</p>
        <p class="lead"><button class="btn btn-default">Read More</button></p>
        <p class="pull-right"><span class="label label-default">keyword</span> <span class="label label-default">tag</span> <span class="label label-default">post</span></p>
        <ul class="list-inline"><li><a href="#">1 Week Ago</a></li><li><a href="#"><i class="glyphicon glyphicon-comment"></i> 4 Comments</a></li><li><a href="#"><i class="glyphicon glyphicon-share"></i> 34 Shares</a></li></ul>
      </div>
    </div> -->
    <hr>
  </div><!--/center-->

  <!--right-->
  <div class="col-sm-4">
        <h1>Servicios Solicitados</h1>
    	<div class="panel panel-default">
         	<div class="panel-heading">Title</div>
         	<div class="panel-body">Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
            Aliquam in felis sit amet augue.</div>
        </div>
        <hr>
        <div class="panel panel-default">
         	<div class="panel-heading">Title</div>
         	<div class="panel-body">Content here..</div>
        </div>
        <hr>
        <div class="panel panel-default">
         	<div class="panel-heading">Title</div>
         	<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
            Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
            dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
            Aliquam in felis sit amet augue.</div>
        </div>
        <hr>
        <div class="panel panel-default">
         	<div class="panel-heading">Title</div>
         	<div class="panel-body">Content here..</div>
        </div>
        <hr>
  </div><!--/right-->
  <hr>
</div><!--/container-fluid-->
