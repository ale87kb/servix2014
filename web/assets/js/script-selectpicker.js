function selectpickerApp(){

           var options = {
                ajax: {
                    url: $site_url+"busqueda_localidades",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        q: '{{{q}}}'
                    }
                },
                log:0,
                locale: {
                    emptyTitle: 'Buscá tu localidad',
                    searchPlaceholder:'Buscar',
                    currentlySelected:'Seleccionado actualmente',
                    errorText:'No se encontraron resultados',
                    statusInitialized:'Para empezar escribe una localidad, Ej:(Flores, Palermo)..'
                },
                // log: 3,
                preprocessData: function (data) {

                    var i, l = data.length, array = [];
                    if (l) {
                        for(i = 0; i < l; i++){

                            array.push($.extend(true, data[i], {

                                text: data[i].localidad,
                                value:data[i].idLoc,
                               
                            }));
                        }
                    }
                    return array;
                }
            };

            $('.selectpicker').selectpicker().filter('.with-ajax').ajaxSelectPicker(options);

            $('select.selectpicker').on('change', function(){
                 $('#formulario-solicitud').bootstrapValidator('revalidateField', 'localidad');
                 $('#formulario-ofrecer').bootstrapValidator('revalidateField', 'localidad');
             });


          
            $('#formulario-ofrecer select.selectpicker').on('change', function(){
                // $('button[data-id="ajax-select"] span.filter-option.pull-left').text('')
                $text = $('#formulario-ofrecer select.selectpicker   option:selected').text();
                console.log($text);
                if($text!=""){
                    
                $('button[data-id="ajax-select"] span.filter-option.pull-left').text($text)
                }
             });

             
        }