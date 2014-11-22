$('document').ready(function(){

	var login = function(){
		this.url 	  = $site_url,

		this.validar_login = function(){
            urlweb = this.url;
            
            $("#formulario-login").submit( function(e)
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
            })
        },
        
		
		this.init = function(){
            this.validar_login();
		}
	}
	

	$servix = new login();
	$servix.init();

});