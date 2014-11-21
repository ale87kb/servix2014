$('document').ready(function(){

	var registro = function(){
		this.url 	  = $site_url,

		this.validar_registro = function(){
            urlweb = this.url;
            
            $('#form_reg').bootstrapValidator({
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
                                message: 'Ingrese un e-mail.'
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
                                message: 'Ingrese su clave.'
                            },
                            stringLength: {
                                min: 6,
                                max: 20,
                                message: 'La contraseña debe tener entre 6 y 20 caracteres.'
                            },
                            identical: {
                                field: 'rclave',
                                message: 'La Contraseña y Repetir Contraseña no son iguales'
                            }
                            
                        },
                        onError: function(e, data){
                                

                        }
                    },
                    rclave: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese su clave nuevamente.'
                            },
                            stringLength: {
                                min: 6,
                                max: 20,
                                message: 'La contraseña debe tener entre 6 y 20 caracteres.'
                            },
                            identical: {
                                field: 'clave',
                                message: 'La Contraseña y Repetir Contraseña no son iguales'
                            }                            
                        }
                    },
                    nombre: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese su nombre.'
                            },
                            regexp: {
                                regexp: /^[A-Zñáéíóú\s]+$/i,
                                message: 'El nombre puede contener solamente letras y espacios'
                            }                            
                        }
                    },
                    apellido: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese su apellido.'
                            },
                            regexp: {
                                regexp: /^[A-Zñáéíóú\s]+$/i,
                                message: 'El apellido puede contener solamente letras y espacios'
                            }                            
                        }
                    },
                    dni: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese su DNI.'
                            },
                            digits: {
                                message: 'El teléfono debe contener solo números.'
                            }
                        }
                    },
                    direccion: {
                        validators: {
                            
                        }
                    },
                    telefono: {
                        validators: {
                            digits: {
                                message: 'El teléfono debe contener solo números.'
                            }
                        }
                    }
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
                
                //$('#form_reg').bootstrapValidator('resetField', 'clave', true);
                //$('input[type="password"]').val('');
                //$('#form_reg').bootstrapValidator('resetField', 'rclave');

            })




            /*$("#form_reg").submit( function(e)
            {
                e.preventDefault();

                $.post(urlweb+"validar_login_ajax", 
                    $(this).serialize(),
                    function(data){
                        var json = JSON.parse(data);
                        $(".errorusername, .errorpassword").html("");
                        if(json.res == "error")
                        {
                            if(json.username)
                            {
                                $(".errorusername").append( json.username );
                            }
                            if(json.password)
                            {
                                $(".errorpassword").append( json.password );
                            }
                        }
                        else
                        {
                            window.location.href = urlweb; //redirigimos a home
                        }
                    }).error(function(jqXHR, exception){
                        console.log("Error: " + jqXHR.responseText)
                    })
            })*/
        },
        
		
		this.init = function(){
            this.validar_registro();
		}
	}
	

	$servix = new registro();
	$servix.init();

});