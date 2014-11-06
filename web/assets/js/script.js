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
                                    message: 'Por favor, ingrese un mensaje con menos de 300 caracteres'
                                }
                               
                            }
                        }
                    }
            }).on('success.form.bv', function(e) {
                e.preventDefault();
                console.log($(this))
               // $('#myForm').ajaxForm(function() { 
               //  alert("Thank you for your comment!"); 
               //  }); 
            });
        },
        this.validar_login_ajax = function(){
            urlweb = this.url;


           
            $('#loginModal').on('shown.bs.modal', function() {
                $('#form_login_ajax').bootstrapValidator('resetForm', true);
            });

            $('#form_login_ajax').bootstrapValidator({
                container: 'tooltip',
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
                                }
                           
                            }
                        },
                        clave: {
                            validators: {
                                notEmpty: {
                                    message: 'Se requiere una clave'
                                }
                            }
                        }
                    }
            }).on('success.form.bv', function(e) {
                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post(urlweb+"validar_login_ajax", $form.serialize(), function(data) { 
                        console.log(data);
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
                            $('#loginModal').modal('hide');//cerramos la modal de bootstrap
                            window.location.reload(); //recargamos la pagina
                        }
                    }
                    

                )}).error(function(jqXHR, exception){
                        console.log("Error: " + jqXHR.responseText)
                    })


                    
            },

		

		this.init = function(){
            this.busqueda();
            this.validar_login_ajax();
            this.dropdownMenu();            
            this.validar_comentario_servicio();			
		}
	}
	

	$servix = new app();
	$servix.init();

});