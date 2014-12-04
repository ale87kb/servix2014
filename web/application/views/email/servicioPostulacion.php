<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- If you delete this meta tag, Half Life 3 will never be released. -->
<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Te han recomendado un Servix ;)</title>
	
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
						<h3>Hola, <?php echo ucfirst($nombreUs );?> </h3>
						<p class="lead">Tienes una nueva postulaci&oacute;n en tu solicitud de <a href="<?php echo $linkSS; ?>"><strong><?php  echo $nombreSS; ?></strong></a></p>
						
						<!-- Callout Panel -->
						<h4>Sus datos de contacto son:</h4>

						<ul>
							<li>Nombre: <?php echo $nombreUP." ".$apellidoUP; ?></li>
							<li>Email: <?php echo $emailUP; ?></li>
							<?php 
							if(isset($telefonoUP)){
							?>
								<li>Tel&eacute;fono: <?php echo $telefonoUP; ?></li>
							 <?php
								
							}
							?>
						</ul>
						<p class="callout">
							
							Si estas interesado en esta postulaci&oacute;n ponte en contacto con &eacute;l

						</p><!-- /Callout Panel		 -->			
												
					
						
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