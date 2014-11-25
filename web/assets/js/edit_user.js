$('document').ready(function(){

	var edit_user = function(){
		this.url 	  = $site_url,
        this.email_change = function(){}
        
        this.validar_clave = function(){}

		this.validar_edicion = function(){
            urlweb = this.url;
            
            $('#form_edit_user').bootstrapValidator({
                autoFocus:  true,
                live:       'submitted',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
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
                        }
                    },
                    nclave: {
                        validators: {
                            notEmpty: {
                                message: 'Ingrese su nueva clave.'
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
            .on('success.form.bv', function(e) {
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');
                // Use Ajax to submit form data
                $.post(urlweb + "validar_nuevo_usuario_ajax", $form.serialize(), 
                    function(data) {
                        if(data['res'] == 'success'){
                            $.ajax({
                                url:urlweb+"registro_respuesta",
                                dataType:'html',
                                method:'POST',
                                data: {'datos':data},
                                success:function(page){
                                    $("#box_registro").html(page);
                                }

                            });

                        }
                        if(data['res']=='error')
                        {
                            if(data['username']){
                                bv.updateStatus('usuario', 'INVALID', 'notEmpty');
                                bv.updateMessage('usuario', 'notEmpty', 'El email ingresado ya se encuentra registrado.');
                            }
                            bv.resetField('clave', true);
                            bv.resetField('rclave', true);
                        }
                    }, 'json'
                )}
            )
            .error(function(jqXHR, exception){
                console.log("Error: " + jqXHR.responseText)
            })

        },

		
		this.init = function(){
          /*  this.email_change();
            this.validar_edicion();
            this.validar_clave();*/
		}
	}
	

	/*$servix = new edit_user();
	$servix.init();*/

});