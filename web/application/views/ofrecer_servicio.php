<div class="row">
    <div class="jumbotron col-md-12">
      <div class="row">
      
        <div class="col-md-12">
          <h1>Ofrecer un servicio</h1>
          <p>En solo 3 pasos publica tu servicio en Servix</p>
        </div>
        </div>
            <div class="row bg-white tab-box">
               <div class="col-md-12 ">
                  <div role="tabpanel">

                  <div class="col-md-12">
                      <!-- Nav tabs -->
                    <ul class="nav nav-pills " role="tablist">
                    <li role="presentation" class="active"><a href="#paso_1" aria-controls="paso_1" role="tab" data-toggle="tab">Paso 1</a></li>
                    <li role="presentation" ><a href="#paso_2" aria-controls="paso_2"  role="tab" data-toggle="tab">Paso 2</a></li>
                    <li role="presentation"><a href="#paso_3" aria-controls="paso_3" role="tab" data-toggle="tab">Paso 3</a></li>
                    </ul>

                  </div>
                    <div class="col-md-12">
                        <!-- Tab panes -->
                      <form action="<?php echo site_url('validar-ofrecer-servicio'); ?>" method="post" id="formulario-ofrecer">
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="paso_1">
                            <div class="col-md-12">
                              <h2>Completa tus datos de servicio</h2>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                              <label for="titulo">¿Titulo del servicio?</label>
                              <input type="text" class="form-control" id="titulo" value="" name="titulo"  required="" placeholder="¿Como se llama tu servicio?">

                              </div>
                              <div class="form-group">
                              <label for="busqueda-servicio">¿En que categoría lo estas ofreciendo?</label>
                              <input type="text" class="form-control typeaheadOnlyCat" id="busqueda-servicio" value="" name="categoria" autocomplete="off" required="" placeholder="¿Qué buscas?">

                              </div>

                              <div class="form-group">
                              <label for="telefono">¿Cual es el numero de teléfono del servicio?</label>
                              <input type="text" class="form-control" id="telefono" value="" name="telefono"  required="" placeholder="¿A que numero te pueden llamar?">

                              </div>
                              <div class="form-group">
                              <label for="sitioweb">¿Sitio web?</label>
                              <input type="text" class="form-control" id="sitioweb" value="" name="sitioweb"  required="" placeholder="www.misitio.com">

                              </div>

                            </div>
                            <div class="col-md-6">
                              <h3>Guia para ofrecer un servicio paso 1</h3>
                            </div>
                            <div class="col-md-12">
                                <p class="text-right">
                                    <a href="#" class="btn btn-primary">Ir al paso 2</a>
                                </p>
                            </div>

                          </div>
                          <div role="tabpanel" class="tab-pane" id="paso_2">
                             <div class="col-md-12">
                              <h2>Completa tus datos de servicio</h2>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                              <label for="titulo">¿Titulo del servicio?</label>
                              <input type="text" class="form-control" id="titulo" value="" name="titulo"  required="" placeholder="¿Como se llama tu servicio?">

                              </div>
                              <div class="form-group">
                              <label for="busqueda-servicio">¿En que categoría lo estas ofreciendo?</label>
                              <input type="text" class="form-control typeaheadOnlyCat" id="busqueda-servicio" value="" name="categoria" autocomplete="off" required="" placeholder="¿Qué buscas?">

                              </div>

                              <div class="form-group">
                              <label for="telefono">¿Cual es el numero de teléfono del servicio?</label>
                              <input type="text" class="form-control" id="telefono" value="" name="telefono"  required="" placeholder="¿A que numero te pueden llamar?">

                              </div>
                              <div class="form-group">
                              <label for="sitioweb">¿Sitio web?</label>
                              <input type="text" class="form-control" id="sitioweb" value="" name="sitioweb"  required="" placeholder="www.misitio.com">

                              </div>

                            </div>
                            <div class="col-md-6">
                              <h3>Guia para ofrecer un servicio paso 1</h3>
                            </div>
                            <div class="col-md-12">
                                <p class="text-right">
                                    <a href="#" class="btn btn-primary">Ir al paso 2</a>
                                </p>
                            </div>
                          </div>
                          <div role="tabpanel" class="tab-pane" id="paso_3">
                            <div class="col-md-12">
                              algo 3
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