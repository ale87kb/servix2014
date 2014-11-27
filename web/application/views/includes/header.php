<nav class="navbar navbar-default navbar-static-top navbar-servix" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-login" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div id="logostyle">
        <a href="<?php echo site_url('');?>">
          <h1 class="s-logo es">Servix - a un click de distancia</h1>
        </a>
      </div>
    </div>

    <div id="navbar-login" class="navbar-collapse collapse">     
  
      <?php
      if(isset($usuarioSession)){
        $this->load->view('includes/user_log');
        
      }else{
        $this->load->view('includes/user_no_log');
      }
      ?>
    </div><!--/.navbar-login -->

  </div>
</nav>

<div class="container">