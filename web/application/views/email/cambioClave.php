<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- If you delete this meta tag, Half Life 3 will never be released. -->
<meta name="viewport" content="width=device-width" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Modificacion en Clave en Servix</title>
	
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
						<td><img src="http://placehold.it/200x50/&text=SERVIX" /></td>
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
						<h3>Hola <?php echo $usuario ?></h3>
						<p class="lead">Modificaste tu contraseña en Servix.</p>
						<p class="lead">Tus nuevos datos para iniciar sesión son los siguientes:</p>

						<table>
							<tr>
								<td>Usuario:</td>
								<td><?php echo $usuario ;?></td>
							</tr>
							<tr>
								<td>Clave:</td>
								<td><?php echo $clave ;?></td>
							</tr>
						</table>

						<p class="lead">Te recordamos que puedes modificar tu clave cuantas veces quieras.</p>
						<p class="lead">Te invitamos a iniciar sesión en el sitio para seguir disfrutando de Servix</p>

						<p class="lead">¡Saludos!</p>
						<p class="lead"><a href="<?php echo site_url('') ?>">Servix</a></p>
						
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
							
							<a href="#">www.servixs.com.ar</a> 
						
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