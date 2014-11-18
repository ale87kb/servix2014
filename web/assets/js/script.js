$('document').ready(function(){

	var app = function(){
		this.url 	  = $site_url,

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

        this.validar_votacion = function(){




            $("#form_votacion").bootstrapValidator({
                container: 'tooltip',
              
                live: 'enabled',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                excluded: ':disabled',
                fields: {
                    puntos: {
                           validators: {
                            between: {
                                min: 1,
                                max: 5,
                                message: 'The latitude must be between 1 and 5'
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
                        }
                    },
                    clave: {
                        validators: {
                            notEmpty: {
                                message: 'Se requiere una clave'
                            },
                        }
                    },
                }
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
                            window.location.reload(); //recargamos la pagina
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
                    
		this.init = function(){
            this.busqueda();
            this.validar_login_ajax();
            this.dropdownMenu();            
            this.validar_comentario_servicio();         
            this.validar_votacion();			
		}
	};
	



	$servix = new app();
	$servix.init();

});