 function typeheadApp(){

        $.get($site_url+"busqueda_servicio", function(data){
            $(".typeaheadCat").typeahead({
                source:data 
            });
        },'json'),
         $.get($site_url+"busqueda_categoria", function(data){
            $(".typeaheadOnlyCat").typeahead({
                source:data 
            });
        },'json'), 

         $.get($site_url+"busqueda_localidades_buscador", function(data){
            $(".typeheadLoc2").typeahead({
                source:data 
            });
        },'json'),


         $(".typeheadLoc").typeahead({
            source : function(query, process) {
                return $.post($site_url+"busqueda_localidades", {
                    localidad : query
                }, function(data) {
                    var json = JSON.parse(data);
                    return process(json);
                });
            },
            items : 5,
            minLength: 3
        });

        $('.typeaheadOnlyCat').on('change', function(e) {
             $('#formulario-solicitud').bootstrapValidator('revalidateField', 'categoria');
        });

        $('.typeheadLoc').on('blur', function(e) {
             $('#formulario-ofrecer').bootstrapValidator('revalidateField', 'localidad');
        });

        



}