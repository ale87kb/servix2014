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
		
		this.init = function(){
			this.busqueda();
			
		}
	}
	

	$servix = new app();
	$servix.init();
	
/* $("#formulario").on("submit", function(e)
        {
            $.ajax({
                type : "POST",
                url : "<?php echo base_url('auth/login') ?>",
                data : $(this).serialize(),
                success: function(data)
                {
                    var json = JSON.parse(data);
                    $(".errorusername, .errorpassword").html("");
                    if(json.res == "error")
                    {
                        if(json.username)
                        {
                            $(".errorusername").append("<p class='error'>" + json.username + "</p>");
                        }
                        if(json.password)
                        {
                            $(".errorpassword").append("<p class='error'>" + json.password + "</p>");
                        }
                    }
                    else
                    {
                        alert("success");//todo ha salido bien
                                $('#myModal').modal('hide');//cerramos la modal de bootstrap
                    }
                },
                error: function(jqXHR, exception)
                {
                    console.log("Error: " + jqXHR.responseText)
                }
            });
            e.preventDefault();
        })*/
	
});




       

