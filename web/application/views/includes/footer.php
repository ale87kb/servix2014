
	<div class="navbar navbar-default navbar-static-bottom footer-servix">
	  <div class="container">
	    <span class="navbar-text">
	    &copy; <?php echo APP_NAME; ?> 2014. Todos los derechos reservados.
	    </span>
	  </div>
	</div>

	 <?php
     if(!isset($usuarioSession)){


      ?>

  <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog login_modal">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Iniciar Sesión con tu e-mail</h4>
           
          </div>
          <div class="modal-body login_modal_body">

            <form role="form" id="form_login_ajax" name="login_ajax" action="<?php echo site_url('validar_login_ajax');?>" method="POST" enctype="application/x-www-form-urlencoded">
              <div class="form-group">
                <ul id="errors"></ul>
              </div>
              <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="email" name="usuario" class="form-control" placeholder="E-mail de usuario">
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
                  <input type="hidden" name="curretSection" id="curretSection" value="<?php echo $this->uri->segment(1); ?>">
                  <input type="hidden" name="nextAction" id="nextAction" value="">
                  
                  <!-- <a href=" <?php   echo ($loginFb['login_url']); ?>" class="btn btn-primary" >Iniciar con <i class="fa  fa-facebook-square"></i></a> -->
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
      }else{
        if(isset($seccion) && ($seccion == 'ficha')){

        ?>
                <!-- Opinion Modal -->
      <div class="modal fade" id="modalOpinion" tabindex="-1" role="dialog" aria-labelledby="modalOpinion-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="modalOpinion-1">Dejanos tu opinion sobre el servicio</h4>
            </div>
            <form class="form-horizontal" role="form" id="form_votacion" method="post" action="<?php echo site_url('validar-voto'); ?>" enctype="application/x-www-form-urlencoded">
            <div class="modal-body">
             <div class="votacion">
            
              <div class="form-group">
                <label for="puntos" class="col-sm-5 control-label">¿Como Calificarias este servicio?</label>
                <div class="col-sm-7">

                     <div id="ratyRating"></div>
                    
                </div>
              </div>
              <div class="form-group">
                <label for="fecha" class="col-sm-5 control-label">¿Cuando usaste el servicio?</label>
                <div class="col-sm-6">
                    <!-- <input class="form-control" type="date" max="<?php echo date('Y-m-d'); ?>" name="fecha" id="fecha" required> -->
                 <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" name="fecha" id="fecha" placeholder="Fecha"   data-date-format="DD/MM/YYYY" />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <div class="alert  alert-warning" role="alert">
                  <p class="text-center">Por favor, sé fiel a los hechos y evita hacer comentarios inapropiados.</p>
                </div>
                <label for="comentario" class="col-sm-5 control-label">Cuentanos tu experiencia</label>
                <div class="col-sm-6">
                  <input type="hidden" name="id_servicio" value="<?php echo $id; ?>">
                        <textarea class="form-control"  name="comentario" rows="3" required></textarea>
                </div>
              </div>
            
          </div> 

          <div class="text-center hidden alert" id="mensajeVoto" >
              
          </div>
            </div>
            <div class="modal-footer">

             
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            </form>
          </div>
        </div>
      </div>





        <?php
        }
      }

      if(isset($seccion) && ($seccion == 'ficha')){
    ?>

    <!-- Recomendar Modal -->
    <div class="modal fade" id="modalRecomendar" tabindex="-1" role="dialog" aria-labelledby="modalOpinion-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="modalOpinion-1">Recomienda este servicio a un amigo</h4>
          </div>
          <form class="form-horizontal" role="form" id="form_recomendacion" method="post" action="<?php echo site_url('validar-recomendacion'); ?>" enctype="application/x-www-form-urlencoded">
          <div class="modal-body">
           <div class="recomendacion">
          
            <div class="form-group">
              <label for="nombreAmigo" class="col-sm-5 control-label">¿Nombre de tu amigo?</label>
              <div class="col-sm-6">
              
                  <input class="form-control" type="text" name="nombreAmigo" id="nombreAmigo" required />
                  
              </div>
            </div>
            <div class="form-group">
              <label for="emailAmigo" class="col-sm-5 control-label">¿E-mail de tu amigo?</label>
              <div class="col-sm-6">
                  <input class="form-control" type="email" name="emailAmigo" id="emailAmigo" required />
              </div>
            </div>
          
        </div> 

          <div class="text-center hidden alert" id="mensajeRecomendacion" ></div>
          </div>
          <div class="modal-footer">

           <input type="hidden" name="nombreServ" id="nombreServ" value="<?php echo $titulo; ?>"/>
           <input type="hidden" name="urlServ" id="urlServ" value="<?php echo $servUrl; ?>"/>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Enviar recomendación</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <?php
      }
      if(isset($editar_perfil)){

      ?>
      <!-- Editar foto Modal -->
      <div class="modal fade" id="edit_photo" tabindex="-1" role="dialog" aria-labelledby="title_edit_foto" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="title_edit_foto">Editar foto de perfil</h4>
            </div>
            <div class="modal-body">
              <p>Sube un archivo para actualizar tu foto de perfil.</p>


                <form action="<?php echo site_url('actulaizar_foto_perfil'); ?>" method="post" enctype="multipart/form-data" id="form_edit_foto">
                  <input type="file" title="Elegir archivo" name="mifoto" class="btn-primary">
                  <input type="submit" value="Subir foto">
                </form>
                    
                <div class="progress">
                    <div class="bar"></div>
                    <div class="percent">0%</div>
                </div>
                    
                <div id="status_pic"></div>


            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>

      <?php

      }
    ?>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="<?php  echo site_url('assets/js/jquery.min.js');?>"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo site_url('assets/js/bootstrap.min.js');?>"></script>

  <!-- BootstrapValidator -->
  <script src="<?php echo site_url('assets/js/bootstrapValidator.min.js');?>" type="text/javascript"></script>
  <script src="<?php echo site_url('assets/js/lang/es_ES.js');?>" type="text/javascript"></script>
  <!-- End BootstrapValidator -->

  <!-- FORM AJAX -->
  <script src="<?php echo site_url('assets/js/jquery.form.min.js');?>" type="text/javascript"></script>
  <!-- END AJAX -->
  <!-- 
  <script src="<?php echo site_url('assets/js/bootstrap-typeahead.js');?>"></script>
  
  <script src="<?php echo site_url('assets/js/moment-with-locales.js');?>"></script>
  <script src="<?php echo site_url('assets/js/bootstrap-datetimepicker.min.js');?>"></script>
  

  <script src="<?php echo site_url('assets/js/bootstrap-select.min.js');?>" type="text/javascript"></script>
  <script src="<?php echo site_url('assets/js/ajax-bootstrap-select.min.js');?>" type="text/javascript"></script>
  
  <script src="<?php echo site_url('assets/js/jquery.raty.js');?>" type="text/javascript"></script>
   -->
  <script>
    $site_url = "<?php echo site_url();?>";
  </script>
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




	<script src="<?php echo site_url('assets/js/script.js');?>" type="text/javascript"></script>

	</body>
</html>