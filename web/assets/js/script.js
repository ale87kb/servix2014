$('document').ready(function(){
var app = function(){
        this.url      = $site_url,

        this.busqueda = function(){
                $.get(this.url+"busqueda_servicio", function(data){
                    $(".typeaheadCat").typeahead({
                        source:data 
                    });
                },'json'),
                $.get(this.url+"busqueda_localidades", function(data){
                    $(".typeheadLoc").typeahead({
                        source:data 
                    });
                },'json');
        },
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
                    $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideDown("fast");
                    $(this).toggleClass('open');        
                },
                function() {
                    $('.dropdown-menu', this).not('.in .dropdown-menu').stop( true, true ).slideUp("fast");
                    $(this).toggleClass('open');       
                }
            );
        },



        this.loadVotacion = function(){
           
             $('#ratyRating').raty({
              
                path: $site_url+'/assets/css/raty/images',
                size: 24,
                hints: ['Muy Malo', 'Malo', 'Regular', 'Bueno', 'Excelente'],
                // The name of hidden field generated by Raty
                scoreName: 'star',
                // Revalidate the star rating whenever user change it
                click: function (score, evt) {
                    setTimeout(function(){
                        $('#form_votacion').bootstrapValidator('revalidateField', 'star');
                    },1000);
                }
            });

             $('.ratyAVG').each(function( index ) {

                 $avg = $(this).attr('data-avg');
                 $(this).raty({
                    path: $site_url+'/assets/css/raty/images',
                    score: $avg ,
                    readOnly: true,
                 });
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
                                    message: 'Fecha Incorrecta'
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
            $('#loginModal').on('shown.bs.modal', function() {
                $('#form_login_ajax').bootstrapValidator('resetForm', true);
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
                             }else if($("#nextAction").val() == 'busqueda-temporal'){

                                  window.location.href='busqueda-temporal';
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
        this.setAffterAction =function(){
            $(".affterOpenLogin").on('click',function(){
            $("#nextAction").val('#modalOpinion');

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
                console.log()

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
               console.log("asd")
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
        },

        this.init = function(){


            this.busqueda();
            this.validar_busqueda();
            this.validar_login_ajax();
            this.dropdownMenu();            
            this.validar_comentario_servicio();         
            this.loadVotacion();            
            this.validar_recomendacion();
            this.validar_votacion();            
            this.ajax_paging();            
            this.setAffterAction();            
            this.favoritosAction();   
            this.pagSolicitados();      
            this.confirmBox();   
        }
    };
    



    var servix = new app();
    servix.init();
	

});