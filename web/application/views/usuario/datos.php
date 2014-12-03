<h1>Mi perfil</h1>
<div class="col-md-12">
  <div class="col-md-4 text-center">
    <figure>
      <img alt="Foto de perfil" src="<?php echo site_url($usuarioSession['foto_thumb_path']);?>" class="img-circle" width="105">
    </figure>
  </div>
  <div class="col-md-8">
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
              <td>Teléfono</td>
              <td><?php echo $usuarioSession['telefono']; ?></td>
            </tr>
            <tr>
              <td>Dirección</td>
              <td><?php echo $usuarioSession['direccion']; ?></td>
            </tr>
          </tbody>
        </table>
        <a href="<?php echo site_url('mi-perfil/editar-datos'); ?>" class="btn btn-primary">Editar Mis Datos</a>
  </div>
</div>