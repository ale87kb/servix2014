<!--<?php

/*Esto es una prueba para ver si el modal box y la lista de login lo ponemos en otro archivo
como por ejemplo en carpetas: 
    views/login/ajax/login_form_ajax.php
    
*/
  $this->load->view('includes/nuevo');
?>-->


<nav class="navbar navbar-default navbar-static-top navbar-servix" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    
    <div id="navbar" class="navbar-collapse collapse">     
      <ul class="nav navbar-nav navbar-right">
        <?php 
        if(isset($usuario)){
          ?>
          <li class="dropdown">
            <a href="#" rel="nofollow" class="dropdown-toggle" data-toggle="dropdown"><?php echo $usuario;?><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Mi perfil</a></li>
              <li><a href="#">Mis favoritos</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo site_url('logout');?>">Cerrar Sesión</a></li>
            </ul>
          </li>
          <?php
        }else{
          ?>
          <li><a href="#">Registrarse</a></li>
          <li><a data-toggle="modal" href="#loginModal" data-target="#loginModal" rel="nofollow">Iniciar Sesión</a></li>
          <?php
        }
         ?>
      </ul>
    </div><!--/.nav-collapse -->

   


  </div>
</nav>

<div class="container">
