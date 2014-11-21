
	<div class="navbar navbar-default navbar-static-bottom footer-servix">
	  <div class="container">
	    <span class="navbar-text">
	    &copy; Servix 2014. Todos los derechos reservados.
	    </span>
	  </div>
	</div>

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
                <div class="text-right">
                  <button class="btn btn-success" type="submit" value="Ingresar">Iniciar Sesión</button>
                </div>
          </form>

          </div>
          <div class="modal-footer">
            <a class="pull-left" href="<?php echo site_url('registrarse'); ?>"rel="nofollow">Registrarse</a>
            <a href="<?php echo site_url('recuperar-clave');?>" rel="nofollow">No recuerdo mi contraseña</a>
            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>-->
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php
      } 
    ?>


	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo site_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo site_url('assets/js/bootstrap-typeahead.js');?>"></script>
	<!-- BootstrapValidator -->
	<script src="<?php echo site_url('assets/js/bootstrapValidator.min.js');?>" type="text/javascript"></script>
  <script src="<?php echo site_url('assets/js/lang/es_ES.js');?>" type="text/javascript"></script>
	<script src="<?php echo site_url('assets/js/jquery.form.min.js');?>" type="text/javascript"></script>
	<?php 
  /* Javascript agregado desde algun Controlador*/
    if(isset($js) && $js!=null)
    {
      foreach ($js as $key ) {
  ?>
      <script src="<?php echo site_url($key);?>" type="text/javascript"></script>
  <?php
      }
    }
  ?>

	<script>
		$site_url = "<?php echo site_url();?>";
	</script>
  <script src="<?php echo site_url('assets/js/jquery.raty.js');?>" type="text/javascript"></script>
	<script src="<?php echo site_url('assets/js/script.js');?>" type="text/javascript"></script>

	</body>
</html>