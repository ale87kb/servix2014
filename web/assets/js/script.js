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

        this.modal_login = function(){


    $('#form_login_ajax').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            usuario: {
                validators: {
                    notEmpty: {
                        message: 'The username is required'
                    }
                }
            },
            clave: {
                validators: {
                    notEmpty: {
                        message: 'The password is required'
                    }
                }
            }
        }
    });

    $('#loginModal').on('shown.bs.modal', function() {
        $('#form_login_ajax').bootstrapValidator('resetForm', true);
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
                                },
                               /* stringLength: {
                                    min: 6,
                                    max: 30,
                                    message: 'The username must be more than 6 and less than 30 characters long'
                                },
                                /*remote: {
                                    url: 'remote.php',
                                    message: 'The username is not available'
                                },*/
                                /*regexp: {
                                    regexp: /^[a-zA-Z0-9_\.]+$/,
                                    message: 'The username can only consist of alphabetical, number, dot and underscore'
                                }*/
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


                    /*var json = JSON.parse(data);
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
                    }).error(function(jqXHR, exception){
                        console.log("Error: " + jqXHR.responseText)
                    })*/
            },



            /* FUNCIONA
            $("#form_login_ajax").submit( function(e)
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
                            $('#loginModal').modal('hide');//cerramos la modal de bootstrap
                            window.location.reload(); //recargamos la pagina
                        }
                    }).error(function(jqXHR, exception){
                        console.log("Error: " + jqXHR.responseText)
                    })
            })
        },
        */
		

		this.init = function(){
            this.busqueda();
            //this.modal_login();
            this.validar_login_ajax();
            this.dropdownMenu();			
		}
	}
	

	$servix = new app();
	$servix.init();

});