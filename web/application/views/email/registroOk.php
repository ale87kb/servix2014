<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- If you delete this meta tag, Half Life 3 will never be released. -->
<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Gracias por iniciar session en Servix</title>
	
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/email.css') ?>" />

</head>
 
<body bgcolor="#FFFFFF">

<!-- HEADER -->
<table class="head-wrap" bgcolor="#999999">
	<tr>
		<td></td>
		<td class="header container" >
				
				<div class="content">
				<table bgcolor="#999999">
					<tr>
						<td><a href="<?php echo site_url(); ?> "><img src="<?php echo site_url('assets/images/servix_logo_48.png'); ?>" /></a></td>
						<td align="right"><h6 class="collapse"><?php echo date('d-m-Y H:m'); ?></h6></td>
					</tr>
				</table>
				</div>
				
		</td>
		<td></td>
	</tr>
</table><!-- /HEADER -->


<!-- BODY -->
<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" bgcolor="#FFFFFF">

			<div class="content">
			<table>
				<tr>
					<td>
						<h3>Hola, <?php  echo ucfirst($nombre); ?> </h3>
						<p class="lead">Haz iniciado sesion en Servix con facebook, y nos hemos tomado la libertad de registrarte en nustro sitio. <br> Te generamos una  cuenta con los siguientes datos de ingreso
						</p>
						<p class="callout">
							Usuario: <?php echo $usuario; ?><br>
							Clave: <strong><?php echo $pass; ?></strong>
						</p><!-- /Callout Panel -->	
						<p>Puedes cambiar la clave a travez del perfil de usuario en editar perfil</p>

						<p>Muchas gracias. <?php echo APP_NAME ?></p>
						<!-- Callout Panel -->
						<p class="callout">
							<a href="<?php ///echo $urlServ; ?>"><?php //echo $urlServ; ?></a>
						</p><!-- /Callout Panel -->					
												
					
						
					</td>
				</tr>
			</table>
			</div><!-- /content -->
									
		</td>
		<td></td>
	</tr>
</table><!-- /BODY -->

<!-- FOOTER -->
<table class="footer-wrap">
	<tr>
		<td></td>
		<td class="container">
			
				<!-- content -->
				<div class="content">
				<table>
				<tr>
					<td align="center">
						<p>
							
								<a  href="<?php echo site_url('') ?>" ><?php echo APP_WEB;?></a> 
						
						</p>
					</td>
				</tr>
			</table>
				</div><!-- /content -->
				
		</td>
		<td></td>
	</tr>
</table><!-- /FOOTER -->

</body>
</html>