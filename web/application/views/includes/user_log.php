<ul class="nav navbar-nav navbar-right">
  <li class="dropdown">
    <a href="#" rel="nofollow" class="dropdown-toggle" data-toggle="dropdown">
      <?php echo $usuarioSession['nombre'];?>
      <b class="caret"></b>
    </a>
    <ul class="dropdown-menu" role="menu">
      <li><a href="<?php echo site_url('mi-perfil'); ?>">Mi perfil</a></li>
      <li><a href="<?php echo site_url('mi-perfil/favoritos'); ?>">Mis favoritos</a></li>
      <li><a href="<?php echo site_url('mi-perfil/servicios'); ?>">Mis servicios</a></li>
      <li><a href="<?php echo site_url('mi-perfil/servicios-solicitados'); ?>">Servicios solicitados</a></li>
      <li><a href="<?php echo site_url('mi-perfil/postulaciones'); ?>">Postulaciones</a></li>
      <li class="divider"></li>
      <li><a href="<?php echo site_url('logout');?>">Cerrar Sesión</a></li>
    </ul>
  </li>
</ul>