<div class="container" id="main">
<section class="perfilUsuario">
	<div class="row"> 
		<div class="col-md-12">
			<h1>Perfil de usuario</h1>
		</div>
		<div class="col-md-12">
            <?php
                if(isset($nologueado))
                {
                    ?>
                <div class="row text-center">
                    <p>Para ver el perfil del usuario necesitas iniciar sesión o estar registrado.</p>
                    <p>Si no tiene una cuenta te invitamos a <a href="<?php echo site_url('registrarse'); ?>">registrarte</a>.</p>
                
                </div>

                    <?php
                }
                else
                {
            ?>
                <div class="row text-center">
    		 	    <p>El perfil que estás buscando no está disponible o no existe</p>
                    
                </div>

            <?php
                }
             ?>
            <p><a href="<?php echo site_url(''); ?>">Volver a la página de inicio</a></p>
             
		</div>
    </div>
</section>
</div>