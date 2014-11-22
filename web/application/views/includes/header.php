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
    
    <div id="logostyle">
      <a href="<?php echo site_url('');?>">
        <h1 class="s-logo es">Servix - a un click de distancia</h1>
      </a>
    </div>
    

    <div id="navbar-login" class="navbar-collapse collapse">     
   <!--   <ul class="nav navbar-nav navbar-right">
        <?php 
        if(isset($usuario)){
          ?>
          <li class="dropdown">
            <a href="#" rel="nofollow" class="dropdown-toggle" data-toggle="dropdown"><?php echo $usuario;?><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<?php echo site_url('mi-perfil'); ?>">Mi perfil</a></li>
              <li><a href="#">Mis favoritos</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo site_url('logout');?>">Cerrar Sesión</a></li>
            </ul>
          </li>
          <?php
        }else{
          ?>
          <li><a href="<?php echo site_url('registrarse'); ?>">Registrarse</a></li>
          <li><a data-toggle="modal" href="#loginModal"  data-target="#loginModal" rel="nofollow">Iniciar Sesión</a></li>
          <?php
        }
         ?>
      </ul>-->
      <?php
      if(isset($usuarioSession)){
        $this->load->view('includes/user_log');
        
      }else{
        $this->load->view('includes/user_no_log');
      }
      ?>
    </div><!--/.nav-collapse -->

   


  </div>
</nav>

<div class="container">