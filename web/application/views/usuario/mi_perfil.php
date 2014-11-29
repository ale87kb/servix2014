<div class="usuario">

	<div class="row">
		<div class="col-md-12">
			<div class="row">
			<?php
				$this->load->view('usuario/datos');
				$this->load->view('usuario/favoritos');
			?>
			</div>
			<div class="row">
			<?php 
				$this->load->view('usuario/comentarios');
				$this->load->view('usuario/servicios_contactados');
			?>
			</div>
			<div class="row">
			<?php 
				$this->load->view('usuario/servicios_solicitados');
				$this->load->view('usuario/postulaciones');
			?>
			</div>

		</div>
	</div>
</div>

</div><!--/container-fluid-->