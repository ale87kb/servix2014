<div class="container" id="main">
<section class="perfilUsuario">
	<div class="row"> 
		<div class="col-md-12">
			<h1>Perfil de usuario</h1>
		</div>
		<div class="col-md-12">
		 	<div class="col-md-3">
		 		<div class="row text-center">
		 			<figure>
						<img src="<?php echo $perfil['foto_path']; ?>" alt="Foto de Perfil" width="125" />
                    </figure>
                </div>
		 	</div>

		 	<div class="col-md-5">
				<h2>Datos personales</h2>
				<p><strong>Nombre: </strong><?php echo $perfil['nombre']; ?></p>
				<p><strong>Apellido: </strong><?php echo $perfil['apellido']; ?></p>
			</div>
			<div class="col-md-3">
				<table class="table table-bordered text-center">
			      <thead>
			        <tr>
			          <td>Servicios Ofrecidos</td>
			        </tr>
			      </thead>
			      <tbody>
			        <tr>
			          <td><?php echo $cantidadServicios; ?></td>
			        </tr>
			      </tbody>
			    </table>
			</div>
        </div>
				
		<div class="col-md-12">
			<hr/>
			<h4>Servicios ofrecidos</h4>

                <?php 
                if(!empty($servicios))
                {
                    foreach ($servicios as $servicio)
                    {
                ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <figure>
                            <a href="<?php echo $servicio['link_servicio']; ?>">
                                <img class="media-object img-responsive" src="<?php echo $servicio['foto_path']; ?>" alt="Foto <?php echo $servicio['titulo']; ?>" width="125" />
                            </a>
                        </figure>
                    </div>
                    <div class="col-md-7">
                        <h4 class="list-group-item-heading"><a href="<?php echo $servicio['link_servicio']; ?>"><?php echo $servicio['titulo'] ; ?></a></h4>
                        <p class="list-group-item-text"><?php echo $servicio['descripcion']; ?></p>
                       
                    </div>
                    <div class="col-md-3 text-center">
                <?php 
                    if($servicio['cantVotado'] != 1)
                    {
                    ?>
                        <h2> <?php echo $servicio['cantVotado']; ?> <small> votos </small></h2>
                <?php
                    }
                    else
                    {
                    ?>
                        <h2> <?php echo $servicio['cantVotado']; ?><small> voto </small></h2>
                    <?php
                    }
                 ?>
                        <span class="ratyAVG" data-avg="<?php echo number_format($servicio['promedio'],2); ?>"></span>
                        <p> Promedio <?php echo number_format($servicio['promedio'],2); ?> <small> / </small> 5 </p>
                    </div>

                    <div class="col-md-7">
                            <p class="pull-right">
                        
                            <span class="label label-default"><?php echo ucfirst($servicio['categoria']); ?></span>
                            <span class="label label-default"><?php echo $servicio['provincia']; ?></span>
                            <span class="label label-default"><?php echo $servicio['localidad']; ?></span>
                        </p>
                    </div>
                </div>
            </div>
            <hr />

                <?php
                    }
                echo "<div class='paginacion'>" . $paginacion . "</div>";

                }
                else
                {
                ?>
                <div class="row">
                    <p class="text-center">No está ofreciendo ningún servicio.</p>
                </div>
                <hr/>
                <?php 
                }
                ?>


        </div>



		 </div> 
</section>
</div>