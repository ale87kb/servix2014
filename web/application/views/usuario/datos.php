<div class="col-md-6 panel-info">

	<div class="panel-heading">
		<h3 class="panel-title">Mis Datos de Usuario</h3>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-md-3" align="center">
				<img alt="User Pic" src="<?php echo $usuarioSession['foto'];?>" class="img-circle" width="105" >
				<a href="#">Editar Foto</a>
			</div>
			<div class=" col-md-9 col-lg-9 "> 
				<table class="table table-user-information">
					<tbody>
						<tr>
							<td>Usuario</td>
							<td><?php echo $usuarioSession['email']; ?></td>
						</tr>
						<tr>
							<td>Nombre</td>
							<td><?php echo $usuarioSession['nombre']; ?></td>
						</tr>
						<tr>
							<td>Apellido</td>
							<td><?php echo $usuarioSession['apellido']; ?></td>
						</tr>
						<tr>
							<td>DNI</td>
							<td><?php echo $usuarioSession['dni']; ?></td>
						</tr>

						<tr>
							<td>Teléfono</td>
							<td><?php echo $usuarioSession['telefono']; ?></td>
						</tr>
						<tr>
							<td>Dirección</td>
							<td><?php echo $usuarioSession['direccion']; ?></td>
						</tr>
					</tbody>
				</table>

				<a href="#" class="btn btn-primary">Editar Mis Datos</a>
			</div>
		</div>
	</div>
</div>



