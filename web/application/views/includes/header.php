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
        <li><a data-toggle="modal" href="#myModal" rel="nofollow" >Login</a></li>
        <li><a href="#">Registrarse</a></li>
      </ul>
    </div><!--/.nav-collapse -->


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Login en Servix</h4>
          </div>
          <div class="modal-body">
            <?php $attr = array("id" => "formulario") ?>
            <?php echo form_open(base_url('validar-login'), $attr) ?>
                <p>Usuario: <input type="text" name="usuario"><span class='errorusername'></span></p>
                <p>Clave: <input type="password" name="clave"><span class='errorpassword'></span></p>
                <p><input type="submit" value="Entrar"></p>
            <?php echo form_close() ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



  </div>
</nav>

<div class="container">
