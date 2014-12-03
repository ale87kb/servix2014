function datepickerApp(){

            function fechaManiana() {
               var today = moment();
               var tomorrow = today.add(1,'days');
               return moment(tomorrow).format("DD-MM-YYYY");
            }
            function fechaHoy() {
               var today = moment();
             
               return today.format("DD-MM-YYYY");
            }

            $('#datetimepicker1').datetimepicker({
                    language: 'es',
                    pickTime: false, 
                    // useCurrent: false,
                    // showToday: false,  
                    maxDate:fechaHoy()

            });

            $('#datetimepicker2').datetimepicker({
                    language: 'es',
                    // defaultDate:fechaManiana(), 
                    showToday: false,  
                    minDate:fechaManiana()

            });

            $('#datetimepicker2').on('dp.change dp.show', function(e) {
               $('#formulario-solicitud').bootstrapValidator('revalidateField', 'fecha_fin');
            });

            $('#datetimepicker1').on('dp.change dp.show', function(e) {
               $('#form_votacion').bootstrapValidator('revalidateField', 'fecha');
            });

             $("#datetimepicker2, #datetimepicker2 .input-group-addon").click(function () {
                // alert("asd")
                $('#datetimepicker2').data("DateTimePicker").setDate();
            });  

          
             
}