<div class="container" id="main">

<div class="row">
    <div class="jumbotron col-md-12">
      <div class="row">
    
        <div class="col-md-12">
          <h1>Editar Servicio</h1>
        </div>
        </div>
        <?php 
        		// print_d($post);
          $form_error = $this->session->flashdata('form_error');

     
        ?>
            <div class="row bg-white tab-box">
               <div class="col-md-12 ">
                  <div role="tabpanel">

                  <div class="col-md-12">
                      <!-- Nav tabs -->
                    <ul class="nav nav-pills " role="tablist" id="tab">
                    <li role="presentation" class="active"><a href="#paso_1" aria-controls="paso_1" role="tab" data-toggle="tab">Datos del servicio</a></li>
                    <li role="presentation" ><a href="#paso_2" aria-controls="paso_2"  role="tab" data-toggle="tab">Foto y descripción</a></li>
                    <li role="presentation"><a href="#paso_3" aria-controls="paso_3" role="tab" data-toggle="tab">Localidad y dirección</a></li>
                    </ul>

                  </div>
                    <div class="col-md-12">
                        <!-- Tab panes -->
                      <form action="<?php echo site_url('validar-editar-servicio'); ?>" method="post" id="formulario-ofrecer" enctype="multipart/form-data">
                        <div class="tab-content">
                          <div role="tabpanel fade " class="tab-pane active" id="paso_1">
                            <div class="col-md-12">
                              <h2>Edita tus datos de servicio</h2>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                              <label for="titulo">Titulo</label>
                              <input type="text" class="form-control" id="titulo" value="<?php echo $post['titulo']?>" name="titulo"  required="" placeholder="Titulo">
                              <div class='titulo' style="color:red;">
                                <?php echo $form_error['titulo']; ?>
                              </div>
                              </div>
                              <div class="form-group">
                              <label for="busqueda-servicio">Categoria</label>
                              <input type="text" class="form-control typeaheadOnlyCat" id="busqueda-servicio" value="<?php echo ucfirst($post['categoria']);?>" name="categoria" autocomplete="off" required="" placeholder="Categoría">
                               <div class='categoria' style="color:red;">
                                 <?php echo $form_error['categoria']; ?>
                              </div> 
                              </div>

                              <div class="form-group">
                              <label for="telefono">Teléfono</label>
                              <input type="text" class="form-control" id="telefono" value="<?php echo $post['telefono'];?>" name="telefono"  required="" placeholder="Teléfono">
                               <div class='telefono' style="color:red;">
                                 <?php echo $form_error['telefono']; ?>
                              </div> 
                              </div>
                              <div class="form-group">
                              <label for="sitioweb">Web</label>
                              <input type="url" class="form-control" id="sitioweb" value="<?php echo $post['url_web'];?>" name="sitioweb"   placeholder="Web">
                               <div class='sitioweb' style="color:red;">
                               <?php echo $form_error['sitioweb']; ?>
                              </div> 
                              </div>

                            </div>
                            <div class="col-md-6">
                              <h3>Editar Datos del servicio</h3>
                               <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus ipsum nisi autem at iusto illum excepturi perspiciatis. Praesentium, quod eligendi consectetur officia nemo dolorum quo. Tempora nostrum debitis laudantium porro.
                              </p>
                              <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus ipsum nisi autem at iusto illum excepturi perspiciatis. Praesentium, quod eligendi consectetur officia nemo dolorum quo. Tempora nostrum debitis laudantium porro.
                              </p>
                            </div>
                            <div class="col-md-12">
                                <p class="text-right">
                                    <a href="#" class="btn btn-primary btnNext">Editar foto o descripción</a>
                                </p>
                            </div>

                          </div>
                          <div role="tabpanel" class="tab-pane fade " id="paso_2">
                             <div class="col-md-12">
                              <h2>Puedes editar la foto o la descripción </h2>
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
                                <label for="fotoServicio">Puedes cambiar la foto de tu servicio o subir una si no tienes</label>
                                <input type="file" id="fotoServicio" name="fotoServicio">
                              
                              </div>
                              <div class="form-group">
                                <label for="descripcion">Describe el servicio que ofreces</label>
                               <textarea class="form-control" id="descripcion" name="descripcion" rows="13"><?php echo $post['descripcion'];?></textarea>
                                <div class='descripcion' style="color:red;">
                                <?php echo $form_error['descripcion']; ?>
                                </div> 
                              </div>

                            </div>
                            <div class="col-md-6">
                            	<?php 

                        	 if(!empty($post['foto'])){
                                 
                             ?>
                              <h3>Imagen del servicio</h3>
                               <p>
                               	<img src="<?php echo site_url('assets/images/servicios/'.$post['foto']); ?>"  alt="" style="margin:0 auto 10px;" class="img-responsive" id="previewImg">
                              </p>
                              <?php
                               }else{
                               	?>
                               	<h3>No tienes una foto del servicio..</h3>
                               	<p>Las imagenes sirven para que la gente se interese más en lo que ofreces,
									tambien hacen más atractiva la descripción  del servicio.
                               	</p>
                               	<?php
                               }
                              ?>
                            </div>
                            <div class="col-md-12">
                              
                                <div class="row">
                                  <div class="col-md-6">
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btnPrev">Editar datos</a>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="text-right">
                                            <a href="#" class="btn btn-primary btnNext">Editar localidad y dirección</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane fade " id="paso_3">
                                 <div class="col-md-12">
                                  <h2>Edita la localidad o la dirección</h2>
                                </div>
                                <div class="col-md-6">
                                   <div class="form-group">
                                      <label for="busqueda-localidad">Tu Localidad </label>
                                    
                                       <select id="ajax-select" class="form-control selectpicker with-ajax" name="localidad" placeholder="Buscar" data-live-search="true" >
                                       	<?php if(isset($post['id_localidad'])){
                                       		?>
                                       		  <option value="<?php echo $post['id_localidad']; ?>">
                                       	
		                                       <?php echo $post['localidad'] .", ".$post['provincia']; ?>
		                                       </option>
                                       		<?php
                                       	} ?>
                                     
                                       </select>
                                     <div class='localidad' style="color:red;">
                                      <?php echo $form_error['localidad']; ?>
                                      </div> 
                                    </div>
                                  
                                    <div class="form-group">
                                      <label for="direccion">Tu dirección en donde ofreces el servicio</label>
                                      <!-- <img src="http://placehold.it/480x400&text=google map" alt=""> -->
                                        <p>
                                           <input type="text" id="myPlaceTextBox" name="direccion" class="form-control" placeholder="Ej: Av Rivadavia 5555" value="<?php echo $post['direccion'];?>" />
                                        </p>
                                        <br>
                                      <div class="map">
                                         <?php echo $map['html']; ?>
                                      </div>
                                      <input type="hidden" name="lati" value="<?php echo $post['latitud'];?>" id="lati" >
                                      <input type="hidden" name="long" value="<?php echo $post['longitud'];?>" id="long" >

                                      <div class='direccion' style="color:red;">
                                      <?php echo $form_error['direccion']; ?>
                                      </div> 
                                    </div>

                                </div>
                                <div class="col-md-6">
                                  <h3>Modificar localidades y direcciones</h3>
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
                                                <a href="#" class="btn btn-primary btnPrev">Editar foto y descripción</a>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-right">
                                            	<input type="hidden" name="seccion" value="<?php echo $seccion; ?>">
                                            		<input type="hidden" name="foto" value="<?php echo $post['foto']; ?>">
                                            		<input type="hidden" name="id_servicio" value="<?php echo $post['id']; ?>">
                                                <button type="submit" class="btn btn-success">Finalizar edición</button>
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

</div>