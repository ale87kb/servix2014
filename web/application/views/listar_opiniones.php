<?php
foreach ($opiniones as $opinion)
{
	$fechaUsoServicio =  strtotime($opinion['fecha_uso_servicio']);
	// date( 'Y-m-d',  );
?>
	<div class="col-md-12">
        <h4 class=""><a href="<?php echo $opinion['link_user'];?>"><?php echo $opinion['nombre'] . " " . $opinion['apellido']; ?></a></h4>
        <div class="ratyAVG" data-avg="<?php echo $opinion['puntos']?>"></div>
        <p class=""><?php echo ucfirst($opinion['comentario'] );?></p>
        <p><small><?php echo $opinion['nombre']; ?> usó el servicio el  <?php echo fechaEs($fechaUsoServicio); ?></small></p>
        <hr>
    </div>
<?php
}
?>
					
<div id="pagination">
<?php
	echo $this->pagination->create_links();  
 ?>
</div>
                