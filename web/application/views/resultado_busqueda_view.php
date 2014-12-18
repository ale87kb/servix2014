<div class="container" id="main">
  <!--center-->

  <h1>Resultado de busqueda</h1>
  <?php 
    if(isset($result)){
      if(!empty($result)){
        ?>
        <div class="col-sm-8">
          <p><?php echo $total_rows; ?></p>
      <?php
        foreach ($result as $r) {
      ?>
        <div class="row">
          <div class="col-xs-12">
            <h3><?php echo ucfirst($r['titulo']); ?></h3>
            <p><?php echo recortar_texto($r['descripcion'],100); ?></p>
            <p class="lead"><a href="<?php echo site_url('ficha/'.$r['id'].'-'.normaliza($r['titulo'])) ?>" class="btn btn-default">Ver Más</a></p>
            <p class="pull-right">
              <span class="label label-default"><?php echo ucfirst($r['categoria']); ?></span> 
              <span class="label label-default"><?php echo ucfirst($r['localidad']); ?></span>
              <span class="label label-default"><?php echo ucfirst($r['provincia']); ?></span>
             </p>
              <ul class="list-inline">
                <li><span>Promedio </span>
                  <span class="ratyAVG" data-avg="<?php echo number_format($r['promedio'],2); ?>"></span>
                  <?php echo number_format($r['promedio'],2); ?> Puntos<span> 
                <?php 
                  if($r['cantPuntos']>1){
                    echo ", Votado: ".$r['cantPuntos']." veces";
                  }else{
                    echo ", Votado: ".$r['cantPuntos']." vez";
                  }
                 ?>
                </span></li></ul>
            
          </div>
        </div>
        <hr>
      <?php
        } /*--/foreach--*/
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
            <p>Si no encontras lo que estas buscando, Solicitalo 
              <?php 
              if(isset($usuarioSession))
              {
              ?>
                <a href="<?php echo site_url('solicitar-servicio'); ?>" class="btn btn-info">Acá</a>
              <?php
              }
              else
              {
              ?>
               <a data-toggle="modal" href="#loginModal" data-target="#loginModal" rel="" class="btn btn-info">Acá</a>
              <?php
              }
              ?>
            </p>
          </div>
        </div>
        <?php
      }
    }else{
    ?>
    <div class="row">
      <div class="col-xs-12">
        <h3>Por favor ingrese una busqueda</h3>
        <p>Si no encontras lo que estas buscando, Solicitalo
           <?php 
              if(isset($usuarioSession))
              {
              ?>
                <a href="<?php echo site_url('solicitar-servicio'); ?>" class="btn btn-info">Acá</a>
              <?php
              }
              else
              {
              ?>
               <a data-toggle="modal" href="#loginModal" data-target="#loginModal" rel="" class="btn btn-info">Acá</a>
              <?php
              }
              ?>
      </div>
    </div>
  <?php
    }
   ?>
</div><!--/container-fluid-->