$('document').ready(function(){


	var normalize = (function() {
	  var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç", 
	      to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
	      mapping = {};
	 
	  for(var i = 0, j = from.length; i < j; i++ )
	      mapping[ from.charAt( i ) ] = to.charAt( i );
	 
	  return function( str ) {
	      var ret = [];
	      for( var i = 0, j = str.length; i < j; i++ ) {
	          var c = str.charAt( i );
	          if( mapping.hasOwnProperty( str.charAt( i ) ) )
	              ret.push( mapping[ c ] );
	          else
	              ret.push( c );
	      }      
	      return ret.join( '' ).replace( /[^-A-Za-z0-9]+/g, '-' ).toLowerCase();
	  }
	 
	})();

	


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
		
		this.form_busqueda = function(){
			$("#formulario-busqueda").on('submit',function(e){
					// e.preventDefault();
					// $serv = $(this).find("#busqueda-servicio").val() ;
					// $loc  = $(this).find("#busqueda-localidad").val();
					// $ruta = $(this).attr('action');
					// $.post($ruta+"/"+normalize($serv)+"/"+normalize($loc),{ servicio: $serv, localidad: $loc } )
					// return location.href=$ruta+"/"+normalize($serv)+"/"+normalize($loc);
			});
		}
		this.init = function(){
			this.busqueda();
			this.form_busqueda();
		}

			

		}
	

	$servix = new app();
	$servix.init();
	

	
});