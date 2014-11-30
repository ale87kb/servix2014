<div class="row">
    <div class="jumbotron col-md-12">
      <div class="row">
    
        <div class="col-md-12">
          <h1>Ofrecer un servicio</h1>
          <p>En solo 3 pasos publica tu servicio en Servix</p>
        </div>
        </div>
        <?php 

          $post = $this->session->flashdata('post');
        
        ?>
            <div class="row bg-white tab-box">
               <div class="col-md-12 ">
                  <div role="tabpanel">

                  <div class="col-md-12">
                      <!-- Nav tabs -->
                    <ul class="nav nav-pills " role="tablist" id="tab">
                    <li role="presentation" class="active"><a href="#paso_1" aria-controls="paso_1" role="tab" data-toggle="tab">Paso 1</a></li>
                    <li role="presentation" ><a href="#paso_2" aria-controls="paso_2"  role="tab" data-toggle="tab">Paso 2</a></li>
                    <li role="presentation"><a href="#paso_3" aria-controls="paso_3" role="tab" data-toggle="tab">Paso 3</a></li>
                    </ul>

                  </div>
                    <div class="col-md-12">
                        <!-- Tab panes -->
                      <form action="<?php echo site_url('validar-ofrecer-servicio'); ?>" method="post" id="formulario-ofrecer" enctype="multipart/form-data">
                        <div class="tab-content">
                          <div role="tabpanel fade " class="tab-pane active" id="paso_1">
                            <div class="col-md-12">
                              <h2>Completa tus datos de servicio</h2>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                              <label for="titulo">¿Titulo del servicio?</label>
                              <input type="text" class="form-control" id="titulo" value="<?php echo $post['titulo']?>" name="titulo"  required="" placeholder="¿Como se llama tu servicio?">
                              <div class='titulo' style="color:red;">
                                <?php echo form_error('titulo'); ?>
                              </div>
                              </div>
                              <div class="form-group">
                              <label for="busqueda-servicio">¿En que categoría lo estas ofreciendo?</label>
                              <input type="text" class="form-control typeaheadOnlyCat" id="busqueda-servicio" value="<?php echo $post['categoria'];?>" name="categoria" autocomplete="off" required="" placeholder="Ej: Herrero, carpintero, panadero..">
                               <div class='categoria' style="color:red;">
                                <?php echo form_error('categoria'); ?>
                              </div> 
                              </div>

                              <div class="form-group">
                              <label for="telefono">¿Cual es el numero de teléfono del servicio?</label>
                              <input type="text" class="form-control" id="telefono" value="<?php echo $post['telefono'];?>" name="telefono"  required="" placeholder="¿A que numero te pueden llamar?">
                               <div class='telefono' style="color:red;">
                                <?php echo form_error('telefono'); ?>
                              </div> 
                              </div>
                              <div class="form-group">
                              <label for="sitioweb">¿Sitio web?</label>
                              <input type="text" class="form-control" id="sitioweb" value="<?php echo $post['sitioweb'];?>" name="sitioweb"   placeholder="www.misitio.com">
                               <div class='sitioweb' style="color:red;">
                                <?php echo form_error('sitioweb'); ?>
                              </div> 
                              </div>

                            </div>
                            <div class="col-md-6">
                              <h3>Guia para ofrecer un servicio paso 1</h3>
                               <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus ipsum nisi autem at iusto illum excepturi perspiciatis. Praesentium, quod eligendi consectetur officia nemo dolorum quo. Tempora nostrum debitis laudantium porro.
                              </p>
                              <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus ipsum nisi autem at iusto illum excepturi perspiciatis. Praesentium, quod eligendi consectetur officia nemo dolorum quo. Tempora nostrum debitis laudantium porro.
                              </p>
                            </div>
                            <div class="col-md-12">
                                <p class="text-right">
                                    <a href="#" class="btn btn-primary btnNext">Ir al paso 2</a>
                                </p>
                            </div>

                          </div>
                          <div role="tabpanel" class="tab-pane fade " id="paso_2">
                             <div class="col-md-12">
                              <h2>Bien, ahora describe tu servicio </h2>
                            </div>

                             <div class="col-md-12  ">
                                  
                                    <?php 
                                    $msj = $this->session->flashdata('mensaje_e');
                                   
                                    if(!empty($msj)){
                                      ?>

                                      <div class="col-md-12 ">
                                        
                                      
                                      <?php
                                        if($msj['error'] == 0){
                                          ?>
                                           <div class="alert alert-success"  role="alert">
                                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <?php echo $msj['mensaje_e']; ?>
                                           </div>
                                          <?php
                                        }else{

                                          ?>
                                          <div class="alert alert-warning"  role="alert">
                                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <?php echo $msj['mensaje_e']; ?>
                                          </div>
                                          <?php

                                        }
                                        ?>
                                        </div>
                                        <?php
                                        
                                    }
                                     ?>
                  
                              </div>
                         
                        
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="fotoServicio">Sube una foto del servicio que ofreces</label>
                                <input type="file" id="fotoServicio" name="fotoServicio">
                              
                              </div>
                              <div class="form-group">
                                <label for="descripcion">Describe el servicio que ofreces</label>
                               <textarea class="form-control" id="descripcion" name="descripcion" rows="8"><?php echo $post['descripcion'];?></textarea>
                                <div class='descripcion' style="color:red;">
                                <?php echo form_error('descripcion'); ?>
                                </div> 
                              </div>

                            </div>
                            <div class="col-md-6">
                              <h3>Guia para ofrecer un servicio paso 2</h3>
                               <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus ipsum nisi autem at iusto illum excepturi perspiciatis. Praesentium, quod eligendi consectetur officia nemo dolorum quo. Tempora nostrum debitis laudantium porro.
                              </p>
                              <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus ipsum nisi autem at iusto illum excepturi perspiciatis. Praesentium, quod eligendi consectetur officia nemo dolorum quo. Tempora nostrum debitis laudantium porro.
                              </p>
                            </div>
                            <div class="col-md-12">
                              
                                <div class="row">
                                  <div class="col-md-6">
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btnPrev">Ir al paso 1</a>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-right">
                                            <a href="#" class="btn btn-primary btnNext">Ir al paso 3</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade " id="paso_3">
                                 <div class="col-md-12">
                                  <h2>Ulimo paso, en que localidad, barrio ofreces el servicio </h2>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                      <label for="busqueda-localidad">¿En que localidad, barrio lo estas ofreciendo?</label>
                                    
                                       <select id="ajax-select" class="form-control selectpicker with-ajax" name="localidad" placeholder="Buscar" data-live-search="true" >
                                       <?php echo $post['localidad'];?>
                                       </select>
                                     <div class='localidad' style="color:red;">
                                      <?php echo form_error('localidad'); ?>
                                      </div> 
                                    </div>
                                  
                                    <div class="form-group">
                                      <label for="direccion">Escribe, y selecciona la dirección en donde ofreces el servicio</label>
                                      <!-- <img src="http://placehold.it/480x400&text=google map" alt=""> -->
                                        <p>
                                           <input type="text" id="myPlaceTextBox" name="direccion" class="form-control" placeholder="Ej: Av Rivadavia 5555" value="<?php echo $post['direccion'];?>" />
                                        </p>
                                        <br>
                                      <div class="map">
                                         <?php echo $map['html']; ?>
                                      </div>
                                      <input type="hidden" name="lati" value="<?php echo $post['lati'];?>" id="lati" >
                                      <input type="hidden" name="long" value="<?php echo $post['long'];?>" id="long" >

                                      <div class='direccion' style="color:red;">
                                      <?php echo form_error('direccion'); ?>
                                      </div> 
                                    </div>

                                </div>
                                <div class="col-md-6">
                                  <h3>Guia para ofrecer un servicio paso 3</h3>
                                  <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus ipsum nisi autem at iusto illum excepturi perspiciatis. Praesentium, quod eligendi consectetur officia nemo dolorum quo. Tempora nostrum debitis laudantium porro.
                                  </p>
                                  <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus ipsum nisi autem at iusto illum excepturi perspiciatis. Praesentium, quod eligendi consectetur officia nemo dolorum quo. Tempora nostrum debitis laudantium porro.
                                  </p>
                                </div>
                                <div class="col-md-12">
                                  
                                    <div class="row">
                                      <div class="col-md-6">
                                            <p class="text-left">
                                                <a href="#" class="btn btn-primary btnPrev">Ir al paso 2</a>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-right">
                                                <button type="submit" class="btn btn-success">Publicar Servicio</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
    
    </div>
</div>