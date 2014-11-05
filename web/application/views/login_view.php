<!--<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>Login en Servix</title>
</head>
<body>
   <h1>Login en Servix</h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('validar-login'); ?>
     <label for="usuario">Usuario:</label>
     <input type="text" size="20" id="usuario" name="usuario"/>
     <br/>
     <label for="clave">Clave:</label>
     <input type="password" size="20" id="clave" name="clave"/>
     <br/>
     <input type="submit" value="Login"/>
   </form>
</body>
</html>
-->
<html>
<head>
    <meta charset="utf-8">
    <title>Login Servix</title>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg" rel="nofollow">Launch demo modal</a>
    <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body">
          <?php $attr = array("id" => "formulario") ?>
          <?php echo form_open(base_url('auth/login'), $attr) ?>
              <p><input type="text" name="username"><span class='errorusername'></span></p>
              <p><input type="password" name="password"><span class='errorpassword'></span></p>
              <p><input type="submit" value="Entrar"></p>
          <?php echo form_close() ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
</body>
<script type="text/javascript">
    $(document).ready(function(){
        $("#formulario").on("submit", function(e)
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
        })
    });
</script>
</html>