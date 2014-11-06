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

    <?php
    if(empty($usuario)){
      ?>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog login_modal">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Iniciar Sesión con tu email</h4>
          </div>
          <div class="modal-body login_modal_body">

            <form role="form" id="form_login_ajax" name="login_ajax" action="<?php echo site_url('validar_login_ajax');?>" method="POST">
              <div class="form-group">
                <ul id="errors"></ul>
              </div>
              <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="email" name="usuario" class="form-control" placeholder="Email de usuario">
                <span class='errorusername'></span>
              </div>
              <div class="form-group">
                <label for="clave">Clave</label>
                <input type="password" name="clave" class="form-control" placeholder="Clave">
                <span class='errorpassword'></span>
              </div>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" value="recordar" name="recordar" id="recordar">Seguir conectado
                  </label>
                </div>
                <button class="btn btn-success" type="submit" value="Ingresar">Iniciar Sesión</button>
          </form>


<!--
          <form role="form" action="javascript:;" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Password</label>
                            <input type="password" name="key" id="key" class="form-control" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <span class="character-checkbox" onclick="showPassword()"></span>
                            <span class="label">Show password</span>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                    </form>

-->







          </div>
          <div class="modal-footer">
            <a href="#">No recuerdo mi contraseña</a>
            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>-->
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php
      } 
    ?>


  </div>
</nav>

<div class="container">
