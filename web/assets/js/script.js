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
	

	
});