<div class="container" id="main">
	<div class="usuario">
		<div class="col-md-12">
			<div class="col-sm-3" id="mPerfilU">
			<nav class="nav-sidebar">
	          <h4>Perfil de usuario</h4>
	          <ul class="nav">
	            <li class="nav-divider"></li>
	            <li class="<?php echo ($page_active =='1')?'active':'';?>">
	              <a href="<?php echo site_url('mi-perfil'); ?>">Mi perfil</a>
	            </li>
	            <li class="<?php echo ($page_active =='2')?'active':'';?>">
	              <a href="<?php echo site_url('mi-perfil/servicios'); ?>">Mis servicios</a>
	            </li>
	            <li class="<?php echo ($page_active =='3')?'active':'';?>">
	              <a href="<?php echo site_url('mi-perfil/favoritos'); ?>">Mis favoritos</a>
	            </li>
	            <li class="<?php echo ($page_active =='4')?'active':'';?>">
	              <a href="<?php echo site_url('mi-perfil/mis-opiniones'); ?>">Mis opiniones</a>
	            </li>
	            <li class="<?php echo ($page_active =='5')?'active':'';?>">
	              <a href="<?php echo site_url('mi-perfil/servicios-contactados'); ?>">Servicios Contactados</a>
	            </li>
	            <li class="<?php echo ($page_active =='6')?'active':'';?>">
	              <a href="<?php echo site_url('mi-perfil/servicios-solicitados'); ?>">Servicios Solicitados</a>
	            </li>
	            <li class="<?php echo ($page_active =='7')?'active':'';?>">
	              <a href="<?php echo site_url('mi-perfil/postulaciones'); ?>">Mis postulaciones</a>
	            </li>
	          </ul>
	      </nav>
	        </div>
	        <div class="col-sm-9">
	        	<?php
					$this->load->view($vistaPerfil);
				?>
	        </div>
        </div>
	</div>

</div><!--/container-fluid-->