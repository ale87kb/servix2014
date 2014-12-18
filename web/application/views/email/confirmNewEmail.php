<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- If you delete this meta tag, Half Life 3 will never be released. -->
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Confirmación de e-mail de usuario en <?php echo APP_NAME;?></title>
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
					<td><a href="<?php echo site_url(); ?>"><img src="<?php echo site_url('assets/images/servix_logo_48.png'); ?>" alt="Logo <?php echo APP_NAME;?>" /></a></td>
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
						<h3>Hola <?php echo $nombre ?></h3>
						<p class="lead">Has modificado tu e-mail de usuario en <?php echo APP_NAME;?></p>
						<p class="lead">Para seguir explorarando servicios y compartir tus propios servicios, 
							debemos confirmar que eres una persona y no un robot.</p>
						<p class="lead">Para completar el cambio de e-mail, haz click en el siguiente botón:</p>
						<table cellspacing="0" cellpadding="0" border="0" align="center" width="360">
							<tbody>
								<tr>
								    <td>
								        <p style="width:300px;background:#2786C2;font-family:helvetica, arial, sans-serif;font-size:18px;line-height:18px;text-align:center;padding:14px 10px;border-radius:6px;">
								        	<a target="_blank" style="color:#fff;text-decoration:none;" href="<?php echo site_url('usuario/verificar?codigo='.$codigo.'&amp;source=email') ?>">
								        		<strong>Completar el registro</strong>
								        	</a>
								        </p>
								        <p><a href="<?php echo site_url('usuario/verificar?codigo='.$codigo.'&amp;source=email') ?>"><?php echo site_url('usuario/verificar?codigo='.$codigo.'&amp;source=email') ?></a></p>
								    </td>
								</tr>
							</tbody>
						</table>
						<p class="lead"><?php echo APP_NAME;?></p>
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
					<td>
					<p style="font-size: 11px;">Este mensaje se envió a <a href="mailto:<?php echo $usuario; ?>"><?php echo $usuario; ?></a>. Si no quieres recibir estos mensajes de <?php echo APP_NAME;?> en el futuro, <a href="#">cancela tu suscripción</a>.</p>
					<p style="font-size: 11px;"><?php echo APP_WEB;?></p>
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