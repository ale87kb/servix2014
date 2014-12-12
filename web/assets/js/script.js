var app = function(){
     this.url      = $site_url,

       
        this.validar_busqueda = function(){
            $("#formulario-busqueda").bootstrapValidator({
                                     
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        servicio: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese un servicio'
                            }
                        }
                        },
                        localidad: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese una localidad'
                            }
                        }
                        },
                    }
            });
        },
        this.dropdownMenu = function(){

            $(".dropdown").hover(            
                function() {
                    $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                    $(this).toggleClass('open');
                    $('b', this).toggleClass("caret caret-up");                
                },
                function() {
                    $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                    $(this).toggleClass('open');
                    $('b', this).toggleClass("caret caret-up");                
                });

        },
        
        this.validar_recomendacion = function(){
            $("#form_recomendacion").bootstrapValidator({
                      // The disabled elements are excluded
                    // Hidden elements (including the rating star) are included
                    excluded: ':disabled',
                        feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        nombreAmigo: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese el nombre de su amigo'
                            }
                        }
                        },
                        emailAmigo: {
                           validators: {
                            notEmpty: {
                                message: 'Ingrese un email valido'
                            },
                            regexp: {
                                regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                                message: 'El email ingresado no es correcto'
                            }
                        }
                        }
                    }
            }).on('success.form.bv', function(e){
                  
              // $(this).data('bootstrapValidator').resetForm();
                var json = null;
                var error = null;
                var options = {

                    success:function(data){
                         json = JSON.parse(data);
                         error  = json.error;
                         // $("#mensajeVoto").html(json.mensaje);
                         $('.recomendacion').addClass('hidden');
                         if(!json.error){
                            $("#mensajeRecomendacion").append(json.mensaje);
                            $("#mensajeRecomendacion").addClass("alert-success");
                            $("#mensajeRecomendacion").removeClass("hidden");
                            console.log(json);
                         }else{
                            $("#mensajeRecomendacion").append(json.mensaje);
                            $("#mensajeRecomendacion").addClass("alert-danger");
                            $("#mensajeRecomendacion").removeClass("hidden");
                         }
                    },
                    resetForm: true,
                }

                $(this).ajaxForm(options);

                 setTimeout(function() {

                    if(error == false){
                        $('#modalRecomendar').modal('hide');
                         setTimeout(function() {window.location.reload(); }, 2000);
                    }else{
                        $('#modalRecomendar').modal('hide');
                       
                    }
                },2500);
               
            });
        },
        this.validar_votacion = function(){


            $("#form_votacion").bootstrapValidator({
                      // The disabled elements are excluded
                    // Hidden elements (including the rating star) are included
                    excluded: ':disabled',
                        feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        star: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese su voto'
                            }
                        }
                        },
                        fecha: {
                           validators: {
                                notEmpty: {
                                    message: 'Se requiere una fecha'
                                },
                                date: {
                                    format: 'DD/MM/YYYY',
                                    message: 'Se requiere una fecha valida'
                                }
                            }
                        },
                        comentario: {
                            validators: {
                                notEmpty: {
                                    message: 'Ingrese un comentario'
                                },
                                stringLength: {
                                    max: 300,
                                    min:10,
                                    message: 'Por favor, ingrese un mensaje entre 10 y 300 caracteres'
                                }
                            }
                        }
                    }
            }).on('success.form.bv', function(e){
                  
              // $(this).data('bootstrapValidator').resetForm();
                var json = null;
                var error = null;
                var options = {

                    success:function(data){
                         json = JSON.parse(data);
                         error  = json.error;
                         // $("#mensajeVoto").html(json.mensaje);
                         $('.votacion').addClass('hidden');
                         if(json.error == false){
                            $("#mensajeVoto").append(json.mensaje);
                            $("#mensajeVoto").addClass("alert-success");
                            $("#mensajeVoto").removeClass("hidden");
                            // console.log(json);
                         }else{
                            $("#mensajeVoto").append(json.mensaje);
                            $("#mensajeVoto").addClass("alert-danger");
                            $("#mensajeVoto").removeClass("hidden");
                         }
                    },
                    resetForm: true,
                }

                $(this).ajaxForm(options);

                 setTimeout(function() {

                    if(error == false){
                        $('#modalOpinion').modal('hide');
                         setTimeout(function() {window.location.reload(); }, 2000);
                    }else{
                        $('#modalOpinion').modal('hide');
                       
                    }
                },2500);
               
            });
        },
        this.ajax_paging = function(){
         
         $(document).on("click", "#pagination a", function(e) {
                $href= $(this).attr("href");
                e.preventDefault();
                    $.ajax({
                         type: "GET",
                         url: $(this).get(),
                         success: function(html){
                            //escribo la url del link para no perder la navegacion si se refresca la pagina
                             history.pushState({}, '',$href);
                            $("#opiniones").html(html);
                             //escribo los comentarios
                            //inicio servix app y ejecuto la funcion de la votacion para q me cargue los votos (las estrellas)
                            
                               $('.ratyAVG').each(function( index ) {

                                     $avg = $(this).attr('data-avg');
                                     $(this).raty({
                                        path: $site_url+'/assets/css/raty/images',
                                        score: $avg ,
                                        readOnly: true,
                                     });
                                });
                                $(document).load(function(){
                                    $servix = new app();
                                

                                    $servix.validar_votacion(); 
                                   
                                })
                          }
                    });               
                   return false;
                });            
      
                  
         },

         
        this.validar_comentario_servicio = function(){

            $("#formCServ").bootstrapValidator({
                container: 'tooltip',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    comentario: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor, ingrese un mensaje'
                            },
                            stringLength: {
                                max: 300,
                                min:10,
                                message: 'Por favor, ingrese un mensaje entre 10 y 300 caracteres'
                            }
                        }
                    }
                }
            })
            .on('success.form.bv', function(e){
                  
              // $(this).data('bootstrapValidator').resetForm();
            
                var options = {

                    success:function(data){
                         var json = JSON.parse(data);
                         if(json.error == false){
                            $("#mensaje").append(json.mensaje);
                            $("#mensaje").addClass("alert-success");
                            $("#mensaje").removeClass("hidden");
                            // console.log(json);
                         }else{
                            $("#mensaje").append(json.mensaje);
                            $("#mensaje").addClass("alert-danger");
                            $("#mensaje").removeClass("hidden");
                         }
                    },
                    resetForm: true,
                }

                $(this).ajaxForm(options);
                setTimeout(function() {window.location.reload(); }, 2000);
            });
        },


        this.validar_login_ajax = function(){
            urlweb = this.url;
           
            //Reseteo el cuadro login cuando aparece
           /*$('#loginModal').on('shown.bs.modal', function() {
                $('#form_login_ajax').bootstrapValidator('resetForm', true);
            });*/
            $('#loginModal').on('hidden.bs.modal', function() {
                $('#form_login_ajax').bootstrapValidator('resetForm', true);
                $('#loginModal').on('shown.bs.modal', function() {
                $('#form_login_ajax').bootstrapValidator('resetForm', true);
                });
            });
            

            $('#form_login_ajax').bootstrapValidator({
                autoFocus:  true,
                live:       'submitted',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    usuario: {
                        validators: {
                            notEmpty: {
                                message: 'Se requiere un email de usuario'
                            },
                            regexp: {
                                regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                                message: 'El email ingresado no es correcto'
                            }
                        }
                    },
                    clave: {
                        validators: {
                            notEmpty: {
                                message: 'Se requiere una clave'
                            },
                        },
                        onError: function(e, data){
                           $(e.target).val('');
                        }
                    },
                }
            })
            .on('error.validator.bv', function(e, data) {
                // $(e.target)    --> The field element
                // data.bv        --> The BootstrapValidator instance
                // data.field     --> The field name
                // data.element   --> The field element
                // data.validator --> The current validator name
                data.element
                    .data('bv.messages')
                    // Hide all the messages
                    .find('.help-block[data-bv-for="' + data.field + '"]').hide()
                    // Show only message associated with current validator
                    .filter('[data-bv-validator="' + data.validator + '"]').show();
            })
            .on('success.form.bv', function(e) {
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post(urlweb + "validar_login_ajax", $form.serialize(), function(data) {
                        if(data['res']=='success'){
                            $('#loginModal').modal('hide');//cerramos la modal de bootstrap
                        
                             if($("#curretSection").val() == 'ficha'){
                                if($("#nextAction").val() == '#modalOpinion'){
                                    history.pushState({}, '','#QuieroOpinar');
                                }
                                    window.location.reload();
                             }else if(($("#nextAction").val() == 'solicitar-servicio') &&  $("#curretSection").val() == ''){

                                  window.location.href='solicitar-servicio';

                             }else if(($("#nextAction").val() == 'ofrecer-servicio') &&  $("#curretSection").val() == '' ){

                                  window.location.href='ofrecer-servicio';

                             
                             }else{

                                window.location.reload();
                             }


                              
                             
                        }
                        if(data['username']){
                            bv.updateStatus('usuario', 'INVALID', 'notEmpty');
                            bv.updateMessage('usuario', 'notEmpty', 'Usuario incorrecto o no registrado');
                            bv.resetField('clave', true);
                        }
                        if(data['password']){
                            bv.updateStatus('clave', 'INVALID');
                            bv.updateMessage('clave', 'notEmpty', 'Clave incorrecta');
                        }
                    }, 'json'
                )}
            )
            .error(function(jqXHR, exception){
                console.log("Error: " + jqXHR.responseText)
            })
        },
        this.validar_solicitud = function(){
            $("#formulario-solicitud").bootstrapValidator({
                autoFocus:  true,
                live:       'submitted',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                excluded: ':disabled',
                fields: {
                    categoria: {
                        validators: {
                            notEmpty: {
                                message: 'Se requiere una categoria'
                            },
                             stringLength: {
                                max: 30,
                                min:3,
                                message: 'Por favor, su categoria debe tener entre 3 y 30'
                            }
                        }
                    },
                    localidad: {
                        validators: {
                            notEmpty: {
                                message: 'Se requiere una localidad'
                            }
                        }
                    },
                    fecha_fin: {
                        validators: {
                             notEmpty: {
                                message: 'Se requiere una fecha'
                            },
                            date: {
                                format: 'DD/MM/YYYY HH:mm',
                                message: 'Se requiere una fecha y hora valida'
                            }
                        }
                    },
                    comentario: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor, ingrese un mensaje'
                            },
                            stringLength: {
                                max: 300,
                                min:10,
                                message: 'Por favor, ingrese un mensaje entre 10 y 300 caracteres'
                            }
                        }
                    }
                }
            })
        },
        this.validar_ofrecer = function(){

            $('#formulario-ofrecer').find('input').keypress(function(e){
                if ( e.which == 13 ) // Enter key = keycode 13
                {

                    return false;
                }
            });

            $('#formulario-ofrecer') .bootstrapValidator({
                autoFocus:  true,
                live:       'submitted',
                // submitButtons: 'button[type="submit"]',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                excluded: ':disabled',
                fields: {
                    titulo: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor introduce un titulo'
                            },
                            stringLength: {
                                max:40,
                                min:3,
                                message: 'Por favor, ingrese un titulo entre 3 y 40 caracteres'
                            }
                        }
                    },
                    categoria: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor introduce una categoría'
                            },
                            stringLength: {
                                max:20,
                                min:3,
                                message: 'Por favor, ingrese una categoria entre 3 y 20 caracteres'
                            }
                        }
                    },
                    telefono: {
                        validators: {
                            notEmpty: {
                                message: 'Ingresa un teléfono'
                            }, 
                            digits: {
                                message: 'El teléfono debe contener solo números.'
                            }
                        }
                    },
                  
                    descripcion: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor ingresa una descripción'
                            },
                            stringLength: {
                                max:800,
                                min:10,
                                message: 'Por favor, ingrese una categoria entre 10 y 800 caracteres'
                            }
                        }
                    },
                    localidad: {
                        validators: {
                            notEmpty: {
                                message: 'Por favor ingresa una localidad'
                            }
                        }
                    },
                    fotoServicio: {
                        validators: {
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/png',
                                maxSize: 2097152,   // 2048 * 1024
                                message: 'Archivo invalido'
                            }
                        }
                    }

                }
            })
            // Called when a field is invalid
            .on('error.field.bv', function(e, data) {
                // data.element --> The field element

                var $tabPane = data.element.parents('.tab-pane'),
                    tabId    = $tabPane.attr('id');
                    // console.log(tabId);

                $('a[href="#' + tabId + '"][data-toggle="tab"]')
                    .parent()
                    .find('i')
                    .removeClass('fa-check')
                    .addClass('fa-times');
            })
            // Called when a field is valid
            .on('success.field.bv', function(e, data) {
                // data.bv      --> The BootstrapValidator instance
                // data.element --> The field element

                var $tabPane = data.element.parents('.tab-pane'),
                    tabId    = $tabPane.attr('id'),
                    $icon    = $('a[href="#' + tabId + '"][data-toggle="tab"]')
                                .parent()
                                .find('i')
                                .removeClass('fa-check fa-times');

                // Check if the submit button is clicked
                if (data.bv.getSubmitButton()) {
                    // Check if all fields in tab are valid
                    var isValidTab = data.bv.isValidContainer($tabPane);
                    $icon.addClass(isValidTab ? 'fa-check' : 'fa-times');
                }
            }).on('success.form.bv', function(e) {
                // e.preventDefault();
                // alert("todo ok")
            });

        },
        this.setAffterAction =function(){
            $(".affterOpenLogin").on('click',function(){
            $("#nextAction").val('#modalOpinion');

            });


            $(".gobusquedaTemp").on('click',function(){
            $("#nextAction").val('solicitar-servicio');

            });
            $(".goOfrecerServicio").on('click',function(){
            $("#nextAction").val('ofrecer-servicio');

            });
            if(window.location.href.indexOf("#QuieroOpinar") > -1) {
                 // alert("your url contains the name franky");
                 $('#modalOpinion').modal('show')
             }


        },
        this.favoritosAction = function(){
           $('#favorito').on('click',function(){
                
                if($(this).prop('checked')){
                    $(this).next('span').text('Agregado a favoritos')
                }else{
                    $(this).next('span').text('Agregar a favoritos')

                }
           

                 $val = $(this).val();
                 $url = $(this).closest('form').attr('action');
                 $postData = $(this).closest('form').serialize();
                 $.post($url,$postData,function(data){
                      
                       console.log(data)
                 },'json')
            })

        }, 
        this.pagSolicitados = function(){
           $(document).on('click','#pagSolicitados a',function(e){
                
               e.preventDefault();
               // console.log("asd")
               $url = $(this).attr('href');
               $.post($url,function(data){
                 $("#solicitados").html(data)
               },'html')

                history.pushState({}, '', $url);
            })

        },
        this.confirmBox = function(){
            $("#cancelar_postulacion").on('click',function(){

             if (confirm('Esta seguro que desea cancelar esta postulación')) {
                  $("#formCancelPostu").submit();
              } else {
                   return false;
              }
            });
            $("#borrar_servicio").on('click',function(){

             if (confirm('Esta seguro que desea borrar este servicio')) {
                  $("#form_del_servicio").submit();
              } else {
                   return false;
              }
            });
            $("#borrar_s_solicitado").on('click',function(){

             if (confirm('Esta seguro que desea borrar este servicio solicitado')) {
                  $("#form_del_servicio_solicitado").submit();
              } else {
                   return false;
              }
            });
        },
        this.hideMensaje= function(){
            setTimeout(function(){$("#mensaje_e").fadeOut('fast')},2000);
        }
        this.compWizzard = function(){
            $(function() {

                $('.btnNext').on('click', function(e) {    
                    e.preventDefault();    
                    nextTab();  
                });

                $('.btnPrev').on('click', function(e) {    
                    e.preventDefault();    
                    prevTab();  
                });

                $('a[data-toggle="tab"]').on('shown', function (e) {
                    isLastTab();
                });

            });

            function nextTab() {
                var e = $('#tab li.active').next().find('a[data-toggle="tab"]');  
                if(e.length > 0) e.click();  
                isLastTab();
            }
            function prevTab() {
                var e = $('#tab li.active').prev().find('a[data-toggle="tab"]');  
                if(e.length > 0) e.click();  
                isLastTab();
            }

            function isLastTab() {
                var e = $('#tab li:last').hasClass('active'); 
            return e;
            }

            $("#tab li a[href='#paso_3']").on('shown.bs.tab', function (e) { 
                    var center = map.getCenter();
                    google.maps.event.trigger(map, "resize");
                    map.setCenter(center);
            });

            var url = document.location.toString();
            if (url.match('#')) {
                $('#tab li a[href=#'+url.split('#')[1]+']').tab('show') ;
            } 

            //  history.pushState({}, '',e.target.hash);

            // Change hash for page-reload
            $('#tab li a').on('shown', function (e) {

                window.location.hash = e.target.hash;
            })


          
          
        },
        this.previewImgUpload = function(){

            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#previewImg').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#fotoServicio").change(function(){
                readURL(this);
            });

        },


        this.init = function(){
          
            this.validar_busqueda();
            this.validar_login_ajax();
            this.dropdownMenu();            
            this.validar_comentario_servicio();         
            // this.loadVotacion();            
            this.validar_recomendacion();
            this.validar_solicitud();
            this.validar_votacion();            
            this.ajax_paging();            
            this.setAffterAction();            
            this.favoritosAction();   
            this.pagSolicitados();      
            this.confirmBox();   
            this.hideMensaje();
            this.compWizzard();
            this.validar_ofrecer();
            this.previewImgUpload();
        }
};
    


$('document').ready(function(){

    var servix = new app();
    servix.init();

    if (typeof typeheadApp == 'function') { 
        typeheadApp(); 
    } 

    if (typeof datepickerApp == 'function') { 
        datepickerApp(); 
    }

    if (typeof selectpickerApp == 'function') { 
        selectpickerApp(); 
    }
    
    if (typeof ratyApp == 'function') { 
        ratyApp(); 
    }
    
	

});